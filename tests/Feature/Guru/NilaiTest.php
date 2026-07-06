<?php

namespace Tests\Feature\Guru;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

/**
 * White-Box Testing — Modul Nilai Guru
 * UT-076 s/d UT-079
 */
class NilaiTest extends TestCase
{
    use RefreshDatabase;

    private function createGuruAndLogin(): array
    {
        $user = User::factory()->create([
            'email'    => 'guru_nilai@test.com',
            'username' => '08333333333',
            'password' => Hash::make('password123'),
            'role'     => 'guru',
        ]);

        $kelas = Kelas::factory()->create();

        $guru = Guru::factory()->create([
            'user_id' => $user->id,
            'kelas_id' => $kelas->id
        ]);

        $this->actingAs($user);

        return [$user, $kelas, $guru];
    }

    // ---------------------------------------------------------------
    // UT-076 — nilai: Menampilkan halaman daftar siswa untuk dinilai
    // ---------------------------------------------------------------
    public function test_nilai_displays_page_with_students(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        
        Siswa::factory()->count(2)->create(['kelas_id' => $kelas->id]);
        Siswa::factory()->create(); // Siswa kelas lain

        $response = $this->get('/guru/nilai');

        $response->assertStatus(200);
        $response->assertViewIs('guru.nilai');
        $response->assertViewHas('guru');
        $response->assertViewHas('siswas', function ($siswas) {
            return $siswas->count() === 2;
        });
    }

    // ---------------------------------------------------------------
    // UT-077 — storeNilai: Validasi gagal jika form kosong
    // ---------------------------------------------------------------
    public function test_store_nilai_fails_validation_on_empty_fields(): void
    {
        $this->createGuruAndLogin();

        $response = $this->post('/guru/nilai', []);

        $response->assertSessionHasErrors(['siswa_id', 'tanggal', 'level', 'hal', 'nilai']);
    }

    // ---------------------------------------------------------------
    // UT-078 — storeNilai: Menyimpan atau update nilai
    // ---------------------------------------------------------------
    public function test_store_nilai_saves_or_updates_data(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        $siswa = Siswa::factory()->create(['kelas_id' => $kelas->id]);

        $payload = [
            'siswa_id' => $siswa->id,
            'tanggal' => '2023-11-01',
            'level' => 'IQRA 1',
            'hal' => '10',
            'nilai' => 'A',
            'keterangan' => 'Sangat Baik'
        ];

        $response = $this->post('/guru/nilai', $payload);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        // Note: field keterangan ter-enkripsi di model Nilai, jadi kita tidak bisa langsung
        // assertDatabaseHas() jika mencocokkan string mentah. 
        // Kita cukup assert field lain, lalu assert keterangan via get instance.
        $this->assertDatabaseHas('nilais', [
            'siswa_id' => $siswa->id,
            'tanggal' => '2023-11-01',
            'level' => 'IQRA 1',
            'hal' => '10',
            'nilai' => 'A'
        ]);

        $nilai = Nilai::where('siswa_id', $siswa->id)->where('tanggal', '2023-11-01')->first();
        $this->assertEquals('Sangat Baik', $nilai->keterangan); // Test decrypt berhasil

        // Test Update (updateOrCreate behavior)
        $payload['nilai'] = 'B';
        $payload['keterangan'] = 'Ada sedikit kesalahan';
        $this->post('/guru/nilai', $payload);

        $nilai->refresh();
        $this->assertEquals('B', $nilai->nilai);
        $this->assertEquals('Ada sedikit kesalahan', $nilai->keterangan);
        $this->assertDatabaseCount('nilais', 1); // Harus tetap 1 record
    }

    // ---------------------------------------------------------------
    // UT-079 — getNilaiSiswa: Ambil JSON riwayat nilai
    // ---------------------------------------------------------------
    public function test_get_nilai_siswa_returns_json(): void
    {
        [$user, $kelas, $guru] = $this->createGuruAndLogin();
        $siswa = Siswa::factory()->create(['kelas_id' => $kelas->id]);
        
        Nilai::factory()->create([
            'siswa_id' => $siswa->id,
            'tanggal' => '2023-11-05',
            'level' => 'AL-QURAN',
            'hal' => '2',
            'nilai' => 'A'
        ]);

        // Request API AJAX (GET)
        $response = $this->getJson("/guru/get-nilai-siswa?siswa_id={$siswa->id}&tanggal=2023-11-05");

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'siswa_id' => $siswa->id,
            'tanggal' => '2023-11-05',
            'level' => 'AL-QURAN',
            'hal' => '2',
            'nilai' => 'A'
        ]);
    }
}
