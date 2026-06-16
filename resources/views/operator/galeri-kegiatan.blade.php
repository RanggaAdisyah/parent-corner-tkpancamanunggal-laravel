<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Galeri Kegiatan - Operator Panel</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/foto-kegiatan.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/galeri-kegiatan.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <style>
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; overflow-y: auto; }
        .modal-overlay.active { display: flex; }
        .modal-content-galeri { background: white; border-radius: 12px; max-width: 800px; width: 100%; max-height: 90vh; overflow-y: auto; display: flex; flex-direction: column; }
        .btn-close-modal { background: none; border: none; font-size: 28px; cursor: pointer; color: #666; padding: 0; line-height: 1; }
        .btn-close-modal:hover { color: #000; }
        .modal-content-galeri .form-card { box-shadow: none; padding: 24px; border-radius: 0; }
    </style>
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar', ['active' => 'galeri-kegiatan'])

        <main class="main ot-main">
            <div class="galeri-top-bar">
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <span>Dashboard</span>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-active">Galeri Kegiatan</span>
                </nav>
            </div>

            <header class="galeri-header" style="align-items: center;">
                <div class="galeri-header-left">
                    <h1 class="galeri-title">Galeri Kegiatan</h1>
                    <p class="galeri-subtitle">Kelola dokumentasi aktivitas siswa di sekolah.</p>
                </div>
                <div class="galeri-filters" style="display: flex; gap: 12px;">
                    <button type="button" id="btnBuatGaleri" class="btn-add" style="border: none; cursor: pointer; background: #2563eb; color: white; padding: 10px 16px; border-radius: 8px; font-weight: 500; display: flex; align-items: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Buat Daftar Kegiatan
                    </button>
                    <select class="galeri-filter-select" aria-label="Kategori">
                        <option selected>Semua Kategori</option>
                        <option>Kunjungan</option>
                        <option>Seni & Kreativitas</option>
                        <option>Kompetisi</option>
                        <option>Olahraga</option>
                        <option>Perayaan</option>
                    </select>
                </div>
            </header>

            <section class="activity-grid">
                <article class="activity-card" role="button" tabindex="0"
                    data-title="Kunjungan Museum"
                    data-category="Kunjungan"
                    data-category-class="kunjungan"
                    data-date="12 Mei 2024"
                    data-photo-count="24 Foto"
                    data-image="https://picsum.photos/seed/museum/600/400"
                    data-body="Ananda mengunjungi Museum Nasional untuk belajar sejarah dan budaya Indonesia. Kegiatan ini membantu anak memahami warisan bangsa melalui pengalaman langsung.|||Para siswa terlihat antusias mengamati benda-benda bersejarah dan berfoto bersama di area pameran.">
                    <div class="activity-card-image">
                        <img src="https://picsum.photos/seed/museum/400/260" alt="Kunjungan Museum" loading="lazy">
                        <span class="activity-badge badge-kunjungan">Kunjungan</span>
                    </div>
                    <div class="activity-card-body">
                        <div class="activity-card-top">
                            <h3 class="activity-card-title">Kunjungan Museum</h3>
                            <button type="button" class="activity-menu-btn" aria-label="Opsi" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="12" cy="19" r="2"></circle></svg>
                            </button>
                        </div>
                        <p class="activity-card-desc">Ananda mengunjungi Museum Nasional untuk belajar sejarah dan budaya Indonesia.</p>
                        <footer class="activity-card-footer">
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                12 Mei 2024
                            </span>
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                24 Foto
                            </span>
                        </footer>
                    </div>
                </article>

                <article class="activity-card" role="button" tabindex="0"
                    data-title="Pentas Seni Akhir Tahun"
                    data-category="Seni & Kreativitas"
                    data-category-class="seni"
                    data-date="28 Juni 2024"
                    data-photo-count="36 Foto"
                    data-image="https://picsum.photos/seed/pentas/600/400"
                    data-body="Pentas seni menampilkan bakat ananda dalam bernyanyi, menari, dan drama. Acara ini dihadiri oleh orang tua dan wali kelas.|||Setiap kelompok menampilkan karya terbaik mereka dengan penuh semangat dan kebanggaan.">
                    <div class="activity-card-image">
                        <img src="https://picsum.photos/seed/pentas/400/260" alt="Pentas Seni Akhir Tahun" loading="lazy">
                        <span class="activity-badge badge-seni">Seni & Kreativitas</span>
                    </div>
                    <div class="activity-card-body">
                        <div class="activity-card-top">
                            <h3 class="activity-card-title">Pentas Seni Akhir Tahun</h3>
                            <button type="button" class="activity-menu-btn" aria-label="Opsi" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="12" cy="19" r="2"></circle></svg>
                            </button>
                        </div>
                        <p class="activity-card-desc">Pentas seni menampilkan bakat ananda dalam bernyanyi, menari, dan drama.</p>
                        <footer class="activity-card-footer">
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                28 Juni 2024
                            </span>
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                36 Foto
                            </span>
                        </footer>
                    </div>
                </article>
            </section>

            @include('partials.footer')
        </main>

        <!-- Detail Galeri Modal -->
        <div id="galeriModal" class="galeri-modal-overlay" aria-hidden="true">
            <div class="galeri-modal" role="dialog" aria-modal="true" aria-labelledby="galeriModalTitle">
                <header class="galeri-modal-header">
                    <h2 id="galeriModalTitle" class="galeri-modal-heading">Detail Galeri Kegiatan</h2>
                    <button type="button" class="galeri-modal-close" id="btnCloseGaleriDetail" aria-label="Tutup">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </header>

                <div class="galeri-modal-body">
                    <h3 id="modalGaleriTitle" class="galeri-modal-title"></h3>
                    <div class="galeri-modal-datetime">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span id="modalGaleriDate"></span>
                        <span class="galeri-modal-dot">&bull;</span>
                        <span id="modalGaleriPhotos"></span>
                    </div>
                    <div id="modalGaleriBody" class="galeri-modal-content"></div>

                    <div class="galeri-modal-lampiran">
                        <span class="galeri-lampiran-label">Lampiran</span>
                        <div class="galeri-modal-image-wrap">
                            <img id="modalGaleriImage" src="" alt="" class="galeri-modal-image">
                            <span id="modalGaleriBadge" class="galeri-modal-badge"></span>
                        </div>
                    </div>
                </div>

                <footer class="galeri-modal-footer">
                    <button type="button" class="btn-selesai" id="btnSelesaiGaleri">Tutup</button>
                </footer>
            </div>
        </div>

        <!-- Modal Buat Galeri -->
        <div id="modalBuatGaleri" class="modal-overlay">
            <div class="modal-content-galeri galeri-kegiatan">
                <div style="display: flex; justify-content: flex-end; padding: 16px 24px 0;">
                    <button class="btn-close-modal" id="btnCloseGaleriForm">&times;</button>
                </div>
                <div class="form-card" style="margin-top: 0; padding-top: 8px; box-shadow: none;">
                    <div style="margin-bottom: 24px;">
                        <h1 class="page-title" style="margin-bottom: 8px;">Unggah Foto Kegiatan</h1>
                        <p class="page-subtitle">Bagikan momen aktivitas siswa di kelas kepada orang tua murid.</p>
                    </div>

                    <div class="step-section">
                        <div class="step-header">
                            <div class="step-number">1</div>
                            <div class="step-text-wrap">
                                <h3>Pilih Kelas</h3>
                                <p>Pilih kelas tujuan untuk foto kegiatan ini.</p>
                            </div>
                        </div>

                        <div class="class-grid">
                            <div class="class-card active">
                                <div class="radio-circle"></div>
                                <div class="class-avatar avatar-orange">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" /></svg>
                                </div>
                                <h4>TK A - Matahari</h4>
                                <p>15 Siswa</p>
                            </div>

                            <div class="class-card">
                                <div class="radio-circle"></div>
                                <div class="class-avatar avatar-blue-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" /></svg>
                                </div>
                                <h4>TK B - Bulan</h4>
                                <p>18 Siswa</p>
                            </div>

                            <div class="class-card">
                                <div class="radio-circle"></div>
                                <div class="class-avatar avatar-purple">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width:24px;height:24px;"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-1.64.457l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-1.64-.457L1.583 10.387a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" /></svg>
                                </div>
                                <h4>PG - Bintang</h4>
                                <p>10 Siswa</p>
                            </div>
                        </div>
                    </div>

                    <div class="step-section">
                        <div class="step-header">
                            <div class="step-number" style="background-color: #f1f5f9; color: #64748b;">2</div>
                            <div class="step-text-wrap">
                                <h3>Unggah Foto & Keterangan</h3>
                                <p>Maksimal 10 foto per unggahan.</p>
                            </div>
                        </div>

                        <div class="upload-container">
                            <div class="upload-area">
                                <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                </svg>
                                <p class="upload-text"><span>Klik untuk unggah</span> atau seret foto</p>
                                <p class="upload-subtext">JPG, PNG, atau WEBP (Max 5MB)</p>
                            </div>

                            <div class="preview-grid">
                                <div class="preview-box preview-placeholder-1"><span class="mock-img-1">👧🏻</span></div>
                                <div class="preview-box preview-placeholder-2"><span class="mock-img-1">👦🏽</span></div>
                                <div class="preview-box preview-uploading">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                                    <span>Uploading...</span>
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 16px;">
                                <label class="form-label">Deskripsi Kegiatan</label>
                                <div id="editor-galeri" style="height: 120px; border-radius: 0 0 8px 8px;"></div>
                                <input type="hidden" name="deskripsi_kegiatan" id="deskripsiKegiatanHidden">
                            </div>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-section">
                        <div class="step-header">
                            <div class="step-number" style="background-color: #f1f5f9; color: #64748b;">3</div>
                            <div class="step-text-wrap">
                                <h3>Pilih Kategori</h3>
                                <p>Tentukan kategori untuk aktivitas ini (bisa pilih lebih dari satu).</p>
                            </div>
                        </div>

                        <div class="class-grid" style="grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));">
                            <div class="class-card category-card cat-kunjungan" style="padding: 16px 40px 16px 16px; min-height: 64px; display: flex; align-items: center;">
                                <div class="radio-circle"></div>
                                <h4 style="margin: 0; font-size: 14px; line-height: 1.4;">Kunjungan</h4>
                            </div>
                            <div class="class-card category-card cat-seni" style="padding: 16px 40px 16px 16px; min-height: 64px; display: flex; align-items: center;">
                                <div class="radio-circle"></div>
                                <h4 style="margin: 0; font-size: 14px; line-height: 1.4;">Seni & Kreativitas</h4>
                            </div>
                            <div class="class-card category-card cat-kompetisi" style="padding: 16px 40px 16px 16px; min-height: 64px; display: flex; align-items: center;">
                                <div class="radio-circle"></div>
                                <h4 style="margin: 0; font-size: 14px; line-height: 1.4;">Kompetisi</h4>
                            </div>
                            <div class="class-card category-card cat-olahraga" style="padding: 16px 40px 16px 16px; min-height: 64px; display: flex; align-items: center;">
                                <div class="radio-circle"></div>
                                <h4 style="margin: 0; font-size: 14px; line-height: 1.4;">Olahraga</h4>
                            </div>
                            <div class="class-card category-card cat-perayaan" style="padding: 16px 40px 16px 16px; min-height: 64px; display: flex; align-items: center;">
                                <div class="radio-circle"></div>
                                <h4 style="margin: 0; font-size: 14px; line-height: 1.4;">Perayaan</h4>
                            </div>
                            <div class="class-card category-card cat-lainnya" style="padding: 16px 40px 16px 16px; min-height: 64px; display: flex; align-items: center;">
                                <div class="radio-circle"></div>
                                <h4 style="margin: 0; font-size: 14px; line-height: 1.4;">Lain-lain</h4>
                            </div>
                        </div>
                    </div>

                    <div class="action-bar" style="justify-content: flex-end; gap: 12px; margin-top: 24px;">
                        <button type="button" class="btn btn-outline" id="btnBatalGaleriForm">Batal</button>
                        <button type="button" class="btn btn-primary">Unggah Foto</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const classCards = document.querySelectorAll('#modalBuatGaleri .class-card:not(.category-card)');
            classCards.forEach(card => {
                card.addEventListener('click', function() {
                    this.classList.toggle('active');
                });
            });

            const categoryCards = document.querySelectorAll('.category-card');
            categoryCards.forEach(card => {
                card.addEventListener('click', function() {
                    this.classList.toggle('active');
                });
            });

            // Modal Logic Buat Galeri
            const modalBuat = document.getElementById('modalBuatGaleri');
            const btnBuat = document.getElementById('btnBuatGaleri');
            const btnCloseBuat = document.getElementById('btnCloseGaleriForm');
            const btnBatalBuat = document.getElementById('btnBatalGaleriForm');

            const openModalBuat = () => modalBuat.classList.add('active');
            const closeModalBuat = () => modalBuat.classList.remove('active');

            if(btnBuat) btnBuat.addEventListener('click', openModalBuat);
            if(btnCloseBuat) btnCloseBuat.addEventListener('click', closeModalBuat);
            if(btnBatalBuat) btnBatalBuat.addEventListener('click', closeModalBuat);
            modalBuat.addEventListener('click', (e) => { if(e.target === modalBuat) closeModalBuat(); });

            // Modal Detail Galeri Logic
            const modalDetail = document.getElementById('galeriModal');
            const cards = document.querySelectorAll('.activity-card[data-title]');
            const btnCloseDetail = document.getElementById('btnCloseGaleriDetail');
            const btnSelesaiDetail = document.getElementById('btnSelesaiGaleri');

            const modalTitle = document.getElementById('modalGaleriTitle');
            const modalDate = document.getElementById('modalGaleriDate');
            const modalPhotos = document.getElementById('modalGaleriPhotos');
            const modalBody = document.getElementById('modalGaleriBody');
            const modalImage = document.getElementById('modalGaleriImage');
            const modalBadge = document.getElementById('modalGaleriBadge');

            const badgeClassMap = {
                kunjungan: 'badge-kunjungan',
                seni: 'badge-seni',
                kompetisi: 'badge-kompetisi',
                olahraga: 'badge-olahraga',
                perayaan: 'badge-perayaan',
            };

            const openModalDetail = (card) => {
                modalTitle.textContent = card.dataset.title || '';
                modalDate.textContent = card.dataset.date || '';
                modalPhotos.textContent = card.dataset.photoCount || '';
                modalImage.src = card.dataset.image || '';
                modalImage.alt = card.dataset.title || '';

                const paragraphs = (card.dataset.body || '').split('|||').filter(Boolean);
                modalBody.innerHTML = paragraphs.map(p => `<p>${p}</p>`).join('');

                const categoryClass = badgeClassMap[card.dataset.categoryClass] || 'badge-kunjungan';
                modalBadge.className = 'galeri-modal-badge activity-badge ' + categoryClass;
                modalBadge.textContent = card.dataset.category || '';

                modalDetail.classList.add('active');
                modalDetail.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const closeModalDetail = () => {
                modalDetail.classList.remove('active');
                modalDetail.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            cards.forEach(card => {
                card.addEventListener('click', (e) => {
                    if (e.target.closest('.activity-menu-btn')) return;
                    openModalDetail(card);
                });
                card.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        openModalDetail(card);
                    }
                });
            });

            if(btnCloseDetail) btnCloseDetail.addEventListener('click', closeModalDetail);
            if(btnSelesaiDetail) btnSelesaiDetail.addEventListener('click', closeModalDetail);

            modalDetail.addEventListener('click', (e) => {
                if (e.target === modalDetail) closeModalDetail();
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modalDetail.classList.contains('active')) closeModalDetail();
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quillGaleri = new Quill('#editor-galeri', {
                theme: 'snow',
                placeholder: 'Contoh: Kegiatan melukis bersama tema alam semesta...'
            });
            
            // Simpan data Quill ke hidden input saat ada perubahan
            quillGaleri.on('text-change', function() {
                var hiddenInput = document.getElementById('deskripsiKegiatanHidden');
                if(hiddenInput) hiddenInput.value = quillGaleri.root.innerHTML;
            });
        });
    </script>
</body>
</html>
