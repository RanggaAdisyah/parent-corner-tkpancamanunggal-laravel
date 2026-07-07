<?php

namespace Tests\Feature\Operator;

use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Kelola Orang Tua
 * UT-030 s/d UT-035
 * Fungsi: OperatorController@indexOrangTua, createOrangTua, storeOrangTua, editOrangTua, updateOrangTua, destroyOrangTua
 * Route:  /operator/kelola_orang_tua
 */
class OrangTuaTest extends TestCase
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
    // UT-030 — indexOrangTua: Menampilkan daftar orang tua
    // ---------------------------------------------------------------
    public function test_index_orang_tua_displays_data(): void
    {
        $operator = $this->createOperator();
        OrangTua::factory()->count(2)->create();

        $response = $this->actingAs($operator)->get('/operator/kelola_orang_tua');

        $response->assertStatus(200);
        $response->assertViewIs('operator.kelola_orang_tua');
        $response->assertViewHas('daftarOrangTua');
    }

    // ---------------------------------------------------------------
    // UT-031 — createOrangTua: Menampilkan form dan siswa yatim (tanpa wali)
    // ---------------------------------------------------------------
    public function test_create_orang_tua_displays_form_with_orphaned_students(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        
        // Siswa dengan orang tua
        $ortu = OrangTua::factory()->create();
        Siswa::factory()->create(['kelas_id' => $kelas->id, 'orang_tua_id' => $ortu->id]);
        
        // Siswa tanpa orang tua
        Siswa::factory()->create(['kelas_id' => $kelas->id, 'orang_tua_id' => null]);
        Siswa::factory()->create(['kelas_id' => $kelas->id, 'orang_tua_id' => null]);

        $response = $this->actingAs($operator)->get('/operator/kelola_orang_tua/buat');

        $response->assertStatus(200);
        $response->assertViewIs('operator.buat_orang_tua');
        
        // Harus hanya mengirimkan 2 siswa yang orang_tua_id-nya null
        $response->assertViewHas('siswas', function ($siswas) {
            return $siswas->count() === 2;
        });
    }

    // ---------------------------------------------------------------
    // UT-032 — storeOrangTua: Validasi gagal jika input kosong
    // ---------------------------------------------------------------
    public function test_store_orang_tua_fails_validation_on_empty_fields(): void
    {
        $operator = $this->createOperator();

        $response = $this->actingAs($operator)->post('/operator/kelola_orang_tua', []);

        $response->assertSessionHasErrors([
            'no_hp', 'email', 'password', 'nama_ayah', 'nama_ibu', 'siswa_id'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-033 — storeOrangTua: Berhasil membuat akun dan relasi siswa
    // ---------------------------------------------------------------
    public function test_store_orang_tua_creates_user_and_attaches_students(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        
        $siswa1 = Siswa::factory()->create(['kelas_id' => $kelas->id, 'orang_tua_id' => null]);
        $siswa2 = Siswa::factory()->create(['kelas_id' => $kelas->id, 'orang_tua_id' => null]);

        $payload = [
            'no_hp' => '081299998888',
            'email' => 'budi@test.com',
            'password' => 'rahasia123',
            'nama_ayah' => 'Bapak Budi',
            'nama_ibu' => 'Ibu Siti',
            'alamat' => 'Jl. Kebenaran',
            'siswa_id' => [$siswa1->id, $siswa2->id],
        ];

        $response = $this->actingAs($operator)->post('/operator/kelola_orang_tua', $payload);

        $response->assertRedirect(route('operator.kelola_orang_tua'));
        $response->assertSessionHas('success');

        // Cek User terbuat
        $this->assertDatabaseHas('users', [
            'username' => '081299998888',
            'email' => 'budi@test.com',
            'role' => 'orang_tua',
        ]);

        $user = User::where('username', '081299998888')->first();

        // Cek relasi anak
        $siswa1->refresh();
        $siswa2->refresh();
        
        $this->assertNotNull($siswa1->orang_tua_id);
        $this->assertEquals($siswa1->orang_tua_id, $siswa2->orang_tua_id);
    }

    // ---------------------------------------------------------------
    // UT-034 — updateOrangTua: Mengubah data dan update relasi anak
    // ---------------------------------------------------------------
    public function test_update_orang_tua_modifies_data_and_syncs_students(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        
        $ortuLama = OrangTua::factory()->create();
        $siswaLama = Siswa::factory()->create(['kelas_id' => $kelas->id, 'orang_tua_id' => $ortuLama->id]);
        $siswaBaru = Siswa::factory()->create(['kelas_id' => $kelas->id, 'orang_tua_id' => null]);

        $payload = [
            'no_hp' => '081299997777',
            'email' => 'bapak_baru@test.com',
            'nama_ayah' => 'Bapak Baru',
            'nama_ibu' => 'Ibu Baru',
            'alamat' => 'Jl. Baru',
            'siswa_id' => [$siswaBaru->id], // Siswa lama dilepas, siswa baru dipasang
        ];

        $response = $this->actingAs($operator)->put("/operator/kelola_orang_tua/{$ortuLama->user_id}", $payload);

        $response->assertRedirect();
        
        $siswaLama->refresh();
        $siswaBaru->refresh();

        // Cek sinkronisasi siswa (yang dilepas jadi null, yang baru dipasang)
        $this->assertNull($siswaLama->orang_tua_id);
        $this->assertEquals($ortuLama->id, $siswaBaru->orang_tua_id);
    }

    // ---------------------------------------------------------------
    // UT-035 — destroyOrangTua: Menghapus data dan anak-anaknya
    // ---------------------------------------------------------------
    public function test_destroy_orang_tua_deletes_records_and_detaches_students(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();
        
        $ortu = OrangTua::factory()->create();
        $siswa = Siswa::factory()->create(['kelas_id' => $kelas->id, 'orang_tua_id' => $ortu->id]);
        
        $userId = $ortu->user_id;

        $response = $this->actingAs($operator)->delete("/operator/kelola_orang_tua/{$userId}");

        $response->assertRedirect();

        $this->assertDatabaseMissing('users', ['id' => $userId]);
        $this->assertDatabaseMissing('orang_tuas', ['id' => $ortu->id]);
        
        // Siswa tidak boleh dihapus, hanya di-detach (orang_tua_id = null)
        $this->assertDatabaseHas('siswas', [
            'id' => $siswa->id,
            'orang_tua_id' => null
        ]);
    }
}
