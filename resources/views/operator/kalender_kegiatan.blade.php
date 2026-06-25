<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Kalender Kegiatan</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/kelola_jadwal.css') }}">
</head>
<body>
    <div class="kelola-jadwal">
        @include('partials.sidebar', ['active' => 'kalender-kegiatan'])

        <main class="main">
            <header class="header">
                <div class="header-left">
                    <h1 class="page-title">Kalender Kegiatan</h1>
                    <p class="page-subtitle">Atur acara spesial dan kalender kegiatan TK Panca Manunggal.</p>
                </div>
                <div class="header-right">
                    <button id="btnBuatJadwal" class="btn btn-primary">
                        <span class="btn-icon">+</span> Kegiatan Baru
                    </button>
                </div>
            </header>

            <div class="tab-panel active">
            <div class="content-wrapper">
                <div class="calendar-section">
                    <div class="calendar-card">
                        <div class="calendar-header">
                            <div class="month-nav">
                                <button class="nav-btn" id="prevMonthBtn">&lt;</button>
                                <h2 id="calendarMonthTitle">Bulan Tahun</h2>
                                <button class="nav-btn" id="nextMonthBtn">&gt;</button>
                            </div>
                        </div>
                        <div class="calendar-grid" id="calendarGrid">
                            <!-- JS will generate this -->
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
            </div>
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
                
                <form id="jadwalForm" method="POST" action="{{ url('/kalender-kegiatan') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label">Judul Kegiatan</label>
                            <input type="text" name="judul" class="form-input" id="jadwalJudul" placeholder="Contoh: Kunjungan Edukasi ke Museum" required>
                        </div>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Tanggal</label>
                                <div class="input-with-icon">
                                    <div class="input-icon-left">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    </div>
                                    <input type="date" name="tanggal" class="form-input" id="jadwalTanggal" required>
                                </div>
                            </div>
                            <div class="form-group" style="display: flex; gap: 12px;">
                                <div style="flex: 1;">
                                    <label class="form-label">Mulai</label>
                                    <div class="input-with-icon">
                                        <div class="input-icon-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                        </div>
                                        <input type="time" name="waktu_mulai" class="form-input" id="jadwalWaktuMulai" required>
                                    </div>
                                </div>
                                <div style="flex: 1;">
                                    <label class="form-label">Selesai</label>
                                    <div class="input-with-icon">
                                        <div class="input-icon-left">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                        </div>
                                        <input type="time" name="waktu_selesai" class="form-input" id="jadwalWaktuSelesai">
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
                                <select class="form-input" name="kategori" id="jadwalKategori" required>
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
                            <textarea class="form-textarea" name="deskripsi" id="jadwalDeskripsi" placeholder="Masukkan detail kegiatan..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-delete-jadwal" id="btnHapusJadwal" onclick="submitDeleteForm()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            Hapus Jadwal
                        </button>
                        <div class="footer-right">
                            <button type="button" class="btn-batal" id="btnBatalJadwal">Batal</button>
                            <button type="submit" class="btn-simpan" id="btnSimpanJadwal">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
                
                <form id="deleteForm" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const eventsData = @json($kegiatanList ?? []);
            
            let currentDate = new Date();
            const calendarGrid = document.getElementById('calendarGrid');
            const calendarMonthTitle = document.getElementById('calendarMonthTitle');
            const prevMonthBtn = document.getElementById('prevMonthBtn');
            const nextMonthBtn = document.getElementById('nextMonthBtn');
            
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            function getCategoryColor(category) {
                switch(category) {
                    case 'Akademik': return 'blue';
                    case 'Upacara': return 'green';
                    case 'Kesehatan': return 'yellow';
                    case 'Seni & Budaya': return 'purple';
                    case 'Libur': return 'red';
                    default: return 'gray';
                }
            }

            function renderCalendar() {
                calendarGrid.innerHTML = `
                    <div class="day-name">MIN</div>
                    <div class="day-name">SEN</div>
                    <div class="day-name">SEL</div>
                    <div class="day-name">RAB</div>
                    <div class="day-name">KAM</div>
                    <div class="day-name">JUM</div>
                    <div class="day-name">SAB</div>
                `;

                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                calendarMonthTitle.innerText = `${monthNames[month]} ${year}`;

                const firstDay = new Date(year, month, 1).getDay(); // 0 (Sun) to 6 (Sat)
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const daysInPrevMonth = new Date(year, month, 0).getDate();

                // Fill previous month days
                for (let i = firstDay - 1; i >= 0; i--) {
                    calendarGrid.innerHTML += `<div class="day disabled"><span class="date">${daysInPrevMonth - i}</span></div>`;
                }

                // Fill current month days
                const today = new Date();
                for (let i = 1; i <= daysInMonth; i++) {
                    const isToday = today.getDate() === i && today.getMonth() === month && today.getFullYear() === year;
                    const isWeekend = new Date(year, month, i).getDay() === 0 || new Date(year, month, i).getDay() === 6;
                    
                    const dateString = `${year}-${String(month+1).padStart(2,'0')}-${String(i).padStart(2,'0')}`;
                    
                    // Find events for this day
                    const dayEvents = eventsData.filter(e => e.tanggal === dateString);
                    let eventsHtml = '';
                    
                    dayEvents.forEach(e => {
                        const colorClass = getCategoryColor(e.kategori);
                        const timeStr = e.waktu_selesai ? `${e.waktu_mulai.substring(0,5)} - ${e.waktu_selesai.substring(0,5)}` : e.waktu_mulai.substring(0,5);
                        eventsHtml += `
                            <div class="event ${colorClass}" 
                                data-id="${e.id}"
                                data-title="${e.judul}" 
                                data-time="${e.waktu_mulai}" 
                                data-time-end="${e.waktu_selesai || ''}" 
                                data-category="${e.kategori}" 
                                data-desc="${e.deskripsi || ''}">
                                ${e.judul}
                            </div>
                        `;
                    });

                    let dayClass = 'day';
                    if (isToday) dayClass += ' today';
                    else if (isWeekend) dayClass += ' weekend';

                    const dateContent = isToday ? `<div class="date-circle">${i}</div>` : `<span class="date">${i}</span>`;
                    
                    calendarGrid.innerHTML += `
                        <div class="${dayClass}" data-date="${dateString}">
                            ${dateContent}
                            ${eventsHtml}
                        </div>
                    `;
                }

                // Fill next month days to complete 6 rows (42 cells minus firstDay and daysInMonth)
                const totalCellsFilled = firstDay + daysInMonth;
                const remainingCells = 42 - totalCellsFilled;
                
                for (let i = 1; i <= remainingCells; i++) {
                    if (remainingCells >= 7 && i > remainingCells - 7 && totalCellsFilled <= 35) continue; // Skip extra row if not needed
                    calendarGrid.innerHTML += `<div class="day disabled"><span class="date">${i}</span></div>`;
                }

                attachCalendarListeners();
            }

            prevMonthBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });

            nextMonthBtn.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
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
            const form = document.getElementById('jadwalForm');
            const deleteForm = document.getElementById('deleteForm');

            const openModal = (type = 'tambah', data = null) => {
                if (type === 'ubah') {
                    modalTitle.innerText = 'Ubah Jadwal Kegiatan';
                    btnSubmit.innerText = 'Simpan Perubahan';
                    btnHapus.style.display = 'flex';
                    form.action = `/kalender-kegiatan/${data.id}`;
                    document.getElementById('formMethod').value = 'PUT';
                    deleteForm.action = `/kalender-kegiatan/${data.id}`;

                    document.getElementById('jadwalJudul').value = data.title || '';
                    document.getElementById('jadwalTanggal').value = data.date || '';
                    document.getElementById('jadwalWaktuMulai').value = data.time || '';
                    document.getElementById('jadwalWaktuSelesai').value = data.timeEnd || '';
                    document.getElementById('jadwalKategori').value = data.category || '';
                    document.getElementById('jadwalDeskripsi').value = data.desc || '';
                    
                } else {
                    modalTitle.innerText = 'Buat Jadwal Baru';
                    btnSubmit.innerText = 'Buat Jadwal';
                    btnHapus.style.display = 'none';
                    form.reset();
                    form.action = `/kalender-kegiatan`;
                    document.getElementById('formMethod').value = 'POST';
                    if (data && data.date) document.getElementById('jadwalTanggal').value = data.date;
                }
                modal.classList.add('active');
            };

            const closeModal = () => modal.classList.remove('active');

            if (btnBuatJadwal) btnBuatJadwal.addEventListener('click', () => openModal('tambah'));
            if (btnCloseX) btnCloseX.addEventListener('click', closeModal);
            if (btnBatal) btnBatal.addEventListener('click', closeModal);

            window.submitDeleteForm = function() {
                if(confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')) {
                    deleteForm.submit();
                }
            };

            function attachCalendarListeners() {
                const calendarDays = document.querySelectorAll('.calendar-grid .day:not(.disabled)');
                calendarDays.forEach(day => {
                    day.addEventListener('click', function(e) {
                        const dateStr = this.dataset.date;
                        
                        // Check if an event was clicked directly
                        if (e.target.classList.contains('event')) {
                            const ev = e.target;
                            openModal('ubah', {
                                id: ev.dataset.id,
                                title: ev.dataset.title,
                                date: dateStr,
                                time: ev.dataset.time,
                                timeEnd: ev.dataset.timeEnd,
                                desc: ev.dataset.desc,
                                category: ev.dataset.category
                            });
                            e.stopPropagation(); // prevent triggering the day click
                        } else {
                            openModal('tambah', { date: dateStr });
                        }
                    });
                });
            }

            modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            // Initialize calendar
            renderCalendar();
        });
    </script>
</body>
</html>

