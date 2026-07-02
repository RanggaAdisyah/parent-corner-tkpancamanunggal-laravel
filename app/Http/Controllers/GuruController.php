<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kehadiran;
use App\Models\Nilai;
use App\Models\JadwalPelajaran;
use App\Models\Galeri;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    private function getGuru()
    {
        return Guru::where('user_id', Auth::id())->first();
    }

    public function dashboard()
    {
        $guru = $this->getGuru();
        
        $jumlahMurid = 0;
        if ($guru && $guru->kelas_id) {
            $jumlahMurid = Siswa::where('kelas_id', $guru->kelas_id)
                                ->orWhere('kelas', optional($guru->kelas)->nama_kelas) // Fallback for old string mapping
                                ->count();
        }

        return view('guru.dashboard', compact('guru', 'jumlahMurid'));
    }

    public function kehadiran()
    {
        $guru = $this->getGuru();
        $siswas = [];
        if ($guru && $guru->kelas_id) {
            $siswas = Siswa::where('kelas_id', $guru->kelas_id)
                           ->orWhere('kelas', optional($guru->kelas)->nama_kelas)
                           ->get();
        }

        return view('guru.kehadiran', compact('guru', 'siswas'));
    }

    public function storeKehadiran(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kehadiran' => 'required|array',
            'kehadiran.*' => 'in:hadir,sakit,izin,alpa',
            'keterangan' => 'nullable|array',
        ]);

        foreach ($request->kehadiran as $siswa_id => $status) {
            Kehadiran::updateOrCreate(
                ['siswa_id' => $siswa_id, 'tanggal' => $request->tanggal],
                [
                    'status' => $status,
                    'keterangan' => $request->keterangan[$siswa_id] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Data kehadiran berhasil disimpan.');
    }

    public function nilai()
    {
        $guru = $this->getGuru();
        $siswas = [];
        if ($guru && $guru->kelas_id) {
            $siswas = Siswa::where('kelas_id', $guru->kelas_id)
                           ->orWhere('kelas', optional($guru->kelas)->nama_kelas)
                           ->get();
        }

        return view('guru.nilai', compact('guru', 'siswas'));
    }

    public function storeNilai(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'nilai' => 'required|array',
            'catatan' => 'nullable|array',
        ]);

        foreach ($request->nilai as $kegiatan => $nilai_val) {
            if (!empty($nilai_val)) {
                Nilai::updateOrCreate(
                    [
                        'siswa_id' => $request->siswa_id, 
                        'tanggal' => $request->tanggal,
                        'kegiatan' => $kegiatan
                    ],
                    [
                        'nilai' => $nilai_val,
                        'catatan' => $request->catatan[$kegiatan] ?? null,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Data nilai berhasil disimpan.');
    }

    public function jadwal()
    {
        $guru = $this->getGuru();
        $jadwals = [];
        if ($guru && $guru->kelas_id) {
            $jadwals = JadwalPelajaran::where('kelas_id', $guru->kelas_id)->get();
        }

        return view('guru.lihat_jadwal', compact('guru', 'jadwals'));
    }

    public function galeri()
    {
        $guru = $this->getGuru();
        $galeris = Galeri::latest()->get(); // Bisa difilter sesuai kelas nanti
        return view('guru.galeri', compact('guru', 'galeris'));
    }

    public function storeGaleri(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $guru = $this->getGuru();

        $path = $request->file('foto')->store('galeri', 'public');

        Galeri::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $path,
            'user_id' => Auth::id(),
            // Assuming galeri class relation will be managed later
        ]);

        return redirect()->back()->with('success', 'Foto berhasil diunggah.');
    }

    public function destroyGaleri($id)
    {
        $galeri = Galeri::findOrFail($id);
        if ($galeri->user_id === Auth::id()) {
            Storage::disk('public')->delete($galeri->file_path);
            $galeri->delete();
        }
        return redirect()->back()->with('success', 'Foto berhasil dihapus.');
    }

    public function buatPengumuman()
    {
        return view('guru.pengumuman');
    }

    public function storePengumuman(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
        ]);

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'user_id' => Auth::id(),
            'role_pengirim' => 'guru',
        ]);

        return redirect()->route('guru.daftar-pengumuman')->with('success', 'Pengumuman berhasil dibuat.');
    }

    public function daftarPengumuman()
    {
        $pengumumans = Pengumuman::where('user_id', Auth::id())->latest()->get();
        return view('guru.daftar_pengumuman', compact('pengumumans'));
    }

    public function destroyPengumuman($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        if ($pengumuman->user_id === Auth::id()) {
            $pengumuman->delete();
        }
        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus.');
    }
}
