<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\KalenderKegiatan;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Jadwal Guru
 * UT-083
 */
class JadwalTest extends TestCase
{
    use RefreshDatabase;

    private function createGuruAndLogin(): array
    {
        $user = User::factory()->create([
            'email'    => 'guru_jadwal@test.com',
            'username' => '08444444444',
            'password' => Hash::make('password123'),
            'role'     => 'guru',
        ]);

        $kelas = Kelas::factory()->create();

        $guru = Guru::factory()->create([
            'user_id' => $user->id,
            'kelas_id' => $kelas->id
        ]);

        $this->actingAs($user);

        return [$user, $kelas, $guru];
    }

    // ---------------------------------------------------------------
    // UT-083 — jadwal: Menampilkan jadwal pelajaran dan kalender
    // ---------------------------------------------------------------
    public function test_jadwal_displays_jadwal_pelajaran_and_kalender(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        // Buat jadwal untuk kelas ini (ditampilkan)
        JadwalPelajaran::factory()->count(2)->create(['kelas_id' => $kelas->id]);
        
        // Buat jadwal untuk kelas lain (tidak ditampilkan)
        JadwalPelajaran::factory()->create(); 
        
        // Buat kalender kegiatan bulan ini
        $now = now();
        KalenderKegiatan::factory()->create([
            'tanggal' => clone $now
        ]);
        // Buat kalender kegiatan bulan depan (tidak ditampilkan)
        KalenderKegiatan::factory()->create([
            'tanggal' => clone $now->addMonths(1)
        ]);

        $response = $this->get('/guru/lihat-jadwal');

        $response->assertStatus(200);
        $response->assertViewIs('guru.lihat_jadwal');
        $response->assertViewHas('guru');
        
        // Assert jadwal
        $response->assertViewHas('jadwals', function ($jadwals) {
            return $jadwals->count() === 2;
        });

        // Assert kalender
        $response->assertViewHas('kalenders', function ($kalenders) {
            return $kalenders->count() === 1;
        });
        
        $response->assertViewHas('month', date('n'));
        $response->assertViewHas('year', date('Y'));
    }
}
