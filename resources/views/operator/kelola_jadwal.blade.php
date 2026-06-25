<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Kelola Jadwal Sekolah</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola_jadwal.css') }}">
</head>
<body>
    <div class="kelola-jadwal">
        @include('partials.sidebar', ['active' => 'jadwal-pelajaran'])

        <main class="main">
            <header class="header">
                <div class="header-left">
                    <h1 class="page-title">Kelola Jadwal Sekolah</h1>
                    <p class="page-subtitle">Atur kegiatan belajar mengajar dan acara spesial TK Panca Manunggal.</p>
                </div>
                <div class="header-right" id="headerActions">
                    <!-- For Kalender Tab -->
                    <div id="actionsKalender" style="display: flex; gap: 12px; flex-wrap: wrap;">
                        <button id="btnBuatJadwal" class="btn btn-primary">
                            <span class="btn-icon">+</span> Kegiatan Baru
                        </button>
                    </div>
                    
                    <!-- For Jadwal Harian Tab -->
                    <div id="actionsHarian" style="display: none; gap: 12px; flex-wrap: wrap;">
                        <button id="btnBuatJadwalHarian" class="btn btn-primary">
                            <span class="btn-icon">+</span> Jadwal Harian Baru
                        </button>
                    </div>
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

                    {{-- Sub-tab Kelas --}}
                    <div class="jh-kelas-tabs">
                        <button class="jh-kelas-tab active" data-kelas="tka">TK A</button>
                        <button class="jh-kelas-tab" data-kelas="tkb">TK B</button>
                    </div>

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
                                        <thead><tr><th>Waktu</th><th>Kegiatan</th><th>Keterangan</th><th>Aksi</th></tr></thead>
                                        <tbody>
                                            @foreach($hari['rows'] as $row)
                                                <tr class="{{ $row[3] }}">
                                                    <td>{!! $row[0] !!}</td>
                                                    <td>{!! $row[1] !!}</td>
                                                    <td>{!! $row[2] !!}</td>
                                                    <td class="td-aksi">
                                                        <button class="btn-icon-action btn-edit" title="Ubah" onclick="openHarianModal('ubah', {waktu: '{!! $row[0] !!}', kegiatan: '{!! $row[1] !!}', keterangan: '{!! $row[2] !!}'})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                        </button>
                                                        <button class="btn-icon-action btn-delete" title="Hapus" onclick="if(confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) alert('Fitur Hapus Jadwal Harian belum terhubung ke backend')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- === TK B === --}}
                    @php
                    $tkbRows = [
                        ['07.00 - 07.30', 'Kedatangan &amp; Doa Pagi', 'Menyapa guru, berdoa bersama', ''],
                        ['07.30 - 08.00', 'Kegiatan Pembukaan', 'Menyanyi, senam pagi, diskusi tema hari ini', ''],
                        ['08.00 - 09.00', 'Kegiatan Inti', 'Sentra bermain / aktivitas tematik (motorik, bahasa, seni)', ''],
                        ['09.00 - 09.30', 'Istirahat &amp; Makan Bekal', 'Makan bersama, cuci tangan', ''],
                        ['09.30', 'Penutup &amp; Pulang', 'Doa bersama dan pulang', 'row-pulang'],
                    ];
                    $tkbJumatRows = [
                        ['07.00 - 07.30', 'Kedatangan &amp; Doa Pagi', 'Menyapa guru, berdoa bersama', ''],
                        ['07.30 - 07.45', 'Kegiatan Pembukaan', 'Menyanyi, senam pagi, diskusi tema hari ini', ''],
                        ['07.45 - 08.30', 'Kegiatan Inti', 'Sentra bermain / aktivitas tematik (motorik, bahasa, seni)', ''],
                        ['08.30 - 09.00', 'Istirahat &amp; Makan Bekal', 'Makan bersama, cuci tangan', ''],
                        ['09.00', 'Penutup &amp; Pulang', 'Doa bersama dan pulang', 'row-pulang'],
                    ];
                    $hariTkb = [
                        ['id'=>'tkb-senin',  'label'=>'Senin',  'rows'=>$tkbRows],
                        ['id'=>'tkb-selasa', 'label'=>'Selasa', 'rows'=>$tkbRows],
                        ['id'=>'tkb-rabu',   'label'=>'Rabu',   'rows'=>$tkbRows],
                        ['id'=>'tkb-kamis',  'label'=>'Kamis',  'rows'=>$tkbRows],
                        ['id'=>'tkb-jumat',  'label'=>'Jumat',  'rows'=>$tkbJumatRows],
                        ['id'=>'tkb-sabtu',  'label'=>'Sabtu',  'rows'=>$sabtuRows],
                    ];
                    @endphp
                    <div class="jh-kelas-panel" id="panel-tkb">
                        <div class="jh-hari-tabs">
                            @foreach($hariTkb as $i => $hari)
                                <button class="jh-hari-tab {{ $i===0?'active':'' }}" data-hari="{{ $hari['id'] }}">{{ $hari['label'] }}</button>
                            @endforeach
                        </div>
                        @foreach($hariTkb as $i => $hari)
                            <div class="jh-schedule {{ $i===0?'active':'' }}" id="{{ $hari['id'] }}">
                                <div class="jh-badge">TK B &nbsp;&middot;&nbsp; {{ $hari['label'] }}</div>
                                <div class="jh-table-wrapper">
                                    <table class="jh-table">
                                        <thead><tr><th>Waktu</th><th>Kegiatan</th><th>Keterangan</th><th>Aksi</th></tr></thead>
                                        <tbody>
                                            @foreach($hari['rows'] as $row)
                                                <tr class="{{ $row[3] }}">
                                                    <td>{!! $row[0] !!}</td>
                                                    <td>{!! $row[1] !!}</td>
                                                    <td>{!! $row[2] !!}</td>
                                                    <td class="td-aksi">
                                                        <button class="btn-icon-action btn-edit" title="Ubah" onclick="openHarianModal('ubah', {waktu: '{!! $row[0] !!}', kegiatan: '{!! $row[1] !!}', keterangan: '{!! $row[2] !!}'})">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                        </button>
                                                        <button class="btn-icon-action btn-delete" title="Hapus" onclick="if(confirm('Apakah Anda yakin ingin menghapus jadwal ini?')) alert('Fitur Hapus Jadwal Harian belum terhubung ke backend')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </button>
                                                    </td>
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


        <!-- Modal Tambah/Ubah Jadwal Harian -->
        <div id="jadwalHarianModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitleHarian" class="modal-title">Ubah Jadwal Harian</h3>
                    <button type="button" class="btn-close-modal" id="btnCloseHarianX">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <form id="harianForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Kelas</label>
                            <select class="form-select" id="harianKelas" required style="width: 100%; padding: 10px; border: 1px solid #e2e8f0; border-radius: 8px;">
                                <option value="tka">TK A</option>
                                <option value="tkb">TK B</option>
                            </select>
                        </div>
                        
                        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="form-group">
                                <label class="form-label">Waktu Mulai</label>
                                <input type="time" class="form-input" id="harianWaktuMulai" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Waktu Selesai</label>
                                <input type="time" class="form-input" id="harianWaktuSelesai">
                                <small style="font-size: 11px; color: #6b7280;">*Kosongkan untuk waktu pulang</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kegiatan</label>
                            <input type="text" class="form-input" id="harianKegiatan" placeholder="Contoh: Kegiatan Pembukaan" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-textarea" id="harianKeterangan" placeholder="Contoh: Menyanyi, senam pagi..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="footer-left"></div>
                        <div class="footer-right">
                            <button type="button" class="btn-batal" id="btnBatalHarian">Batal</button>
                            <button type="submit" class="btn-simpan" id="btnSimpanHarian">Simpan Jadwal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Tambah/Ubah Jadwal -->
        <div id="jadwalModal" class="modal-overlay">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitleJadwal" class="modal-title">Ubah Jadwal Kegiatan</h3>
                    <button type="button" class="btn-close-modal" id="btnCloseJadwalX">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                
                <form id="jadwalForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Judul Kegiatan</label>
                            <input type="text" class="form-input" id="jadwalJudul" placeholder="Contoh: Kunjungan Edukasi ke Museum" required>
                        </div>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <div class="input-with-icon">
                                    <div class="input-icon-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    </div>
                                    <input type="date" class="form-input" id="jadwalTanggal" required>
                                </div>
                            </div>
                            <div class="form-group" style="display: flex; gap: 12px;">
                                <div style="flex: 1;">
                                    <label class="form-label">Mulai</label>
                                    <div class="input-with-icon">
                                        <div class="input-icon-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                        </div>
                                        <input type="time" class="form-input" id="jadwalWaktuMulai" required>
                                    </div>
                                </div>
                                <div style="flex: 1;">
                                    <label class="form-label">Selesai</label>
                                    <div class="input-with-icon">
                                        <div class="input-icon-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                        </div>
                                        <input type="time" class="form-input" id="jadwalWaktuSelesai" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <div class="input-with-icon">
                                <div class="input-icon-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                                </div>
                                <select class="form-input" id="jadwalKategori" required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Akademik" style="color: #3b82f6; font-weight: 600;">&#9679; Akademik</option>
                                    <option value="Upacara" style="color: #22c55e; font-weight: 600;">&#9679; Upacara</option>
                                    <option value="Kesehatan" style="color: #eab308; font-weight: 600;">&#9679; Kesehatan</option>
                                    <option value="Seni & Budaya" style="color: #a855f7; font-weight: 600;">&#9679; Seni & Budaya</option>
                                    <option value="Libur" style="color: #ef4444; font-weight: 600;">&#9679; Libur</option>
                                    <option value="Lain-lain" style="color: #64748b; font-weight: 600;">&#9679; Lain-lain</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-textarea" id="jadwalDeskripsi" placeholder="Masukkan detail kegiatan..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-delete-jadwal" id="btnHapusJadwal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            Hapus Jadwal
                        </button>
                        <div class="footer-right">
                            <button type="button" class="btn-batal" id="btnBatalJadwal">Batal</button>
                            <button type="submit" class="btn-simpan" id="btnSimpanJadwal">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
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
            const actionsKalender = document.getElementById('actionsKalender');
            const actionsHarian = document.getElementById('actionsHarian');

            mainTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    mainTabs.forEach(t => t.classList.remove('active'));
                    tabPanels.forEach(p => p.classList.remove('active'));
                    tab.classList.add('active');
                    document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
                    
                    if (tab.dataset.tab === 'harian') {
                        actionsKalender.style.display = 'none';
                        actionsHarian.style.display = 'flex';
                    } else {
                        actionsKalender.style.display = 'flex';
                        actionsHarian.style.display = 'none';
                    }
                });
            });

            // =========================================
            // SUB-TAB KELAS (TK A / TK B / Sabtu)
            // =========================================
            document.querySelectorAll('.jh-kelas-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    const kelas = tab.dataset.kelas;
                    document.querySelectorAll('.jh-kelas-tab').forEach(t => t.classList.remove('active'));
                    document.querySelectorAll('.jh-kelas-panel').forEach(p => p.classList.remove('active'));
                    tab.classList.add('active');
                    document.getElementById('panel-' + kelas).classList.add('active');
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
            // MODAL KALENDER
            // =========================================
            const modal = document.getElementById('jadwalModal');
            const btnBuatJadwal = document.getElementById('btnBuatJadwal');
            const btnCloseX = document.getElementById('btnCloseJadwalX');
            const btnBatal = document.getElementById('btnBatalJadwal');
            const modalTitle = document.getElementById('modalTitleJadwal');
            const btnSubmit = document.getElementById('btnSimpanJadwal');
            const btnHapus = document.getElementById('btnHapusJadwal');
            const calendarDays = document.querySelectorAll('.calendar-grid .day:not(.disabled)');

            const openModal = (type = 'tambah', data = null) => {
                if (type === 'ubah') {
                    modalTitle.innerText = 'Ubah Jadwal Kegiatan';
                    btnSubmit.innerText = 'Simpan Perubahan';
                    btnHapus.style.display = 'flex';
                    if (data) {
                        document.getElementById('jadwalJudul').value = data.title || '';
                        document.getElementById('jadwalTanggal').value = data.date || '2023-10-05';
                        
                        let wMulai = '08:00';
                        let wSelesai = '10:00';
                        if (data.time) {
                            const parts = data.time.replace(' WIB', '').split(' - ');
                            if(parts.length > 0) wMulai = parts[0];
                            if(parts.length > 1) wSelesai = parts[1];
                        }
                        
                        document.getElementById('jadwalWaktuMulai').value = wMulai;
                        document.getElementById('jadwalWaktuSelesai').value = wSelesai;
                        document.getElementById('jadwalKategori').value = data.category || '';
                        document.getElementById('jadwalDeskripsi').value = data.desc || '';
                    }
                } else {
                    modalTitle.innerText = 'Buat Jadwal Baru';
                    btnSubmit.innerText = 'Buat Jadwal';
                    btnHapus.style.display = 'none';
                    document.getElementById('jadwalForm').reset();
                    if (data && data.date) document.getElementById('jadwalTanggal').value = data.date;
                }
                modal.classList.add('active');
            };

            const closeModal = () => modal.classList.remove('active');

            if (btnBuatJadwal) btnBuatJadwal.addEventListener('click', () => openModal('tambah'));
            if (btnCloseX) btnCloseX.addEventListener('click', closeModal);
            if (btnBatal) btnBatal.addEventListener('click', closeModal);

            calendarDays.forEach(day => {
                day.addEventListener('click', function() {
                    const dateText = this.querySelector('.date') ? this.querySelector('.date').innerText : this.innerText;
                    const eventEl = this.querySelector('.event');
                    
                    if (eventEl) {
                        openModal('ubah', {
                            title: eventEl.dataset.title || eventEl.innerText,
                            date: `2023-10-${dateText.padStart(2, '0')}`,
                            time: eventEl.dataset.time || '',
                            desc: eventEl.dataset.desc || '',
                            category: eventEl.dataset.category || ''
                        });
                    } else {
                        openModal('tambah', {
                            date: `2023-10-${dateText.padStart(2, '0')}`
                        });
                    }
                });
            });

            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
            document.getElementById('jadwalForm').addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Jadwal berhasil disimpan!');
                closeModal();
            });
            // =========================================
            // MODAL JADWAL HARIAN
            // =========================================
            const harianModal = document.getElementById('jadwalHarianModal');
            const btnBuatJadwalHarian = document.getElementById('btnBuatJadwalHarian');
            const btnCloseHarianX = document.getElementById('btnCloseHarianX');
            const btnBatalHarian = document.getElementById('btnBatalHarian');
            const modalTitleHarian = document.getElementById('modalTitleHarian');
            const btnSimpanHarian = document.getElementById('btnSimpanHarian');
            const harianForm = document.getElementById('harianForm');

            window.openHarianModal = (type = 'tambah', data = null) => {
                if (type === 'ubah') {
                    modalTitleHarian.innerText = 'Ubah Jadwal Harian';
                    btnSimpanHarian.innerText = 'Simpan Perubahan';
                    if (data) {
                        document.getElementById('harianWaktuMulai').value = data.waktu ? data.waktu.replace('.', ':') : '';
                        document.getElementById('harianWaktuSelesai').value = data.akhir ? data.akhir.replace('.', ':') : '';
                        document.getElementById('harianKegiatan').value = data.kegiatan || '';
                        
                        // Handle escaped ampersand
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = data.keterangan || '';
                        document.getElementById('harianKeterangan').value = tempDiv.textContent || tempDiv.innerText || '';
                        
                        document.getElementById('harianKelas').value = data.kelas || 'tka';
                    }
                } else {
                    modalTitleHarian.innerText = 'Buat Jadwal Harian Baru';
                    btnSimpanHarian.innerText = 'Tambahkan Jadwal';
                    harianForm.reset();
                }
                harianModal.classList.add('active');
            };

            const closeHarianModal = () => harianModal.classList.remove('active');

            if (btnBuatJadwalHarian) btnBuatJadwalHarian.addEventListener('click', () => openHarianModal('tambah'));
            if (btnCloseHarianX) btnCloseHarianX.addEventListener('click', closeHarianModal);
            if (btnBatalHarian) btnBatalHarian.addEventListener('click', closeHarianModal);

            harianModal.addEventListener('click', (e) => { if (e.target === harianModal) closeHarianModal(); });
            harianForm.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Jadwal Harian berhasil disimpan!');
                closeHarianModal();
            });



        });
    </script>
</body>
</html>

