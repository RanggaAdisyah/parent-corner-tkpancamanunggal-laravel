<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Guru Dashboard
 * UT-071
 */
class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private function createGuruAndLogin(): User
    {
        $user = User::factory()->create([
            'email'    => 'guru@test.com',
            'username' => '08222222222',
            'password' => Hash::make('password123'),
            'role'     => 'guru',
        ]);

        $kelas = Kelas::factory()->create();

        Guru::factory()->create([
            'user_id' => $user->id,
            'kelas_id' => $kelas->id
        ]);

        // Buat 3 siswa di kelas tersebut
        Siswa::factory()->count(3)->create([
            'kelas_id' => $kelas->id
        ]);

        $this->actingAs($user);

        return $user;
    }

    // ---------------------------------------------------------------
    // UT-071 — dashboard: Menampilkan data dashboard guru
    // ---------------------------------------------------------------
    public function test_guru_dashboard_displays_correct_data(): void
    {
        $this->createGuruAndLogin();

        $response = $this->get('/guru/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('guru.dashboard');
        
        $response->assertViewHas('guru');
        $response->assertViewHas('jumlahMurid', 3);
    }
}
