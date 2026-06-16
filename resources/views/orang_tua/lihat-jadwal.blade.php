<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Jadwal Pelajaran - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/operator/kelola-jadwal.css') }}">
</head>
<body>
    <div class="kelola-jadwal">
        @include('partials.sidebar-orang-tua', ['active' => 'lihat-jadwal'])

        <main class="main">
            <header class="header">
                <div class="header-left">
                    <h1 class="page-title">Jadwal Pelajaran</h1>
                    <p class="page-subtitle">Lihat jadwal pelajaran dan kalender kegiatan TK Panca Manunggal.</p>
                </div>

            </header>

            {{-- TAB NAVIGASI UTAMA --}}
            <div class="main-tabs">
                <button class="main-tab active" data-tab="kalender">📅 Kalender Kegiatan</button>
                <button class="main-tab" data-tab="harian">🕐 Jadwal Harian</button>
            </div>

            {{-- TAB PANEL: KALENDER --}}
            <div id="tab-kalender" class="tab-panel active">
            <div class="content-wrapper">
                <div class="calendar-section">
                    <div class="calendar-card">
                        <div class="calendar-header">
                            <div class="month-nav">
                                <button class="nav-btn">&lt;</button>
                                <h2>Oktober 2023</h2>
                                <button class="nav-btn">&gt;</button>
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

                            <!-- Row 1 -->
                            <div class="day disabled"><span class="date">28</span></div>
                            <div class="day disabled"><span class="date">29</span></div>
                            <div class="day disabled"><span class="date">30</span></div>
                            <div class="day">
                                <span class="date">1</span>
                                <div class="event green" data-title="Upacara Bendera" data-time="08:00 WIB" data-desc="Kegiatan rutin upacara bendera hari Senin yang diikuti oleh seluruh siswa dan guru TK Panca Manunggal.">Upacara Be...</div>
                            </div>
                            <div class="day">
                                <span class="date">2</span>
                                <div class="event blue" data-title="Pelajaran Tambahan" data-time="13:00 WIB" data-desc="Pelajaran tambahan khusus untuk kelas persiapan membaca dan berhitung.">Pelajaran T...</div>
                            </div>
                            <div class="day"><span class="date">3</span></div>
                            <div class="day weekend"><span class="date">4</span></div>

                            <!-- Row 2 -->
                            <div class="day weekend"><span class="date">5</span></div>
                            <div class="day">
                                <span class="date">6</span>
                                <div class="event yellow" data-title="Kunjungan Dr. Gigi" data-time="10:00 WIB" data-desc="Pemeriksaan kesehatan gigi rutin oleh dokter gigi dari Puskesmas setempat.">Kunjungan</div>
                            </div>
                            <div class="day"><span class="date">7</span></div>
                            <div class="day">
                                <span class="date">8</span>
                                <div class="event purple" data-title="Latihan Menari" data-time="09:00 WIB" data-desc="Latihan menari daerah untuk persiapan pentas seni akhir tahun.">Latihan Me...</div>
                            </div>
                            <div class="day today">
                                <div class="date-circle">9</div>
                                <div class="event red" data-title="Batik Day" data-time="Sepanjang Hari" data-desc="Seluruh siswa dan guru diwajibkan menggunakan seragam atau baju bebas bermotif batik hari ini.">Batik Day</div>
                            </div>
                            <div class="day"><span class="date">10</span></div>
                            <div class="day weekend"><span class="date">11</span></div>

                            <!-- Row 3 -->
                            <div class="day weekend"><span class="date">12</span></div>
                            <div class="day"><span class="date">13</span></div>
                            <div class="day"><span class="date">14</span></div>
                            <div class="day"><span class="date">15</span></div>
                            <div class="day"><span class="date">16</span></div>
                            <div class="day"><span class="date">17</span></div>
                            <div class="day weekend"><span class="date">18</span></div>
                            
                            <!-- Row 4 -->
                            <div class="day weekend"><span class="date">19</span></div>
                            <div class="day"><span class="date">20</span></div>
                            <div class="day"><span class="date">21</span></div>
                            <div class="day"><span class="date">22</span></div>
                            <div class="day"><span class="date">23</span></div>
                            <div class="day"><span class="date">24</span></div>
                            <div class="day weekend"><span class="date">25</span></div>

                            <!-- Row 5 -->
                            <div class="day weekend"><span class="date">26</span></div>
                            <div class="day"><span class="date">27</span></div>
                            <div class="day"><span class="date">28</span></div>
                            <div class="day"><span class="date">29</span></div>
                            <div class="day"><span class="date">30</span></div>
                            <div class="day"><span class="date">31</span></div>
                            <div class="day disabled"><span class="date">1</span></div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-widgets">
                    <!-- Widget Minggu Ini -->
                    <div class="widget">
                        <h3 class="widget-title">
                            <span class="widget-icon">📅</span> Minggu Ini
                        </h3>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-icon green-bg">🚩</div>
                                <div class="timeline-content">
                                    <h4>Upacara Bendera</h4>
                                    <p>Senin, 08:00 WIB</p>
                                </div>
                                <div class="timeline-date">1 Okt</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon blue-bg">🎨</div>
                                <div class="timeline-content">
                                    <h4>Tema Hewan</h4>
                                    <p>Selasa, 09:00 WIB</p>
                                </div>
                                <div class="timeline-date">2 Okt</div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-icon yellow-bg">🏥</div>
                                <div class="timeline-content">
                                    <h4>Kunjungan Dr. Gigi</h4>
                                    <p>Jumat, 10:00 WIB</p>
                                </div>
                                <div class="timeline-date">6 Okt</div>
                            </div>
                        </div>
                        <button class="btn btn-full btn-outline">Lihat Semua Jadwal</button>
                    </div>



                    <!-- Widget Kategori -->
                    <div class="widget">
                        <h3 class="widget-subtitle">KATEGORI</h3>
                        <ul class="category-list">
                            <li><span class="dot dot-blue"></span> Akademik</li>
                            <li><span class="dot dot-green"></span> Upacara</li>
                            <li><span class="dot dot-yellow"></span> Kesehatan</li>
                            <li><span class="dot dot-purple"></span> Seni & Budaya</li>
                            <li><span class="dot dot-red"></span> Libur</li>
                        </ul>
                    </div>
                </div>
            </div>

            @include('partials.footer')
            </div> {{-- /tab-panel kalender --}}

            {{-- TAB PANEL: JADWAL HARIAN --}}
            <div id="tab-harian" class="tab-panel">
                <div class="jadwal-harian-wrapper">

                    {{-- === TK A === --}}
                    @php
                    $tkaRows = [
                        ['09.30 - 10.00', 'Kedatangan &amp; Doa Pagi', 'Menyapa guru, berdoa bersama', ''],
                        ['10.00 - 10.30', 'Kegiatan Pembukaan', 'Menyanyi, senam pagi, diskusi tema hari ini', ''],
                        ['10.30 - 11.30', 'Kegiatan Inti', 'Sentra bermain / aktivitas tematik (motorik, bahasa, seni)', ''],
                        ['11.30 - 11.45', 'Istirahat &amp; Makan Bekal', 'Makan bersama, cuci tangan', ''],
                        ['11.45', 'Penutup &amp; Pulang', 'Doa bersama dan pulang', 'row-pulang'],
                    ];
                    $tkaJumatRows = [
                        ['09.15 - 09.30', 'Kedatangan &amp; Doa Pagi', 'Menyapa guru, berdoa bersama', ''],
                        ['09.30 - 09.45', 'Kegiatan Pembukaan', 'Menyanyi, senam pagi, diskusi tema hari ini', ''],
                        ['09.45 - 10.45', 'Kegiatan Inti', 'Sentra bermain / aktivitas tematik (motorik, bahasa, seni)', ''],
                        ['10.45 - 11.00', 'Istirahat &amp; Makan Bekal', 'Makan bersama, cuci tangan', ''],
                        ['11.00', 'Penutup &amp; Pulang', 'Doa bersama dan pulang', 'row-pulang'],
                    ];
                    $sabtuRows = [
                        ['07.00 - 07.15', 'Kedatangan &amp; Doa Pagi', 'Menyapa guru, berdoa bersama', ''],
                        ['07.15 - 07.30', 'Kegiatan Pembukaan', 'Menyanyi, senam pagi, diskusi tema hari ini', ''],
                        ['07.30 - 08.30', 'Kegiatan Inti', 'Makan bersama / Ekstra Karate / Jalan-jalan', ''],
                        ['08.30 - 09.00', 'Istirahat &amp; Makan Bekal', 'Makan bersama, cuci tangan', ''],
                        ['09.00', 'Penutup &amp; Pulang', 'Doa bersama dan pulang', 'row-pulang'],
                    ];
                    $hariTka = [
                        ['id'=>'tka-senin',  'label'=>'Senin',  'rows'=>$tkaRows],
                        ['id'=>'tka-selasa', 'label'=>'Selasa', 'rows'=>$tkaRows],
                        ['id'=>'tka-rabu',   'label'=>'Rabu',   'rows'=>$tkaRows],
                        ['id'=>'tka-kamis',  'label'=>'Kamis',  'rows'=>$tkaRows],
                        ['id'=>'tka-jumat',  'label'=>'Jumat',  'rows'=>$tkaJumatRows],
                        ['id'=>'tka-sabtu',  'label'=>'Sabtu',  'rows'=>$sabtuRows],
                    ];
                    @endphp
                    <div class="jh-kelas-panel active" id="panel-tka">
                        <div class="jh-hari-tabs">
                            @foreach($hariTka as $i => $hari)
                                <button class="jh-hari-tab {{ $i===0?'active':'' }}" data-hari="{{ $hari['id'] }}">{{ $hari['label'] }}</button>
                            @endforeach
                        </div>
                        @foreach($hariTka as $i => $hari)
                            <div class="jh-schedule {{ $i===0?'active':'' }}" id="{{ $hari['id'] }}">
                                <div class="jh-badge">Kelas Bintang Kecil &nbsp;&middot;&nbsp; {{ $hari['label'] }}</div>
                                <div class="jh-table-wrapper">
                                    <table class="jh-table">
                                        <thead><tr><th>Waktu</th><th>Kegiatan</th><th>Keterangan</th></tr></thead>
                                        <tbody>
                                            @foreach($hari['rows'] as $row)
                                                <tr class="{{ $row[3] }}">
                                                    <td>{!! $row[0] !!}</td>
                                                    <td>{!! $row[1] !!}</td>
                                                    <td>{!! $row[2] !!}</td>

                                                </tr>
                                            @endforeach
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
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 16px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span id="modalEventTime" style="font-weight: 600; color: #1e293b;"></span>
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
            const modalEventDesc = document.getElementById('modalEventDesc');

            // Tambahkan event click pada keseluruhan kotak hari (day) jika memiliki acara
            document.querySelectorAll('.day').forEach(dayEl => {
                const eventEl = dayEl.querySelector('.event');
                if (eventEl) {
                    dayEl.style.cursor = 'pointer';
                    dayEl.addEventListener('click', function() {
                        modalEventTitle.textContent = eventEl.dataset.title || 'Detail Kegiatan';
                        modalEventTime.textContent = eventEl.dataset.time || '-';
                        modalEventDesc.textContent = eventEl.dataset.desc || 'Tidak ada deskripsi.';
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
