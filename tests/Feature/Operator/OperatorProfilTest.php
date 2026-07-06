<?php

namespace Tests\Feature\Operator;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Profil Operator
 * UT-081 s/d UT-083
 */
class OperatorProfilTest extends TestCase
{
    use RefreshDatabase;

    private function createOperatorAndLogin(): User
    {
        $operator = User::factory()->create([
            'name'     => 'Operator Admin',
            'email'    => 'operator_profil@test.com',
            'password' => Hash::make('password123'),
            'role'     => 'operator',
        ]);

        $this->actingAs($operator);

        return $operator;
    }

    // ---------------------------------------------------------------
    // UT-081 — profil: Menampilkan form edit profil
    // ---------------------------------------------------------------
    public function test_profil_displays_form(): void
    {
        $this->createOperatorAndLogin();

        $response = $this->get('/operator/profil');

        $response->assertStatus(200);
        $response->assertViewIs('operator.profil');
        $response->assertViewHas('user');
    }

    // ---------------------------------------------------------------
    // UT-082 — updateProfil: Gagal validasi jika email kosong / kembar
    // ---------------------------------------------------------------
    public function test_update_profil_fails_validation(): void
    {
        $operator = $this->createOperatorAndLogin();

        // Buat user lain untuk testing email duplicate
        User::factory()->create(['email' => 'other_operator@test.com']);

        // Test 1: Email kosong
        $response = $this->put('/operator/profil', [
            'email' => '',
        ]);
        $response->assertSessionHasErrors(['email']);

        // Test 2: Email dipakai user lain
        $response = $this->put('/operator/profil', [
            'email' => 'other_operator@test.com',
        ]);
        $response->assertSessionHasErrors(['email']);

        // Test 3: Konfirmasi password salah
        $response = $this->put('/operator/profil', [
            'email' => 'my_new_email@test.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'salah123'
        ]);
        $response->assertSessionHasErrors(['password']);
    }

    // ---------------------------------------------------------------
    // UT-083 — updateProfil: Sukses mengubah profil & password
    // ---------------------------------------------------------------
    public function test_update_profil_saves_data(): void
    {
        $operator = $this->createOperatorAndLogin();

        $response = $this->put('/operator/profil', [
            'email' => 'admin_baru@test.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $operator->refresh();

        $this->assertEquals('admin_baru@test.com', $operator->email);
        $this->assertTrue(Hash::check('rahasia123', $operator->password));
    }
}
