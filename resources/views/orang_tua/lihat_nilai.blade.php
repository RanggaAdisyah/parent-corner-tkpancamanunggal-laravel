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
            {{-- Filter Section --}}
            <section class="filter-section">
                <form action="{{ route('orang-tua.lihat-nilai') ?? url()->current() }}" method="GET" style="display: flex; gap: 16px; width: 100%; flex-wrap: wrap; align-items: flex-end;">
                    <div class="filter-group" style="flex: 1; min-width: 200px;">
                        <label class="filter-label">Tahun & Bulan</label>
                        <div class="filter-input-wrapper">
                            <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <select class="filter-select" name="month_year">
                                @for($i = 0; $i < 6; $i++)
                                    @php
                                        $d = \Carbon\Carbon::now()->subMonths($i);
                                        $val = $d->format('Y-m');
                                        $label = $d->translatedFormat('F Y');
                                    @endphp
                                    <option value="{{ $val }}" {{ (isset($monthYear) && $monthYear == $val) ? 'selected' : '' }}>{{ $label }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="filter-group" style="flex: 1; min-width: 200px;">
                        <label class="filter-label">Minggu Ke-</label>
                        <div class="filter-input-wrapper">
                            <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <select class="filter-select" name="week">
                                <option value="all" {{ (isset($week) && $week == 'all') ? 'selected' : '' }}>Semua Minggu</option>
                                <option value="1" {{ (isset($week) && $week == '1') ? 'selected' : '' }}>Minggu 1</option>
                                <option value="2" {{ (isset($week) && $week == '2') ? 'selected' : '' }}>Minggu 2</option>
                                <option value="3" {{ (isset($week) && $week == '3') ? 'selected' : '' }}>Minggu 3</option>
                                <option value="4" {{ (isset($week) && $week == '4') ? 'selected' : '' }}>Minggu 4</option>
                                <option value="5" {{ (isset($week) && $week == '5') ? 'selected' : '' }}>Minggu 5</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="filter-btn" style="flex: 0 0 auto; padding-left: 32px; padding-right: 32px; margin-bottom: 0;">
                        Tampilkan
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </form>
            </section>

            {{-- Result Categories per Tanggal --}}
            <section class="result-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-top: 32px;">
                @forelse($groupedNilai as $tanggal => $nilaiList)
                    @foreach($nilaiList as $nilai)
                    <div class="category-card" style="padding: 24px;">
                        <header class="category-header" style="border-bottom: 1px solid #f1f5f9; padding-bottom: 16px; margin-bottom: 16px;">
                            <div class="category-title-wrap">
                                <div class="category-icon" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                </div>
                                <h2 class="category-title" style="font-size: 16px;">{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y') }}</h2>
                            </div>
                            <div class="score-badge excellent" style="font-size: 20px; padding: 8px 16px;">
                                {{ $nilai->nilai ?? '-' }}
                            </div>
                        </header>
                        <div class="category-body">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                                <div>
                                    <span class="observation-label" style="display: block; margin-bottom: 4px;">Level / Jilid:</span>
                                    <div style="font-size: 15px; font-weight: 600; color: #1e293b;">{{ $nilai->level ?? '-' }}</div>
                                </div>
                                <div>
                                    <span class="observation-label" style="display: block; margin-bottom: 4px;">Halaman:</span>
                                    <div style="font-size: 15px; font-weight: 600; color: #1e293b;">{{ $nilai->hal ?? '-' }}</div>
                                </div>
                            </div>
                            <span class="observation-label" style="display: block; margin-bottom: 4px;">Catatan Guru:</span>
                            <div class="observation-text" style="background: #f8fafc; padding: 16px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                <div style="white-space: pre-line; word-break: break-all; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">{{ $nilai->keterangan ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @empty
                    <div style="grid-column: 1 / -1; padding: 40px; text-align: center; color: #64748b; background: white; border-radius: 12px; margin-top: 32px;">
                        Belum ada data penilaian yang dimasukkan oleh guru untuk saat ini.
                    </div>
                @endforelse
            </section>


            @include('partials.footer')
        </main>
    </div>
</body>
</html>
