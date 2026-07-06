<?php

namespace Tests\Feature\OrangTua;

use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Pengumuman;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Lihat Pengumuman (Orang Tua)
 * UT-105
 */
class LihatPengumumanTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-105 — lihatPengumuman: Menampilkan daftar pengumuman untuk kelas anak
    // ---------------------------------------------------------------
    public function test_lihat_pengumuman_displays_class_announcements(): void
    {
        $user = User::factory()->create([
            'email'    => 'ortu_pengumuman@test.com',
            'username' => '08555555555',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Budi',
        ]);

        $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas C']);
        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'kelas_id' => $kelas->id,
            'nama' => 'Budi Junior'
        ]);

        $this->actingAs($user);

        // Buat pengumuman untuk kelas anak
        $pengumumanTerkait = Pengumuman::factory()->create([
            'judul' => 'Pengumuman Libur Kelas C'
        ]);
        $pengumumanTerkait->kelas()->attach($kelas->id);

        // Buat pengumuman untuk kelas lain
        $kelasLain = Kelas::factory()->create(['nama_kelas' => 'Kelas D']);
        $pengumumanLain = Pengumuman::factory()->create([
            'judul' => 'Pengumuman Rapat Kelas D'
        ]);
        $pengumumanLain->kelas()->attach($kelasLain->id);

        $response = $this->get('/orang-tua/lihat-pengumuman');

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.lihat_pengumuman');
        
        $response->assertViewHas('pengumumans');
        
        $pengumumans = $response->viewData('pengumumans');
        
        // Assert data pengumuman terkait ada
        $this->assertTrue($pengumumans->contains('judul', 'Pengumuman Libur Kelas C'));
        // Assert data pengumuman kelas lain tidak ada
        $this->assertFalse($pengumumans->contains('judul', 'Pengumuman Rapat Kelas D'));

        // Cek render (tergantung blade, kita asumsikan teks muncul)
        $response->assertSee('Pengumuman Libur Kelas C');
        $response->assertDontSee('Pengumuman Rapat Kelas D');
    }
}
