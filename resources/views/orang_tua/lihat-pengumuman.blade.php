<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Lihat Pengumuman - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/pengumuman.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar-orang-tua', ['active' => 'pengumuman'])

        <main class="main ot-main">

            {{-- Top Header Bar --}}
            <header class="pengumuman-header">
                <h1 class="pengumuman-title">Pengumuman Sekolah</h1>
                <div class="pengumuman-header-right">
                    <div class="search-wrapper">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" class="search-input" placeholder="Cari pengumuman...">
                    </div>
                    <button class="header-icon-btn" aria-label="Toggle Dark Mode">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                    </button>
                    <button class="header-icon-btn header-icon-btn-notif" aria-label="Notifikasi">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        <span class="notif-dot" aria-hidden="true"></span>
                    </button>
                </div>
            </header>

            {{-- Featured Banner --}}
            <section class="pengumuman-banner">
                <div class="pengumuman-banner-content">
                    <h2 class="pengumuman-banner-title">Informasi &amp; Berita Terbaru</h2>
                    <p class="pengumuman-banner-desc">
                        Tetap update dengan kegiatan sekolah, jadwal libur, dan informasi penting
                        lainnya untuk putra-putri Anda di TK Panca Manunggal.
                    </p>
                </div>
                <div class="pengumuman-banner-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                </div>
            </section>

            {{-- Announcement List --}}
            <section class="announcement-list">

                {{-- Card 1: Text with Link --}}
                <article class="announcement-card"
                    role="button"
                    tabindex="0"
                    data-title="Pemberitahuan Libur Nasional"
                    data-datetime="25 Oktober 2023 • 08:00 WIB"
                    data-body="Berdasarkan surat edaran pemerintah, sekolah akan diliburkan pada hari Jumat, 27 Oktober 2023. Kegiatan belajar mengajar akan kembali normal pada hari Senin. Mohon orang tua menyesuaikan jadwal penjemputan.|||Demikian informasi ini kami sampaikan. Atas perhatian dan kerjasamanya kami ucapkan terima kasih."
                    data-attachment-name="Surat_Edaran_Libur.pdf"
                    data-attachment-size="245 KB">
                    <time class="announcement-time" datetime="2023-10-25T08:00">25 Oktober 2023 &bull; 08:00 WIB</time>
                    <h3 class="announcement-title">Pemberitahuan Libur Nasional</h3>
                    <p class="announcement-body">
                        Diberitahukan kepada seluruh wali murid bahwa sekolah akan diliburkan pada
                        tanggal 1 November 2023 dalam rangka Hari Buruh Internasional. Kegiatan belajar
                        mengajar akan dilanjutkan kembali pada tanggal 2 November 2023.
                    </p>
                    <span class="announcement-link">
                        Baca selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </span>
                </article>

                {{-- Card 2: Text with Attachment --}}
                <article class="announcement-card"
                    role="button"
                    tabindex="0"
                    data-title="Field Trip ke Kebun Binatang"
                    data-datetime="20 Oktober 2023 • 10:30 WIB"
                    data-body="Kami mengundang seluruh siswa TK Panca Manunggal untuk mengikuti kegiatan field trip edukatif ke Kebun Binatang Ragunan pada tanggal 5 November 2023.|||Mohon melengkapi surat izin dan mempersiapkan perlengkapan sesuai ketentuan yang tercantum dalam lampiran. Anak diharapkan membawa topi, botol minum, dan bekal ringan."
                    data-attachment-name="Surat_Izin.pdf"
                    data-attachment-size="312 KB">
                    <time class="announcement-time" datetime="2023-10-20T10:30">20 Oktober 2023 &bull; 10:30 WIB</time>
                    <h3 class="announcement-title">Field Trip ke Kebun Binatang</h3>
                    <p class="announcement-body">
                        Kami mengundang seluruh siswa TK Panca Manunggal untuk mengikuti kegiatan
                        field trip edukatif ke Kebun Binatang Ragunan pada tanggal 5 November 2023.
                        Mohon melengkapi surat izin dan mempersiapkan perlengkapan sesuai ketentuan.
                    </p>
                    <span class="announcement-attachment">
                        <span class="attachment-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        </span>
                        <span class="attachment-name">Surat_Izin.pdf</span>
                    </span>
                </article>

                {{-- Card 3: Text with Image Gallery --}}
                <article class="announcement-card"
                    role="button"
                    tabindex="0"
                    data-title="Menu Makan Siang Bulan November"
                    data-datetime="15 Oktober 2023 • 09:00 WIB"
                    data-body="Berikut kami sampaikan menu makan siang catering untuk bulan November 2023. Menu dirancang seimbang gizi untuk mendukung tumbuh kembang anak usia dini.|||Silakan hubungi pihak sekolah jika ada alergi makanan tertentu agar dapat disesuaikan dengan kebutuhan anak."
                    data-has-gallery="true">
                    <time class="announcement-time" datetime="2023-10-15T09:00">15 Oktober 2023 &bull; 09:00 WIB</time>
                    <h3 class="announcement-title">Menu Makan Siang Bulan November</h3>
                    <p class="announcement-body">
                        Berikut kami sampaikan menu makan siang catering untuk bulan November 2023.
                        Menu dirancang seimbang gizi untuk mendukung tumbuh kembang anak usia dini.
                        Silakan hubungi pihak sekolah jika ada alergi makanan tertentu.
                    </p>
                    <div class="announcement-gallery">
                        <div class="gallery-thumb gallery-thumb-broccoli" role="img" aria-label="Foto menu brokoli"></div>
                        <div class="gallery-thumb gallery-thumb-milk" role="img" aria-label="Foto menu susu"></div>
                        <div class="gallery-thumb gallery-thumb-more">
                            <span>+2 Foto</span>
                        </div>
                    </div>
                </article>

            </section>


            @include('partials.footer')
        </main>
    </div>

    {{-- Detail Pengumuman Modal --}}
    <div id="detailModal" class="detail-modal-overlay" aria-hidden="true">
        <div class="detail-modal" role="dialog" aria-modal="true" aria-labelledby="detailModalTitle">
            <header class="detail-modal-header">
                <h2 id="detailModalTitle" class="detail-modal-heading">Detail Pengumuman</h2>
                <button type="button" class="detail-modal-close" id="btnCloseModal" aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </header>

            <div class="detail-modal-body">
                <h3 id="modalTitle" class="detail-title"></h3>
                <div class="detail-datetime">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span id="modalDatetime"></span>
                </div>
                <div id="modalBody" class="detail-content"></div>

                <div id="modalAttachmentSection" class="detail-attachment-section" hidden>
                    <span class="detail-attachment-label">Lampiran</span>
                    <div class="detail-attachment-card">
                        <span class="detail-attachment-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        </span>
                        <div class="detail-attachment-info">
                            <span id="modalAttachmentName" class="detail-attachment-name"></span>
                            <span id="modalAttachmentSize" class="detail-attachment-size"></span>
                        </div>
                        <button type="button" class="detail-attachment-download" aria-label="Unduh lampiran">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        </button>
                    </div>
                </div>

                <div id="modalGallerySection" class="detail-gallery-section" hidden>
                    <span class="detail-attachment-label">Foto</span>
                    <div class="detail-gallery">
                        <div class="gallery-thumb gallery-thumb-broccoli" role="img" aria-label="Foto menu brokoli"></div>
                        <div class="gallery-thumb gallery-thumb-milk" role="img" aria-label="Foto menu susu"></div>
                        <div class="gallery-thumb gallery-thumb-more"><span>+2 Foto</span></div>
                    </div>
                </div>
            </div>

            <footer class="detail-modal-footer">
                <button type="button" class="btn-selesai" id="btnSelesai">Selesai Membaca</button>
            </footer>
        </div>
    </div>

    <script>
        (function () {
            const modal = document.getElementById('detailModal');
            const cards = document.querySelectorAll('.announcement-card[data-title]');
            const btnClose = document.getElementById('btnCloseModal');
            const btnSelesai = document.getElementById('btnSelesai');

            const modalTitle = document.getElementById('modalTitle');
            const modalDatetime = document.getElementById('modalDatetime');
            const modalBody = document.getElementById('modalBody');
            const modalAttachmentSection = document.getElementById('modalAttachmentSection');
            const modalAttachmentName = document.getElementById('modalAttachmentName');
            const modalAttachmentSize = document.getElementById('modalAttachmentSize');
            const modalGallerySection = document.getElementById('modalGallerySection');

            const openModal = (card) => {
                modalTitle.textContent = card.dataset.title || '';
                modalDatetime.textContent = card.dataset.datetime || '';

                const paragraphs = (card.dataset.body || '').split('|||').filter(Boolean);
                modalBody.innerHTML = paragraphs.map(p => `<p>${p}</p>`).join('');

                if (card.dataset.attachmentName) {
                    modalAttachmentSection.hidden = false;
                    modalAttachmentName.textContent = card.dataset.attachmentName;
                    modalAttachmentSize.textContent = card.dataset.attachmentSize || '';
                } else {
                    modalAttachmentSection.hidden = true;
                }

                modalGallerySection.hidden = card.dataset.hasGallery !== 'true';

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
                card.addEventListener('click', () => openModal(card));
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
