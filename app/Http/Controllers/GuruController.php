<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kehadiran;
use App\Models\Nilai;
use App\Models\JadwalPelajaran;
use App\Models\Galeri;
use App\Models\Pengumuman;
use App\Models\KalenderKegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendGaleriNotificationJob;
use App\Jobs\SendPengumumanNotificationJob;

class GuruController extends Controller
{
    private function getGuru()
    {
        return Guru::where('user_id', Auth::id())->first();
    }

    public function dashboard()
    {
        $guru = $this->getGuru();
        
        $jumlahMurid = 0;
        if ($guru && $guru->kelas_id) {
            $jumlahMurid = Siswa::where('kelas_id', $guru->kelas_id)
                                ->count();
        }

        return view('guru.dashboard', compact('guru', 'jumlahMurid'));
    }

    public function kehadiran()
    {
        $guru = $this->getGuru();
        $siswas = collect();
        if ($guru && $guru->kelas_id) {
            $siswas = Siswa::where('kelas_id', $guru->kelas_id)
                           ->get();
        }

        return view('guru.kehadiran', compact('guru', 'siswas'));
    }

    public function storeKehadiran(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kehadiran' => 'required|array',
            'kehadiran.*' => 'in:hadir,sakit,izin,alpa',
            'keterangan' => 'nullable|array',
        ]);

        foreach ($request->kehadiran as $siswa_id => $status) {
            Kehadiran::updateOrCreate(
                ['siswa_id' => $siswa_id, 'tanggal' => $request->tanggal],
                [
                    'status' => $status,
                    'keterangan' => $request->keterangan[$siswa_id] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data kehadiran berhasil disimpan.');
    }

    public function getKehadiranTanggal(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date'
        ]);
        
        $guru = $this->getGuru();
        if (!$guru || !$guru->kelas_id) {
            return response()->json([]);
        }

        $siswaIds = Siswa::where('kelas_id', $guru->kelas_id)
                         ->pluck('id');

        $kehadirans = \App\Models\Kehadiran::whereIn('siswa_id', $siswaIds)
                                           ->where('tanggal', $request->tanggal)
                                           ->get();

        return response()->json($kehadirans);
    }

    public function nilai(Request $request)
    {
        $guru = $this->getGuru();
        $siswas = collect();
        if ($guru && $guru->kelas_id) {
            $siswas = Siswa::where('kelas_id', $guru->kelas_id)
                           ->orderBy('nama')
                           ->get();
        }

        $kategoriList = Nilai::kategoriList();
        $skalaList = Nilai::skalaList();

        $existingNilai = [];
        $selectedSiswaId = $request->get('siswa_id');

        if ($selectedSiswaId) {
            // Filter by current week (auto-derive dari tanggal hari ini)
            $today = \Carbon\Carbon::now();
            $bulan = (int) $today->format('n');
            $minggu = (int) ceil($today->day / 7);

            $rows = Nilai::where('siswa_id', $selectedSiswaId)
                      ->whereIn('level', array_keys($kategoriList))
                      ->where('bulan', $bulan)
                      ->where('minggu_ke', $minggu)
                      ->get();

            foreach ($rows as $n) {
                $existingNilai[$n->level] = $n;
            }
        }

        return view('guru.nilai', compact(
            'guru', 'siswas', 'kategoriList', 'skalaList', 'existingNilai', 'selectedSiswaId'
        ));
    }

    public function storeNilai(Request $request)
    {
        $kategoriKeys = array_keys(Nilai::kategoriList());
        $skalaValues = array_keys(Nilai::skalaList());

        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'nilai' => 'required|array',
            'nilai.*.skala' => 'nullable|in:' . implode(',', $skalaValues),
            'nilai.*.keterangan' => 'nullable|string',
        ]);

        $tanggal = \Carbon\Carbon::parse($request->tanggal);
        $bulan = (int) $tanggal->format('n');
        $mingguKe = (int) ceil($tanggal->day / 7); // 1-5
        $siswaId = $request->siswa_id;

        foreach ($kategoriKeys as $kategori) {
            $entry = $request->input("nilai.$kategori", []);
            $skala = $entry['skala'] ?? null;
            $keterangan = $entry['keterangan'] ?? null;
            $shouldDelete = !empty($entry['_delete']);

            // Cari existing record
            $existing = Nilai::where([
                'siswa_id' => $siswaId,
                'tanggal' => $request->tanggal,
                'level' => $kategori,
            ])->first();

            // Toggle OFF (frontend kirim _delete=1) → hapus record
            if ($shouldDelete) {
                if ($existing) {
                    $existing->delete();
                }
                continue;
            }

            // Kalau skala null DAN keterangan null/kosong, lewati
            if (!$skala && (is_null($keterangan) || trim(strip_tags($keterangan)) === '')) {
                continue;
            }

            // Kalau skala null (kosong) tapi record sudah ada → skip supaya tidak timpa nilai
            if (!$skala) {
                if ($existing) {
                    // Hanya update keterangan jika ada perubahan
                    if (!is_null($keterangan)) {
                        $existing->update(['keterangan' => $keterangan]);
                    }
                    continue;
                }
                // Kalau belum ada record, tetap skip (nilai wajib)
                continue;
            }

            Nilai::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'tanggal' => $request->tanggal,
                    'level' => $kategori,
                ],
                [
                    'bulan' => $bulan,
                    'minggu_ke' => $mingguKe,
                    'nilai' => $skala,
                    'keterangan' => $keterangan,
                ]
            );
        }

        return redirect()
            ->route('guru.nilai', [
                'siswa_id' => $siswaId,
                'bulan' => $bulan,
                'minggu_ke' => $mingguKe,
            ])
            ->with('success', 'Penilaian perkembangan berhasil disimpan.');
    }

    public function getNilaiSiswa(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
        ]);

        $kategoriList = Nilai::kategoriList();

        $rows = Nilai::where('siswa_id', $request->siswa_id)
                  ->where('tanggal', $request->tanggal)
                  ->whereIn('level', array_keys($kategoriList))
                  ->get();

        $byKategori = [];
        foreach ($kategoriList as $key => $meta) {
            $row = $rows->firstWhere('level', $key);
            $byKategori[$key] = $row ? [
                'skala' => $row->nilai,
                'keterangan' => $row->keterangan,
            ] : null;
        }

        return response()->json([
            'kategori' => $byKategori,
        ]);
    }

    public function jadwal(Request $request)
    {
        $guru = $this->getGuru();
        $jadwals = collect();
        if ($guru && $guru->kelas_id) {
            $jadwals = JadwalPelajaran::where('kelas_id', $guru->kelas_id)->get();
        }

        // Ambil bulan & tahun (default: sekarang)
        $month = $request->get('month', date('n'));
        $year = $request->get('year', date('Y'));
        
        $kalenders = KalenderKegiatan::whereMonth('tanggal', $month)
                                      ->whereYear('tanggal', $year)
                                      ->get();

        return view('guru.lihat_jadwal', compact('guru', 'jadwals', 'kalenders', 'month', 'year'));
    }

    public function galeri()
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        $galeris = collect();
        if ($guru) {
            $galeris = Galeri::where(function($q) use ($kelas_id, $guru) {
                if ($kelas_id) {
                    $q->whereHas('kelas', function($qq) use ($kelas_id) {
                        $qq->where('kelas_id', $kelas_id);
                    });
                }
                // Include galeri yang ditargetkan ke siswa di kelas guru ini
                $siswaIds = Siswa::where('kelas_id', $kelas_id)->pluck('id');
                if ($siswaIds->isNotEmpty()) {
                    $q->orWhereHas('siswa', function($qq) use ($siswaIds) {
                        $qq->whereIn('siswa_id', $siswaIds);
                    });
                }
            })->with(['kelas', 'siswa'])->latest()->get();
        }

        return view('guru.galeri', compact('guru', 'galeris'));
    }

    public function createGaleri()
    {
        $guru = $this->getGuru();
        $siswaList = $guru && $guru->kelas_id
            ? Siswa::where('kelas_id', $guru->kelas_id)->orderBy('nama')->get()
            : collect();
        return view('guru.buat_galeri', compact('guru', 'siswaList'));
    }

    public function storeGaleri(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori' => 'nullable|array',
            'foto' => 'required|array',
            'foto.*' => 'file|mimes:jpg,jpeg,png,webp|max:5120',
            'target_type' => 'required|in:kelas,siswa',
            'target_siswa_id' => 'required_if:target_type,siswa|nullable|integer|exists:siswas,id',
        ]);

        $uploadedPhotos = [];
        $newPathsMap = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $filename = time() . '_' . uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->move(public_path('uploads/galeri'), $filename);
                $path = 'uploads/galeri/' . $filename;
                $uploadedPhotos[] = $path;
                $newPathsMap[$file->getClientOriginalName()] = $path;
            }
        }

        if ($request->filled('cover_image')) {
            $coverVal = $request->cover_image;
            $coverPath = null;
            if (str_starts_with($coverVal, 'new:')) {
                $origName = substr($coverVal, 4);
                if (isset($newPathsMap[$origName])) {
                    $coverPath = $newPathsMap[$origName];
                }
            }
            if ($coverPath && in_array($coverPath, $uploadedPhotos)) {
                $uploadedPhotos = array_diff($uploadedPhotos, [$coverPath]);
                array_unshift($uploadedPhotos, $coverPath);
            }
        }

        $guru = $this->getGuru();

        $galeri = Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'kategori' => $request->kategori,
            'foto' => !empty($uploadedPhotos) ? $uploadedPhotos : null,
        ]);

        if ($guru && $guru->kelas_id) {
            if ($request->target_type === 'siswa' && $request->filled('target_siswa_id')) {
                $siswa = Siswa::where('id', $request->target_siswa_id)
                    ->where('kelas_id', $guru->kelas_id)
                    ->first();
                if ($siswa) {
                    $galeri->siswa()->attach($siswa->id);
                }
            } else {
                $galeri->kelas()->attach($guru->kelas_id);
            }
        }

        // Dispatch notification jobs ke semua ortu terkait
        $this->dispatchGaleriNotifications($galeri, 'created');

        return redirect()->route('guru.galeri')->with('success', 'Galeri berhasil dibuat!');
    }

    private function dispatchGaleriNotifications(Galeri $galeri, string $event = 'created'): void
    {
        try {
            $galeri->loadMissing('kelas', 'siswa');
            $resolver = new \App\Services\NotificationRecipientResolver();
            $recipients = $resolver->forGaleri($galeri);

            foreach ($recipients as $user) {
                SendGaleriNotificationJob::dispatch(
                    $galeri->id,
                    $user->id,
                    $user->email,
                    $user->name ?? 'Orang Tua',
                    $event,
                );
            }
        } catch (\Throwable $e) {
            \Log::error('Galeri notification dispatch failed: ' . $e->getMessage());
        }
    }

    private function findGaleriForGuru($id)
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        // Galeri yang bisa diakses guru:
        // 1. Galeri kelas (ada di pivot galeri_kelas dengan kelas_id guru)
        // 2. Galeri personal (target_type=siswa DAN siswa ada di kelas guru)
        return Galeri::where(function($q) use ($kelas_id) {
            $q->whereHas('kelas', function($sub) use ($kelas_id) {
                $sub->where('kelas_id', $kelas_id);
            });
            if ($kelas_id) {
                $q->orWhereHas('siswa', function($sub) use ($kelas_id) {
                    $sub->where('kelas_id', $kelas_id);
                });
            }
        })->findOrFail($id);
    }

    public function editGaleri($id)
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        $galeri = $this->findGaleriForGuru($id);

        $galeri->load('siswa');
        $siswaList = Siswa::where('kelas_id', $kelas_id)->orderBy('nama')->get();
        $selectedSiswaId = $galeri->siswa->first()?->id;
        $targetType = $galeri->siswa->count() > 0 ? 'siswa' : 'kelas';

        return view('guru.edit_galeri', compact('galeri', 'guru', 'siswaList', 'selectedSiswaId', 'targetType'));
    }

    public function updateGaleri(Request $request, $id)
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        $galeri = $this->findGaleriForGuru($id);

        // Count existing photos yang akan di-keep
        $existingPhotos = is_array($galeri->foto) ? $galeri->foto : [];
        $deletedFiles = $request->input('deleted_files', []);
        $keptExisting = array_diff($existingPhotos, $deletedFiles);

        // Validasi: minimal 1 foto (existing yang di-keep + baru)
        $newFileCount = $request->hasFile('foto') ? count($request->file('foto')) : 0;
        $totalPhotosAfter = count($keptExisting) + $newFileCount;

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori' => 'nullable|array',
            'foto' => 'nullable|array',
            'foto.*' => 'file|mimes:jpg,jpeg,png,webp|max:5120',
            'target_type' => 'required|in:kelas,siswa',
            'target_siswa_id' => 'required_if:target_type,siswa|nullable|integer|exists:siswas,id',
        ], [
            'judul.required' => 'Judul kegiatan wajib diisi.',
        ]);

        // Validasi minimal 1 foto (setelah proses delete)
        if ($totalPhotosAfter < 1) {
            return back()
                ->withInput()
                ->withErrors(['foto' => 'Galeri harus memiliki minimal 1 foto. Silakan tambahkan foto baru sebelum menghapus semua foto lama.']);
        }

        // Keep current photos that weren't deleted
        $currentPhotos = $keptExisting;
        if (!empty($deletedFiles)) {
            foreach ($deletedFiles as $deletedFile) {
                if (file_exists(public_path($deletedFile))) {
                    @unlink(public_path($deletedFile));
                }
            }
        }
        $currentPhotos = array_values($currentPhotos);

        // Add new photos
        $newPathsMap = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $filename = time() . '_' . uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->move(public_path('uploads/galeri'), $filename);
                $path = 'uploads/galeri/' . $filename;
                $currentPhotos[] = $path;
                $newPathsMap[$file->getClientOriginalName()] = $path;
            }
        }

        // Determine cover
        if ($request->filled('cover_image')) {
            $coverVal = $request->cover_image;
            $coverPath = null;
            if (str_starts_with($coverVal, 'old:')) {
                $coverPath = substr($coverVal, 4);
            } elseif (str_starts_with($coverVal, 'new:')) {
                $origName = substr($coverVal, 4);
                if (isset($newPathsMap[$origName])) {
                    $coverPath = $newPathsMap[$origName];
                }
            }

            if ($coverPath && in_array($coverPath, $currentPhotos)) {
                $currentPhotos = array_diff($currentPhotos, [$coverPath]);
                array_unshift($currentPhotos, $coverPath);
            }
        }

        $galeri->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'kategori' => $request->kategori,
            'foto' => !empty($currentPhotos) ? array_values($currentPhotos) : null,
        ]);

        if ($guru && $guru->kelas_id) {
            if ($request->target_type === 'siswa' && $request->filled('target_siswa_id')) {
                $siswa = Siswa::where('id', $request->target_siswa_id)
                    ->where('kelas_id', $guru->kelas_id)
                    ->first();
                if ($siswa) {
                    $galeri->siswa()->sync([$siswa->id]);
                }
            } else {
                $galeri->siswa()->detach();
                $galeri->kelas()->sync([$guru->kelas_id]);
            }
        }

        $this->dispatchGaleriNotifications($galeri, 'updated');

        return redirect()->route('guru.galeri')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroyGaleri($id)
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        $galeri = $this->findGaleriForGuru($id);

        if (is_array($galeri->foto)) {
            foreach ($galeri->foto as $path) {
                if (file_exists(public_path($path))) {
                    unlink(public_path($path));
                }
            }
        }

        $galeri->delete();
        return redirect()->route('guru.galeri')->with('success', 'Galeri berhasil dihapus!');
    }

    public function buatPengumuman()
    {
        return view('guru.pengumuman');
    }

    public function storePengumuman(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi_pengumuman' => 'required|string',
            'lampiran.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:51200',
        ]);

        $guru = $this->getGuru();
        
        $lampiranPaths = [];
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->move(public_path('uploads/pengumuman'), $filename);
                $lampiranPaths[] = 'uploads/pengumuman/' . $filename;
            }
        }

        $pengumuman = Pengumuman::create([
            'judul' => $request->judul,
            'isi_pesan' => $request->isi_pengumuman,
            'lampiran' => !empty($lampiranPaths) ? $lampiranPaths : null,
        ]);

        if ($guru && $guru->kelas_id) {
            $pengumuman->kelas()->attach($guru->kelas_id);
        }

        $this->dispatchPengumumanNotifications($pengumuman, 'created');

        return redirect()->route('guru.daftar-pengumuman')->with('success', 'Pengumuman berhasil dibuat.');
    }

    private function dispatchPengumumanNotifications(Pengumuman $pengumuman, string $event = 'created'): void
    {
        try {
            $resolver = new \App\Services\NotificationRecipientResolver();
            $recipients = $resolver->forPengumuman($pengumuman);

            foreach ($recipients as $user) {
                SendPengumumanNotificationJob::dispatch(
                    $pengumuman->id,
                    $user->id,
                    $user->email,
                    $user->name ?? 'Orang Tua',
                    $event,
                );
            }
        } catch (\Throwable $e) {
            \Log::error('Pengumuman notification dispatch failed: ' . $e->getMessage());
        }
    }

    public function daftarPengumuman()
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        $pengumumans = Pengumuman::whereHas('kelas', function($q) use ($kelas_id) {
            $q->where('kelas_id', $kelas_id);
        })->latest()->paginate(10);

        return view('guru.daftar_pengumuman', compact('pengumumans'));
    }

    public function editPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        if (!$pengumuman->kelas()->where('kelas_id', $kelas_id)->exists()) {
            abort(403, 'Unauthorized action.');
        }

        return view('guru.edit_pengumuman', compact('pengumuman'));
    }

    public function updatePengumuman(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        if (!$pengumuman->kelas()->where('kelas_id', $kelas_id)->exists()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'judul' => 'required|string',
            'isi_pengumuman' => 'required|string',
            'lampiran.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:51200',
        ]);

        $lampiranPaths = is_array($pengumuman->lampiran) ? $pengumuman->lampiran : [];

        if ($request->has('deleted_files')) {
            foreach ($request->deleted_files as $deletedFile) {
                if (($key = array_search($deletedFile, $lampiranPaths)) !== false) {
                    if (file_exists(public_path($deletedFile))) {
                        unlink(public_path($deletedFile));
                    }
                    unset($lampiranPaths[$key]);
                }
            }
            $lampiranPaths = array_values($lampiranPaths);
        }

        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->move(public_path('uploads/pengumuman'), $filename);
                $lampiranPaths[] = 'uploads/pengumuman/' . $filename;
            }
        }

        $pengumuman->update([
            'judul' => $request->judul,
            'isi_pesan' => $request->isi_pengumuman,
            'lampiran' => !empty($lampiranPaths) ? $lampiranPaths : null,
        ]);

        $this->dispatchPengumumanNotifications($pengumuman, 'updated');

        return redirect()->route('guru.daftar-pengumuman')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroyPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        if ($pengumuman->kelas()->where('kelas_id', $kelas_id)->exists()) {
            $pengumuman->kelas()->detach($kelas_id);
            if ($pengumuman->kelas()->count() == 0) {
                $pengumuman->delete();
            }
        }
        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
    }



    public function profil()
    {
        $user = auth()->user();
        $guru = $this->getGuru();
        return view('guru.profil', compact('user', 'guru'));
    }
}
