<?php

namespace Tests\Feature\Operator;

use App\Models\KalenderKegiatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Kalender Kegiatan
 * UT-052 s/d UT-056
 */
class KalenderKegiatanTest extends TestCase
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
    // UT-052 — indexKalenderKegiatan: Menampilkan kalender
    // ---------------------------------------------------------------
    public function test_index_kalender_kegiatan_displays_data(): void
    {
        $operator = $this->createOperator();
        KalenderKegiatan::factory()->count(3)->create();

        $response = $this->actingAs($operator)->get('/operator/kalender-kegiatan');

        $response->assertStatus(200);
        $response->assertViewIs('operator.kalender_kegiatan');
        $response->assertViewHas('kegiatanList', function ($list) {
            return $list->count() === 3;
        });
    }

    // ---------------------------------------------------------------
    // UT-053 — storeKalenderKegiatan: Validasi gagal jika form kosong
    // ---------------------------------------------------------------
    public function test_store_kalender_kegiatan_fails_validation_on_empty_fields(): void
    {
        $operator = $this->createOperator();

        $response = $this->actingAs($operator)->post('/operator/kalender-kegiatan', []);

        $response->assertSessionHasErrors(['judul', 'tanggal', 'waktu_mulai', 'kategori']);
    }

    // ---------------------------------------------------------------
    // UT-054 — storeKalenderKegiatan: Berhasil menyimpan kegiatan
    // ---------------------------------------------------------------
    public function test_store_kalender_kegiatan_creates_record(): void
    {
        $operator = $this->createOperator();

        $payload = [
            'judul' => 'Lomba Mewarnai',
            'tanggal' => '2023-08-17',
            'waktu_mulai' => '08:00',
            'waktu_selesai' => '12:00',
            'kategori' => 'Lomba',
            'deskripsi' => 'Membawa alat warna sendiri.'
        ];

        $response = $this->actingAs($operator)->post('/operator/kalender-kegiatan', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('kalender_kegiatans', [
            'judul' => 'Lomba Mewarnai',
            'tanggal' => '2023-08-17',
            'kategori' => 'Lomba'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-055 — updateKalenderKegiatan: Berhasil mengubah data kegiatan
    // ---------------------------------------------------------------
    public function test_update_kalender_kegiatan_modifies_data(): void
    {
        $operator = $this->createOperator();
        $kegiatan = KalenderKegiatan::factory()->create(['judul' => 'Lama']);

        $payload = [
            'judul' => 'Baru',
            'tanggal' => '2023-08-18',
            'waktu_mulai' => '09:00',
            'kategori' => 'Akademik',
        ];

        $response = $this->actingAs($operator)->put("/operator/kalender-kegiatan/{$kegiatan->id}", $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('kalender_kegiatans', [
            'id' => $kegiatan->id,
            'judul' => 'Baru',
            'kategori' => 'Akademik'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-056 — destroyKalenderKegiatan: Berhasil menghapus kegiatan
    // ---------------------------------------------------------------
    public function test_destroy_kalender_kegiatan_deletes_record(): void
    {
        $operator = $this->createOperator();
        $kegiatan = KalenderKegiatan::factory()->create();

        $response = $this->actingAs($operator)->delete("/operator/kalender-kegiatan/{$kegiatan->id}");

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('kalender_kegiatans', ['id' => $kegiatan->id]);
    }
}
