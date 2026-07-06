<?php

namespace Tests\Feature\OrangTua;

use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Pilih Anak (Orang Tua)
 * UT-098 s/d UT-100
 */
class PilihAnakTest extends TestCase
{
    use RefreshDatabase;

    private function createOrangTuaAndLogin(): array
    {
        $user = User::factory()->create([
            'email'    => 'ortu@test.com',
            'username' => '08888888888',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Budi',
            'nama_ibu' => 'Ibu Budi',
        ]);

        $siswa1 = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'nama' => 'Anak Pertama'
        ]);

        $siswa2 = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'nama' => 'Anak Kedua'
        ]);

        $this->actingAs($user);

        return [$user, $orangTua, $siswa1, $siswa2];
    }

    // ---------------------------------------------------------------
    // UT-098 — pilihAnak: Validasi required siswa_id
    // ---------------------------------------------------------------
    public function test_pilih_anak_requires_siswa_id(): void
    {
        $this->createOrangTuaAndLogin();

        $response = $this->post('/orang-tua/pilih-anak', []);

        $response->assertSessionHasErrors(['siswa_id']);
    }

    // ---------------------------------------------------------------
    // UT-099 — pilihAnak: Validasi exists siswa_id
    // ---------------------------------------------------------------
    public function test_pilih_anak_validates_existing_siswa_id(): void
    {
        $this->createOrangTuaAndLogin();

        $response = $this->post('/orang-tua/pilih-anak', [
            'siswa_id' => 99999 // Non-existent ID
        ]);

        $response->assertSessionHasErrors(['siswa_id']);
    }

    // ---------------------------------------------------------------
    // UT-100 — pilihAnak: Sukses menyimpan ke session dan redirect back
    // ---------------------------------------------------------------
    public function test_pilih_anak_sets_session_and_redirects_back(): void
    {
        [$user, $orangTua, $siswa1, $siswa2] = $this->createOrangTuaAndLogin();

        $response = $this->from('/orang-tua/dashboard')
                         ->post('/orang-tua/pilih-anak', [
                             'siswa_id' => $siswa2->id
                         ]);

        $response->assertRedirect('/orang-tua/dashboard');
        $response->assertSessionHas('active_siswa_id', $siswa2->id);
    }
}
