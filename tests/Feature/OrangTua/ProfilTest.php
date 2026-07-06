<?php

namespace Tests\Feature\OrangTua;

use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Profil (Orang Tua)
 * UT-110
 */
class ProfilTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-110 — profil: Menampilkan data diri dan daftar anak
    // ---------------------------------------------------------------
    public function test_profil_displays_user_and_children_data(): void
    {
        $user = User::factory()->create([
            'email'    => 'ortu_profil@test.com',
            'username' => '08999999999',
            'name'     => 'Bapak Andi',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Andi Surya',
        ]);

        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'nama' => 'Andi Junior'
        ]);

        $this->actingAs($user);

        $response = $this->get('/orang-tua/profil');

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.profil');
        
        $response->assertViewHas('user');
        $response->assertViewHas('orangTua');
        $response->assertViewHas('siswas');
        
        $siswasView = $response->viewData('siswas');
        $this->assertCount(1, $siswasView);
        $this->assertEquals('Andi Junior', $siswasView->first()->nama);

        $response->assertSee('Bapak Andi Surya');
        $response->assertSee('Andi Junior');
    }
}
