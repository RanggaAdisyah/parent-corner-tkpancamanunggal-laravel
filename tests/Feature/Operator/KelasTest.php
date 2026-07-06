<?php

namespace Tests\Feature\Operator;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Kelola Kelas & Jadwal Pelajaran
 * UT-042 s/d UT-051
 */
class KelasTest extends TestCase
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

    // ---------------------------------------------------------------
    // UT-042 — indexKelas: Menampilkan daftar kelas
    // ---------------------------------------------------------------
    public function test_index_kelas_displays_data(): void
    {
        $operator = $this->createOperator();
        Kelas::factory()->count(2)->create();

        $response = $this->actingAs($operator)->get('/operator/kelola-kelas');

        $response->assertStatus(200);
        $response->assertViewIs('operator.kelola_kelas');
        $response->assertViewHas('kelasList');
    }

    // ---------------------------------------------------------------
    // UT-043 — storeKelas: Gagal validasi jika tingkat kosong
    // ---------------------------------------------------------------
    public function test_store_kelas_fails_validation_on_empty_fields(): void
    {
        $operator = $this->createOperator();

        $response = $this->actingAs($operator)->post('/operator/kelola-kelas', []);

        $response->assertSessionHasErrors(['tingkat']);
    }

    // ---------------------------------------------------------------
    // UT-044 — storeKelas: Berhasil membuat kelas dan fallback nama_kelas
    // ---------------------------------------------------------------
    public function test_store_kelas_creates_record(): void
    {
        $operator = $this->createOperator();

        // Testing fallback: jika nama_kelas kosong, diisi dengan tingkat
        $payload = [
            'tingkat' => 'PAUD',
            'nama_kelas' => ''
        ];

        $response = $this->actingAs($operator)->post('/operator/kelola-kelas', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('kelas', [
            'tingkat' => 'PAUD',
            'nama_kelas' => 'PAUD' // Fallback logic controller
        ]);
    }

    // ---------------------------------------------------------------
    // UT-045 — updateKelas: Berhasil mengubah data kelas
    // ---------------------------------------------------------------
    public function test_update_kelas_modifies_data(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create(['tingkat' => 'TK A', 'nama_kelas' => 'Bulan']);

        $payload = [
            'tingkat' => 'TK B',
            'nama_kelas' => 'Bintang'
        ];

        $response = $this->actingAs($operator)->put("/operator/kelola-kelas/{$kelas->id}", $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('kelas', [
            'id' => $kelas->id,
            'tingkat' => 'TK B',
            'nama_kelas' => 'Bintang'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-046 — destroyKelas: Berhasil menghapus kelas
    // ---------------------------------------------------------------
    public function test_destroy_kelas_deletes_record(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();

        $response = $this->actingAs($operator)->delete("/operator/kelola-kelas/{$kelas->id}");

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('kelas', ['id' => $kelas->id]);
    }

    // ---------------------------------------------------------------
    // UT-047 — indexJadwalKelas: Menampilkan jadwal suatu kelas
    // ---------------------------------------------------------------
    public function test_index_jadwal_kelas_displays_data(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        JadwalPelajaran::factory()->count(3)->create(['kelas_id' => $kelas->id]);

        $response = $this->actingAs($operator)->get("/operator/kelola-kelas/{$kelas->id}/jadwal");

        $response->assertStatus(200);
        $response->assertViewIs('operator.jadwal_kelas');
        $response->assertViewHas('kelas');
        $response->assertViewHas('jadwalList', function ($jadwalList) {
            return $jadwalList->count() === 3;
        });
    }

    // ---------------------------------------------------------------
    // UT-048 — storeJadwalKelas: Gagal validasi jika input kosong
    // ---------------------------------------------------------------
    public function test_store_jadwal_kelas_fails_validation_on_empty_fields(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();

        $response = $this->actingAs($operator)->post("/operator/kelola-kelas/{$kelas->id}/jadwal", []);

        $response->assertSessionHasErrors(['hari', 'jam_mulai', 'kegiatan']);
    }

    // ---------------------------------------------------------------
    // UT-049 — storeJadwalKelas: Berhasil menyimpan jadwal
    // ---------------------------------------------------------------
    public function test_store_jadwal_kelas_creates_record(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();

        $payload = [
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '09:00',
            'kegiatan' => 'Belajar Menggambar',
            'keterangan' => 'Membawa buku gambar'
        ];

        $response = $this->actingAs($operator)->post("/operator/kelola-kelas/{$kelas->id}/jadwal", $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('jadwal_pelajarans', [
            'kelas_id' => $kelas->id,
            'hari' => 'Senin',
            'kegiatan' => 'Belajar Menggambar'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-050 — updateJadwalKelas: Berhasil mengubah jadwal
    // ---------------------------------------------------------------
    public function test_update_jadwal_kelas_modifies_data(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        $jadwal = JadwalPelajaran::factory()->create([
            'kelas_id' => $kelas->id,
            'kegiatan' => 'Kegiatan Lama'
        ]);

        $payload = [
            'hari' => 'Selasa',
            'jam_mulai' => '10:00',
            'jam_selesai' => '11:00',
            'kegiatan' => 'Kegiatan Baru'
        ];

        // Karena route di controller menggunakan $id jadwalnya langsung, di URL /operator/jadwal-kelas/{id}
        $response = $this->actingAs($operator)->put("/operator/jadwal-kelas/{$jadwal->id}", $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('jadwal_pelajarans', [
            'id' => $jadwal->id,
            'hari' => 'Selasa',
            'kegiatan' => 'Kegiatan Baru'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-051 — destroyJadwalKelas: Berhasil menghapus jadwal
    // ---------------------------------------------------------------
    public function test_destroy_jadwal_kelas_deletes_record(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        $jadwal = JadwalPelajaran::factory()->create(['kelas_id' => $kelas->id]);

        $response = $this->actingAs($operator)->delete("/operator/jadwal-kelas/{$jadwal->id}");

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('jadwal_pelajarans', ['id' => $jadwal->id]);
    }
}
