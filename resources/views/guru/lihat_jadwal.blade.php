<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Jadwal Mengajar - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/jadwal_master.css') }}">
</head>
<body>
    <div class="kelola-jadwal">
        @include('partials.sidebar_guru', ['active' => 'lihat-jadwal'])

        <main class="main">
            <header class="header">
                <div class="header-left">
                    <h1 class="page-title">Jadwal Mengajar</h1>
                    <p class="page-subtitle">Lihat jadwal mengajar dan kalender kegiatan TK Panca Manunggal.</p>
                </div>

            </header>

            {{-- TAB NAVIGASI UTAMA --}}
            <div class="main-tabs">
                <button class="main-tab active" data-tab="kalender">Kalender Kegiatan</button>
                <button class="main-tab" data-tab="harian">Jadwal Harian</button>
            </div>

            {{-- TAB PANEL: KALENDER --}}
            <div id="tab-kalender" class="tab-panel active">
            <div class="content-wrapper">
                <div class="calendar-section">
                    <div class="calendar-card">
                        <div class="calendar-header">
                            <div class="month-nav">
                                @php
                                    $prevMonth = $month == 1 ? 12 : $month - 1;
                                    $prevYear = $month == 1 ? $year - 1 : $year;
                                    $nextMonth = $month == 12 ? 1 : $month + 1;
                                    $nextYear = $month == 12 ? $year + 1 : $year;
                                    $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y');
                                @endphp
                                <a href="?month={{ $prevMonth }}&year={{ $prevYear }}" class="nav-btn" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">&lt;</a>
                                <h2>{{ $monthName }}</h2>
                                <a href="?month={{ $nextMonth }}&year={{ $nextYear }}" class="nav-btn" style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">&gt;</a>
                            </div>

                        </div>
                        <div class="calendar-grid">
                            <div class="day-name">MIN</div>
                            <div class="day-name">SEN</div>
                            <div class="day-name">SEL</div>
                            <div class="day-name">RAB</div>
                            <div class="day-name">KAM</div>
                            <div class="day-name">JUM</div>
                            <div class="day-name">SAB</div>

                            @php
                                $dateObj = \Carbon\Carbon::createFromDate($year, $month, 1);
                                $daysInMonth = $dateObj->daysInMonth;
                                $firstDayOfWeek = $dateObj->dayOfWeek; // 0 (Sun) - 6 (Sat)
                                
                                $kalenderByDay = [];
                                foreach($kalenders as $k) {
                                    $d = \Carbon\Carbon::parse($k->tanggal)->day;
                                    $kalenderByDay[$d][] = $k;
                                }
                                $catColors = [
                                    'Akademik' => 'blue',
                                    'Upacara' => 'green',
                                    'Kesehatan' => 'yellow',
                                    'Seni & Budaya' => 'purple',
                                    'Libur' => 'red',
                                    'Lain-lain' => 'gray'
                                ];
                            @endphp

                            @for($i = 0; $i < $firstDayOfWeek; $i++)
                                <div class="day disabled"><span class="date"></span></div>
                            @endfor

                            @for($d = 1; $d <= $daysInMonth; $d++)
                                @php
                                    $currentDow = ($firstDayOfWeek + $d - 1) % 7;
                                    $isWeekend = ($currentDow == 0 || $currentDow == 6); // Sun or Sat
                                    $isToday = ($year == date('Y') && $month == date('n') && $d == date('j'));
                                @endphp
                                <div class="day {{ $isWeekend ? 'weekend' : '' }} {{ $isToday ? 'today' : '' }}">
                                    @if($isToday)
                                        <div class="date-circle">{{ $d }}</div>
                                    @else
                                        <span class="date">{{ $d }}</span>
                                    @endif

                                    @if(isset($kalenderByDay[$d]))
                                        @foreach($kalenderByDay[$d] as $event)
                                            @php $color = $catColors[$event->kategori] ?? 'gray'; @endphp
                                            <div class="event {{ $color }}" data-category="{{ $event->kategori }}" data-title="{{ $event->judul }}" data-time="{{ \Carbon\Carbon::parse($event->waktu_mulai)->format('H:i') }}{{ $event->waktu_selesai ? ' - ' . \Carbon\Carbon::parse($event->waktu_selesai)->format('H:i') : '' }}" data-desc="{{ $event->deskripsi }}">{{ \Illuminate\Support\Str::limit($event->judul, 10) }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="sidebar-widgets">


                    <!-- Widget Kategori -->
                    <div class="widget">
                        <h3 class="widget-subtitle">KATEGORI</h3>
                        <ul class="category-list">
                            <li><span class="dot dot-blue"></span> Akademik</li>
                            <li><span class="dot dot-green"></span> Upacara</li>
                            <li><span class="dot dot-yellow"></span> Kesehatan</li>
                            <li><span class="dot dot-purple"></span> Seni & Budaya</li>
                            <li><span class="dot dot-red"></span> Libur</li>
                            <li><span class="dot dot-gray"></span> Lain-lain</li>
                        </ul>
                    </div>
                </div>
            </div>

            @include('partials.footer')
            </div> {{-- /tab-panel kalender --}}

            {{-- TAB PANEL: JADWAL HARIAN --}}
            <div id="tab-harian" class="tab-panel">
                <div class="jadwal-harian-wrapper">



                    @php
                    $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    $jadwalByHari = array_fill_keys($hariList, []);
                    if(isset($jadwals)) {
                        foreach($jadwals as $j) {
                            $jadwalByHari[$j->hari][] = $j;
                        }
                    }
                    @endphp
                    <div class="jh-kelas-panel active" id="panel-jadwal">
                        <div class="jh-hari-tabs">
                            @foreach($hariList as $i => $hari)
                                <button class="jh-hari-tab {{ $i===0?'active':'' }}" data-hari="hari-{{ $hari }}">{{ $hari }}</button>
                            @endforeach
                        </div>
                        @foreach($hariList as $i => $hari)
                            <div class="jh-schedule {{ $i===0?'active':'' }}" id="hari-{{ $hari }}">
                                <div class="jh-badge">{{ $guru->kelas ? $guru->kelas->nama_kelas : 'Kelas' }} &nbsp;&middot;&nbsp; {{ $hari }}</div>
                                <div class="jh-table-wrapper">
                                    <table class="jh-table">
                                        <thead><tr><th>Waktu</th><th>Kegiatan</th><th>Keterangan</th></tr></thead>
                                        <tbody>
                                            @forelse($jadwalByHari[$hari] as $row)
                                                <tr>
                                                    <td>{{ $row->jam_mulai }}{{ $row->jam_selesai ? ' - ' . $row->jam_selesai : ' - Selesai' }}</td>
                                                    <td>{{ $row->kegiatan }}</td>
                                                    <td>{{ $row->keterangan }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" style="text-align:center; padding:20px;">Belum ada jadwal</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>



                </div>{{-- /jadwal-harian-wrapper --}}
                @include('partials.footer')
            </div>{{-- /tab-panel harian --}}

        </main>

        {{-- Modal Detail Kegiatan --}}
        <div class="modal-overlay" id="eventDetailModal">
            <div class="modal-content" style="max-width: 400px;">
                <div class="modal-header">
                    <h3 class="modal-title" id="modalEventTitle">Detail Kegiatan</h3>
                    <button class="btn-close-modal" id="closeEventModal" style="font-size: 24px;">&times;</button>
                </div>
                <div class="modal-body">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span id="modalEventTime" style="font-weight: 600; color: #1e293b;"></span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                        <span id="modalEventCategory" style="font-weight: 600; color: #1e293b;"></span>
                    </div>
                    <div>
                        <span style="font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase;">Deskripsi</span>
                        <p id="modalEventDesc" style="margin-top: 6px; color: #334155; line-height: 1.5;"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =========================================
            // TAB UTAMA: Kalender vs Jadwal Harian
            // =========================================
            const mainTabs = document.querySelectorAll('.main-tab');
            const tabPanels = document.querySelectorAll('.tab-panel');

            mainTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    mainTabs.forEach(t => t.classList.remove('active'));
                    tabPanels.forEach(p => p.classList.remove('active'));
                    tab.classList.add('active');
                    document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
                });
            });



            // =========================================
            // SUB-TAB HARI (Senin-Kamis / Jumat)
            // =========================================
            document.querySelectorAll('.jh-hari-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    const panel = tab.closest('.jh-kelas-panel');
                    panel.querySelectorAll('.jh-hari-tab').forEach(t => t.classList.remove('active'));
                    panel.querySelectorAll('.jh-schedule').forEach(s => s.classList.remove('active'));
                    tab.classList.add('active');
                    panel.querySelector('#' + tab.dataset.hari).classList.add('active');
                });
            });


            // =========================================
            // MODAL DETAIL KEGIATAN KALENDER
            // =========================================
            const eventModal = document.getElementById('eventDetailModal');
            const closeEventModal = document.getElementById('closeEventModal');
            const modalEventTitle = document.getElementById('modalEventTitle');
            const modalEventTime = document.getElementById('modalEventTime');
            const modalEventCategory = document.getElementById('modalEventCategory');
            const modalEventDesc = document.getElementById('modalEventDesc');

            document.querySelectorAll('.day').forEach(dayEl => {
                const eventEl = dayEl.querySelector('.event');
                if (eventEl) {
                    dayEl.style.cursor = 'pointer';
                    dayEl.addEventListener('click', function() {
                        modalEventTitle.textContent = eventEl.dataset.title || 'Detail Kegiatan';
                        modalEventTime.textContent = eventEl.dataset.time || '-';
                        modalEventCategory.textContent = eventEl.dataset.category || 'Lain-lain';
                        modalEventDesc.innerHTML = eventEl.dataset.desc || 'Tidak ada deskripsi.';
                        eventModal.classList.add('active');
                    });
                }
            });

            if (closeEventModal) {
                closeEventModal.addEventListener('click', () => {
                    eventModal.classList.remove('active');
                });
            }

            if (eventModal) {
                eventModal.addEventListener('click', (e) => {
                    if(e.target === eventModal) {
                        eventModal.classList.remove('active');
                    }
                });
            }

        });
    </script>
</body>
</html>

