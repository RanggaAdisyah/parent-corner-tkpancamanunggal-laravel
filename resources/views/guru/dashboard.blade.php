<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_guru', ['active' => 'dashboard'])

        <main class="main">
            <section class="container-3" aria-label="Header dashboard guru">
                <div class="container-4">
                    <div class="div-2">
                        <h1 class="text-6">Dashboard Guru</h1>
                    </div>
                    <div class="div-2">
                        <p class="p">Panel Kontrol Aktivitas Harian</p>
                    </div>
                </div>

                <div class="container-5" aria-label="Aksi header">
                    <div class="button-margin">
                        <button class="button-2" type="button" aria-label="Mode gelap">
                            <span class="icon-wrapper">
                                <img class="icon-7" src="{{ asset('img/icon-9.svg') }}" alt="" />
                            </span>
                        </button>
                    </div>
                    <div class="button-margin">
                        <button class="button-2" type="button" aria-label="Notifikasi">
                            <span class="icon-wrapper">
                                <img class="icon-7" src="{{ asset('img/icon-9.svg') }}" alt="" />
                            </span>
                            <span class="background-border-2" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            </section>

            <section class="guru-top-banner" aria-label="Banner sambutan">
                <div class="guru-top-banner__content">
                    <h2 class="guru-top-banner__title">Selamat Datang, Bapak/Ibu {{ $guru ? $guru->nama_lengkap : 'Guru' }}!</h2>
                    <p class="guru-top-banner__desc">
                        Semoga hari ini menyenangkan. Silakan pilih menu di bawah untuk mengelola aktivitas kelas hari ini.
                    </p>
                </div>

                <div class="guru-murid-badge" aria-label="Jumlah murid">
                    <div class="guru-murid-badge__count">{{ $jumlahMurid }}</div>
                    <div class="guru-murid-badge__label">MURID</div>
                </div>
            </section>

            <section class="guru-actions-grid" aria-label="Menu cepat guru">
                <article class="guru-action-card" aria-label="Input Kehadiran">
                    <div class="guru-action-icon-bg guru-action-icon-bg--blue" aria-hidden="true">
                        <img class="guru-action-icon" src="{{ asset('img/icon-5.svg') }}" alt="" />
                    </div>
                    <h3 class="guru-action-title">Input Kehadiran</h3>
                    <p class="guru-action-desc">Catat kehadiran siswa hari ini. Pastikan data terisi sebelum jam 9 pagi.</p>
                    <a class="guru-action-cta guru-action-cta--primary" href="{{ route('guru.kehadiran') }}" aria-label="Buka Kehadiran">
                        Buka Kehadiran
                        <span class="guru-action-cta__arrow" aria-hidden="true">→</span>
                    </a>
                </article>

                <article class="guru-action-card" aria-label="Input Nilai">
                    <div class="guru-action-icon-bg guru-action-icon-bg--purple" aria-hidden="true">
                        <img class="guru-action-icon" src="{{ asset('img/icon-15.svg') }}" alt="" />
                    </div>
                    <h3 class="guru-action-title">Input Nilai</h3>
                    <p class="guru-action-desc">Masukkan nilai harian, tugas, atau evaluasi mingguan siswa.</p>
                    <a class="guru-action-cta" href="{{ route('guru.nilai') }}" aria-label="Kelola Nilai">
                        Kelola Nilai
                        <span class="guru-action-cta__arrow" aria-hidden="true">↗</span>
                    </a>
                </article>

                <article class="guru-action-card" aria-label="Lihat Jadwal">
                    <div class="guru-action-icon-bg guru-action-icon-bg--amber" aria-hidden="true">
                        <img class="guru-action-icon" src="{{ asset('img/icon-17.svg') }}" alt="" />
                    </div>
                    <h3 class="guru-action-title">Lihat Jadwal</h3>
                    <p class="guru-action-desc">Cek jadwal pelajaran, kegiatan ekstrakurikuler, dan jam istirahat.</p>
                    <a class="guru-action-cta" href="{{ route('guru.lihat-jadwal') }}" aria-label="Cek Jadwal">
                        Cek Jadwal
                        <span class="guru-action-cta__arrow" aria-hidden="true">👁</span>
                    </a>
                </article>

                <article class="guru-action-card" aria-label="Buat Pengumuman">
                    <div class="guru-action-icon-bg guru-action-icon-bg--rose" aria-hidden="true">
                        <img class="guru-action-icon" src="{{ asset('img/icon-14.svg') }}" alt="" />
                    </div>
                    <h3 class="guru-action-title">Buat Pengumuman</h3>
                    <p class="guru-action-desc">Kirim informasi penting kepada orang tua murid secara langsung.</p>
                    <a class="guru-action-cta" href="{{ route('guru.buat-pengumuman') }}" aria-label="Tulis Info">
                        Tulis Info
                        <span class="guru-action-cta__arrow" aria-hidden="true">></span>
                    </a>
                </article>

                <article class="guru-action-card" aria-label="Galeri Kegiatan">
                    <div class="guru-action-icon-bg guru-action-icon-bg--green" aria-hidden="true">
                        <img class="guru-action-icon" src="{{ asset('img/icon-18.svg') }}" alt="" />
                    </div>
                    <h3 class="guru-action-title">Galeri Kegiatan</h3>
                    <p class="guru-action-desc">Bagikan momen seru kegiatan siswa di kelas ke galeri orang tua.</p>
                    <a class="guru-action-cta" href="{{ route('guru.galeri') }}" aria-label="Upload Foto">
                        Galeri Foto
                        <span class="guru-action-cta__arrow" aria-hidden="true">⬆</span>
                    </a>
                </article>
            </section>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>

