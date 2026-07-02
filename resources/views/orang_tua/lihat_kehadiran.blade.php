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
                    <p class="page-subtitle">Pantau kehadiran Ananda {{ $siswa ? $siswa->nama : '...' }} (Kelas {{ $siswa && $siswa->kelasLokal ? $siswa->kelasLokal->nama_kelas : '-' }}).</p>
                </div>
            </header>

            {{-- Summary Cards --}}
            <section class="summary-grid">
                {{-- Total Hadir --}}
                <div class="summary-card">
                    <div class="summary-info">
                        <p class="summary-label">Total Hadir</p>
                        <p class="summary-value">{{ $totalHadir }} <span>Hari</span></p>
                        <div class="summary-trend trend-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                            {{ $persentase }}% Bulan ini
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
                        <p class="summary-value">{{ $totalSakit }} <span>Hari</span></p>
                    </div>
                    <div class="summary-icon icon-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M8 14s1.5 2 4 2 4-2 4-2"></path><line x1="9" y1="9" x2="9.01" y2="9"></line><line x1="15" y1="9" x2="15.01" y2="9"></line><path d="M8 8a2 2 0 0 1 2 2"></path><path d="M14 8a2 2 0 0 1 2 2"></path><path d="M16.5 13a3.5 3.5 0 0 1-5 0"></path><line x1="17" y1="14" x2="18" y2="15"></line><line x1="18" y1="14" x2="17" y2="15"></line></svg>
                    </div>
                </div>

                {{-- Izin --}}
                <div class="summary-card">
                    <div class="summary-info">
                        <p class="summary-label">Izin</p>
                        <p class="summary-value">{{ $totalIzin }} <span>Hari</span></p>
                    </div>
                    <div class="summary-icon icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    </div>
                </div>

                {{-- Alfa --}}
                <div class="summary-card">
                    <div class="summary-info">
                        <p class="summary-label">Alfa (Tanpa Ket.)</p>
                        <p class="summary-value">{{ $totalAlfa }} <span>Hari</span></p>
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
                        @php
                            $prevMonth = $month == 1 ? 12 : $month - 1;
                            $prevYear = $month == 1 ? $year - 1 : $year;
                            $nextMonth = $month == 12 ? 1 : $month + 1;
                            $nextYear = $month == 12 ? $year + 1 : $year;
                            $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y');
                        @endphp
                        {{ $monthName }}
                    </h2>
                    <div class="calendar-nav">
                        <a href="?month={{ $prevMonth }}&year={{ $prevYear }}" class="calendar-nav-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                        </a>
                        <a href="?month={{ date('n') }}&year={{ date('Y') }}" class="calendar-today-btn" style="text-decoration:none; display:inline-flex; align-items:center;">Hari Ini</a>
                        <a href="?month={{ $nextMonth }}&year={{ $nextYear }}" class="calendar-nav-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </a>
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

                    @php
                        $dateObj = \Carbon\Carbon::createFromDate($year, $month, 1);
                        $daysInMonth = $dateObj->daysInMonth;
                        $firstDayOfWeek = $dateObj->dayOfWeek; // 0 (Sun) - 6 (Sat)
                        // Adjust to start on Monday (0=Mon, 1=Tue... 6=Sun)
                        $firstDayIndex = ($firstDayOfWeek == 0) ? 6 : $firstDayOfWeek - 1;
                    @endphp

                    {{-- Empty cells before day 1 --}}
                    @for($i = 0; $i < $firstDayIndex; $i++)
                        <div class="calendar-cell empty"><span class="cell-date"></span></div>
                    @endfor

                    @for($d = 1; $d <= $daysInMonth; $d++)
                        @php
                            $currentDow = ($firstDayIndex + $d - 1) % 7;
                            $isWeekend = ($currentDow == 6); // Sunday in this context
                            $isToday = ($year == date('Y') && $month == date('n') && $d == date('j'));
                            
                            $status = null;
                            if (isset($kehadirans[$d])) {
                                $status = $kehadirans[$d]->status;
                            }
                        @endphp
                        
                        <div class="calendar-cell {{ $isWeekend ? 'weekend' : '' }} {{ $isToday ? 'today' : '' }}">
                            <span class="cell-date">{{ $d }}</span>
                            @if($isToday && !$status)
                                <div class="status-today">Hari Ini</div>
                            @elseif($status)
                                <div class="cell-status status-{{ strtolower($status) }}">
                                    <div class="status-dot"></div>
                                    <span class="status-text">{{ ucfirst($status) }}</span>
                                </div>
                            @endif
                        </div>
                    @endfor
                </div>

                {{-- Mobile Agenda List --}}
                <div class="calendar-mobile-list">
                    @forelse($kehadirans as $d => $kh)
                        <div class="agenda-item">
                            <div class="agenda-date">{{ \Carbon\Carbon::parse($kh->tanggal)->translatedFormat('l, d M Y') }}</div>
                            <div class="agenda-status status-{{ strtolower($kh->status) }}">{{ ucfirst($kh->status) }}</div>
                        </div>
                    @empty
                        <div style="padding: 20px; text-align: center; color: #64748b; font-size: 14px;">
                            Tidak ada data kehadiran di bulan ini.
                        </div>
                    @endforelse
                </div>
            </section>


            @include('partials.footer')
        </main>
    </div>
</body>
</html>
