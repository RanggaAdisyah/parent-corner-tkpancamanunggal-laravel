<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Profil Guru
 * UT-097
 */
class ProfilTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-097 — profil: Menampilkan data profil guru (View Only)
    // ---------------------------------------------------------------
    public function test_profil_displays_guru_data(): void
    {
        $user = User::factory()->create([
            'email'    => 'guru_profil@test.com',
            'username' => '08777777777',
            'name'     => 'Budi Sudarsono',
            'password' => Hash::make('password123'),
            'role'     => 'guru',
        ]);

        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas A']);
        $guru = Guru::factory()->create([
            'user_id' => $user->id,
            'kelas_id' => $kelas->id,
            'nama_lengkap' => 'Budi Sudarsono S.Pd',
            'nip' => '123456789'
        ]);

        $this->actingAs($user);

        $response = $this->get('/guru/profil');

        $response->assertStatus(200);
        $response->assertViewIs('guru.profil');
        
        // Assert data is displayed
        $response->assertSee('Budi Sudarsono S.Pd');
        $response->assertSee('123456789');
        $response->assertSee('guru_profil@test.com');
    }
}
