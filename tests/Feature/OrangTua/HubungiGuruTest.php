<?php

namespace Tests\Feature\OrangTua;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Hubungi Guru (Orang Tua)
 * UT-107
 */
class HubungiGuruTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-107 — hubungiGuru: Menampilkan data wali kelas anak
    // ---------------------------------------------------------------
    public function test_hubungi_guru_displays_wali_kelas_data(): void
    {
        $user = User::factory()->create([
            'email'    => 'ortu_kontak@test.com',
            'username' => '08777777123',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Budi',
        ]);

        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas A']);
        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'kelas_id' => $kelas->id,
            'nama' => 'Budi Junior'
        ]);

        $this->actingAs($user);

        // Buat Wali Kelas
        $userGuru = User::factory()->create(['name' => 'Guru Budi Sudarsono']);
        $guru = Guru::factory()->create([
            'user_id' => $userGuru->id,
            'kelas_id' => $kelas->id,
            'nama_lengkap' => 'Guru Budi Sudarsono',
            'no_hp' => '08123456789'
        ]);

        $response = $this->get('/orang-tua/hubungi-guru');

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.hubungi_guru');
        
        $response->assertViewHas('guru');
        $guruView = $response->viewData('guru');
        
        $this->assertEquals('Guru Budi Sudarsono', $guruView->user->name);
        $this->assertEquals('08123456789', $guruView->no_hp);

        $response->assertSee('Guru Budi Sudarsono');
        $response->assertSee('628123456789');
    }
}
