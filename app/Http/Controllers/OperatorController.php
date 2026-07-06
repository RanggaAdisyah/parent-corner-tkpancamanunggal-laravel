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
    public function indexDashboard()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalFoto = Galeri::count();
        $fotoBulanIni = Galeri::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
        $pengumumanTerkini = Pengumuman::with('kelas')->latest()->take(3)->get();

        return view('operator.dashboard', compact(
            'totalSiswa', 'totalGuru', 'totalFoto', 'fotoBulanIni', 'pengumumanTerkini'
        ));
    }

    public function indexSiswa()
    {
        $daftarSiswa = Siswa::with('orangTua')->get();
        $kelasList = Kelas::all();
        return view('operator.data_siswa', compact('daftarSiswa', 'kelasList'));
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required',
            'nis' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        $kelas = Kelas::find($request->kelas_id);
        $request->merge([
            'kelas' => $kelas ? ($kelas->tingkat . ' - ' . $kelas->nama_kelas) : ''
        ]);

        Siswa::create($request->all());
        return redirect()->back()->with('success', 'Data Siswa berhasil ditambahkan!');
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas_id' => 'required',
            'nis' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
        ]);

        $kelas = Kelas::find($request->kelas_id);
        $request->merge([
            'kelas' => $kelas ? ($kelas->tingkat . ' - ' . $kelas->nama_kelas) : ''
        ]);

        $siswa->update($request->all());
        return redirect()->back()->with('success', 'Data Siswa berhasil diperbarui!');
    }

    public function destroySiswa($id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data Siswa berhasil dihapus!');
    }

    public function indexOrangTua()
    {
        // Ambil semua data orang tua beserta anaknya
        $daftarOrangTua = OrangTua::with(['siswas', 'user'])->get();
        return view('operator.kelola_orang_tua', compact('daftarOrangTua'));
    }

    public function createOrangTua()
    {
        $siswas = Siswa::whereNull('orang_tua_id')->get(); // Anak yang belum punya wali
        return view('operator.buat_orang_tua', compact('siswas'));
    }

    public function storeOrangTua(Request $request)
    {
        $request->merge([
            'siswa_id' => array_filter($request->siswa_id ?? [])
        ]);

        $request->validate([
            'no_hp' => 'required|string|unique:users,username',
            'password' => 'required|min:6',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'siswa_id' => 'required|array|min:1', // Harus memilih minimal 1 siswa
        ]);

        // 1. Buat User (Login)
        $user = User::create([
            'name' => $request->nama_ayah, // default menggunakan nama ayah
            'username' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'orang_tua'
        ]);

        // 2. Buat Orang Tua
        $orangTua = OrangTua::create([
            'user_id' => $user->id,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        // 3. Hubungkan Anak (Siswa) ke Orang Tua ini
        if ($request->has('siswa_id')) {
            Siswa::whereIn('id', $request->siswa_id)->update(['orang_tua_id' => $orangTua->id]);
        }

        return redirect()->route('operator.kelola_orang_tua')->with('success', 'Akun Orang Tua berhasil ditambahkan!');
    }

    public function destroyOrangTua($id)
    {
        $user = User::findOrFail($id);
        
        $orangTua = OrangTua::where('user_id', $id)->first();
        if ($orangTua) {
            // Unlink anak-anaknya agar tidak yatim piatu di database (jangan dihapus)
            Siswa::where('orang_tua_id', $orangTua->id)->update(['orang_tua_id' => null]);
        }

        // Hapus user (yang akan cascade menghapus orang_tuas jika sudah diatur di DB)
        $user->delete();

        return redirect()->back()->with('success', 'Akun Orang Tua berhasil dihapus!');
    }

    public function editOrangTua($id)
    {
        $orangTua = OrangTua::with(['siswas', 'user'])->where('user_id', $id)->firstOrFail();
        $siswas = Siswa::whereNull('orang_tua_id')->orWhere('orang_tua_id', $orangTua->id)->get();
        return view('operator.edit_orang_tua', compact('orangTua', 'siswas'));
    }

    public function updateOrangTua(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->merge([
            'siswa_id' => array_filter($request->siswa_id ?? [])
        ]);

        $rules = [
            'no_hp' => 'required|string|unique:users,username,'.$id,
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'siswa_id' => 'required|array|min:1',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        $user->name = $request->nama_ayah;
        $user->username = $request->no_hp;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        $orangTua = OrangTua::where('user_id', $id)->first();
        if ($orangTua) {
            $orangTua->update([
                'nama_ayah' => $request->nama_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            // Detach previous students that are not in the new array
            Siswa::where('orang_tua_id', $orangTua->id)
                 ->whereNotIn('id', $request->siswa_id)
                 ->update(['orang_tua_id' => null]);
            
            // Attach selected students
            Siswa::whereIn('id', $request->siswa_id)->update(['orang_tua_id' => $orangTua->id]);
        }

        return redirect()->route('operator.kelola_orang_tua')->with('success', 'Data Akun Orang Tua berhasil diperbarui!');
    }

    // --- KELOLA GURU ---
    public function indexGuru()
    {
        $daftarGuru = Guru::with(['user', 'kelas'])->get();
        $kelasList = Kelas::all();
        return view('operator.kelola_guru', compact('daftarGuru', 'kelasList'));
    }

    public function createGuru()
    {
        $kelasList = Kelas::all();
        return view('operator.buat_guru', compact('kelasList'));
    }

    public function storeGuru(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|unique:users,username', // Hybrid login dengan nomor WA sebagai username
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nama_lengkap' => 'required',
        ]);

        $user = User::create([
            'name' => $request->nama_lengkap,
            'username' => $request->no_hp,
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
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->route('operator.kelola-guru')->with('success', 'Akun Guru berhasil ditambahkan!');
    }

    public function editGuru($id)
    {
        $guru = Guru::where('user_id', $id)->firstOrFail();
        $kelasList = Kelas::all();
        return view('operator.edit_guru', compact('guru', 'kelasList'));
    }

    public function updateGuru(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $rules = [
            'email' => 'required|email|unique:users,email,'.$id,
            'no_hp' => 'required|unique:users,username,'.$id,
            'nama_lengkap' => 'required',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'min:6';
        }

        $request->validate($rules);

        $user->name = $request->nama_lengkap;
        $user->username = $request->no_hp;
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
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
            ]);
        }

        return redirect()->route('operator.kelola-guru')->with('success', 'Akun Guru berhasil diperbarui!');
    }

    public function destroyGuru($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Cascades ke guru jika diset foreign key on delete cascade
        
        return redirect()->route('operator.kelola-guru')->with('success', 'Akun Guru berhasil dihapus!');
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
            'nama_kelas' => 'nullable|string',
        ]);

        $data = $request->all();
        if (empty($data['nama_kelas'])) {
            $data['nama_kelas'] = $data['tingkat'];
        }

        Kelas::create($data);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function updateKelas(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $request->validate([
            'tingkat' => 'required',
            'nama_kelas' => 'nullable|string',
        ]);

        $data = $request->all();
        if (empty($data['nama_kelas'])) {
            $data['nama_kelas'] = $data['tingkat'];
        }

        $kelas->update($data);

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

    public function profil()
    {
        $user = auth()->user();
        return view('operator.profil', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('operator.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function backupSemua()
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // ── Sheet 1: Orang Tua ─────────────────────────────────────────
        $sheetOT = $spreadsheet->getActiveSheet();
        $sheetOT->setTitle('Orang Tua');
        $sheetOT->fromArray(['ID','Username (No HP)','Nama Ayah','Nama Ibu','No HP','Alamat','Daftar Anak','Dibuat Pada'], NULL, 'A1');
        
        $dataOT = [];
        foreach (\App\Models\OrangTua::with(['user','siswas'])->get() as $ot) {
            $dataOT[] = [
                $ot->id,
                $ot->user->username ?? '-',
                $ot->nama_ayah ?? '-',
                $ot->nama_ibu  ?? '-',
                $ot->no_hp     ?? '-',
                $ot->alamat    ?? '-',
                $ot->siswas->pluck('nama')->implode(', ') ?: '-',
                $ot->created_at->format('d/m/Y H:i'),
            ];
        }
        $sheetOT->fromArray($dataOT, NULL, 'A2');

        // ── Sheet 2: Guru ──────────────────────────────────────────────
        $sheetGuru = $spreadsheet->createSheet();
        $sheetGuru->setTitle('Guru');
        $sheetGuru->fromArray(['ID','Nama Lengkap','NIP','Jabatan','Kelas','No HP','Email','Alamat','Jenis Kelamin','Tanggal Lahir','Dibuat Pada'], NULL, 'A1');
        
        $dataGuru = [];
        foreach (\App\Models\Guru::with(['user','kelas'])->get() as $g) {
            $dataGuru[] = [
                $g->id,
                $g->nama_lengkap  ?? '-',
                $g->nip           ?? '-',
                $g->jabatan       ?? '-',
                $g->kelas ? $g->kelas->tingkat.' - '.$g->kelas->nama_kelas : '-',
                $g->no_hp         ?? '-',
                $g->user->email   ?? '-',
                $g->alamat        ?? '-',
                $g->jenis_kelamin ?? '-',
                $g->tanggal_lahir ?? '-',
                $g->created_at->format('d/m/Y H:i'),
            ];
        }
        $sheetGuru->fromArray($dataGuru, NULL, 'A2');

        // ── Sheet 3: Siswa ─────────────────────────────────────────────
        $sheetSiswa = $spreadsheet->createSheet();
        $sheetSiswa->setTitle('Siswa');
        $sheetSiswa->fromArray(['ID','Nama','NIS','Kelas','Jenis Kelamin','Tanggal Lahir','Dibuat Pada'], NULL, 'A1');
        
        $dataSiswa = [];
        foreach (\App\Models\Siswa::with('kelasLokal')->get() as $s) {
            $dataSiswa[] = [
                $s->id,
                $s->nama           ?? '-',
                $s->nis            ?? '-',
                $s->kelasLokal ? $s->kelasLokal->tingkat.' - '.$s->kelasLokal->nama_kelas : '-',
                $s->jenis_kelamin  ?? '-',
                $s->tanggal_lahir  ?? '-',
                $s->created_at->format('d/m/Y H:i'),
            ];
        }
        $sheetSiswa->fromArray($dataSiswa, NULL, 'A2');

        // ── Sheet 4: Nilai ─────────────────────────────────────────────
        $sheetNilai = $spreadsheet->createSheet();
        $sheetNilai->setTitle('Nilai');
        $sheetNilai->fromArray(['ID','Siswa','Tanggal','Level','Hal','Nilai','Keterangan'], NULL, 'A1');
        
        $dataNilai = [];
        foreach (\App\Models\Nilai::with('siswa')->get() as $n) {
            $dataNilai[] = [
                $n->id,
                $n->siswa->nama ?? '-',
                $n->tanggal     ?? '-',
                $n->level       ?? '-',
                $n->hal         ?? '-',
                $n->nilai       ?? '-',
                $n->keterangan  ?? '-',
            ];
        }
        $sheetNilai->fromArray($dataNilai, NULL, 'A2');

        // ── Sheet 5: Kehadiran ─────────────────────────────────────────
        $sheetKehadiran = $spreadsheet->createSheet();
        $sheetKehadiran->setTitle('Kehadiran');
        $sheetKehadiran->fromArray(['ID','Siswa','Tanggal','Status'], NULL, 'A1');
        
        $dataKehadiran = [];
        foreach (\App\Models\Kehadiran::with('siswa')->get() as $k) {
            $dataKehadiran[] = [
                $k->id,
                $k->siswa->nama ?? '-',
                $k->tanggal     ?? '-',
                $k->status      ?? '-',
            ];
        }
        $sheetKehadiran->fromArray($dataKehadiran, NULL, 'A2');

        // Set active sheet to the first one
        $spreadsheet->setActiveSheetIndex(0);

        $tanggal = now()->format('d-m-Y_H-i');
        $fileName = "backup_semua_{$tanggal}.xlsx";
        $tempPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $fileName;

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($tempPath);

        return response()->download($tempPath, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
}
