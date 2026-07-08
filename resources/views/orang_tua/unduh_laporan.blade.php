<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Unduh Laporan - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/unduh_laporan.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar_orang_tua', ['active' => 'unduh-laporan'])

        <main class="main">

            {{-- Top Bar: Breadcrumb + Icons --}}


            {{-- Header Card --}}
            <section class="report-hero-card">
                <div class="report-hero-content">
                    <h1 class="report-hero-title">Rekap Nilai Akademik {{ $siswa ? $siswa->nama : 'Ananda' }}</h1>
                    <p class="report-hero-desc">
                        Halo Orang Tua {{ $siswa ? $siswa->nama : 'Ananda' }}, berikut adalah daftar laporan akademik yang tersedia untuk diunduh.
                        Laporan ini berisi rekap nilai perkembangan ananda selama semester berjalan.
                    </p>
                </div>
                <div class="report-hero-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                </div>
            </section>

            {{-- Data Table --}}
            <div class="report-table-container">
                <div class="report-table-scroll">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Jenis Laporan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($months as $m)
                                @php
                                    $dateObj = \Carbon\Carbon::createFromFormat('Y-m', $m);
                                    $monthName = $dateObj->translatedFormat('F Y');
                                    $reportName = "Rekap Nilai bulan " . $monthName;
                                @endphp
                                <tr>
                                    <td>
                                        <div class="report-cell">
                                            <div class="report-icon-wrap">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                            </div>
                                            <div>
                                                <span class="report-title">{{ $reportName }}</span>
                                                <span class="report-meta">Format: .pdf</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('orang-tua.cetak-laporan', ['month_year' => $m]) }}" target="_blank" class="btn-download" style="text-decoration:none; display:inline-flex; align-items:center; gap:8px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                            Cetak Laporan
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @if($months->isEmpty())
                                <tr>
                                    <td colspan="2" style="text-align: center; padding: 32px; color: #64748b;">Belum ada laporan nilai untuk diunduh.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Mobile Card List --}}
            <div class="report-mobile-list">
                @foreach($months as $m)
                    @php
                        $dateObj = \Carbon\Carbon::createFromFormat('Y-m', $m);
                        $monthName = $dateObj->translatedFormat('F Y');
                        $reportName = "Rekap Nilai bulan " . $monthName;
                    @endphp
                    <div class="report-mobile-card">
                        <div class="report-mobile-title">{{ $reportName }}</div>
                        <div class="report-mobile-meta">Format: Cetak Web</div>
                        <a href="{{ route('orang-tua.cetak-laporan', ['month_year' => $m]) }}" target="_blank" class="btn-download" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center; width:100%; margin-top:16px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            Cetak Laporan
                        </a>
                    </div>
                @endforeach
                @if($months->isEmpty())
                    <div class="report-mobile-card" style="text-align: center; color: #64748b;">
                        Belum ada laporan nilai untuk diunduh.
                    </div>
                @endif
            </div>
            @include('partials.footer')
        </main>
    </div>
</body>
</html>
