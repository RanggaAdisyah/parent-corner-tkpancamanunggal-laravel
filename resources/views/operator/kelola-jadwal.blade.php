<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Kelola Jadwal Sekolah</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola-jadwal.css') }}">
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
                <div class="header-right">
                    <button id="btnBuatJadwal" class="btn btn-primary">
                        <span class="btn-icon">+</span> Kegiatan Baru
                    </button>
                    <button class="btn btn-outline">
                        <img src="{{ asset('img/icon-print.svg') }}" alt="Cetak" class="btn-icon-img" onerror="this.style.display='none'"> Cetak Jadwal
                    </button>
                    <button class="btn btn-primary">
                        <img src="{{ asset('img/icon-download.svg') }}" alt="Export" class="btn-icon-img" onerror="this.style.display='none'"> Export PDF
                    </button>
                </div>
            </header>

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
        </main>

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
                            <div class="form-group">
                                <label class="form-label">Waktu</label>
                                <div class="input-with-icon">
                                    <div class="input-icon-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    </div>
                                    <input type="time" class="form-input" id="jadwalWaktu" required>
                                </div>
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
                    
                    // Fill dummy data if it's an edit
                    if (data) {
                        document.getElementById('jadwalJudul').value = data.title || '';
                        document.getElementById('jadwalTanggal').value = data.date || '2023-10-05';
                        document.getElementById('jadwalWaktu').value = data.time || '08:00';
                        document.getElementById('jadwalDeskripsi').value = data.desc || '';
                    }
                } else {
                    modalTitle.innerText = 'Buat Jadwal Baru';
                    btnSubmit.innerText = 'Buat Jadwal';
                    btnHapus.style.display = 'none';
                    document.getElementById('jadwalForm').reset();
                }
                modal.classList.add('active');
            };

            const closeModal = () => {
                modal.classList.remove('active');
            };

            if (btnBuatJadwal) btnBuatJadwal.addEventListener('click', () => openModal('tambah'));
            if (btnCloseX) btnCloseX.addEventListener('click', closeModal);
            if (btnBatal) btnBatal.addEventListener('click', closeModal);

            calendarDays.forEach(day => {
                day.addEventListener('click', function() {
                    const dateText = this.querySelector('.date') ? this.querySelector('.date').innerText : this.innerText;
                    const eventText = this.querySelector('.event') ? this.querySelector('.event').innerText : '';
                    
                    openModal('ubah', {
                        title: eventText || 'Kegiatan Sekolah',
                        date: `2023-10-${dateText.padStart(2, '0')}`,
                        time: '08:00',
                        desc: 'Deskripsi kegiatan akan muncul di sini.'
                    });
                });
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            // Prevent default form submission
            document.getElementById('jadwalForm').addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Jadwal berhasil disimpan!');
                closeModal();
            });
        });
    </script>
</body>
</html>
