<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\JadwalPelajaran;
use App\Models\KalenderKegiatan;
use App\Models\Guru;
use App\Models\Pengumuman;
use App\Models\Galeri;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OperatorController extends Controller
{
    public function indexWali()
    {
        // Ambil semua data orang tua beserta anaknya
        $daftarWali = OrangTua::with(['siswas', 'user'])->get();
        $kelasList = Kelas::all();
        return view('operator.kelola_wali', compact('daftarWali', 'kelasList'));
    }

    public function storeWali(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nama_anak' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ]);

        // 1. Buat User (Login)
        $user = User::create([
            'name' => $request->nama_ayah, // default menggunakan nama ayah
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'orang_tua'
        ]);

        // 2. Buat Orang Tua
        $orangTua = OrangTua::create([
            'user_id' => $user->id,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        // 3. Buat Siswa
        Siswa::create([
            'orang_tua_id' => $orangTua->id,
            'nama' => $request->nama_anak,
            'kelas' => $request->kelas,
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->back()->with('success', 'Akun Wali berhasil ditambahkan!');
    }

    public function destroyWali($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // Karena kita set cascade di migrasi, orang_tuas dan siswas yang terkait dengan user ini seharusnya terhapus jika di DB di-set cascade. 
        // Jika tidak, mari kita hapus manual untuk aman.
        $orangTua = OrangTua::where('user_id', $id)->first();
        if ($orangTua) {
            Siswa::where('orang_tua_id', $orangTua->id)->delete();
            $orangTua->delete();
        }

        return redirect()->back()->with('success', 'Akun Wali berhasil dihapus!');
    }

    public function updateWali(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'email' => 'required|email|unique:users,email,'.$id,
            'nama_anak' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
        ];

        // Only validate password if it's filled
        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        // Update User
        $user->name = $request->nama_ayah;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Update Orang Tua
        $orangTua = OrangTua::where('user_id', $id)->first();
        if ($orangTua) {
            $orangTua->update([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

            // Update Siswa
            $siswa = Siswa::where('orang_tua_id', $orangTua->id)->first();
            if ($siswa) {
                $siswa->update([
                    'nama' => $request->nama_anak,
                    'kelas' => $request->kelas,
                    'nis' => $request->nis,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'tanggal_lahir' => $request->tanggal_lahir,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Data Akun Wali berhasil diperbarui!');
    }

    // --- KELOLA GURU ---
    public function indexGuru()
    {
        $daftarGuru = Guru::with(['user', 'kelas'])->get();
        $kelasList = Kelas::all();
        return view('operator.kelola_guru', compact('daftarGuru', 'kelasList'));
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
        ]);

        $user = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru'
        ]);

        Guru::create([
            'user_id' => $user->id,
            'nama_lengkap' => $request->nama_lengkap,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
            'kelas_id' => $request->kelas_id,
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Akun Guru berhasil ditambahkan!');
    }

    public function updateGuru(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'email' => 'required|email|unique:users,email,'.$id,
            'nama_lengkap' => 'required',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $guru = Guru::where('user_id', $id)->first();
        if ($guru) {
            $guru->update([
                'nama_lengkap' => $request->nama_lengkap,
                'jabatan' => $request->jabatan,
                'nip' => $request->nip,
                'kelas_id' => $request->kelas_id,
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);
        }

        return redirect()->back()->with('success', 'Data Guru berhasil diperbarui!');
    }

    public function destroyGuru($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        // The foreign key cascade will delete the guru automatically.
        return redirect()->back()->with('success', 'Akun Guru berhasil dihapus!');
    }

    // --- KELOLA KELAS ---
    public function indexKelas()
    {
        $kelasList = Kelas::all();
        return view('operator.kelola_kelas', compact('kelasList'));
    }

    public function storeKelas(Request $request)
    {
        $request->validate([
            'tingkat' => 'required',
            'nama_kelas' => 'required',
        ]);

        Kelas::create($request->all());

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function updateKelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $request->validate([
            'tingkat' => 'required',
            'nama_kelas' => 'required',
        ]);

        $kelas->update($request->all());

        return redirect()->back()->with('success', 'Kelas berhasil diperbarui!');
    }

    public function destroyKelas($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->back()->with('success', 'Kelas berhasil dihapus!');
    }

    // --- JADWAL PELAJARAN KELAS ---
    public function indexJadwalKelas($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $jadwalList = JadwalPelajaran::where('kelas_id', $kelas_id)->orderBy('jam_mulai')->get();
        return view('operator.jadwal_kelas', compact('kelas', 'jadwalList'));
    }

    public function storeJadwalKelas(Request $request, $kelas_id)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'kegiatan' => 'required'
        ]);

        JadwalPelajaran::create([
            'kelas_id' => $kelas_id,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kegiatan' => $request->kegiatan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function updateJadwalKelas(Request $request, $id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'kegiatan' => 'required'
        ]);

        $jadwal->update($request->all());

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroyJadwalKelas($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }

    // --- KALENDER KEGIATAN ---
    public function indexKalenderKegiatan()
    {
        $kegiatanList = KalenderKegiatan::orderBy('tanggal', 'asc')->orderBy('waktu_mulai', 'asc')->get();
        return view('operator.kalender_kegiatan', compact('kegiatanList'));
    }

    public function storeKalenderKegiatan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'kategori' => 'required|string'
        ]);

        KalenderKegiatan::create($request->all());
        return redirect()->back()->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    public function updateKalenderKegiatan(Request $request, $id)
    {
        $kegiatan = KalenderKegiatan::findOrFail($id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'kategori' => 'required|string'
        ]);

        $kegiatan->update($request->all());
        return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui!');
    }

    public function destroyKalenderKegiatan($id)
    {
        $kegiatan = KalenderKegiatan::findOrFail($id);
        $kegiatan->delete();
        return redirect()->back()->with('success', 'Kegiatan berhasil dihapus!');
    }

    // --- PENGUMUMAN ---
    public function indexPengumuman()
    {
        $pengumumans = Pengumuman::with('kelas')->latest()->get();
        return view('operator.daftar_pengumuman', compact('pengumumans'));
    }

    public function createPengumuman()
    {
        $kelasList = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('operator.buat_pengumuman', compact('kelasList'));
    }

    public function storePengumuman(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'isi_pesan'    => 'required|string',
            'target_kelas' => 'required|array|min:1',
            'lampiran.*'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $lampiranPaths = [];
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/pengumuman'), $filename);
                $lampiranPaths[] = 'uploads/pengumuman/' . $filename;
            }
        }

        $pengumuman = Pengumuman::create([
            'judul' => $request->judul,
            'isi_pesan' => $request->isi_pesan,
            'lampiran' => !empty($lampiranPaths) ? $lampiranPaths : null,
        ]);

        $pengumuman->kelas()->attach($request->target_kelas);

        return redirect()->route('operator.pengumuman')
            ->with('success', 'Pengumuman "' . $request->judul . '" berhasil dikirim!');
    }

    public function editPengumuman($id)
    {
        $pengumuman = Pengumuman::with('kelas')->findOrFail($id);
        $kelasList = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();
        return view('operator.edit_pengumuman', compact('pengumuman', 'kelasList'));
    }

    public function updatePengumuman(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul'        => 'required|string|max:255',
            'isi_pesan'    => 'required|string',
            'target_kelas' => 'required|array|min:1',
            'lampiran.*'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        $currentFiles = is_array($pengumuman->lampiran) ? $pengumuman->lampiran : [];

        // Hapus file yang diminta oleh user
        if ($request->has('deleted_files')) {
            foreach ($request->deleted_files as $deletedFile) {
                if (($key = array_search($deletedFile, $currentFiles)) !== false) {
                    if (file_exists(public_path($deletedFile))) {
                        unlink(public_path($deletedFile));
                    }
                    unset($currentFiles[$key]);
                }
            }
            // Re-index array
            $currentFiles = array_values($currentFiles);
        }

        // Tambah file baru
        if ($request->hasFile('lampiran')) {
            foreach ($request->file('lampiran') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/pengumuman'), $filename);
                $currentFiles[] = 'uploads/pengumuman/' . $filename;
            }
        }

        $pengumuman->judul = $request->judul;
        $pengumuman->isi_pesan = $request->isi_pesan;
        $pengumuman->lampiran = !empty($currentFiles) ? $currentFiles : null;
        $pengumuman->save();

        $pengumuman->kelas()->sync($request->target_kelas);

        return redirect()->route('operator.pengumuman')
            ->with('success', 'Pengumuman "' . $pengumuman->judul . '" berhasil diperbarui!');
    }

    public function destroyPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
        if (is_array($pengumuman->lampiran)) {
            foreach ($pengumuman->lampiran as $file) {
                if (file_exists(public_path($file))) {
                    unlink(public_path($file));
                }
            }
        }

        $pengumuman->delete();

        return redirect()->route('operator.pengumuman')->with('success', 'Pengumuman berhasil dihapus!');
    }

    public function indexGaleri()
    {
        $galeris = Galeri::with('kelas')->latest('tanggal_kegiatan')->get();
        return view('operator.galeri_kegiatan', compact('galeris'));
    }

    public function createGaleri()
    {
        $kelasList = \App\Models\Kelas::all();
        return view('operator.buat_galeri', compact('kelasList'));
    }

    public function storeGaleri(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori' => 'nullable|array',
            'target_kelas' => 'required|array',
            'target_kelas.*' => 'exists:kelas,id',
            'foto' => 'nullable|array',
            'foto.*' => 'file|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $uploadedPhotos = [];
        $newPathsMap = [];
        if ($request->hasFile('foto')) {
            foreach ($request->file('foto') as $file) {
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
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

        $galeri = Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi_kegiatan,
            'tanggal_kegiatan' => $request->tanggal_kegiatan,
            'kategori' => $request->kategori,
            'foto' => !empty($uploadedPhotos) ? $uploadedPhotos : null,
        ]);

        $galeri->kelas()->attach($request->target_kelas);

        return redirect()->route('operator.galeri')
            ->with('success', 'Galeri "' . $galeri->judul . '" berhasil dibuat!');
    }

    public function editGaleri($id)
    {
        $galeri = Galeri::with('kelas')->findOrFail($id);
        $kelasList = \App\Models\Kelas::all();
        $selectedKelas = $galeri->kelas->pluck('id')->toArray();
        return view('operator.edit_galeri', compact('galeri', 'kelasList', 'selectedKelas'));
    }

    public function updateGaleri(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi_kegiatan' => 'nullable|string',
            'tanggal_kegiatan' => 'nullable|date',
            'kategori' => 'nullable|array',
            'target_kelas' => 'required|array',
            'target_kelas.*' => 'exists:kelas,id',
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
                $filename = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
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

        $galeri->kelas()->sync($request->target_kelas);

        return redirect()->route('operator.galeri')
            ->with('success', 'Galeri "' . $galeri->judul . '" berhasil diperbarui!');
    }

    public function destroyGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        if (is_array($galeri->foto)) {
            foreach ($galeri->foto as $file) {
                if (file_exists(public_path($file))) {
                    unlink(public_path($file));
                }
            }
        }
        
        $galeri->delete();

        return redirect()->route('operator.galeri')
            ->with('success', 'Galeri berhasil dihapus!');
    }
}
