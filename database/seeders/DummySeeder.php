<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guru;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\Kelas;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        $tkA = Kelas::where('nama_kelas', 'TK A')->first();

        // 1. Guru Aktif (Punya Kelas)
        $userGuru1 = User::create([
            'username' => 'guru.aktif',
            'name' => 'Guru Aktif',
            'email' => 'guru.aktif@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'guru'
        ]);
        Guru::create([
            'user_id' => $userGuru1->id,
            'nama_lengkap' => 'Guru Aktif, S.Pd',
            'kelas_id' => $tkA->id,
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081200000001'
        ]);

        // 2. Guru Kosong (Tanpa Kelas)
        $userGuru2 = User::create([
            'username' => 'guru.kosong',
            'name' => 'Guru Kosong',
            'email' => 'guru.kosong@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'guru'
        ]);
        Guru::create([
            'user_id' => $userGuru2->id,
            'nama_lengkap' => 'Guru Tanpa Kelas',
            'kelas_id' => null,
            'jenis_kelamin' => 'Laki-laki',
            'no_hp' => '081200000002'
        ]);

        // 3. Ortu Lengkap (Anak di TK A)
        $userOrtu1 = User::create([
            'username' => 'ortu.lengkap',
            'name' => 'Ortu Lengkap',
            'email' => 'ortu.lengkap@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'orang_tua'
        ]);
        $ortu1 = OrangTua::create([
            'user_id' => $userOrtu1->id,
            'nama_ayah' => 'Ayah Lengkap',
            'nama_ibu' => 'Ibu Lengkap',
            'no_hp' => '081200000003'
        ]);
        Siswa::create([
            'orang_tua_id' => $ortu1->id,
            'kelas_id' => $tkA->id,
            'nama' => 'Anak Lengkap',
            'nis' => '111111',
            'jenis_kelamin' => 'Laki-laki'
        ]);

        // 4. Ortu Anak Tanpa Kelas
        $userOrtu2 = User::create([
            'username' => 'ortu.tanpakelas',
            'name' => 'Ortu Tanpa Kelas',
            'email' => 'ortu.tanpakelas@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'orang_tua'
        ]);
        $ortu2 = OrangTua::create([
            'user_id' => $userOrtu2->id,
            'nama_ayah' => 'Ayah Tanpa Kelas',
            'nama_ibu' => 'Ibu Tanpa Kelas',
            'no_hp' => '081200000004'
        ]);
        Siswa::create([
            'orang_tua_id' => $ortu2->id,
            'kelas_id' => null,
            'nama' => 'Anak Tanpa Kelas',
            'nis' => '222222',
            'jenis_kelamin' => 'Perempuan'
        ]);

        // 5. Ortu Kosong (Tanpa Siswa)
        $userOrtu3 = User::create([
            'username' => 'ortu.kosong',
            'name' => 'Ortu Kosong',
            'email' => 'ortu.kosong@gmail.com',
            'password' => bcrypt('password123'),
            'role' => 'orang_tua'
        ]);
        OrangTua::create([
            'user_id' => $userOrtu3->id,
            'nama_ayah' => 'Ayah Kosong',
            'nama_ibu' => 'Ibu Kosong',
            'no_hp' => '081200000005'
        ]);
    }
}
