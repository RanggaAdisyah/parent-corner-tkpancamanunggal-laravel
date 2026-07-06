<?php

namespace Tests\Feature\Guru;

use App\Models\Galeri;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Galeri Guru
 * UT-084 s/d UT-089
 */
class GaleriTest extends TestCase
{
    use RefreshDatabase;

    private function createGuruAndLogin(): array
    {
        $user = User::factory()->create([
            'email'    => 'guru_galeri@test.com',
            'username' => '08555555555',
            'password' => Hash::make('password123'),
            'role'     => 'guru',
        ]);

        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas A']);
        $guru = Guru::factory()->create(['user_id' => $user->id, 'kelas_id' => $kelas->id]);

        $this->actingAs($user);

        return [$user, $kelas, $guru];
    }

    // ---------------------------------------------------------------
    // UT-084 — galeri: Menampilkan galeri milik kelas sendiri
    // ---------------------------------------------------------------
    public function test_galeri_displays_own_class_galeri_only(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        $galeriSendiri = Galeri::factory()->create();
        $galeriSendiri->kelas()->attach($kelas->id);

        $kelasLain = Kelas::factory()->create();
        $galeriLain = Galeri::factory()->create();
        $galeriLain->kelas()->attach($kelasLain->id);

        $response = $this->get('/guru/galeri-kegiatan');

        $response->assertStatus(200);
        $response->assertViewIs('guru.galeri');
        $response->assertSee($galeriSendiri->judul);
        $response->assertDontSee($galeriLain->judul);
    }

    // ---------------------------------------------------------------
    // UT-085 — createGaleri: Menampilkan form buat galeri
    // ---------------------------------------------------------------
    public function test_create_galeri_displays_form(): void
    {
        $this->createGuruAndLogin();
        $response = $this->get('/guru/galeri-kegiatan/buat');
        
        $response->assertStatus(200);
        $response->assertViewIs('guru.buat_galeri');
    }

    // ---------------------------------------------------------------
    // UT-086 — storeGaleri: Validasi gagal jika input kosong
    // ---------------------------------------------------------------
    public function test_store_galeri_fails_validation_on_empty_fields(): void
    {
        $this->createGuruAndLogin();
        $response = $this->post('/guru/galeri-kegiatan', []);
        
        $response->assertSessionHasErrors(['judul', 'foto']); // Judul & Foto is required
    }

    // ---------------------------------------------------------------
    // UT-087 — storeGaleri: Sukses upload foto dan simpan data
    // ---------------------------------------------------------------
    public function test_store_galeri_saves_data_and_attaches_class(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        Storage::fake('public');

        $payload = [
            'judul' => 'Kegiatan Mewarnai',
            'deskripsi_kegiatan' => 'Anak-anak mewarnai bersama',
            'tanggal_kegiatan' => '2023-11-01',
            'kategori' => ['Seni & Kreativitas'],
            'foto' => [UploadedFile::fake()->image('mewarnai.jpg', 500, 500)]
        ];

        $response = $this->post('/guru/galeri-kegiatan', $payload);

        $response->assertRedirect('/guru/galeri-kegiatan');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('galeris', [
            'judul' => 'Kegiatan Mewarnai'
        ]);

        $galeri = Galeri::where('judul', 'Kegiatan Mewarnai')->first();
        $this->assertTrue($galeri->kelas->contains($kelas->id));
        $this->assertCount(1, $galeri->foto);
    }

    // ---------------------------------------------------------------
    // UT-088 — editGaleri: Form edit galeri dan proteksi ID
    // ---------------------------------------------------------------
    public function test_edit_galeri_displays_form_for_own_galeri(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        $galeriSendiri = Galeri::factory()->create();
        $galeriSendiri->kelas()->attach($kelas->id);

        $kelasLain = Kelas::factory()->create();
        $galeriLain = Galeri::factory()->create();
        $galeriLain->kelas()->attach($kelasLain->id);

        // Edit galeri milik kelas sendiri -> Sukses
        $response = $this->get("/guru/galeri-kegiatan/{$galeriSendiri->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('guru.edit_galeri');
        $response->assertViewHas('galeri');

        // Edit galeri kelas lain -> Gagal (404 / NotFoundHttpException karena findOrFail)
        $responseLain = $this->get("/guru/galeri-kegiatan/{$galeriLain->id}/edit");
        $responseLain->assertStatus(404);
    }

    // ---------------------------------------------------------------
    // UT-089 — updateGaleri: Sukses mengupdate galeri
    // ---------------------------------------------------------------
    public function test_update_galeri_saves_changes(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        $galeri = Galeri::factory()->create(['judul' => 'Judul Lama', 'foto' => []]);
        $galeri->kelas()->attach($kelas->id);

        $payload = [
            'judul' => 'Judul Baru Update',
            'deskripsi_kegiatan' => 'Update deskripsi'
        ];

        $response = $this->put("/guru/galeri-kegiatan/{$galeri->id}", $payload);

        $response->assertRedirect('/guru/galeri-kegiatan');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('galeris', [
            'id' => $galeri->id,
            'judul' => 'Judul Baru Update',
            'deskripsi' => 'Update deskripsi'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-090 — destroyGaleri: Sukses menghapus galeri
    // ---------------------------------------------------------------
    public function test_destroy_galeri_removes_record(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        $galeri = Galeri::factory()->create(['judul' => 'Galeri Untuk Dihapus', 'foto' => []]);
        $galeri->kelas()->attach($kelas->id);

        $response = $this->delete("/guru/galeri-kegiatan/{$galeri->id}");

        $response->assertRedirect('/guru/galeri-kegiatan');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('galeris', [
            'id' => $galeri->id
        ]);
    }
}
