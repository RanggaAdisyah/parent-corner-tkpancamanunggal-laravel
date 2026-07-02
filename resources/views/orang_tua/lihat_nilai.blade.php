<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Lihat Nilai - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/nilai.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar_orang_tua', ['active' => 'lihat-nilai'])

        <main class="main">

            <header class="page-header">
                <div>
                    <h1 class="page-title">Laporan Nilai Perkembangan</h1>
                    <p class="page-subtitle">Pantau observasi dan penilaian guru untuk Ananda {{ $siswa ? $siswa->nama : '...' }}.</p>
                </div>
            </header>

            {{-- Filter Section --}}
            <section class="filter-section">
                <div class="filter-group">
                    <label class="filter-label">Tahun & Semester</label>
                    <div class="filter-input-wrapper">
                        <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <select class="filter-select">
                            <option>Ganjil 2023/2024</option>
                            <option>Genap 2023/2024</option>
                        </select>
                    </div>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Minggu Ke-</label>
                    <div class="filter-input-wrapper">
                        <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <select class="filter-select">
                            <option>Minggu 3 (Agustus)</option>
                            <option>Minggu 2 (Agustus)</option>
                            <option>Minggu 1 (Agustus)</option>
                        </select>
                    </div>
                </div>
                <button class="filter-btn">
                    Tampilkan
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </section>

            {{-- Result Categories per Tanggal --}}
            @forelse($groupedNilai as $tanggal => $nilaiList)
            <div style="margin-top: 32px; margin-bottom: 16px;">
                <h3 style="color: #1e293b; font-size: 18px; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Penilaian Tanggal: {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}
                </h3>
            </div>
            
            <section class="result-grid">
                @foreach($nilaiList as $nilai)
                <div class="category-card">
                    <header class="category-header">
                        <div class="category-title-wrap">
                            <div class="category-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                            </div>
                            <h2 class="category-title" style="text-transform: capitalize;">{{ str_replace('_', ' ', $nilai->kegiatan) }}</h2>
                        </div>
                        <div class="score-badge excellent">
                            {{ $nilai->nilai ?? '-' }}
                        </div>
                    </header>
                    <div class="category-body">
                        <span class="observation-label">Catatan Guru:</span>
                        <div class="observation-text">{!! $nilai->catatan ?? '-' !!}</div>
                    </div>
                </div>
                @endforeach
            </section>
            @empty
            <div style="padding: 40px; text-align: center; color: #64748b; background: white; border-radius: 12px; margin-top: 32px;">
                Belum ada data penilaian yang dimasukkan oleh guru untuk saat ini.
            </div>
            @endforelse


            @include('partials.footer')
        </main>
    </div>
</body>
</html>
