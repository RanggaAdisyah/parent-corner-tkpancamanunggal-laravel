<?php

namespace Tests\Feature\OrangTua;

use App\Models\Guru;
use App\Models\KalenderKegiatan;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Carbon\Carbon;

/**
 * White-Box Testing — Modul Dashboard Orang Tua
 * UT-101
 */
class DashboardTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-101 — dashboard: Menampilkan semua data rangkuman dengan benar
    // ---------------------------------------------------------------
    public function test_dashboard_displays_correct_data(): void
    {
        // 1. Buat User & Orang Tua
        $user = User::factory()->create([
            'email'    => 'ortu_dash@test.com',
            'username' => '08123456789',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Budi',
            'nama_ibu' => 'Ibu Budi',
        ]);

        // 2. Buat Kelas & Siswa
        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas A']);
        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'kelas_id' => $kelas->id,
            'nama' => 'Budi Junior'
        ]);

        // 3. Buat Wali Kelas
        $guru = Guru::factory()->create([
            'kelas_id' => $kelas->id,
            'nama_lengkap' => 'Guru Wali Budi'
        ]);

        // 4. Buat Kalender Kegiatan (Bulan Ini)
        $kegiatan = KalenderKegiatan::factory()->create([
            'judul' => 'Kegiatan Bulan Ini',
            'tanggal' => Carbon::now()->format('Y-m-d')
        ]);

        // 5. Buat Pengumuman untuk kelas
        $pengumuman = Pengumuman::factory()->create([
            'judul' => 'Pengumuman Penting Dashboard'
        ]);
        $pengumuman->kelas()->attach($kelas->id);

        // 6. Buat Kehadiran (50% Hadir -> 1 Hadir, 1 Sakit)
        Kehadiran::factory()->create([
            'siswa_id' => $siswa->id,
            'status' => 'hadir',
            'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d')
        ]);
        Kehadiran::factory()->create([
            'siswa_id' => $siswa->id,
            'status' => 'sakit',
            'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d')
        ]);

        // Login
        $this->actingAs($user);

        // Akses Dashboard
        $response = $this->get('/orang-tua/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.dashboard');
        
        // Assert Data Terkirim ke View
        $response->assertViewHas('siswa');
        $response->assertViewHas('kegiatans');
        $response->assertViewHas('waliKelas');
        $response->assertViewHas('pengumumanTerbaru');
        $response->assertViewHas('persentaseKehadiran');

        // Assert Value Data
        $this->assertEquals(50, $response->viewData('persentaseKehadiran'));
        $this->assertEquals('Guru Wali Budi', $response->viewData('waliKelas')->nama_lengkap);
        $this->assertEquals('Pengumuman Penting Dashboard', $response->viewData('pengumumanTerbaru')->judul);
        
        $kegiatans = $response->viewData('kegiatans');
        $this->assertTrue($kegiatans->contains('judul', 'Kegiatan Bulan Ini'));

        // Assert UI menampilkan info yang benar
        $response->assertSee('Budi Junior'); // Nama siswa
    }
}
