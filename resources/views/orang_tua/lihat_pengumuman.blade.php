<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Lihat Pengumuman - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/pengumuman.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar_orang_tua', ['active' => 'pengumuman'])

        <main class="main">

            {{-- Top Header Bar --}}
            <header class="pengumuman-header">
                <h1 class="pengumuman-title">Pengumuman Sekolah</h1>
                <div class="pengumuman-header-right">
                    <div class="search-wrapper">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" class="search-input" placeholder="Cari pengumuman...">
                    </div>
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

            </section>

            {{-- Announcement List --}}
            <section class="announcement-list">

                @forelse($pengumumans as $p)
                <article class="announcement-card"
                    role="button"
                    tabindex="0"
                    data-title="{{ $p->judul }}"
                    data-datetime="{{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d F Y • H:i') }} WIB"
                    data-body="{{ strip_tags(str_replace(['<br>', '</p>'], ['|||', '|||'], $p->isi_pesan)) }}"
                    data-attachment-name="{{ is_array($p->lampiran) && count($p->lampiran) > 0 ? basename($p->lampiran[0]) : (is_string($p->lampiran) ? basename($p->lampiran) : '') }}"
                    data-attachment-url="{{ is_array($p->lampiran) && count($p->lampiran) > 0 ? asset($p->lampiran[0]) : (is_string($p->lampiran) ? asset($p->lampiran) : '') }}"
                    data-has-gallery="false">
                    <time class="announcement-time" datetime="{{ \Carbon\Carbon::parse($p->created_at)->toIso8601String() }}">{{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d F Y • H:i') }} WIB</time>
                    <h3 class="announcement-title">{{ $p->judul }}</h3>
                    <p class="announcement-body">
                        {{ \Illuminate\Support\Str::limit(strip_tags($p->isi_pesan), 150) }}
                    </p>
                    <span class="announcement-link">
                        Baca selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </span>
                </article>
                @empty
                <div style="padding: 40px; text-align: center; color: #64748b; background: white; border-radius: 12px;">
                    Belum ada pengumuman terbaru untuk kelas anak Anda.
                </div>
                @endforelse

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
                        <a href="#" id="modalAttachmentDownload" class="detail-attachment-download" aria-label="Unduh lampiran" download>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        </a>
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

            // Logika Pencarian (Filter)
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const keyword = e.target.value.toLowerCase();
                    cards.forEach(card => {
                        const title = (card.dataset.title || '').toLowerCase();
                        const body = (card.dataset.body || '').toLowerCase();
                        if (title.includes(keyword) || body.includes(keyword)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

            const openModal = (card) => {
                modalTitle.textContent = card.dataset.title || '';
                modalDatetime.textContent = card.dataset.datetime || '';

                const paragraphs = (card.dataset.body || '').split('|||').filter(Boolean);
                modalBody.innerHTML = paragraphs.map(p => `<p>${p}</p>`).join('');

                if (card.dataset.attachmentName) {
                    modalAttachmentSection.hidden = false;
                    modalAttachmentName.textContent = card.dataset.attachmentName;
                    modalAttachmentSize.textContent = card.dataset.attachmentSize || '';
                    document.getElementById('modalAttachmentDownload').href = card.dataset.attachmentUrl || '#';
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
