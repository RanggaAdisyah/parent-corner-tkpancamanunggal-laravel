<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Lihat Jadwal - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/jadwal.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar-orang-tua', ['active' => 'lihat-jadwal'])

        <main class="main ot-main">

            <header class="page-header">
                <div class="header-left">
                    <h1 class="page-title">Jadwal Pelajaran</h1>
                    <p class="page-subtitle">Kelas Bintang Kecil - Semester Ganjil 2023/2024</p>
                </div>
                <div class="header-right">
                    <button class="header-icon-btn" aria-label="Toggle Dark Mode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                    </button>
                    <button class="header-icon-btn" aria-label="Notifikasi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </button>
                </div>
            </header>

            <section class="schedule-card">
                <header class="schedule-header">
                    <h2 class="schedule-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        Jadwal Mingguan
                    </h2>
                    <div class="schedule-nav">
                        <button class="schedule-nav-btn">&lsaquo; Sebelumnya</button>
                        <button class="schedule-nav-btn">Selanjutnya &rsaquo;</button>
                    </div>
                </header>
                
                <div style="overflow-x: auto;">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>WAKTU</th>
                                <th>SENIN</th>
                                <th>SELASA</th>
                                <th>RABU</th>
                                <th>KAMIS</th>
                                <th>JUMAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Baris 1: 08:00 - 09:00 --}}
                            <tr>
                                <td class="time-cell">08:00<br>-<br>09:00</td>
                                <td>
                                    <div class="subject-pill bg-blue">
                                        <p class="subject-name">Upacara</p>
                                        <p class="subject-location">Lapangan Utama</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-green">
                                        <p class="subject-name">Berhitung</p>
                                        <p class="subject-location">Kelas Bintang</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-purple">
                                        <p class="subject-name">Seni Lukis</p>
                                        <p class="subject-location">Ruang Seni</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-yellow">
                                        <p class="subject-name">Olahraga</p>
                                        <p class="subject-location">Lapangan</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-indigo">
                                        <p class="subject-name">Agama</p>
                                        <p class="subject-location">Musholla</p>
                                    </div>
                                </td>
                            </tr>

                            {{-- Baris 2: 09:00 - 10:00 --}}
                            <tr>
                                <td class="time-cell">09:00<br>-<br>10:00</td>
                                <td>
                                    <div class="subject-pill bg-pink">
                                        <p class="subject-name">Bernyanyi</p>
                                        <p class="subject-location">Kelas Bintang</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-orange">
                                        <p class="subject-name">Membaca</p>
                                        <p class="subject-location">Perpustakaan</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-mint">
                                        <p class="subject-name">Sains Dasar</p>
                                        <p class="subject-location">Lab Mini</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-teal">
                                        <p class="subject-name">Bhs. Inggris</p>
                                        <p class="subject-location">Kelas Bintang</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-red">
                                        <p class="subject-name">Senam</p>
                                        <p class="subject-location">Aula</p>
                                    </div>
                                </td>
                            </tr>

                            {{-- Baris 3: Istirahat --}}
                            <tr class="break-row">
                                <td class="time-cell">10:00 -<br>10:30</td>
                                <td colspan="5">
                                    <span class="break-pill">ISTIRAHAT & MAKAN SIANG</span>
                                </td>
                            </tr>

                            {{-- Baris 4: 10:30 - 11:30 --}}
                            <tr>
                                <td class="time-cell">10:30 -<br>11:30</td>
                                <td>
                                    <div class="subject-pill bg-cyan">
                                        <p class="subject-name">Motorik Halus</p>
                                        <p class="subject-location">Kelas Bintang</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-mint">
                                        <p class="subject-name">Bercerita</p>
                                        <p class="subject-location">Pojok Baca</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-purple">
                                        <p class="subject-name">Menari</p>
                                        <p class="subject-location">Ruang Seni</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-lime">
                                        <p class="subject-name">Berkebun</p>
                                        <p class="subject-location">Taman Sekolah</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="subject-pill bg-gray">
                                        <p class="subject-name">Pulang</p>
                                        <p class="subject-location">--</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>
