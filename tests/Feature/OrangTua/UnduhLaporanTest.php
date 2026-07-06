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
 * White-Box Testing — Modul Unduh & Cetak Laporan (Orang Tua)
 * UT-108 s/d UT-109
 */
class UnduhLaporanTest extends TestCase
{
    use RefreshDatabase;

    private function createOrangTuaAndLogin(): array
    {
        $user = User::factory()->create([
            'email'    => 'ortu_laporan@test.com',
            'username' => '08777777777',
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

        return [$user, $orangTua, $siswa];
    }

    // ---------------------------------------------------------------
    // UT-108 — unduhLaporan: Menampilkan daftar bulan berdasarkan data nilai
    // ---------------------------------------------------------------
    public function test_unduh_laporan_displays_available_months(): void
    {
        [$user, $orangTua, $siswa] = $this->createOrangTuaAndLogin();

        // Buat nilai di bulan saat ini dan bulan lalu
        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        Nilai::factory()->create([
            'siswa_id' => $siswa->id,
            'tanggal' => $now->format('Y-m-d')
        ]);
        
        Nilai::factory()->create([
            'siswa_id' => $siswa->id,
            'tanggal' => $lastMonth->format('Y-m-d')
        ]);

        $response = $this->get('/orang-tua/unduh-laporan');

        $response->assertStatus(200);
        $response->assertViewIs('orang_tua.unduh_laporan');
        
        $response->assertViewHas('months');
        $months = $response->viewData('months');
        
        // Assert unik bulan berhasil diekstrak dan di-sort desc
        $this->assertCount(2, $months);
        $this->assertTrue($months->contains($now->format('Y-m')));
        $this->assertTrue($months->contains($lastMonth->format('Y-m')));
        $this->assertEquals($now->format('Y-m'), $months->first()); // Sort desc check
    }

    // ---------------------------------------------------------------
    // UT-109 — cetakLaporan: Menampilkan nilai khusus bulan tertentu
    // ---------------------------------------------------------------
    public function test_cetak_laporan_displays_nilai_for_given_month_and_redirects_empty(): void
    {
        [$user, $orangTua, $siswa] = $this->createOrangTuaAndLogin();

        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        $nilaiBulanIni = Nilai::factory()->create([
            'siswa_id' => $siswa->id,
            'level' => 'Jilid 1',
            'tanggal' => $now->format('Y-m-d')
        ]);
        
        $nilaiBulanLalu = Nilai::factory()->create([
            'siswa_id' => $siswa->id,
            'level' => 'Jilid 2',
            'tanggal' => $lastMonth->format('Y-m-d')
        ]);

        // Tes 1: Request tanpa parameter month_year -> redirect back
        // Karena tidak ada header Referer di test HTTP, default fallback adalah '/'
        $responseRedirect = $this->from('/orang-tua/unduh-laporan')->get('/orang-tua/cetak-laporan');
        $responseRedirect->assertRedirect('/orang-tua/unduh-laporan');

        // Tes 2: Request dengan parameter month_year valid
        $responseValid = $this->get('/orang-tua/cetak-laporan?month_year=' . $now->format('Y-m'));

        $responseValid->assertStatus(200);
        $responseValid->assertViewIs('orang_tua.cetak_laporan');
        
        $responseValid->assertViewHas('nilais');
        $nilais = $responseValid->viewData('nilais');

        $this->assertCount(1, $nilais);
        $this->assertEquals($nilaiBulanIni->id, $nilais->first()->id);
        $this->assertEquals('Jilid 1', $nilais->first()->level);
        
        // Assert nilai bulan lalu tidak ikut masuk
        $this->assertFalse($nilais->contains('id', $nilaiBulanLalu->id));
    }
}
