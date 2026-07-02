<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="description" content="Dashboard Orang Tua - Parent Corner TK Panca Manunggal" />
    <title>Beranda - Portal Orang Tua | TK Panca Manunggal</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">

        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar_orang_tua', ['active' => 'beranda'])

        <main class="main">

            {{-- ===== HERO BANNER ===== --}}
            <section class="hero-banner">
                <h1 class="hero-greeting">Selamat {{ (date('H') < 15) ? ((date('H') < 12) ? 'Pagi' : 'Siang') : ((date('H') < 18) ? 'Sore' : 'Malam') }}, {{ Auth::user()->name }}! 👋</h1>
                <p class="hero-description">
                    Selamat datang di Dashboard Orang Tua. Pantau perkembangan ananda <strong>{{ $siswa ? $siswa->nama : '...' }}</strong>
                    hari ini. {{ $pengumumanTerbaru ? 'Ada pengumuman baru mengenai ' . Str::limit($pengumumanTerbaru->judul, 30) : 'Belum ada pengumuman terbaru saat ini.' }}
                </p>
                <button class="hero-btn" onclick="window.location.href='#'">
                    Lihat Pengumuman Terbaru
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </section>

            {{-- ===== MENU UTAMA ===== --}}
            <section>
                <div class="section-header">
                    <h2 class="section-title">Menu Utama</h2>
                    <span class="section-meta">Tahun Ajaran 2023/2024</span>
                </div>

                {{-- ROW 1: 4 kartu --}}
                <div class="menu-grid-top">
                    {{-- Lihat Nilai --}}
                    <a href="{{ url('/orang-tua/lihat-nilai') }}" class="menu-card" id="card-lihat-nilai">
                        <div class="menu-icon-wrap menu-icon-green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        </div>
                        <h3 class="menu-card-title">Lihat Nilai</h3>
                        <p class="menu-card-desc">Pantau perkembangan akademik dan laporan mingguan.</p>
                        <span class="menu-card-link link-green">
                            Akses Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    </a>

                    {{-- Lihat Jadwal --}}
                    <a href="{{ url('/orang-tua/lihat-jadwal') }}" class="menu-card" id="card-lihat-jadwal">
                        <div class="menu-icon-wrap menu-icon-orange">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <h3 class="menu-card-title">Lihat Jadwal</h3>
                        <p class="menu-card-desc">Cek jadwal pelajaran, ekstrakurikuler, dan libur.</p>
                        <span class="menu-card-link link-orange">
                            Akses Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    </a>

                    {{-- Lihat Absensi --}}
                    <a href="{{ url('/orang-tua/lihat-kehadiran') }}" class="menu-card" id="card-lihat-absensi">
                        <div class="menu-icon-wrap menu-icon-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </div>
                        <h3 class="menu-card-title">Lihat Absensi</h3>
                        <p class="menu-card-desc">Rekap kehadiran siswa keseluruhan: <strong>{{ $persentaseKehadiran }}%</strong></p>
                        <span class="menu-card-link link-purple">
                            Akses Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    </a>

                    {{-- Foto Kegiatan --}}
                    <a href="{{ url('/orang-tua/foto-kegiatan') }}" class="menu-card" id="card-foto-kegiatan">
                        <div class="menu-icon-wrap menu-icon-pink">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        </div>
                        <h3 class="menu-card-title">Foto Kegiatan</h3>
                        <p class="menu-card-desc">Dokumentasi kegiatan belajar mengajar dan acara.</p>
                        <span class="menu-card-link link-pink">
                            Akses Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    </a>
                </div>

                {{-- ROW 2: 3 kartu --}}
                <div class="menu-grid-bottom">
                    {{-- Hubungi Guru --}}
                    <a href="{{ url('/orang-tua/hubungi-guru') }}" class="menu-card" id="card-hubungi-guru">
                        <div class="menu-icon-wrap menu-icon-teal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        </div>
                        <h3 class="menu-card-title">Hubungi Guru</h3>
                        <p class="menu-card-desc">Kirim pesan langsung ke wali kelas {{ $siswa ? $siswa->nama : '...' }}.</p>
                        <span class="menu-card-link link-teal">
                            Akses Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    </a>

                    {{-- Lihat Pengumuman --}}
                    <a href="{{ url('/orang-tua/lihat-pengumuman') }}" class="menu-card" id="card-pengumuman">
                        <div class="menu-icon-wrap menu-icon-red">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        </div>
                        <h3 class="menu-card-title">Lihat Pengumuman</h3>
                        <p class="menu-card-desc">Informasi penting sekolah dan agenda mendatang.</p>
                        <span class="menu-card-link link-red">
                            Akses Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    </a>

                    {{-- Unduh Laporan --}}
                    <a href="{{ url('/orang-tua/unduh-laporan') }}" class="menu-card" id="card-unduh-laporan">
                        <div class="menu-icon-wrap menu-icon-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        </div>
                        <h3 class="menu-card-title">Unduh Laporan</h3>
                        <p class="menu-card-desc">Download rapor semester dan dokumen administratif.</p>
                        <span class="menu-card-link link-blue">
                            Akses Sekarang
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </span>
                    </a>
                </div>
            </section>

            {{-- ===== BOTTOM: AKTIVITAS + WALI KELAS ===== --}}
            <div class="bottom-grid">

                {{-- Aktivitas Mendatang --}}
                <div class="activity-card">
                    <h2 class="card-title">Aktivitas Mendatang (Bulan Ini)</h2>

                    @forelse($kegiatans as $kegiatan)
                    <div class="activity-item">
                        <div class="activity-date-box">
                            <span class="date-day">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d') }}</span>
                            <span class="date-month">{{ strtoupper(\Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('M')) }}</span>
                        </div>
                        <div class="activity-info">
                            <p class="activity-title">{{ $kegiatan->nama_kegiatan }}</p>
                            <p class="activity-desc">{{ $kegiatan->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                        </div>
                    </div>
                    @empty
                    <div style="padding: 20px; text-align: center; color: #64748b; font-size: 14px;">
                        Belum ada jadwal aktivitas di bulan ini.
                    </div>
                    @endforelse
                </div>

                {{-- Wali Kelas --}}
                <div class="wali-card">
                    <h2 class="card-title">Wali Kelas</h2>

                    @if($waliKelas)
                    <div class="wali-avatar-wrap">
                        <div class="wali-avatar-placeholder">{{ substr($waliKelas->nama_guru, 0, 2) }}</div>
                    </div>

                    <p class="wali-name">{{ $waliKelas->nama_guru }}</p>
                    <p class="wali-role">Wali Kelas {{ $siswa && $siswa->kelasLokal ? $siswa->kelasLokal->nama_kelas : 'Belum Ditentukan' }}</p>

                    <div class="wali-subject-tag">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                        Kelas {{ $siswa && $siswa->kelasLokal ? $siswa->kelasLokal->nama_kelas : '-' }}
                    </div>

                    <hr class="wali-divider">

                    <div class="wali-contacts">
                        <div class="wali-contact-item">
                            <svg class="wali-contact-icon" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.41 2 2 0 0 1 3.6 1.23h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.73a16 16 0 0 0 6 6l1.06-.95a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            {{ $waliKelas->no_wa ?? 'Tidak ada nomor' }}
                        </div>
                    </div>

                    <a href="{{ url('/orang-tua/hubungi-guru') }}" class="btn-hubungi" id="btn-hubungi-guru" style="text-decoration: none; text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        Hubungi
                    </a>
                    @else
                    <div style="padding: 20px; text-align: center; color: #64748b; font-size: 14px;">
                        Data wali kelas belum tersedia.
                    </div>
                    @endif
                </div>

            </div>{{-- /bottom-grid --}}


            @include('partials.footer')
        </main>
    </div>
</body>
</html>
