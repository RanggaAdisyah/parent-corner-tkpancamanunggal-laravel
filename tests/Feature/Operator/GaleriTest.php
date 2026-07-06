<?php

namespace Tests\Feature\Operator;

use App\Models\Galeri;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Galeri Kegiatan
 * UT-060 s/d UT-065
 */
class GaleriTest extends TestCase
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
    // UT-060 — indexGaleri
    // ---------------------------------------------------------------
    public function test_index_galeri_displays_data(): void
    {
        $operator = $this->createOperator();
        Galeri::factory()->count(2)->create();

        $response = $this->actingAs($operator)->get('/operator/galeri');

        $response->assertStatus(200);
        $response->assertViewIs('operator.galeri_kegiatan');
        $response->assertViewHas('galeris');
    }

    // ---------------------------------------------------------------
    // UT-061 — createGaleri
    // ---------------------------------------------------------------
    public function test_create_galeri_displays_form(): void
    {
        $operator = $this->createOperator();
        Kelas::factory()->count(2)->create();

        $response = $this->actingAs($operator)->get('/operator/galeri/buat');

        $response->assertStatus(200);
        $response->assertViewIs('operator.buat_galeri');
        $response->assertViewHas('kelasList');
    }

    // ---------------------------------------------------------------
    // UT-062 — storeGaleri
    // ---------------------------------------------------------------
    public function test_store_galeri_creates_record_and_syncs_kelas(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();

        $file1 = UploadedFile::fake()->image('foto1.jpg');
        $file2 = UploadedFile::fake()->image('foto2.jpg');

        $payload = [
            'judul' => 'Kegiatan Kartini',
            'deskripsi_kegiatan' => 'Lomba baju adat',
            'tanggal_kegiatan' => '2023-04-21',
            'target_kelas' => [$kelas->id],
            'foto' => [$file1, $file2],
            'cover_image' => 'new:foto2.jpg' // Menjadikan foto2 sebagai cover (index 0)
        ];

        $response = $this->actingAs($operator)->post('/operator/galeri', $payload);

        $response->assertRedirect(route('operator.galeri'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('galeris', [
            'judul' => 'Kegiatan Kartini',
            'tanggal_kegiatan' => '2023-04-21'
        ]);

        $galeri = Galeri::where('judul', 'Kegiatan Kartini')->first();
        
        $this->assertTrue($galeri->kelas->contains($kelas->id));
        $this->assertIsArray($galeri->foto);
        $this->assertCount(2, $galeri->foto);

        // Jika cover ditentukan ke foto2, namanya pasti ada string 'foto2.jpg' di index 0
        $this->assertStringContainsString('foto2.jpg', $galeri->foto[0]);

        // Cleanup
        foreach ($galeri->foto as $path) {
            @unlink(public_path($path));
        }
    }

    // ---------------------------------------------------------------
    // UT-063 — editGaleri
    // ---------------------------------------------------------------
    public function test_edit_galeri_displays_form(): void
    {
        $operator = $this->createOperator();
        $galeri = Galeri::factory()->create();

        $response = $this->actingAs($operator)->get("/operator/galeri/{$galeri->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('operator.edit_galeri');
        $response->assertViewHas('galeri');
        $response->assertViewHas('kelasList');
        $response->assertViewHas('selectedKelas');
    }

    // ---------------------------------------------------------------
    // UT-064 — updateGaleri
    // ---------------------------------------------------------------
    public function test_update_galeri_modifies_data_and_deletes_files(): void
    {
        $operator = $this->createOperator();
        $kelas = Kelas::factory()->create();

        // Buat file dummy lama
        $fakePath1 = 'uploads/galeri/test_lama1_' . time() . '.jpg';
        $fakePath2 = 'uploads/galeri/test_lama2_' . time() . '.jpg';
        if (!is_dir(public_path('uploads/galeri'))) {
            mkdir(public_path('uploads/galeri'), 0777, true);
        }
        file_put_contents(public_path($fakePath1), 'dummy1');
        file_put_contents(public_path($fakePath2), 'dummy2');

        $galeri = Galeri::factory()->create([
            'judul' => 'Judul Lama',
            'foto' => [$fakePath1, $fakePath2]
        ]);
        $galeri->kelas()->attach($kelas->id);

        $fileBaru = UploadedFile::fake()->image('foto_baru.jpg');

        $payload = [
            'judul' => 'Judul Baru Update',
            'target_kelas' => [$kelas->id],
            'foto' => [$fileBaru],
            'deleted_files' => [$fakePath1], // Hapus file lama 1
            'cover_image' => 'old:'.$fakePath2 // Jadikan file lama 2 sebagai cover
        ];

        $response = $this->actingAs($operator)->put("/operator/galeri/{$galeri->id}", $payload);

        $response->assertRedirect(route('operator.galeri'));
        
        $galeri->refresh();
        $this->assertEquals('Judul Baru Update', $galeri->judul);

        $this->assertFileDoesNotExist(public_path($fakePath1));
        
        $this->assertIsArray($galeri->foto);
        $this->assertCount(2, $galeri->foto); // sisa lama2 + foto_baru
        
        // Cek bahwa cover lama2 ada di index 0
        $this->assertEquals($fakePath2, $galeri->foto[0]);
        $this->assertStringContainsString('foto_baru.jpg', $galeri->foto[1]);

        // Cleanup
        @unlink(public_path($fakePath2));
        @unlink(public_path($galeri->foto[1]));
    }

    // ---------------------------------------------------------------
    // UT-065 — destroyGaleri
    // ---------------------------------------------------------------
    public function test_destroy_galeri_deletes_record_and_files(): void
    {
        $operator = $this->createOperator();
        
        $fakePath = 'uploads/galeri/test_destroy_' . time() . '.jpg';
        if (!is_dir(public_path('uploads/galeri'))) {
            mkdir(public_path('uploads/galeri'), 0777, true);
        }
        file_put_contents(public_path($fakePath), 'dummy');

        $galeri = Galeri::factory()->create([
            'foto' => [$fakePath]
        ]);

        $response = $this->actingAs($operator)->delete("/operator/galeri/{$galeri->id}");

        $response->assertRedirect(route('operator.galeri'));
        
        $this->assertDatabaseMissing('galeris', ['id' => $galeri->id]);
        $this->assertFileDoesNotExist(public_path($fakePath));
    }
}
