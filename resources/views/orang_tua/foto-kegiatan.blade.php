<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Foto Kegiatan - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/foto-kegiatan.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar-orang-tua', ['active' => 'foto-kegiatan'])

        <main class="main">

            {{-- Top Bar --}}
            <div class="galeri-top-bar">
                <nav class="breadcrumb" aria-label="Breadcrumb">
                    <span>Dashboard</span>
                    <span class="breadcrumb-sep">/</span>
                    <span class="breadcrumb-active">Galeri Foto</span>
                </nav>
                <div class="galeri-top-actions">
                    <button class="header-icon-btn" aria-label="Notifikasi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </button>
                    <button class="header-icon-btn" aria-label="Toggle Dark Mode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                    </button>
                </div>
            </div>

            {{-- Page Header --}}
            <header class="galeri-header">
                <div class="galeri-header-left">
                    <h1 class="galeri-title">Galeri Kegiatan</h1>
                    <p class="galeri-subtitle">Dokumentasi aktivitas ananda di sekolah.</p>
                </div>
                <div class="galeri-filters">
                    <select class="galeri-filter-select" aria-label="Tahun Ajaran">
                        <option selected>2023 / 2024</option>
                        <option>2022 / 2023</option>
                    </select>
                    <select class="galeri-filter-select" aria-label="Kategori">
                        <option selected>Semua Kategori</option>
                        <option>Kunjungan</option>
                        <option>Seni &amp; Kreativitas</option>
                        <option>Kompetisi</option>
                        <option>Olahraga</option>
                        <option>Perayaan</option>
                    </select>
                </div>
            </header>

            {{-- Activity Grid --}}
            <section class="activity-grid">

                {{-- Card 1 --}}
                <article class="activity-card"
                    role="button"
                    tabindex="0"
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

                {{-- Card 2 --}}
                <article class="activity-card"
                    role="button"
                    tabindex="0"
                    data-title="Pentas Seni Akhir Tahun"
                    data-category="Seni &amp; Kreativitas"
                    data-category-class="seni"
                    data-date="28 Juni 2024"
                    data-photo-count="36 Foto"
                    data-image="https://picsum.photos/seed/pentas/600/400"
                    data-body="Pentas seni akhir tahun menampilkan bakat ananda dalam bernyanyi, menari, dan drama. Acara ini dihadiri oleh orang tua dan wali kelas.|||Setiap kelompok menampilkan karya terbaik mereka dengan penuh semangat dan kebanggaan.">
                    <div class="activity-card-image">
                        <img src="https://picsum.photos/seed/pentas/400/260" alt="Pentas Seni Akhir Tahun" loading="lazy">
                        <span class="activity-badge badge-seni">Seni &amp; Kreativitas</span>
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

                {{-- Card 3 --}}
                <article class="activity-card"
                    role="button"
                    tabindex="0"
                    data-title="Lomba Mewarnai"
                    data-category="Kompetisi"
                    data-category-class="kompetisi"
                    data-date="05 April 2024"
                    data-photo-count="12 Foto"
                    data-image="https://picsum.photos/seed/mewarnai/600/400"
                    data-body="Keseruan Lomba mewarnai tingkat kecamatan yang diikuti oleh ananda. Anak-anak menunjukkan kreativitas dan ketelitian dalam mengisi warna pada gambar yang telah disediakan.|||Kegiatan ini melatih motorik halus dan menumbuhkan rasa percaya diri anak dalam berkompetisi secara sehat.">
                    <div class="activity-card-image">
                        <img src="https://picsum.photos/seed/mewarnai/400/260" alt="Lomba Mewarnai" loading="lazy">
                        <span class="activity-badge badge-kompetisi">Kompetisi</span>
                    </div>
                    <div class="activity-card-body">
                        <div class="activity-card-top">
                            <h3 class="activity-card-title">Lomba Mewarnai</h3>
                            <button type="button" class="activity-menu-btn" aria-label="Opsi" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="12" cy="19" r="2"></circle></svg>
                            </button>
                        </div>
                        <p class="activity-card-desc">Keseruan lomba mewarnai tingkat kecamatan yang diikuti oleh ananda.</p>
                        <footer class="activity-card-footer">
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                05 April 2024
                            </span>
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                12 Foto
                            </span>
                        </footer>
                    </div>
                </article>

                {{-- Card 4 --}}
                <article class="activity-card"
                    role="button"
                    tabindex="0"
                    data-title="Belajar Berenang"
                    data-category="Olahraga"
                    data-category-class="olahraga"
                    data-date="18 Maret 2024"
                    data-photo-count="18 Foto"
                    data-image="https://picsum.photos/seed/renang/600/400"
                    data-body="Ananda belajar teknik dasar berenang di kolam renang sekolah bersama instruktur profesional. Kegiatan ini melatih kepercayaan diri anak di dalam air.|||Para siswa terlihat antusias dan gembira saat berlatih mengapung dan bergerak di air dengan pengawasan guru.">
                    <div class="activity-card-image">
                        <img src="https://picsum.photos/seed/renang/400/260" alt="Belajar Berenang" loading="lazy">
                        <span class="activity-badge badge-olahraga">Olahraga</span>
                    </div>
                    <div class="activity-card-body">
                        <div class="activity-card-top">
                            <h3 class="activity-card-title">Belajar Berenang</h3>
                            <button type="button" class="activity-menu-btn" aria-label="Opsi" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="12" cy="19" r="2"></circle></svg>
                            </button>
                        </div>
                        <p class="activity-card-desc">Ananda belajar teknik dasar berenang di kolam renang sekolah bersama instruktur.</p>
                        <footer class="activity-card-footer">
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                18 Maret 2024
                            </span>
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                18 Foto
                            </span>
                        </footer>
                    </div>
                </article>

                {{-- Card 5 --}}
                <article class="activity-card"
                    role="button"
                    tabindex="0"
                    data-title="Perayaan Hari Kartini"
                    data-category="Perayaan"
                    data-category-class="perayaan"
                    data-date="21 April 2024"
                    data-photo-count="30 Foto"
                    data-image="https://picsum.photos/seed/kartini/600/400"
                    data-body="Perayaan Hari Kartini dengan tema kebanggaan akan budaya Indonesia. Ananda mengenakan pakaian adat dari berbagai daerah.|||Kegiatan ini menanamkan rasa cinta tanah air dan menghargai perjuangan Ibu Kartini bagi kemajuan pendidikan.">
                    <div class="activity-card-image">
                        <img src="https://picsum.photos/seed/kartini/400/260" alt="Perayaan Hari Kartini" loading="lazy">
                        <span class="activity-badge badge-perayaan">Perayaan</span>
                    </div>
                    <div class="activity-card-body">
                        <div class="activity-card-top">
                            <h3 class="activity-card-title">Perayaan Hari Kartini</h3>
                            <button type="button" class="activity-menu-btn" aria-label="Opsi" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="12" cy="19" r="2"></circle></svg>
                            </button>
                        </div>
                        <p class="activity-card-desc">Perayaan Hari Kartini dengan tema kebanggaan akan budaya Indonesia.</p>
                        <footer class="activity-card-footer">
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                21 April 2024
                            </span>
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                30 Foto
                            </span>
                        </footer>
                    </div>
                </article>



            </section>


            @include('partials.footer')
        </main>
    </div>

    {{-- Detail Galeri Modal --}}
    <div id="galeriModal" class="galeri-modal-overlay" aria-hidden="true">
        <div class="galeri-modal" role="dialog" aria-modal="true" aria-labelledby="galeriModalTitle">
            <header class="galeri-modal-header">
                <h2 id="galeriModalTitle" class="galeri-modal-heading">Detail Galeri Kegiatan</h2>
                <button type="button" class="galeri-modal-close" id="btnCloseGaleri" aria-label="Tutup">
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
                <button type="button" class="btn-selesai" id="btnSelesaiGaleri">Selesai Membaca</button>
            </footer>
        </div>
    </div>

    <script>
        (function () {
            const modal = document.getElementById('galeriModal');
            const cards = document.querySelectorAll('.activity-card[data-title]');
            const btnClose = document.getElementById('btnCloseGaleri');
            const btnSelesai = document.getElementById('btnSelesaiGaleri');

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

            const openModal = (card) => {
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

                modal.classList.add('active');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            };

            const closeModal = () => {
                modal.classList.remove('active');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            };

            cards.forEach(card => {
                card.addEventListener('click', (e) => {
                    if (e.target.closest('.activity-menu-btn')) return;
                    openModal(card);
                });
                card.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        openModal(card);
                    }
                });
            });

            btnClose.addEventListener('click', closeModal);
            btnSelesai.addEventListener('click', closeModal);

            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('active')) closeModal();
            });
        })();
    </script>
</body>
</html>
