<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Jadwal Mengajar - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/jadwal.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar-guru', ['active' => 'lihat-jadwal'])

        <main class="main">
            <div class="jadwal-header">
                <div class="header-left">
                    <h1 class="header-title">Jadwal Mengajar</h1>
                    <p class="header-subtitle">Minggu ke-4, Oktober 2023 • Semester Ganjil</p>
                </div>
                <div class="header-actions">
                    <button class="btn-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                        Cetak
                    </button>
                    <button class="btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        Unduh Jadwal PDF
                    </button>
                </div>
            </div>

            <div class="schedule-container">
                <div class="filter-row">
                    <div class="date-selector">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span>23 Okt - 28 Okt 2023</span>
                    </div>
                    <div class="class-filter">
                        <span class="filter-label">Filter Kelas:</span>
                        <select class="select-input">
                            <option>Kelas TK B - Mawar</option>
                            <option>Kelas TK A - Melati</option>
                        </select>
                    </div>
                </div>

                <div class="day-grid">
                    <!-- SENIN -->
                    <div class="day-column">
                        <div class="day-header">
                            <span class="day-name">Senin</span>
                            <span class="day-date">23 Okt</span>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">07:30 - 08:00</span>
                            <h3 class="subject-name">Upacara Bendera</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Lapangan
                            </div>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">08:00 - 09:30</span>
                            <h3 class="subject-name">Mewarnai & Seni</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Ruang Kelas B
                            </div>
                            <span class="tag">Tema: Alam</span>
                        </div>
                        <div class="break-divider">
                            <div class="divider-line"></div>
                            <span class="break-label">ISTIRAHAT</span>
                            <div class="divider-line"></div>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">10:00 - 11:30</span>
                            <h3 class="subject-name">Berhitung Ceria</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Ruang Kelas B
                            </div>
                        </div>
                    </div>

                    <!-- SELASA -->
                    <div class="day-column">
                        <div class="day-header">
                            <span class="day-name">Selasa</span>
                            <span class="day-date">24 Okt</span>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">07:30 - 08:00</span>
                            <h3 class="subject-name">Senam Pagi</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Halaman Depan
                            </div>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">08:00 - 09:30</span>
                            <h3 class="subject-name">Mengenal Huruf</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Ruang Kelas B
                            </div>
                            <span class="tag">Alat Peraga</span>
                        </div>
                        <div class="break-divider">
                            <div class="divider-line"></div>
                            <span class="break-label">ISTIRAHAT</span>
                            <div class="divider-line"></div>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">10:00 - 11:30</span>
                            <h3 class="subject-name">Bahasa Inggris Dasar</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Lab Bahasa
                            </div>
                        </div>
                    </div>

                    <!-- RABU -->
                    <div class="day-column">
                        <div class="day-header">
                            <span class="day-name">Rabu</span>
                            <span class="day-date">25 Okt</span>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">07:30 - 09:30</span>
                            <h3 class="subject-name">Tari Tradisional</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Aula Serbaguna
                            </div>
                        </div>
                        <div class="break-divider">
                            <div class="divider-line"></div>
                            <span class="break-label">ISTIRAHAT</span>
                            <div class="divider-line"></div>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">10:00 - 11:30</span>
                            <h3 class="subject-name">Prakarya Tangan</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Ruang Seni
                            </div>
                            <span class="tag">Bawa Kertas Lipat</span>
                        </div>
                    </div>

                    <!-- KAMIS -->
                    <div class="day-column">
                        <div class="day-header">
                            <span class="day-name">Kamis</span>
                            <span class="day-date">26 Okt</span>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">07:30 - 09:00</span>
                            <h3 class="subject-name">Agama & Budi Pekerti</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Musholla
                            </div>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">09:00 - 09:30</span>
                            <h3 class="subject-name">Bernyanyi Bersama</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Ruang Musik
                            </div>
                        </div>
                        <div class="break-divider">
                            <div class="divider-line"></div>
                            <span class="break-label">ISTIRAHAT</span>
                            <div class="divider-line"></div>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">10:00 - 11:30</span>
                            <h3 class="subject-name">Olahraga Ringan</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Halaman Belakang
                            </div>
                        </div>
                    </div>

                    <!-- JUMAT -->
                    <div class="day-column">
                        <div class="day-header">
                            <span class="day-name">Jumat</span>
                            <span class="day-date">27 Okt</span>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">07:30 - 08:30</span>
                            <h3 class="subject-name">Jumat Bersih</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Lingkungan Sekolah
                            </div>
                        </div>
                        <div class="subject-card">
                            <span class="subject-time">08:30 - 10:30</span>
                            <h3 class="subject-name">Dongeng & Cerita</h3>
                            <div class="subject-location">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                Perpustakaan
                            </div>
                        </div>
                        <div class="status-card-blue">
                            <span class="status-text-blue">Pulang Lebih Awal<br>(11:00)</span>
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.footer')
        </main>
    </div>
</body>
</html>
