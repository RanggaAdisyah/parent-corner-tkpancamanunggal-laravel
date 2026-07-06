<?php

namespace Tests\Feature\OrangTua;

use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Carbon\Carbon;

/**
 * White-Box Testing — Modul Lihat Kehadiran (Orang Tua)
 * UT-104
 */
class LihatKehadiranTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-104 — lihatKehadiran: Menampilkan rekap kehadiran bulanan
    // ---------------------------------------------------------------
    public function test_lihat_kehadiran_displays_attendance_summary(): void
    {
        $user = User::factory()->create([
            'email'    => 'ortu_kehadiran@test.com',
            'username' => '08444444444',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Budi',
        ]);

        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'nama' => 'Budi Junior'
        ]);

        $this->actingAs($user);

        $now = Carbon::now();

        // 3 hari absensi: 2 Hadir, 1 Sakit
        Kehadiran::factory()->create([
            'siswa_id' => $siswa->id,
            'tanggal' => $now->copy()->subDays(1)->format('Y-m-d'),
            'status' => 'hadir'
        ]);
        Kehadiran::factory()->create([
            'siswa_id' => $siswa->id,
            'tanggal' => $now->copy()->subDays(2)->format('Y-m-d'),
            'status' => 'hadir'
        ]);
        Kehadiran::factory()->create([
            'siswa_id' => $siswa->id,
            'tanggal' => $now->copy()->subDays(3)->format('Y-m-d'),
            'status' => 'sakit'
        ]);

        $response = $this->get('/orang-tua/lihat-kehadiran?month=' . $now->format('n') . '&year=' . $now->format('Y'));

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.lihat_kehadiran');
        
        $response->assertViewHas('totalHadir', 2);
        $response->assertViewHas('totalSakit', 1);
        $response->assertViewHas('totalIzin', 0);
        $response->assertViewHas('totalAlfa', 0);
        
        // Persentase = (2 hadir / 3 total) * 100 = 67%
        $response->assertViewHas('persentase', 67);

        // Verifikasi array kehadiran di-key dengan tanggal
        $kehadirans = $response->viewData('kehadirans');
        $this->assertArrayHasKey($now->copy()->subDays(1)->format('j'), $kehadirans->toArray());
    }
}
