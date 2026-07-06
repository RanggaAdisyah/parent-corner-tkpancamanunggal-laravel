<?php

namespace Tests\Feature\Operator;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Kelola Guru
 * UT-036 s/d UT-041
 * Fungsi: OperatorController@indexGuru, createGuru, storeGuru, editGuru, updateGuru, destroyGuru
 * Route:  /operator/kelola-guru
 */
class GuruTest extends TestCase
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
    // UT-036 — indexGuru: Menampilkan daftar guru
    // ---------------------------------------------------------------
    public function test_index_guru_displays_data(): void
    {
        $operator = $this->createOperator();
        Guru::factory()->count(2)->create();

        $response = $this->actingAs($operator)->get('/operator/kelola-guru');

        $response->assertStatus(200);
        $response->assertViewIs('operator.kelola_guru');
        $response->assertViewHas('daftarGuru');
        $response->assertViewHas('kelasList');
    }

    // ---------------------------------------------------------------
    // UT-037 — createGuru: Menampilkan form buat guru
    // ---------------------------------------------------------------
    public function test_create_guru_displays_form(): void
    {
        $operator = $this->createOperator();

        $response = $this->actingAs($operator)->get('/operator/kelola-guru/buat');

        $response->assertStatus(200);
        $response->assertViewIs('operator.buat_guru');
        $response->assertViewHas('kelasList');
    }

    // ---------------------------------------------------------------
    // UT-038 — storeGuru: Validasi gagal jika form kosong/salah
    // ---------------------------------------------------------------
    public function test_store_guru_fails_validation_on_empty_fields(): void
    {
        $operator = $this->createOperator();

        $response = $this->actingAs($operator)->post('/operator/kelola-guru', [
            'email' => 'bukan-email',
            // fields lainnya kosong
        ]);

        $response->assertSessionHasErrors([
            'no_hp', 'email', 'password', 'nama_lengkap'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-039 — storeGuru: Berhasil menyimpan data guru baru
    // ---------------------------------------------------------------
    public function test_store_guru_creates_user_and_guru_records(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();

        $payload = [
            'nama_lengkap' => 'Guru Testing',
            'no_hp' => '081234567890',
            'email' => 'guru@test.com',
            'password' => 'rahasia123',
            'jabatan' => 'Wali Kelas',
            'nip' => '199001012020011001',
            'kelas_id' => $kelas->id,
            'alamat' => 'Jl. Pendidikan',
            'jenis_kelamin' => 'Laki-laki',
            'tanggal_lahir' => '1990-01-01',
        ];

        $response = $this->actingAs($operator)->post('/operator/kelola-guru', $payload);

        $response->assertRedirect(route('operator.kelola-guru'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'username' => '081234567890',
            'email' => 'guru@test.com',
            'role' => 'guru'
        ]);

        // Cek guru terbuat dan terelasi
        $user = User::where('email', 'guru@test.com')->first();
        
        $this->assertDatabaseHas('gurus', [
            'user_id' => $user->id,
            'kelas_id' => $kelas->id,
        ]);
        
        $guru = Guru::where('user_id', $user->id)->first();
        $this->assertEquals('199001012020011001', $guru->nip);
    }

    // ---------------------------------------------------------------
    // UT-040 — updateGuru: Berhasil mengubah data tanpa error unique
    // ---------------------------------------------------------------
    public function test_update_guru_modifies_data_successfully(): void
    {
        $operator = $this->createOperator();
        
        $userGuru = User::factory()->create([
            'username' => '0811111111',
            'email' => 'lama@test.com',
            'role' => 'guru'
        ]);
        
        $guru = Guru::factory()->create([
            'user_id' => $userGuru->id,
            'nama_lengkap' => 'Guru Lama',
            'nip' => '111111111'
        ]);

        $payloadBaru = [
            'nama_lengkap' => 'Guru Baru',
            'no_hp' => '0822222222', // update no hp
            'email' => 'baru@test.com', // update email
            'jabatan' => 'Kepala Sekolah',
            'nip' => '222222222'
        ];

        // Harus menggunakan id dari users table
        $response = $this->actingAs($operator)->put("/operator/kelola-guru/{$userGuru->id}", $payloadBaru);

        $response->assertRedirect(route('operator.kelola-guru'));
        $response->assertSessionHas('success');

        $userGuru->refresh();
        $this->assertEquals('baru@test.com', $userGuru->email);
        $this->assertEquals('0822222222', $userGuru->username);
        $this->assertEquals('Guru Baru', $userGuru->name);

        $guru->refresh();
        $this->assertEquals('222222222', $guru->nip);
    }

    // ---------------------------------------------------------------
    // UT-041 — destroyGuru: Menghapus user cascade ke guru
    // ---------------------------------------------------------------
    public function test_destroy_guru_deletes_user_and_guru_records(): void
    {
        $operator = $this->createOperator();
        
        $userGuru = User::factory()->create(['role' => 'guru']);
        $guru = Guru::factory()->create(['user_id' => $userGuru->id]);

        $response = $this->actingAs($operator)->delete("/operator/kelola-guru/{$userGuru->id}");

        $response->assertRedirect(route('operator.kelola-guru'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('users', ['id' => $userGuru->id]);
        
        // Karena on delete cascade (atau in memory DB), kita pastikan terhapus. 
        // Jika pakai database dengan relasi MySQL, record Guru akan ikut terhapus.
        $this->assertDatabaseMissing('gurus', ['id' => $guru->id]);
    }
}
