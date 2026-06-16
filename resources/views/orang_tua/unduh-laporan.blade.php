<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Unduh Laporan - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/unduh-laporan.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar-orang-tua', ['active' => 'unduh-laporan'])

        <main class="main ot-main">

            {{-- Top Bar: Breadcrumb + Icons --}}
            <div class="top-bar">
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <span>Orang Tua</span>
                    <span class="breadcrumb-sep">&rsaquo;</span>
                    <span>Pilih Aksi</span>
                    <span class="breadcrumb-sep">&rsaquo;</span>
                    <span class="breadcrumb-active">Rekap Nilai</span>
                </nav>
                <div class="top-bar-actions">
                    <button class="header-icon-btn" aria-label="Notifikasi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </button>
                    <button class="header-icon-btn" aria-label="Toggle Dark Mode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                    </button>
                </div>
            </div>

            {{-- Header Card --}}
            <section class="report-hero-card">
                <div class="report-hero-content">
                    <h1 class="report-hero-title">Rekap Nilai Akademik Andi</h1>
                    <p class="report-hero-desc">
                        Halo Orang Tua Andi, berikut adalah daftar laporan akademik yang tersedia untuk diunduh.
                        Laporan ini berisi rekap nilai perkembangan ananda selama semester berjalan.
                    </p>
                </div>
                <div class="report-hero-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                </div>
            </section>

            {{-- Filter Bar --}}
            <section class="report-filter-bar">
                <span class="report-filter-label">Filter:</span>
                <select class="report-filter-select" aria-label="Tahun Ajaran">
                    <option selected>2023/2024</option>
                    <option>2022/2023</option>
                    <option>2021/2022</option>
                </select>
                <select class="report-filter-select" aria-label="Semester">
                    <option selected>Semester 1</option>
                    <option>Semester 2</option>
                </select>
            </section>

            {{-- Data Table --}}
            <div class="report-table-container">
                <div class="report-table-scroll">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>Jenis Laporan</th>
                                <th>Tahun Ajaran</th>
                                <th>Semester</th>
                                <th>Tanggal Terbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="report-cell">
                                        <div class="report-icon-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        </div>
                                        <div>
                                            <span class="report-title">Rekap Nilai Semester Ganjil</span>
                                            <span class="report-meta">Format: PDF (1.8 MB)</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="report-year">2023/2024</span></td>
                                <td><span class="badge-semester-1">Semester 1</span></td>
                                <td><span class="report-date">15 Des 2023</span></td>
                                <td>
                                    <button class="btn-download" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                        Unduh PDF
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="report-cell">
                                        <div class="report-icon-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        </div>
                                        <div>
                                            <span class="report-title">Rekap Nilai Semester Genap</span>
                                            <span class="report-meta">Format: PDF (2.1 MB)</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="report-year">2023/2024</span></td>
                                <td><span class="badge-semester-2">Semester 2</span></td>
                                <td><span class="report-date">15 Jun 2024</span></td>
                                <td>
                                    <button class="btn-download" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                        Unduh PDF
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="report-cell">
                                        <div class="report-icon-wrap">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                        </div>
                                        <div>
                                            <span class="report-title">Laporan Perkembangan Anak</span>
                                            <span class="report-meta">Format: PDF (1.5 MB)</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="report-year">2023/2024</span></td>
                                <td><span class="badge-semester-1">Semester 1</span></td>
                                <td><span class="report-date">20 Des 2023</span></td>
                                <td>
                                    <button class="btn-download" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                        Unduh PDF
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <span class="pagination-info">Menampilkan 1 sampai 3 dari 3 hasil</span>
                    <div class="pagination-nav">
                        <button class="btn-page" disabled aria-label="Halaman sebelumnya">&lsaquo;</button>
                        <button class="btn-page btn-page-active" aria-current="page">1</button>
                        <button class="btn-page" disabled aria-label="Halaman selanjutnya">&rsaquo;</button>
                    </div>
                </div>
            </div>

            {{-- Mobile Card List --}}
            <div class="report-mobile-list">
                <div class="report-mobile-card">
                    <div class="report-mobile-title">Rekap Nilai Semester Ganjil</div>
                    <div class="report-mobile-meta">Format: PDF (1.8 MB)</div>
                    <div class="report-mobile-info">
                        <span>Tahun Ajaran</span>
                        <strong>2023/2024</strong>
                    </div>
                    <div class="report-mobile-info">
                        <span>Semester</span>
                        <span class="badge-semester-1">Semester 1</span>
                    </div>
                    <div class="report-mobile-info">
                        <span>Tanggal Terbit</span>
                        <strong>15 Des 2023</strong>
                    </div>
                    <button class="btn-download" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        Unduh PDF
                    </button>
                </div>
                
                <div class="report-mobile-card">
                    <div class="report-mobile-title">Rekap Nilai Semester Genap</div>
                    <div class="report-mobile-meta">Format: PDF (2.1 MB)</div>
                    <div class="report-mobile-info">
                        <span>Tahun Ajaran</span>
                        <strong>2023/2024</strong>
                    </div>
                    <div class="report-mobile-info">
                        <span>Semester</span>
                        <span class="badge-semester-2">Semester 2</span>
                    </div>
                    <div class="report-mobile-info">
                        <span>Tanggal Terbit</span>
                        <strong>15 Jun 2024</strong>
                    </div>
                    <button class="btn-download" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        Unduh PDF
                    </button>
                </div>

                <div class="report-mobile-card">
                    <div class="report-mobile-title">Laporan Perkembangan Anak</div>
                    <div class="report-mobile-meta">Format: PDF (1.5 MB)</div>
                    <div class="report-mobile-info">
                        <span>Tahun Ajaran</span>
                        <strong>2023/2024</strong>
                    </div>
                    <div class="report-mobile-info">
                        <span>Semester</span>
                        <span class="badge-semester-1">Semester 1</span>
                    </div>
                    <div class="report-mobile-info">
                        <span>Tanggal Terbit</span>
                        <strong>20 Des 2023</strong>
                    </div>
                    <button class="btn-download" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        Unduh PDF
                    </button>
                </div>

                <div class="pagination" style="border-radius: 16px; border: 1px solid #e2e8f0; border-top: none;">
                    <span class="pagination-info">Menampilkan 1 sampai 3 dari 3 hasil</span>
                    <div class="pagination-nav">
                        <button class="btn-page" disabled aria-label="Halaman sebelumnya">&lsaquo;</button>
                        <button class="btn-page btn-page-active" aria-current="page">1</button>
                        <button class="btn-page" disabled aria-label="Halaman selanjutnya">&rsaquo;</button>
                    </div>
                </div>
            </div>
            @include('partials.footer')
        </main>
    </div>
</body>
</html>
