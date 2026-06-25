<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\JadwalPelajaran;
use Illuminate\Support\Facades\Hash;

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
}
