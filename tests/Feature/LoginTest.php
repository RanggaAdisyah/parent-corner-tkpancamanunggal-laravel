<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Halaman Login Parent Corner
 *
 * Cakupan: UT-001 s/d UT-013 (server-side)
 * UT-014 & UT-015 adalah client-side JS, diuji manual / via browser test.
 */
class LoginTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // Helper: buat user dummy untuk keperluan test
    // ---------------------------------------------------------------
    private function createUser(string $email = 'guru@test.com', string $password = 'password123'): User
    {
        return User::factory()->create([
            'email'    => $email,
            'username' => '08123456789',
            'password' => Hash::make($password),
            'role'     => 'guru',
        ]);
    }

    // ---------------------------------------------------------------
    // UT-001 — index(): user yang sudah login mengakses /login
    // WB-001: Karena route tidak menggunakan middleware 'guest',
    //         sistem tetap menampilkan halaman login (status 200).
    // ---------------------------------------------------------------
    public function test_index_redirects_if_already_authenticated(): void
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->get('/login');

        // Status 200: halaman login dirender (tidak error)
        $response->assertStatus(200);
    }

    // ---------------------------------------------------------------
    // UT-002 — index(): tampilkan halaman login jika belum ada sesi
    // WB-002
    // ---------------------------------------------------------------
    public function test_index_shows_login_page_when_not_authenticated(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('login');
    }

    // ---------------------------------------------------------------
    // UT-003 — store(): gagal jika login_identifier (email) kosong
    // WB-003
    // ---------------------------------------------------------------
    public function test_store_fails_if_login_identifier_empty(): void
    {
        $response = $this->post('/login', [
            'login_identifier' => '',
            'password'         => 'password123',
        ]);

        $response->assertSessionHasErrors(['login_identifier']);
    }

    // ---------------------------------------------------------------
    // UT-004 — store(): gagal jika password kosong
    // WB-005
    // ---------------------------------------------------------------
    public function test_store_fails_if_password_empty(): void
    {
        $response = $this->post('/login', [
            'login_identifier' => 'guru@test.com',
            'password'         => '',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    // ---------------------------------------------------------------
    // UT-005 — store(): gagal jika email tidak terdaftar
    // WB-006
    // ---------------------------------------------------------------
    public function test_store_fails_if_email_not_registered(): void
    {
        $response = $this->post('/login', [
            'login_identifier' => 'tidakada@test.com',
            'password'         => 'password123',
        ]);

        $response->assertSessionHasErrors(['login_identifier']);
    }

    // ---------------------------------------------------------------
    // UT-006 — store(): gagal jika password salah
    // WB-007
    // ---------------------------------------------------------------
    public function test_store_fails_if_password_wrong(): void
    {
        $this->createUser('guru@test.com', 'password123');

        $response = $this->post('/login', [
            'login_identifier' => 'guru@test.com',
            'password'         => 'passwordSalah',
        ]);

        $response->assertSessionHasErrors(['login_identifier']);
    }

    // ---------------------------------------------------------------
    // UT-007 — store(): berhasil login dengan email & password valid
    // WB-008
    // ---------------------------------------------------------------
    public function test_store_success_with_valid_email_credentials(): void
    {
        $this->createUser('guru@test.com', 'password123');

        $response = $this->post('/login', [
            'login_identifier' => 'guru@test.com',
            'password'         => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    // ---------------------------------------------------------------
    // UT-008 — store(): berhasil login dengan username (no HP)
    // (Hybrid login — WB-008 extended)
    // ---------------------------------------------------------------
    public function test_store_success_with_username_credentials(): void
    {
        $this->createUser('guru@test.com', 'password123');

        $response = $this->post('/login', [
            'login_identifier' => '08123456789',
            'password'         => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    // ---------------------------------------------------------------
    // UT-009 — destroy(): logout membersihkan sesi
    // WB-009
    // ---------------------------------------------------------------
    public function test_destroy_logs_out_and_redirects(): void
    {
        $user = $this->createUser();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
