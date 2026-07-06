<?php

namespace Tests\Feature\OrangTua;

use App\Models\Nilai;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Carbon\Carbon;

/**
 * White-Box Testing — Modul Lihat Nilai (Orang Tua)
 * UT-102
 */
class LihatNilaiTest extends TestCase
{
    use RefreshDatabase;

    // ---------------------------------------------------------------
    // UT-102 — lihatNilai: Menampilkan nilai anak yang dikelompokkan
    // ---------------------------------------------------------------
    public function test_lihat_nilai_displays_grouped_nilai(): void
    {
        $user = User::factory()->create([
            'email'    => 'ortu_nilai@test.com',
            'username' => '08222222222',
            'password' => Hash::make('password123'),
            'role'     => 'orang_tua',
        ]);

        $orangTua = OrangTua::factory()->create([
            'user_id' => $user->id,
            'nama_ayah' => 'Bapak Budi',
        ]);

        $siswa = Siswa::factory()->create([
            'orang_tua_id' => $orangTua->id,
            'nama' => 'Budi Junior'
        ]);

        $this->actingAs($user);

        // Buat data nilai bulan ini
        $now = Carbon::now();
        $nilai = Nilai::factory()->create([
            'siswa_id' => $siswa->id,
            'level' => 'Jilid 1',
            'hal' => '12',
            'nilai' => 'B',
            'tanggal' => $now->format('Y-m-d')
        ]);

        $response = $this->get('/orang-tua/lihat-nilai?month_year=' . $now->format('Y-m'));

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.lihat_nilai');
        
        $response->assertViewHas('groupedNilai');
        $groupedNilai = $response->viewData('groupedNilai');

        // Pastikan nilai terkelompokkan dengan benar berdasarkan tanggal
        $this->assertArrayHasKey($now->format('Y-m-d'), $groupedNilai);
        $this->assertEquals('Jilid 1', $groupedNilai[$now->format('Y-m-d')][0]->level);

        $response->assertSee('Jilid 1');
        $response->assertSee('12');
    }
}
