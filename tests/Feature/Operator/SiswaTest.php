<?php

namespace Tests\Feature\Operator;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Kelola Siswa
 * UT-024 s/d UT-029
 * Fungsi: OperatorController@indexAnak, storeAnak, updateAnak, destroyAnak
 * Route:  /operator/data_siswa
 */
class SiswaTest extends TestCase
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
    // UT-024 — indexAnak: Menampilkan data siswa dan daftar kelas
    // ---------------------------------------------------------------
    public function test_index_anak_displays_siswa_and_kelas(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        Siswa::factory()->count(3)->create(['kelas_id' => $kelas->id]);

        $response = $this->actingAs($operator)->get('/operator/data_siswa');

        $response->assertStatus(200);
        $response->assertViewIs('operator.data_siswa');
        $response->assertViewHas('daftarSiswa');
        $response->assertViewHas('kelasList');
    }

    // ---------------------------------------------------------------
    // UT-025 — storeAnak: Validasi gagal jika input wajib kosong
    // ---------------------------------------------------------------
    public function test_store_anak_fails_validation_on_empty_fields(): void
    {
        $operator = $this->createOperator();

        $response = $this->actingAs($operator)->post('/operator/data_siswa', []);

        $response->assertSessionHasErrors([
            'nama', 'kelas_id', 'nis', 'jenis_kelamin', 'tanggal_lahir'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-026 — storeAnak: Simpan sukses dan generate string 'kelas'
    // ---------------------------------------------------------------
    public function test_store_anak_creates_data_and_merges_kelas_string(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create([
            'tingkat' => 'TK A',
            'nama_kelas' => 'Matahari'
        ]);

        $payload = [
            'nama' => 'Budi Santoso',
            'kelas_id' => $kelas->id,
            'nis' => '123456',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2015-05-15',
        ];

        $response = $this->actingAs($operator)->post('/operator/data_siswa', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Data Siswa berhasil ditambahkan!');
        
        $this->assertDatabaseHas('siswas', [
            'nis' => '123456',
            // Kita tidak cek 'nama' dan 'tanggal_lahir' mentah-mentah pakai assertDatabaseHas 
            // karena field tersebut kena casting (encrypted) di model.
        ]);

        // Cek bahwa field 'kelas' tergabung dengan benar via model call (agar decrypter bekerja jika ada, dsb)
        $siswa = Siswa::where('nis', '123456')->first();
        $this->assertEquals('TK A - Matahari', $siswa->kelas);
        $this->assertEquals('Budi Santoso', $siswa->nama);
    }

    // ---------------------------------------------------------------
    // UT-027 — updateAnak: Validasi gagal jika form kosong
    // ---------------------------------------------------------------
    public function test_update_anak_fails_validation_on_empty_fields(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        $siswa = Siswa::factory()->create(['kelas_id' => $kelas->id]);

        // Route update: PUT /operator/data_siswa/{id}
        // Menggunakan method route fallback karena tidak ada name() di web.php untuk put data_siswa/{id}
        $response = $this->actingAs($operator)->put("/operator/data_siswa/{$siswa->id}", []);

        $response->assertSessionHasErrors([
            'nama', 'kelas_id', 'nis', 'jenis_kelamin', 'tanggal_lahir'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-028 — updateAnak: Berhasil mengubah data siswa
    // ---------------------------------------------------------------
    public function test_update_anak_modifies_data_successfully(): void
    {
        $operator = $this->createOperator();
        
        $kelasLama = Kelas::factory()->create(['tingkat' => 'TK A', 'nama_kelas' => 'Lama']);
        $kelasBaru = Kelas::factory()->create(['tingkat' => 'TK B', 'nama_kelas' => 'Baru']);
        
        $siswa = Siswa::factory()->create([
            'nama' => 'Nama Lama',
            'kelas_id' => $kelasLama->id,
            'nis' => '111111',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '2015-01-01',
            'kelas' => 'TK A - Lama'
        ]);

        $payloadBaru = [
            'nama' => 'Nama Baru',
            'kelas_id' => $kelasBaru->id,
            'nis' => '222222',
            'jenis_kelamin' => 'Perempuan',
            'tanggal_lahir' => '2016-02-02',
        ];

        $response = $this->actingAs($operator)->put("/operator/data_siswa/{$siswa->id}", $payloadBaru);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Data Siswa berhasil diperbarui!');
        
        // Refresh instansi dari database
        $siswa->refresh();
        
        $this->assertEquals('Nama Baru', $siswa->nama);
        $this->assertEquals('222222', $siswa->nis);
        $this->assertEquals('TK B - Baru', $siswa->kelas); // Cek merge logic
    }

    // ---------------------------------------------------------------
    // UT-029 — destroyAnak: Berhasil menghapus siswa
    // ---------------------------------------------------------------
    public function test_destroy_anak_deletes_record_from_database(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        $siswa = Siswa::factory()->create(['kelas_id' => $kelas->id]);

        // Pastikan ada 1
        $this->assertDatabaseCount('siswas', 1);

        $response = $this->actingAs($operator)->delete("/operator/data_siswa/{$siswa->id}");

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Data Siswa berhasil dihapus!');

        // Pastikan terhapus (jadi 0)
        $this->assertDatabaseCount('siswas', 0);
    }
}
