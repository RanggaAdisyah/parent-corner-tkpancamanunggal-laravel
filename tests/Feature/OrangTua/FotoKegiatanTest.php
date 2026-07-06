<?php

namespace Tests\Feature\OrangTua;

use App\Models\Galeri;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Carbon\Carbon;

/**
 * White-Box Testing — Modul Foto Kegiatan (Orang Tua)
 * UT-106
 */
class FotoKegiatanTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-106 — fotoKegiatan: Menampilkan galeri khusus kelas anak
    // ---------------------------------------------------------------
    public function test_foto_kegiatan_displays_class_galeri(): void
    {
        $user = User::factory()->create([
            'email'    => 'ortu_galeri@test.com',
            'username' => '08666666666',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Budi',
        ]);

        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas Anak']);
        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'kelas_id' => $kelas->id,
            'nama' => 'Budi Junior'
        ]);

        $this->actingAs($user);

        // Galeri milik kelas anak
        $galeriTerkait = Galeri::factory()->create([
            'judul' => 'Galeri Kelas Anak',
            'tanggal_kegiatan' => Carbon::now()->format('Y-m-d')
        ]);
        $galeriTerkait->kelas()->attach($kelas->id);

        // Galeri milik kelas lain
        $kelasLain = Kelas::factory()->create(['nama_kelas' => 'Kelas Tetangga']);
        $galeriLain = Galeri::factory()->create([
            'judul' => 'Galeri Kelas Tetangga',
            'tanggal_kegiatan' => Carbon::now()->format('Y-m-d')
        ]);
        $galeriLain->kelas()->attach($kelasLain->id);

        $response = $this->get('/orang-tua/foto-kegiatan');

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.foto_kegiatan');
        
        $response->assertViewHas('galeris');
        $galeris = $response->viewData('galeris');
        
        // Cek bahwa data yang ditarik hanya data milik kelas anaknya
        $this->assertTrue($galeris->contains('judul', 'Galeri Kelas Anak'));
        $this->assertFalse($galeris->contains('judul', 'Galeri Kelas Tetangga'));

        // Cek render text (asumsi blade menampilkan judul galeri)
        $response->assertSee('Galeri Kelas Anak');
        $response->assertDontSee('Galeri Kelas Tetangga');
    }
}
