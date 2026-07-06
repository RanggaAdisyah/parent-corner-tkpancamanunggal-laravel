<?php

namespace Tests\Feature\Operator;

use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Dashboard Operator
 * UT-016 s/d UT-021
 * Fungsi: OperatorController@indexDashboard
 * Route:  GET /operator/dashboard (middleware: auth, role:operator)
 */
class DashboardTest extends TestCase
{
    use RefreshDatabase;

    private function createOperator(): User
    {
        return User::factory()->create([
            'email'    => 'operator@test.com',
            'username' => '08111000001',
            'password' => Hash::make('password123'),
            'role'     => 'operator',
        ]);
    }

    private function createGuru(): User
    {
        return User::factory()->create([
            'email'    => 'guru@test.com',
            'username' => '08111000002',
            'password' => Hash::make('password123'),
            'role'     => 'guru',
        ]);
    }

    // ---------------------------------------------------------------
    // UT-016 — Akses tanpa login → redirect ke /login
    // ---------------------------------------------------------------
    public function test_dashboard_requires_authentication(): void
    {
        $response = $this->get('/operator/dashboard');

        $response->assertRedirect('/login');
    }

    // ---------------------------------------------------------------
    // UT-017 — Akses dengan role guru → redirect (bukan 403)
    // Catatan: RoleMiddleware melakukan redirect('/') bukan abort(403)
    // ---------------------------------------------------------------
    public function test_dashboard_forbidden_for_non_operator_role(): void
    {
        $guru = $this->createGuru();

        $response = $this->actingAs($guru)->get('/operator/dashboard');

        $response->assertRedirect('/');
    }

    // ---------------------------------------------------------------
    // UT-018 — Akses dengan role operator → berhasil (200)
    // ---------------------------------------------------------------
    public function test_dashboard_accessible_for_operator_role(): void
    {
        $operator = $this->createOperator();

        $response = $this->actingAs($operator)->get('/operator/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('operator.dashboard');
    }

    // ---------------------------------------------------------------
    // UT-019 — totalSiswa sesuai jumlah data di database
    // ---------------------------------------------------------------
    public function test_dashboard_displays_correct_total_siswa(): void
    {
        $operator = $this->createOperator();
        $kelas    = Kelas::factory()->create();
        Siswa::factory()->count(5)->create(['kelas_id' => $kelas->id]);

        $response = $this->actingAs($operator)->get('/operator/dashboard');

        $response->assertViewHas('totalSiswa', 5);
    }

    // ---------------------------------------------------------------
    // UT-020 — totalGuru sesuai jumlah data di database
    // ---------------------------------------------------------------
    public function test_dashboard_displays_correct_total_guru(): void
    {
        $operator = $this->createOperator();
        Guru::factory()->count(3)->create(['user_id' => $operator->id]);

        $response = $this->actingAs($operator)->get('/operator/dashboard');

        $response->assertViewHas('totalGuru', 3);
    }

    // ---------------------------------------------------------------
    // UT-021 — totalFoto sesuai jumlah data di database
    // ---------------------------------------------------------------
    public function test_dashboard_displays_correct_total_foto(): void
    {
        $operator = $this->createOperator();
        Galeri::factory()->count(10)->create();

        $response = $this->actingAs($operator)->get('/operator/dashboard');

        $response->assertViewHas('totalFoto', 10);
    }

    // ---------------------------------------------------------------
    // UT-022 — fotoBulanIni hanya menghitung foto di bulan berjalan
    // ---------------------------------------------------------------
    public function test_dashboard_displays_correct_foto_bulan_ini(): void
    {
        $operator = $this->createOperator();
        
        // Buat 2 foto bulan lalu
        Galeri::factory()->count(2)->create([
            'created_at' => now()->subMonth()
        ]);
        
        // Buat 3 foto bulan ini
        Galeri::factory()->count(3)->create([
            'created_at' => now()
        ]);

        $response = $this->actingAs($operator)->get('/operator/dashboard');

        $response->assertViewHas('fotoBulanIni', 3);
    }

    // ---------------------------------------------------------------
    // UT-023 — pengumumanTerkini max 3 item, urut terbaru
    // ---------------------------------------------------------------
    public function test_dashboard_displays_latest_pengumuman(): void
    {
        $operator = $this->createOperator();
        Pengumuman::factory()->count(5)->create();

        $response = $this->actingAs($operator)->get('/operator/dashboard');

        $response->assertViewHas('pengumumanTerkini', function ($items) {
            return $items->count() <= 3;
        });
    }
}
