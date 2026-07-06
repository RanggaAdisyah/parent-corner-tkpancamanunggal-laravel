<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Kehadiran Guru
 * UT-075 s/d UT-078
 */
class KehadiranTest extends TestCase
{
    use RefreshDatabase;

    private function createGuruAndLogin(): array
    {
        $user = User::factory()->create([
            'email'    => 'guru@test.com',
            'username' => '08222222222',
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
    // UT-075 — kehadiran: Menampilkan daftar siswa untuk diabsen
    // ---------------------------------------------------------------
    public function test_kehadiran_displays_page_with_students(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        // Buat 2 siswa di kelas yang sama
        Siswa::factory()->count(2)->create(['kelas_id' => $kelas->id]);
        
        // Buat 1 siswa di kelas beda (harusnya tak tampil)
        Siswa::factory()->create();

        $response = $this->get('/guru/kehadiran');

        $response->assertStatus(200);
        $response->assertViewIs('guru.kehadiran');
        $response->assertViewHas('guru');
        $response->assertViewHas('siswas', function ($siswas) {
            return $siswas->count() === 2;
        });
    }

    // ---------------------------------------------------------------
    // UT-076 — storeKehadiran: Validasi gagal jika input kosong
    // ---------------------------------------------------------------
    public function test_store_kehadiran_fails_validation_on_empty_fields(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();

        // Kirim payload kosong
        $response = $this->post('/guru/kehadiran', []);

        $response->assertSessionHasErrors(['tanggal', 'kehadiran']);
    }

    // ---------------------------------------------------------------
    // UT-077 — storeKehadiran: Menyimpan absensi
    // ---------------------------------------------------------------
    public function test_store_kehadiran_saves_or_updates_data(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        $siswa1 = Siswa::factory()->create(['kelas_id' => $kelas->id]);
        $siswa2 = Siswa::factory()->create(['kelas_id' => $kelas->id]);

        $payload = [
            'tanggal' => '2023-10-10',
            'kehadiran' => [
                $siswa1->id => 'hadir',
                $siswa2->id => 'sakit',
            ],
            'keterangan' => [
                $siswa2->id => 'Sakit demam' // Siswa 1 tak punya keterangan
            ]
        ];

        $response = $this->post('/guru/kehadiran', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('kehadirans', [
            'siswa_id' => $siswa1->id,
            'tanggal' => '2023-10-10',
            'status' => 'hadir',
            'keterangan' => null
        ]);

        $this->assertDatabaseHas('kehadirans', [
            'siswa_id' => $siswa2->id,
            'tanggal' => '2023-10-10',
            'status' => 'sakit',
            'keterangan' => 'Sakit demam'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-078 — getKehadiranTanggal: Ambil JSON data presensi
    // ---------------------------------------------------------------
    public function test_get_kehadiran_tanggal_returns_json(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        $siswa = Siswa::factory()->create(['kelas_id' => $kelas->id]);
        
        Kehadiran::factory()->create([
            'siswa_id' => $siswa->id,
            'tanggal' => '2023-10-15',
            'status' => 'izin'
        ]);

        // Request API AJAX (GET)
        $response = $this->getJson('/guru/get-kehadiran-tanggal?tanggal=2023-10-15');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'siswa_id' => $siswa->id,
            'tanggal' => '2023-10-15',
            'status' => 'izin'
        ]);
    }
}
