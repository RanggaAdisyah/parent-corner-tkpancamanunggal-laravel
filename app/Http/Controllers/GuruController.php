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
                                ->orWhere('kelas', optional($guru->kelas)->nama_kelas) // Fallback for old string mapping
                                ->count();
        }

        return view('guru.dashboard', compact('guru', 'jumlahMurid'));
    }

    public function kehadiran()
    {
        $guru = $this->getGuru();
        $siswas = [];
        if ($guru && $guru->kelas_id) {
            $siswas = Siswa::where('kelas_id', $guru->kelas_id)
                           ->orWhere('kelas', optional($guru->kelas)->nama_kelas)
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
                         ->orWhere('kelas', optional($guru->kelas)->nama_kelas)
                         ->pluck('id');

        $kehadirans = \App\Models\Kehadiran::whereIn('siswa_id', $siswaIds)
                                           ->where('tanggal', $request->tanggal)
                                           ->get();

        return response()->json($kehadirans);
    }

    public function nilai()
    {
        $guru = $this->getGuru();
        $siswas = [];
        if ($guru && $guru->kelas_id) {
            $siswas = Siswa::where('kelas_id', $guru->kelas_id)
                           ->orWhere('kelas', optional($guru->kelas)->nama_kelas)
                           ->get();
        }

        return view('guru.nilai', compact('guru', 'siswas'));
    }

    public function storeNilai(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'level' => 'required|string',
            'hal' => 'required|string',
            'nilai' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);

        \App\Models\Nilai::updateOrCreate(
            [
                'siswa_id' => $request->siswa_id, 
                'tanggal' => $request->tanggal,
            ],
            [
                'level' => $request->level,
                'hal' => $request->hal,
                'nilai' => $request->nilai,
                'keterangan' => $request->keterangan,
            ]
        );

        return redirect()->back()->with('success', 'Data nilai berhasil disimpan.');
    }

    public function getNilaiSiswa(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date'
        ]);

        $nilai = \App\Models\Nilai::where('siswa_id', $request->siswa_id)
                                   ->where('tanggal', $request->tanggal)
                                   ->first();

        return response()->json($nilai);
    }

    public function jadwal(Request $request)
    {
        $guru = $this->getGuru();
        $jadwals = [];
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

        $galeris = Galeri::whereHas('kelas', function($q) use ($kelas_id) {
            $q->where('kelas_id', $kelas_id);
        })->latest()->get();
        
        return view('guru.galeri', compact('guru', 'galeris'));
    }

    public function createGaleri()
    {
        $guru = $this->getGuru();
        return view('guru.buat_galeri', compact('guru'));
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
            $galeri->kelas()->attach($guru->kelas_id);
        }

        return redirect()->route('guru.galeri')->with('success', 'Galeri berhasil dibuat!');
    }

    public function editGaleri($id)
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;
        
        $galeri = Galeri::whereHas('kelas', function($q) use ($kelas_id) {
            $q->where('kelas_id', $kelas_id);
        })->findOrFail($id);

        return view('guru.edit_galeri', compact('galeri', 'guru'));
    }

    public function updateGaleri(Request $request, $id)
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        $galeri = Galeri::whereHas('kelas', function($q) use ($kelas_id) {
            $q->where('kelas_id', $kelas_id);
        })->findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori' => 'nullable|array',
            'foto' => 'nullable|array',
            'foto.*' => 'file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Keep current photos that weren't deleted
        $currentPhotos = is_array($galeri->foto) ? $galeri->foto : [];
        if ($request->has('deleted_files')) {
            foreach ($request->deleted_files as $deletedFile) {
                if (($key = array_search($deletedFile, $currentPhotos)) !== false) {
                    unset($currentPhotos[$key]);
                    if (file_exists(public_path($deletedFile))) {
                        unlink(public_path($deletedFile));
                    }
                }
            }
            $currentPhotos = array_values($currentPhotos);
        }

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

        return redirect()->route('guru.galeri')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroyGaleri($id)
    {
        $guru = $this->getGuru();
        $kelas_id = $guru->kelas_id ?? null;

        $galeri = Galeri::whereHas('kelas', function($q) use ($kelas_id) {
            $q->where('kelas_id', $kelas_id);
        })->findOrFail($id);

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

        return redirect()->route('guru.daftar-pengumuman')->with('success', 'Pengumuman berhasil dibuat.');
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
