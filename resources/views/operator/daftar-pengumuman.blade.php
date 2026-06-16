<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Daftar Pengumuman - Operator Panel</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/daftar-pengumuman.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/buat-pengumuman.css') }}">
    <style>
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; overflow-y: auto; }
        .modal-overlay.active { display: flex; }
        .modal-content-pengumuman { background: white; border-radius: 12px; max-width: 800px; width: 100%; max-height: 90vh; overflow-y: auto; display: flex; flex-direction: column; }
        .btn-close-modal { background: none; border: none; font-size: 28px; cursor: pointer; color: #666; padding: 0; line-height: 1; }
        .btn-close-modal:hover { color: #000; }
        .modal-content-pengumuman .scrollable-content { padding: 24px; }
    </style>
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar', ['active' => 'pengumuman'])

        <main class="main">
            <header class="page-header">
                <div class="header-left">
                    <h1 class="header-title">Daftar Pengumuman</h1>
                    <p class="header-subtitle">Kelola dan lihat semua pengumuman yang telah Anda bagikan.</p>
                </div>
                <button type="button" id="btnBuatPengumuman" class="btn-add" style="border: none; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Buat Pengumuman Baru
                </button>
            </header>

            <div class="table-container">
                <div class="table-header">
                    <h2 class="table-title">Semua Pengumuman</h2>
                    <div class="search-wrapper">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" class="search-input" placeholder="Cari judul pengumuman...">
                    </div>
                </div>

                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Pengumuman</th>
                            <th>Tanggal Kirim</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="announcement-title">Kegiatan Berenang Hari Jumat</span>
                                <span class="announcement-preview">Diharapkan orang tua menyiapkan perlengkapan renang...</span>
                            </td>
                            <td><span class="date-text">24 Okt 2023, 08:30</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-icon" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-icon btn-icon-delete" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="announcement-title">Pemberitahuan Libur Nasional</span>
                                <span class="announcement-preview">Sehubungan dengan hari raya, sekolah akan diliburkan pada...</span>
                            </td>
                            <td><span class="date-text">20 Okt 2023, 14:15</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-icon" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                    <button class="btn-icon btn-icon-delete" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination">
                    <span class="pagination-info">Menampilkan 1 - 2 dari 12 pengumuman</span>
                    <div class="pagination-nav">
                        <button class="btn-page" disabled>Sebelumnya</button>
                        <button class="btn-page btn-page-active">1</button>
                        <button class="btn-page">2</button>
                        <button class="btn-page">3</button>
                        <button class="btn-page">Selanjutnya</button>
                    </div>
                </div>
            </div>

            @include('partials.footer')
        </main>

        <!-- Modal Buat Pengumuman -->
        <div id="modalPengumuman" class="modal-overlay">
            <div class="modal-content-pengumuman buat-pengumuman">
                <div style="display: flex; justify-content: flex-end; padding: 16px 24px 0;">
                    <button class="btn-close-modal" id="btnClosePengumuman">&times;</button>
                </div>
                <div class="scrollable-content" style="margin-top: 0; padding-top: 8px;">
                    <div style="margin-bottom: 24px;">
                        <h1 class="page-title" style="margin-bottom: 8px;">Buat Pengumuman Baru</h1>
                        <p class="page-subtitle">Buat dan sebarkan informasi penting kepada orang tua murid dengan mudah. Pastikan semua detail terisi dengan benar sebelum mengirim.</p>
                    </div>

                    <!-- Step 1 Card -->
                    <div class="step-card">
                        <div class="step-header">
                            <h2 class="step-title"><span class="step-number">1</span> Isi Detail Pengumuman</h2>
                            <span class="badge-wajib">Wajib Diisi</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Judul Pengumuman <span class="required-asterisk">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon">T</span>
                                <input type="text" class="form-input" placeholder="Contoh: Kegiatan Outbound Semester 1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Isi Pesan <span class="required-asterisk">*</span></label>
                            <textarea class="form-textarea" placeholder="Tuliskan detail pengumuman yang ingin disampaikan secara lengkap..."></textarea>
                            <div class="textarea-footer">
                                <span>Gunakan bahasa yang sopan dan jelas.</span>
                                <span>0/500 karakter</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Lampiran (Opsional)</label>
                            <div class="upload-area">
                                <p class="upload-text"><span>Klik untuk upload</span> atau drag & drop</p>
                                <p class="upload-subtext">Mendukung format gambar (JPG, PNG) atau dokumen (PDF). Maks 5MB.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 Card -->
                    <div class="step-card">
                        <div class="step-header">
                            <h2 class="step-title"><span class="step-number">2</span> Pilih Target Kelas</h2>
                            <div class="step-header-actions">
                                <span class="info-text">Pilih minimal satu kelas</span>
                                <label class="checkbox-label">
                                    <input type="checkbox" id="selectAll" style="display:none;" />
                                    <div class="radio-circle check-all-circle" style="border-radius: 4px; width: 16px; height: 16px;"></div>
                                    Pilih Semua
                                </label>
                            </div>
                        </div>
                        <div class="class-grid">
                            <div class="class-card active">
                                <div class="class-card-header">
                                    <div class="class-info"><div class="class-avatar avatar-blue">A1</div><div class="class-details"><h4>TK A - Matahari</h4><p>Ibu Ani</p></div></div>
                                    <div class="radio-circle"></div>
                                </div>
                            </div>
                            <div class="class-card">
                                <div class="class-card-header">
                                    <div class="class-info"><div class="class-avatar avatar-purple">A2</div><div class="class-details"><h4>TK A - Bulan</h4><p>Ibu Budi</p></div></div>
                                    <div class="radio-circle"></div>
                                </div>
                            </div>
                            <div class="class-card">
                                <div class="class-card-header">
                                    <div class="class-info"><div class="class-avatar avatar-yellow">B1</div><div class="class-details"><h4>TK B - Bintang</h4><p>Ibu Citra</p></div></div>
                                    <div class="radio-circle"></div>
                                </div>
                            </div>
                            <div class="class-card">
                                <div class="class-card-header">
                                    <div class="class-info"><div class="class-avatar avatar-pink">B2</div><div class="class-details"><h4>TK B - Pelangi</h4><p>Ibu Dina</p></div></div>
                                    <div class="radio-circle"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Action Bar -->
                    <div class="bottom-action-bar" style="position: static; margin-top: 24px;">
                        <div class="action-info">Pastikan data sudah benar sebelum mengirim.</div>
                        <div class="action-buttons">
                            <button type="button" class="btn btn-outline" id="btnBatalPengumuman">Batal</button>
                            <button type="button" class="btn btn-primary">Kirim Pengumuman</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Logic
            const modal = document.getElementById('modalPengumuman');
            const btnBuat = document.getElementById('btnBuatPengumuman');
            const btnClose = document.getElementById('btnClosePengumuman');
            const btnBatal = document.getElementById('btnBatalPengumuman');

            const openModal = () => modal.classList.add('active');
            const closeModal = () => modal.classList.remove('active');

            if(btnBuat) btnBuat.addEventListener('click', openModal);
            if(btnClose) btnClose.addEventListener('click', closeModal);
            if(btnBatal) btnBatal.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if(e.target === modal) closeModal(); });

            // Class Cards Selection Logic
            const classCards = document.querySelectorAll('.class-card');
            const selectAllCheckbox = document.getElementById('selectAll');
            const checkAllCircle = document.querySelector('.check-all-circle');

            classCards.forEach(card => {
                card.addEventListener('click', function() {
                    this.classList.toggle('active');
                    updateSelectAllState();
                });
            });

            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    const isChecked = this.checked;
                    if(isChecked) checkAllCircle.classList.add('checked');
                    else checkAllCircle.classList.remove('checked');

                    classCards.forEach(card => {
                        if (isChecked) card.classList.add('active');
                        else card.classList.remove('active');
                    });
                });
            }

            function updateSelectAllState() {
                if (!selectAllCheckbox) return;
                const totalCards = classCards.length;
                const activeCards = document.querySelectorAll('.class-card.active').length;
                
                const isAllChecked = (totalCards > 0 && totalCards === activeCards);
                selectAllCheckbox.checked = isAllChecked;
                
                if(isAllChecked) checkAllCircle.classList.add('checked');
                else checkAllCircle.classList.remove('checked');
            }
        });
    </script>
</body>
</html>
