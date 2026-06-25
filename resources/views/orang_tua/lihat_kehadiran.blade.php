<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Lihat Kehadiran - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/kehadiran.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar_orang_tua', ['active' => 'lihat-kehadiran'])

        <main class="main">

            <header class="page-header">
                <div class="header-left">
                    <h1 class="page-title">Rekap Absensi</h1>
                    <p class="page-subtitle">Pantau kehadiran Ananda Rizky Santoso (Kelas B1).</p>
                </div>
            </header>

            {{-- Summary Cards --}}
            <section class="summary-grid">
                {{-- Total Hadir --}}
                <div class="summary-card">
                    <div class="summary-info">
                        <p class="summary-label">Total Hadir</p>
                        <p class="summary-value">18 <span>Hari</span></p>
                        <div class="summary-trend trend-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                            90% Bulan ini
                        </div>
                    </div>
                    <div class="summary-icon icon-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                </div>

                {{-- Sakit --}}
                <div class="summary-card">
                    <div class="summary-info">
                        <p class="summary-label">Sakit</p>
                        <p class="summary-value">2 <span>Hari</span></p>
                    </div>
                    <div class="summary-icon icon-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line><path d="M8 8a2 2 0 0 1 2 2"></path><path d="M14 8a2 2 0 0 1 2 2"></path><path d="M16.5 13a3.5 3.5 0 0 1-5 0"></path><line x1="17" y1="14" x2="18" y2="15"></line><line x1="18" y1="14" x2="17" y2="15"></line></svg>
                    </div>
                </div>

                {{-- Izin --}}
                <div class="summary-card">
                    <div class="summary-info">
                        <p class="summary-label">Izin</p>
                        <p class="summary-value">1 <span>Hari</span></p>
                    </div>
                    <div class="summary-icon icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    </div>
                </div>

                {{-- Alfa --}}
                <div class="summary-card">
                    <div class="summary-info">
                        <p class="summary-label">Alfa (Tanpa Ket.)</p>
                        <p class="summary-value">0 <span>Hari</span></p>
                    </div>
                    <div class="summary-icon icon-red">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    </div>
                </div>
            </section>

            {{-- Calendar View --}}
            <section class="calendar-card">
                <header class="calendar-header">
                    <h2 class="calendar-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        Oktober 2023
                    </h2>
                    <div class="calendar-nav">
                        <button class="calendar-nav-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </button>
                        <button class="calendar-today-btn">Hari Ini</button>
                        <button class="calendar-nav-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                    </div>
                </header>

                <div class="calendar-grid">
                    {{-- Header Hari --}}
                    <div class="calendar-day-header">Senin</div>
                    <div class="calendar-day-header">Selasa</div>
                    <div class="calendar-day-header">Rabu</div>
                    <div class="calendar-day-header">Kamis</div>
                    <div class="calendar-day-header">Jumat</div>
                    <div class="calendar-day-header">Sabtu</div>
                    <div class="calendar-day-header weekend">Minggu</div>

                    {{-- Minggu 1 (Kosong) --}}
                    <div class="calendar-cell empty"><span class="cell-date">25</span></div>
                    <div class="calendar-cell empty"><span class="cell-date">26</span></div>
                    <div class="calendar-cell empty"><span class="cell-date">27</span></div>
                    <div class="calendar-cell empty"><span class="cell-date">28</span></div>
                    <div class="calendar-cell empty"><span class="cell-date">29</span></div>
                    <div class="calendar-cell empty"><span class="cell-date">30</span></div>
                    <div class="calendar-cell"><span class="cell-date">1</span></div>

                    {{-- Minggu 2 --}}
                    <div class="calendar-cell">
                        <span class="cell-date">2</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">3</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">4</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">5</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">6</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell"><span class="cell-date">7</span></div>
                    <div class="calendar-cell weekend"><span class="cell-date">8</span></div>

                    {{-- Minggu 3 --}}
                    <div class="calendar-cell">
                        <span class="cell-date">9</span>
                        <div class="cell-status status-sakit">
                            <div class="status-dot"></div>
                            <span class="status-text">Sakit</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">10</span>
                        <div class="cell-status status-sakit">
                            <div class="status-dot"></div>
                            <span class="status-text">Sakit</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">11</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">12</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">13</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell"><span class="cell-date">14</span></div>
                    <div class="calendar-cell weekend"><span class="cell-date">15</span></div>

                    {{-- Minggu 4 --}}
                    <div class="calendar-cell">
                        <span class="cell-date">16</span>
                        <div class="cell-status status-izin">
                            <div class="status-dot"></div>
                            <span class="status-text">Izin</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">17</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell">
                        <span class="cell-date">18</span>
                        <div class="cell-status status-hadir">
                            <div class="status-dot"></div>
                            <span class="status-text">Hadir</span>
                        </div>
                    </div>
                    <div class="calendar-cell today">
                        <span class="cell-date">19</span>
                        <div class="status-today">Hari Ini</div>
                    </div>
                    <div class="calendar-cell"><span class="cell-date">20</span></div>
                    <div class="calendar-cell"><span class="cell-date">21</span></div>
                    <div class="calendar-cell weekend"><span class="cell-date">22</span></div>

                    {{-- Minggu 5 --}}
                    <div class="calendar-cell"><span class="cell-date">23</span></div>
                    <div class="calendar-cell"><span class="cell-date">24</span></div>
                    <div class="calendar-cell"><span class="cell-date">25</span></div>
                    <div class="calendar-cell"><span class="cell-date">26</span></div>
                    <div class="calendar-cell"><span class="cell-date">27</span></div>
                    <div class="calendar-cell"><span class="cell-date">28</span></div>
                    <div class="calendar-cell weekend"><span class="cell-date">29</span></div>
                </div>

                {{-- Mobile Agenda List --}}
                <div class="calendar-mobile-list">
                    <div class="agenda-item">
                        <div class="agenda-date">Senin, 2 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Selasa, 3 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Rabu, 4 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Kamis, 5 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Jumat, 6 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Senin, 9 Okt 2023</div>
                        <div class="agenda-status status-sakit">Sakit</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Selasa, 10 Okt 2023</div>
                        <div class="agenda-status status-sakit">Sakit</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Rabu, 11 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Kamis, 12 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Jumat, 13 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Senin, 16 Okt 2023</div>
                        <div class="agenda-status status-izin">Izin</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Selasa, 17 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Rabu, 18 Okt 2023</div>
                        <div class="agenda-status status-hadir">Hadir</div>
                    </div>
                    <div class="agenda-item">
                        <div class="agenda-date">Kamis, 19 Okt 2023</div>
                        <div class="agenda-status status-today">Hari Ini</div>
                    </div>
                </div>
            </section>


            @include('partials.footer')
        </main>
    </div>
</body>
</html>
