<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/operator/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_guru', ['active' => 'dashboard'])

        <main class="main">
            {{-- ===== HERO BANNER ===== --}}
            <section class="hero-banner" style="display: flex; justify-content: space-between; align-items: center; gap: 20px; flex-wrap: wrap;">
                <div>
                    <h1 class="hero-greeting">Selamat {{ (date('H') < 15) ? ((date('H') < 12) ? 'Pagi' : 'Siang') : ((date('H') < 18) ? 'Sore' : 'Malam') }}, Bapak/Ibu {{ $guru ? $guru->nama_lengkap : 'Guru' }}!</h1>
                    <p class="hero-description" style="max-width: 600px;">
                        Semoga hari ini menyenangkan. Silakan pilih menu di bawah untuk mengelola aktivitas kelas hari ini.
                    </p>
                </div>
                <div style="background: rgba(255,255,255,0.2); padding: 16px 32px; border-radius: 12px; text-align: center; min-width: 100px;">
                    <div style="font-size: 32px; font-weight: 800; color: white; line-height: 1;">{{ $jumlahMurid }}</div>
                    <div style="font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.9); letter-spacing: 2px; margin-top: 4px;">MURID</div>
                </div>
            </section>

            {{-- ===== AKSI CEPAT (Style Orang Tua) ===== --}}
            <div class="dashboard-operator" style="display: contents;">
                <section class="heading" aria-labelledby="aksi-cepat-title" style="margin-top: 30px;">
                    <h2 class="text-8" id="aksi-cepat-title">Pilih Aksi Cepat</h2>
                </section>

                <section class="container-6" aria-label="Aksi cepat" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 24px;">
                    <a class="link-3" href="{{ route('guru.kehadiran') }}" aria-label="Input Kehadiran" style="grid-column: auto; grid-row: auto;">
                        <div class="background-2" style="background-color: #dbeafe;">
                            <div class="div">
                                <img class="icon-2" src="{{ asset('icon/guru/kehadiran.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-9">Input Kehadiran</div></div>
                        <div class="container-7"><p class="text-10">Catat kehadiran harian siswa.</p></div>
                        <div class="container-8"><div class="text-11">Akses Menu</div></div>
                    </a>

                    <a class="link-3" href="{{ route('guru.nilai') }}" aria-label="Input Nilai" style="grid-column: auto; grid-row: auto;">
                        <div class="background-2">
                            <div class="div">
                                <img class="icon-2" src="{{ asset('icon/guru/nilai.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-9">Input Nilai</div></div>
                        <div class="container-7"><p class="text-10">Masukkan nilai harian & tugas.</p></div>
                        <div class="container-8"><div class="text-11">Akses Menu</div></div>
                    </a>

                    <a class="link-3" href="{{ route('guru.lihat-jadwal') }}" aria-label="Lihat Jadwal" style="grid-column: auto; grid-row: auto;">
                        <div class="background-2" style="background-color: #fef08a;">
                            <div class="div">
                                <img class="icon-11" src="{{ asset('icon/guru/jadwal.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-9">Lihat Jadwal</div></div>
                        <div class="container-7"><p class="text-10">Cek jadwal pelajaran harian.</p></div>
                        <div class="container-8"><div class="text-11">Akses Menu</div></div>
                    </a>

                    <a class="link-4" href="{{ route('guru.buat-pengumuman') }}" aria-label="Buat Pengumuman" style="grid-column: auto; grid-row: auto;">
                        <div class="background-3" style="background-color: #fecaca;">
                            <div class="div">
                                <img class="icon-5" src="{{ asset('icon/guru/pengumuman.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-12">Pengumuman</div></div>
                        <div class="container-7"><p class="text-13">Kirim informasi penting ke wali murid.</p></div>
                        <div class="container-8"><div class="text-14">Akses Menu</div></div>
                    </a>

                    <a class="link-5" href="{{ route('guru.galeri') }}" aria-label="Galeri Kegiatan" style="grid-column: auto; grid-row: auto;">
                        <div class="background-4" style="background-color: #fce7f3;">
                            <div class="div">
                                <img class="icon-14" src="{{ asset('icon/guru/foto.svg') }}" alt="" />
                            </div>
                        </div>
                        <div class="heading-2"><div class="text-15" style="font-size: 16px;">Galeri Kegiatan</div></div>
                        <div class="container-7"><p class="text-16">Bagikan dokumentasi momen belajar.</p></div>
                        <div class="container-9"><div class="text-17">Akses Menu</div></div>
                    </a>
                </section>
            </div>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>
