<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Pengumuman Guru
 * UT-091 s/d UT-096
 */
class PengumumanTest extends TestCase
{
    use RefreshDatabase;

    private function createGuruAndLogin(): array
    {
        $user = User::factory()->create([
            'email'    => 'guru_pengumuman@test.com',
            'username' => '08666666666',
            'password' => Hash::make('password123'),
            'role'     => 'guru',
        ]);

        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas A']);
        $guru = Guru::factory()->create(['user_id' => $user->id, 'kelas_id' => $kelas->id]);

        $this->actingAs($user);

        return [$user, $kelas, $guru];
    }

    // ---------------------------------------------------------------
    // UT-091 — daftarPengumuman: Menampilkan pengumuman kelas sendiri
    // ---------------------------------------------------------------
    public function test_daftar_pengumuman_displays_own_class_only(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        $pengumumanSendiri = Pengumuman::factory()->create();
        $pengumumanSendiri->kelas()->attach($kelas->id);

        $kelasLain = Kelas::factory()->create();
        $pengumumanLain = Pengumuman::factory()->create();
        $pengumumanLain->kelas()->attach($kelasLain->id);

        $response = $this->get('/guru/daftar-pengumuman');

        $response->assertStatus(200);
        $response->assertViewIs('guru.daftar_pengumuman');
        $response->assertSee($pengumumanSendiri->judul);
        $response->assertDontSee($pengumumanLain->judul);
    }

    // ---------------------------------------------------------------
    // UT-092 — buatPengumuman: Menampilkan form buat
    // ---------------------------------------------------------------
    public function test_buat_pengumuman_displays_form(): void
    {
        $this->createGuruAndLogin();
        $response = $this->get('/guru/buat-pengumuman');
        
        $response->assertStatus(200);
        $response->assertViewIs('guru.pengumuman');
    }

    // ---------------------------------------------------------------
    // UT-093 — storePengumuman: Validasi & simpan data
    // ---------------------------------------------------------------
    public function test_store_pengumuman_validates_and_saves(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        Storage::fake('public');

        // Test Empty fields validation
        $responseFail = $this->post('/guru/buat-pengumuman', []);
        $responseFail->assertSessionHasErrors(['judul', 'isi_pengumuman']);

        // Test Success
        $payload = [
            'judul' => 'Pengumuman Libur',
            'isi_pengumuman' => 'Besok libur nasional',
            'lampiran' => UploadedFile::fake()->image('surat.jpg', 100, 100)
        ];

        $response = $this->post('/guru/buat-pengumuman', $payload);

        $response->assertRedirect('/guru/daftar-pengumuman');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pengumumans', [
            'judul' => 'Pengumuman Libur'
        ]);

        $pengumuman = Pengumuman::where('judul', 'Pengumuman Libur')->first();
        $this->assertTrue($pengumuman->kelas->contains($kelas->id));
        $this->assertNotEmpty($pengumuman->lampiran);
    }

    // ---------------------------------------------------------------
    // UT-094 — editPengumuman: Cek akses 403 untuk kelas lain
    // ---------------------------------------------------------------
    public function test_edit_pengumuman_protects_cross_class_access(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        $pengumumanSendiri = Pengumuman::factory()->create();
        $pengumumanSendiri->kelas()->attach($kelas->id);

        $kelasLain = Kelas::factory()->create();
        $pengumumanLain = Pengumuman::factory()->create();
        $pengumumanLain->kelas()->attach($kelasLain->id);

        // Edit pengumuman milik kelas sendiri -> Sukses
        $response = $this->get("/guru/pengumuman/{$pengumumanSendiri->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('guru.edit_pengumuman');

        // Edit pengumuman kelas lain -> Gagal (403 Forbidden)
        $responseLain = $this->get("/guru/pengumuman/{$pengumumanLain->id}/edit");
        $responseLain->assertStatus(403);
    }

    // ---------------------------------------------------------------
    // UT-095 — updatePengumuman: Sukses mengupdate
    // ---------------------------------------------------------------
    public function test_update_pengumuman_saves_changes(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        $pengumuman = Pengumuman::factory()->create(['judul' => 'Lama']);
        $pengumuman->kelas()->attach($kelas->id);

        $payload = [
            'judul' => 'Baru Update',
            'isi_pengumuman' => 'Isi baru'
        ];

        $response = $this->put("/guru/pengumuman/{$pengumuman->id}", $payload);

        $response->assertRedirect('/guru/daftar-pengumuman');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pengumumans', [
            'id' => $pengumuman->id,
            'judul' => 'Baru Update',
            'isi_pesan' => 'Isi baru'
        ]);
    }

    // ---------------------------------------------------------------
    // UT-096 — destroyPengumuman: Detach & Delete
    // ---------------------------------------------------------------
    public function test_destroy_pengumuman_removes_record(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        $pengumuman = Pengumuman::factory()->create();
        $pengumuman->kelas()->attach($kelas->id);

        $response = $this->delete("/guru/pengumuman/{$pengumuman->id}");

        $response->assertRedirect(); // back()
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('pengumumans', [
            'id' => $pengumuman->id
        ]);
    }
}
