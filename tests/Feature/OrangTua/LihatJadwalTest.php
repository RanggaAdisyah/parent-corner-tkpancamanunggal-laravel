<?php

namespace Tests\Feature\OrangTua;

use App\Models\JadwalPelajaran;
use App\Models\KalenderKegiatan;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Carbon\Carbon;

/**
 * White-Box Testing — Modul Lihat Jadwal (Orang Tua)
 * UT-103
 */
class LihatJadwalTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-103 — lihatJadwal: Menampilkan jadwal pelajaran & kegiatan
    // ---------------------------------------------------------------
    public function test_lihat_jadwal_displays_jadwal_and_kalender(): void
    {
        $user = User::factory()->create([
            'email'    => 'ortu_jadwal@test.com',
            'username' => '08333333333',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Budi',
        ]);

        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas B']);
        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'kelas_id' => $kelas->id,
            'nama' => 'Budi Junior'
        ]);

        $this->actingAs($user);

        // Buat Jadwal Pelajaran untuk Kelas anak
        $jadwal = JadwalPelajaran::factory()->create([
            'kelas_id' => $kelas->id,
            'hari' => 'Senin',
            'kegiatan' => 'Menggambar'
        ]);

        // Buat Kalender Kegiatan
        $now = Carbon::now();
        $kalender = KalenderKegiatan::factory()->create([
            'tanggal' => $now->format('Y-m-d'),
            'judul' => 'Lomba Mewarnai'
        ]);

        $response = $this->get('/orang-tua/lihat-jadwal?month=' . $now->format('n') . '&year=' . $now->format('Y'));

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.lihat_jadwal');
        
        $response->assertViewHas('jadwals');
        $response->assertViewHas('kalenders');
        
        // Verifikasi jadwal yang diload benar untuk kelas siswa
        $jadwals = $response->viewData('jadwals');
        $this->assertTrue($jadwals->contains('kegiatan', 'Menggambar'));
        $this->assertTrue($jadwals->contains('hari', 'Senin'));

        // Verifikasi kalender yang diload
        $kalenders = $response->viewData('kalenders');
        $this->assertTrue($kalenders->contains('judul', 'Lomba Mewarnai'));

        // Cek UI merender teks dengan benar (ini diasumsikan muncul di HTML)
        $response->assertSee('Menggambar');
        $response->assertSee('Lomba Mewarnai');
    }
}
