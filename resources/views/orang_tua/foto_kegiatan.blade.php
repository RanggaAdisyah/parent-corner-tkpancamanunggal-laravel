<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Foto Kegiatan - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/foto_kegiatan.css') }}">
</head>
<body>
    <div class="dashboard-guru">
        {{-- Sidebar Orang Tua --}}
        @include('partials.sidebar_orang_tua', ['active' => 'foto-kegiatan'])

        <main class="main">



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

                @forelse($galeris as $galeri)
                @php
                    $kategoriList = is_array($galeri->kategori) ? $galeri->kategori : (json_decode($galeri->kategori, true) ?: [$galeri->kategori]);
                    $kategoriFirst = $kategoriList[0] ?? 'Lain-lain';
                    $kategoriClass = strtolower(str_replace([' ', '&'], ['-', ''], $kategoriFirst));
                    $fotos = is_array($galeri->foto) ? $galeri->foto : (json_decode($galeri->foto, true) ?: []);
                    $firstFoto = !empty($fotos) ? url('storage/' . $fotos[0]) : 'https://picsum.photos/seed/kegiatan/400/260';
                    $photoCount = count($fotos);
                @endphp
                <article class="activity-card"
                    role="button"
                    tabindex="0"
                    data-title="{{ $galeri->judul }}"
                    data-category="{{ $kategoriFirst }}"
                    data-category-class="{{ $kategoriClass }}"
                    data-date="{{ \Carbon\Carbon::parse($galeri->tanggal_kegiatan)->translatedFormat('d F Y') }}"
                    data-photo-count="{{ $photoCount }} Foto"
                    data-image="{{ $firstFoto }}"
                    data-body="{{ strip_tags(str_replace(['<br>', '</p>'], ['|||', '|||'], $galeri->deskripsi)) }}">
                    <div class="activity-card-image">
                        <img src="{{ $firstFoto }}" alt="{{ $galeri->judul }}" loading="lazy" style="object-fit: cover;">
                        <span class="activity-badge badge-{{ $kategoriClass }}">{{ $kategoriFirst }}</span>
                    </div>
                    <div class="activity-card-body">
                        <div class="activity-card-top">
                            <h3 class="activity-card-title">{{ $galeri->judul }}</h3>
                            <button type="button" class="activity-menu-btn" aria-label="Opsi" tabindex="-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="5" r="2"></circle><circle cx="12" cy="12" r="2"></circle><circle cx="12" cy="19" r="2"></circle></svg>
                            </button>
                        </div>
                        <p class="activity-card-desc">{{ \Illuminate\Support\Str::limit(strip_tags($galeri->deskripsi), 80) }}</p>
                        <footer class="activity-card-footer">
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                {{ \Carbon\Carbon::parse($galeri->tanggal_kegiatan)->translatedFormat('d F Y') }}
                            </span>
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                {{ $photoCount }} Foto
                            </span>
                        </footer>
                    </div>
                </article>
                @empty
                <div style="grid-column: 1 / -1; padding: 40px; text-align: center; color: #64748b; background: white; border-radius: 12px;">
                    Belum ada galeri kegiatan untuk saat ini.
                </div>
                @endforelse



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
