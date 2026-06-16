<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Jadwal Mengajar - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola-jadwal.css') }}">
</head>
<body>
    <div class="kelola-jadwal">
        @include('partials.sidebar-guru', ['active' => 'lihat-jadwal'])

        <main class="main">
            <header class="header">
                <div class="header-left">
                    <h1 class="page-title">Jadwal Mengajar</h1>
                    <p class="page-subtitle">Lihat jadwal mengajar dan kalender kegiatan TK Panca Manunggal.</p>
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
                            <div class="view-toggle">
                                <button class="toggle-btn active">Bulan</button>
                                <button class="toggle-btn">Minggu</button>
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
                                <div class="event green">Upacara Be...</div>
                            </div>
                            <div class="day">
                                <span class="date">2</span>
                                <div class="event blue">Pelajaran T...</div>
                            </div>
                            <div class="day"><span class="date">3</span></div>
                            <div class="day weekend"><span class="date">4</span></div>

                            <!-- Row 2 -->
                            <div class="day weekend"><span class="date">5</span></div>
                            <div class="day">
                                <span class="date">6</span>
                                <div class="event yellow">Kunjungan</div>
                            </div>
                            <div class="day"><span class="date">7</span></div>
                            <div class="day">
                                <span class="date">8</span>
                                <div class="event purple">Latihan Me...</div>
                            </div>
                            <div class="day today">
                                <div class="date-circle">9</div>
                                <div class="event red">Batik Day</div>
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

                    <!-- Widget Ulang Tahun -->
                    <div class="widget widget-birthday">
                        <h3>Ulang Tahun Bulan Ini</h3>
                        <p>Ada 3 siswa yang berulang tahun di bulan Oktober.</p>
                        <div class="avatars">
                            <div class="avatar"></div>
                            <div class="avatar"></div>
                            <div class="avatar"></div>
                        </div>
                        <button class="btn btn-full btn-white-translucent">Kirim Ucapan</button>
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
                                <div class="jh-badge">TK A &nbsp;&middot;&nbsp; {{ $hari['label'] }}</div>
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



        });
    </script>
</body>
</html>

