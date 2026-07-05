<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\JadwalPelajaran;
use App\Models\KalenderKegiatan;
use App\Models\Pengumuman;
use App\Models\Galeri;
use App\Models\Nilai;
use App\Models\Kehadiran;
use App\Models\Guru;
use Carbon\Carbon;

class OrangTuaController extends Controller
{
    /**
     * Mendapatkan anak (siswa) pertama dari orang tua yang sedang login.
     * Mengembalikan null jika belum ada anak yang ditautkan.
     */
    private function getSiswa()
    {
        $user = Auth::user();
        if (!$user || !$user->orangTua) return null;
        
        $siswas = $user->orangTua->siswas;
        if ($siswas->isEmpty()) return null;

        $activeId = session('active_siswa_id');
        if ($activeId) {
            $siswa = $siswas->where('id', $activeId)->first();
            if ($siswa) return $siswa;
        }

        $first = $siswas->first();
        session(['active_siswa_id' => $first->id]);
        return $first;
    }

    public function pilihAnak(Request $request)
    {
        $request->validate(['siswa_id' => 'required|exists:siswas,id']);
        session(['active_siswa_id' => $request->siswa_id]);
        return back();
    }

    public function dashboard()
    {
        $siswa = $this->getSiswa();
        
        // Ambil kalender kegiatan bulan ini
        $month = date('n');
        $year = date('Y');
        $kegiatans = KalenderKegiatan::whereMonth('tanggal', $month)
                                     ->whereYear('tanggal', $year)
                                     ->orderBy('tanggal', 'asc')
                                     ->take(3)
                                     ->get();

        $waliKelas = null;
        $pengumumanTerbaru = null;
        if ($siswa && $siswa->kelas_id) {
            $waliKelas = Guru::where('kelas_id', $siswa->kelas_id)->first();
            $pengumumanTerbaru = Pengumuman::whereHas('kelas', function($q) use ($siswa) {
                $q->where('kelas_id', $siswa->kelas_id);
            })->latest()->first();
        }

        // Kehadiran statistik (contoh: 100% hadir) - sederhana
        $persentaseKehadiran = 100;
        if ($siswa) {
            $totalHari = Kehadiran::where('siswa_id', $siswa->id)->count();
            if ($totalHari > 0) {
                $hadirCount = Kehadiran::where('siswa_id', $siswa->id)->where('status', 'hadir')->count();
                $persentaseKehadiran = round(($hadirCount / $totalHari) * 100);
            }
        }

        return view('orang_tua.dashboard', compact('siswa', 'kegiatans', 'waliKelas', 'pengumumanTerbaru', 'persentaseKehadiran'));
    }

    public function lihatNilai(Request $request)
    {
        $siswa = $this->getSiswa();
        
        $monthYear = $request->get('month_year', date('Y-m'));
        $parts = explode('-', $monthYear);
        $year = $parts[0] ?? date('Y');
        $month = $parts[1] ?? date('m');
        $week = $request->get('week', 'all');

        $nilais = [];
        if ($siswa) {
            $query = Nilai::where('siswa_id', $siswa->id)
                          ->whereMonth('tanggal', $month)
                          ->whereYear('tanggal', $year)
                          ->orderBy('tanggal', 'desc');
            
            $collection = $query->get();

            if ($week !== 'all') {
                $collection = $collection->filter(function($n) use ($week) {
                    return \Carbon\Carbon::parse($n->tanggal)->weekOfMonth == $week;
                });
            }
            $nilais = $collection;
        }

        // Kelompokkan nilai per tanggal
        $groupedNilai = [];
        foreach($nilais as $n) {
            $groupedNilai[$n->tanggal][] = $n;
        }

        return view('orang_tua.lihat_nilai', compact('siswa', 'groupedNilai', 'monthYear', 'week'));
    }

    public function lihatJadwal(Request $request)
    {
        $siswa = $this->getSiswa();
        $jadwals = [];
        if ($siswa && $siswa->kelas_id) {
            $jadwals = JadwalPelajaran::where('kelas_id', $siswa->kelas_id)->get();
        }

        $month = $request->get('month', date('n'));
        $year = $request->get('year', date('Y'));
        
        $kalenders = KalenderKegiatan::whereMonth('tanggal', $month)
                                     ->whereYear('tanggal', $year)
                                     ->get();

        return view('orang_tua.lihat_jadwal', compact('siswa', 'jadwals', 'month', 'year', 'kalenders'));
    }

    public function lihatKehadiran(Request $request)
    {
        $siswa = $this->getSiswa();
        
        $month = $request->get('month', date('n'));
        $year = $request->get('year', date('Y'));
        
        $kehadirans = [];
        $totalHadir = 0;
        $totalSakit = 0;
        $totalIzin = 0;
        $totalAlfa = 0;
        $persentase = 0;

        if ($siswa) {
            $semuaKehadiran = Kehadiran::where('siswa_id', $siswa->id)
                                        ->whereMonth('tanggal', $month)
                                        ->whereYear('tanggal', $year)
                                        ->get();
            
            $kehadirans = $semuaKehadiran->keyBy(function($item) {
                return \Carbon\Carbon::parse($item->tanggal)->format('j');
            });

            $totalHadir = $semuaKehadiran->where('status', 'hadir')->count();
            $totalSakit = $semuaKehadiran->where('status', 'sakit')->count();
            $totalIzin = $semuaKehadiran->where('status', 'izin')->count();
            $totalAlfa = $semuaKehadiran->where('status', 'alfa')->count();

            $total = $semuaKehadiran->count();
            if ($total > 0) {
                $persentase = round(($totalHadir / $total) * 100);
            }
        }

        return view('orang_tua.lihat_kehadiran', compact(
            'siswa', 'kehadirans', 'month', 'year',
            'totalHadir', 'totalSakit', 'totalIzin', 'totalAlfa', 'persentase'
        ));
    }

    public function lihatPengumuman()
    {
        $siswa = $this->getSiswa();
        $pengumumans = [];
        if ($siswa && $siswa->kelas_id) {
            $pengumumans = Pengumuman::whereHas('kelas', function($q) use ($siswa) {
                $q->where('kelas_id', $siswa->kelas_id);
            })->orderBy('created_at', 'desc')->get();
        }

        return view('orang_tua.lihat_pengumuman', compact('siswa', 'pengumumans'));
    }

    public function fotoKegiatan()
    {
        $siswa = $this->getSiswa();
        $galeris = [];
        if ($siswa && $siswa->kelas_id) {
            $galeris = Galeri::whereHas('kelas', function($q) use ($siswa) {
                $q->where('kelas_id', $siswa->kelas_id);
            })->orderBy('tanggal_kegiatan', 'desc')->get();
        }

        return view('orang_tua.foto_kegiatan', compact('siswa', 'galeris'));
    }

    public function hubungiGuru()
    {
        $siswa = $this->getSiswa();
        $guru = null;
        if ($siswa && $siswa->kelas_id) {
            $guru = Guru::where('kelas_id', $siswa->kelas_id)->first();
        }

        return view('orang_tua.hubungi_guru', compact('siswa', 'guru'));
    }

    public function unduhLaporan()
    {
        $siswa = $this->getSiswa();
        
        return view('orang_tua.unduh_laporan', compact('siswa'));
    }

    public function profil()
    {
        $user = auth()->user();
        $orangTua = $user->orangTua;
        $siswas = $orangTua ? $orangTua->siswas : collect([]);
        
        return view('orang_tua.profil', compact('user', 'orangTua', 'siswas'));
    }
}
