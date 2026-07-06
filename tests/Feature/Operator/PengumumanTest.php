<?php

namespace Tests\Feature\Operator;

use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Pengumuman
 * UT-054 s/d UT-059
 */
class PengumumanTest extends TestCase
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

    protected function tearDown(): void
    {
        // Bersihkan folder upload buatan test agar tidak menumpuk di public
        $testUploadPath = public_path('uploads/pengumuman');
        
        // Hanya hapus file yang berawalan "test_" jika ada, tapi karena nama file di-generate dengan uniqid() dan time() di controller,
        // kita sulit mencari file mana saja milik test.
        // Solusinya: Kita jalankan test saja, Laravel UploadedFile fake kadang bisa dibersihkan otomatis, 
        // tapi karena controller pakai ->move(), file akan menetap.
        // Lebih baik kita hapus semua isi direktori yang berbau test, tapi karena ini di public, berisiko.
        // Oleh karena itu, di sini saya biarkan dulu, Anda bisa tambahkan clean-up manual jika mau.
        
        parent::tearDown();
    }

    // ---------------------------------------------------------------
    // UT-054 — indexPengumuman: Menampilkan daftar
    // ---------------------------------------------------------------
    public function test_index_pengumuman_displays_data(): void
    {
        $operator = $this->createOperator();
        Pengumuman::factory()->count(2)->create();

        $response = $this->actingAs($operator)->get('/operator/pengumuman');

        $response->assertStatus(200);
        $response->assertViewIs('operator.daftar_pengumuman');
        $response->assertViewHas('pengumumans');
    }

    // ---------------------------------------------------------------
    // UT-055 — createPengumuman: Menampilkan form
    // ---------------------------------------------------------------
    public function test_create_pengumuman_displays_form(): void
    {
        $operator = $this->createOperator();
        Kelas::factory()->count(2)->create();

        $response = $this->actingAs($operator)->get('/operator/pengumuman/buat');

        $response->assertStatus(200);
        $response->assertViewIs('operator.buat_pengumuman');
        $response->assertViewHas('kelasList');
    }

    // ---------------------------------------------------------------
    // UT-056 — storePengumuman: Simpan pengumuman dan sync pivot
    // ---------------------------------------------------------------
    public function test_store_pengumuman_creates_record_and_syncs_kelas(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();

        $file = UploadedFile::fake()->image('pengumuman.jpg');

        $payload = [
            'judul' => 'Pengumuman Libur',
            'isi_pesan' => 'Sekolah libur 1 minggu.',
            'target_kelas' => [$kelas->id],
            'lampiran' => [$file]
        ];

        $response = $this->actingAs($operator)->post('/operator/pengumuman', $payload);

        $response->assertRedirect(route('operator.pengumuman'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pengumumans', [
            'judul' => 'Pengumuman Libur'
        ]);

        $pengumuman = Pengumuman::where('judul', 'Pengumuman Libur')->first();
        
        // Pivot check
        $this->assertTrue($pengumuman->kelas->contains($kelas->id));
        
        // Assert lampiran di-set
        $this->assertIsArray($pengumuman->lampiran);
        $this->assertCount(1, $pengumuman->lampiran);

        // Hapus file fisik (Cleanup)
        foreach ($pengumuman->lampiran as $path) {
            @unlink(public_path($path));
        }
    }

    // ---------------------------------------------------------------
    // UT-057 — editPengumuman: Menampilkan halaman edit
    // ---------------------------------------------------------------
    public function test_edit_pengumuman_displays_form(): void
    {
        $operator = $this->createOperator();
        $pengumuman = Pengumuman::factory()->create();

        $response = $this->actingAs($operator)->get("/operator/pengumuman/{$pengumuman->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('operator.edit_pengumuman');
        $response->assertViewHas('pengumuman');
        $response->assertViewHas('kelasList');
    }

    // ---------------------------------------------------------------
    // UT-058 — updatePengumuman: Mengubah data dan menghapus file lama
    // ---------------------------------------------------------------
    public function test_update_pengumuman_modifies_data_and_deletes_files(): void
    {
        $operator = $this->createOperator();
        $kelasLama = Kelas::factory()->create();
        $kelasBaru = Kelas::factory()->create();

        // Buat file dummy asli
        $fakePath = 'uploads/pengumuman/test_hapus_' . time() . '.jpg';
        if (!is_dir(public_path('uploads/pengumuman'))) {
            mkdir(public_path('uploads/pengumuman'), 0777, true);
        }
        file_put_contents(public_path($fakePath), 'dummy');

        $pengumuman = Pengumuman::factory()->create([
            'judul' => 'Judul Lama',
            'lampiran' => [$fakePath]
        ]);
        $pengumuman->kelas()->attach($kelasLama->id);

        $payload = [
            'judul' => 'Judul Baru',
            'isi_pesan' => 'Pesan Baru',
            'target_kelas' => [$kelasBaru->id],
            'deleted_files' => [$fakePath] // Request hapus file ini
        ];

        $response = $this->actingAs($operator)->put("/operator/pengumuman/{$pengumuman->id}", $payload);

        $response->assertRedirect(route('operator.pengumuman'));
        
        $pengumuman->refresh();
        $this->assertEquals('Judul Baru', $pengumuman->judul);
        $this->assertTrue($pengumuman->kelas->contains($kelasBaru->id));
        $this->assertFalse($pengumuman->kelas->contains($kelasLama->id));

        // File fisik seharusnya terhapus
        $this->assertFileDoesNotExist(public_path($fakePath));
        
        // Array lampiran harusnya kosong atau null
        $this->assertTrue(empty($pengumuman->lampiran));
    }

    // ---------------------------------------------------------------
    // UT-059 — destroyPengumuman: Menghapus data dan file
    // ---------------------------------------------------------------
    public function test_destroy_pengumuman_deletes_record_and_files(): void
    {
        $operator = $this->createOperator();
        
        $fakePath = 'uploads/pengumuman/test_destroy_' . time() . '.jpg';
        if (!is_dir(public_path('uploads/pengumuman'))) {
            mkdir(public_path('uploads/pengumuman'), 0777, true);
        }
        file_put_contents(public_path($fakePath), 'dummy');

        $pengumuman = Pengumuman::factory()->create([
            'lampiran' => [$fakePath]
        ]);

        $response = $this->actingAs($operator)->delete("/operator/pengumuman/{$pengumuman->id}");

        $response->assertRedirect(route('operator.pengumuman'));
        
        $this->assertDatabaseMissing('pengumumans', ['id' => $pengumuman->id]);
        $this->assertFileDoesNotExist(public_path($fakePath));
    }
}
