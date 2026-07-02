<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="description" content="Dashboard Orang Tua - Parent Corner TK Panca Manunggal" />
    <title>Beranda - Portal Orang Tua | TK Panca Manunggal</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/operator/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
<body>
    <div class="dashboard-guru">

        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar_orang_tua', ['active' => 'beranda'])

        <main class="main">

            {{-- ===== HERO BANNER ===== --}}
            <section class="hero-banner">
                <h1 class="hero-greeting">Selamat {{ (date('H') < 15) ? ((date('H') < 12) ? 'Pagi' : 'Siang') : ((date('H') < 18) ? 'Sore' : 'Malam') }}, {{ Auth::user()->name }}!</h1>
                <p class="hero-description">
                    Selamat datang di Dashboard Orang Tua. Pantau perkembangan ananda <strong>{{ $siswa ? $siswa->nama : '...' }}</strong>
                    hari ini. {{ $pengumumanTerbaru ? 'Ada pengumuman baru mengenai ' . Str::limit($pengumumanTerbaru->judul, 30) : 'Belum ada pengumuman terbaru saat ini.' }}
                </p>
                <button class="hero-btn" onclick="window.location.href='#'">
                    Lihat Pengumuman Terbaru
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </section>

            {{-- ===== AKSI CEPAT (Style Operator) ===== --}}
            <div class="dashboard-operator" style="display: contents;">
                <section class="heading" aria-labelledby="aksi-cepat-title" style="margin-top: 30px;">
                    <h2 class="text-8" id="aksi-cepat-title">Pilih Aksi Cepat</h2>
                </section>

                <section class="container-6" aria-label="Aksi cepat" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px;">
                    <a class="link-3" href="{{ url('/orang-tua/lihat-nilai') }}" aria-label="Lihat Nilai" style="grid-column: auto; grid-row: auto;">
                        <div class="background-2">
                            <div class="div">
                                <img class="icon-2" src="{{ asset('icon/guru/nilai.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-9">Lihat Nilai</div></div>
                        <div class="container-7"><p class="text-10">Pantau perkembangan akademik anak.</p></div>
                        <div class="container-8"><div class="text-11">Akses Menu</div></div>
                    </a>

                    <a class="link-3" href="{{ url('/orang-tua/lihat-jadwal') }}" aria-label="Lihat Jadwal" style="grid-column: auto; grid-row: auto;">
                        <div class="background-2" style="background-color: #fef08a;">
                            <div class="div">
                                <img class="icon-11" src="{{ asset('icon/guru/jadwal.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-9">Lihat Jadwal</div></div>
                        <div class="container-7"><p class="text-10">Cek jadwal pelajaran harian.</p></div>
                        <div class="container-8"><div class="text-11">Akses Menu</div></div>
                    </a>

                    <a class="link-3" href="{{ url('/orang-tua/lihat-kehadiran') }}" aria-label="Lihat Kehadiran" style="grid-column: auto; grid-row: auto;">
                        <div class="background-2" style="background-color: #dbeafe;">
                            <div class="div">
                                <img class="icon-2" src="{{ asset('icon/guru/kehadiran.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-9">Lihat Kehadiran</div></div>
                        <div class="container-7"><p class="text-10">Rekap absensi: {{ $persentaseKehadiran }}% Hadir.</p></div>
                        <div class="container-8"><div class="text-11">Akses Menu</div></div>
                    </a>

                    <a class="link-4" href="{{ url('/orang-tua/unduh-laporan') }}" aria-label="Unduh Laporan" style="grid-column: auto; grid-row: auto;">
                        <div class="background-3">
                            <div class="div">
                                <img class="icon-11" src="{{ asset('icon/guru/nilai.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-12">Unduh Laporan</div></div>
                        <div class="container-7"><p class="text-13">Download rapor dan dokumen lainnya.</p></div>
                        <div class="container-8"><div class="text-14">Akses Menu</div></div>
                    </a>

                    <a class="link-4" href="{{ url('/orang-tua/lihat-pengumuman') }}" aria-label="Pengumuman" style="grid-column: auto; grid-row: auto;">
                        <div class="background-3" style="background-color: #fecaca;">
                            <div class="div">
                                <img class="icon-5" src="{{ asset('icon/guru/pengumuman.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-12">Pengumuman</div></div>
                        <div class="container-7"><p class="text-13">Informasi agenda sekolah terkini.</p></div>
                        <div class="container-8"><div class="text-14">Akses Menu</div></div>
                    </a>

                    <a class="link-5" href="{{ url('/orang-tua/foto-kegiatan') }}" aria-label="Galeri Kegiatan" style="grid-column: auto; grid-row: auto;">
                        <div class="background-4" style="background-color: #fce7f3;">
                            <div class="div">
                                <img class="icon-14" src="{{ asset('icon/guru/foto.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-15" style="font-size: 16px;">Galeri Kegiatan</div></div>
                        <div class="container-7"><p class="text-16">Dokumentasi momen belajar anak.</p></div>
                        <div class="container-9"><div class="text-17">Akses Menu</div></div>
                    </a>

                    <a class="link-6" href="{{ url('/orang-tua/hubungi-guru') }}" aria-label="Hubungi Guru" style="grid-column: auto; grid-row: auto;">
                        <div class="background-5" style="background-color: #ccfbf1;">
                            <div class="div">
                                <img class="icon-2" src="{{ asset('icon/guru/kehadiran.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-18" style="font-size: 16px;">Hubungi Guru</div></div>
                        <div class="container-7"><p class="text-19">Kirim pesan ke wali kelas {{ $siswa ? $siswa->nama : '...' }}.</p></div>
                        <div class="container-9"><div class="text-20">Akses Menu</div></div>
                    </a>
                </section>
            </div>




            @include('partials.footer')
        </main>
    </div>
</body>
</html>
