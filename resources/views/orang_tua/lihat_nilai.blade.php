<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Lihat Nilai - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/nilai.css') }}">
    <style>
        .kategori-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .kategori-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 8px 20px rgba(59,130,246,0.1);
            transform: translateY(-2px);
        }
        .kategori-card-head { display: flex; align-items: center; gap: 12px; }
        .kategori-card-icon {
            width: 44px; height: 44px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }
        .kategori-card-title { font-size: 16px; font-weight: 700; color: #1e293b; margin: 0; line-height: 1.3; }
        .kategori-card-skala { font-size: 14px; color: #64748b; margin: 4px 0 0; }
        .skala-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
        }
        .kategori-card-date { font-size: 12px; color: #94a3b8; margin-top: 8px; }
        .kategori-card-empty { font-size: 13px; color: #cbd5e1; font-style: italic; }

        /* Modal Timeline */
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; display: none; align-items: center; justify-content: center; padding: 16px; }
        .modal-overlay.active { display: flex; }
        .modal-content { background: #fff; border-radius: 16px; max-width: 720px; width: 100%; max-height: 90vh; overflow-y: auto; }
        .modal-header { padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; background: #fff; z-index: 1; }
        .modal-title { font-size: 18px; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 10px; }
        .modal-close { background: none; border: none; font-size: 24px; cursor: pointer; color: #94a3b8; padding: 0; line-height: 1; }
        .modal-close:hover { color: #1e293b; }
        .modal-body { padding: 24px; }

        .timeline-item {
            position: relative;
            padding: 16px 0 16px 36px;
            border-left: 2px solid #e2e8f0;
            margin-left: 8px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -7px;
            top: 20px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #3b82f6;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #3b82f6;
        }
        .timeline-date { font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 6px; display: flex; align-items: center; gap: 8px; }
        .timeline-skala { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 12px; font-weight: 700; color: #fff; }
        .timeline-catatan {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px;
            margin-top: 8px;
            font-size: 14px;
            color: #334155;
            line-height: 1.5;
        }
        .timeline-empty {
            text-align: center;
            padding: 40px 20px;
            color: #94a3b8;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_orang_tua', ['active' => 'lihat-nilai'])

        <main class="main">
            <header class="page-header">
                <div>
                    <h1 class="page-title">Laporan Nilai Perkembangan</h1>
                    <p class="page-subtitle">Pantau observasi dan penilaian guru untuk Ananda {{ $siswa ? $siswa->nama : '...' }}.</p>
                </div>
            </header>

            {{-- Filter --}}
            <section class="filter-section">
                <form action="{{ url()->current() }}" method="GET" style="display: flex; gap: 16px; width: 100%; flex-wrap: wrap; align-items: flex-end;">
                    <div class="filter-group" style="flex: 1; min-width: 180px;">
                        <label class="filter-label">Bulan</label>
                        <div class="filter-input-wrapper">
                            <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <select class="filter-select" name="bulan">
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ ($bulan ?? date('n')) == $m ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="filter-group" style="flex: 1; min-width: 180px;">
                        <label class="filter-label">Minggu Ke-</label>
                        <div class="filter-input-wrapper">
                            <svg class="filter-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <select class="filter-select" name="minggu_ke">
                                <option value="">Semua Minggu</option>
                                @for($w = 1; $w <= 5; $w++)
                                    <option value="{{ $w }}" {{ ($minggu ?? null) == $w ? 'selected' : '' }}>Minggu {{ $w }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="filter-btn" style="flex: 0 0 auto; padding-left: 32px; padding-right: 32px;">
                        Tampilkan
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </form>
            </section>

            {{-- 4 Kategori Card Grid --}}
            <section class="result-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 32px;">
                @foreach($kategoriList as $key => $meta)
                    @php
                        $data = $kategoriData[$key] ?? ['timeline' => collect(), 'latest' => null];
                        $latest = $data['latest'];
                        $skalaInfo = $latest && isset($skalaList[$latest->nilai]) ? $skalaList[$latest->nilai] : null;
                    @endphp
                    <div class="kategori-card" data-kategori="{{ $key }}" onclick="openTimeline('{{ $key }}')">
                        <div class="kategori-card-head">
                            <div class="kategori-card-icon" style="background: {{ $meta['color'] }}15;">
                                <span style="font-size: 24px;">{{ $meta['icon'] }}</span>
                            </div>
                            <div>
                                <h3 class="kategori-card-title">{{ $meta['label'] }}</h3>
                            </div>
                        </div>

                        @if($skalaInfo)
                            <div class="kategori-card-skala">
                                Skala terakhir:
                                <span class="skala-badge" style="background: {{ $skalaInfo['color'] }}; margin-left: 4px;">
                                    {{ $skalaInfo['short'] }}
                                </span>
                            </div>
                            <div class="kategori-card-date">
                                📅 {{ \Carbon\Carbon::parse($latest->tanggal)->translatedFormat('d F Y') }}
                            </div>
                        @else
                            <div class="kategori-card-empty">
                                Belum ada catatan perkembangan
                            </div>
                        @endif
                    </div>
                @endforeach
            </section>

            @include('partials.footer')
        </main>
    </div>

    {{-- Modal Timeline --}}
    <div class="modal-overlay" id="timelineModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">
                    <span id="modalIcon"></span>
                    <span id="modalLabel"></span>
                </h3>
                <button class="modal-close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body" id="modalBody">
                {{-- Timeline content akan di-inject via JS --}}
            </div>
        </div>
    </div>

    <script>
        const kategoriData = @json($kategoriData);
        const skalaList = @json($skalaList);
        const kategoriList = @json($kategoriList);

        function openTimeline(key) {
            const data = kategoriData[key];
            const meta = kategoriList[key];
            const timeline = data.timeline;

            document.getElementById('modalIcon').textContent = meta.icon;
            document.getElementById('modalLabel').textContent = 'Perkembangan ' + meta.label;

            const body = document.getElementById('modalBody');
            if (timeline.length === 0) {
                body.innerHTML = '<div class="timeline-empty">Belum ada data penilaian untuk aspek ini pada filter yang dipilih.</div>';
            } else {
                let html = '';
                timeline.forEach(item => {
                    const skala = skalaList[item.nilai];
                    html += `
                        <div class="timeline-item">
                            <div class="timeline-date">
                                📅 ${new Date(item.tanggal).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}
                                ${item.minggu_ke ? ` · Minggu ${item.minggu_ke}` : ''}
                                ${skala ? `<span class="timeline-skala" style="background: ${skala.color};">${skala.short} — ${skala.label}</span>` : ''}
                            </div>
                            <div class="timeline-catatan">${item.keterangan || '<em style="color:#94a3b8;">Tidak ada catatan</em>'}</div>
                        </div>
                    `;
                });
                body.innerHTML = html;
            }

            document.getElementById('timelineModal').classList.add('active');
        }

        document.getElementById('closeModal').addEventListener('click', () => {
            document.getElementById('timelineModal').classList.remove('active');
        });

        document.getElementById('timelineModal').addEventListener('click', (e) => {
            if (e.target === document.getElementById('timelineModal')) {
                document.getElementById('timelineModal').classList.remove('active');
            }
        });
    </script>
</body>
</html>
