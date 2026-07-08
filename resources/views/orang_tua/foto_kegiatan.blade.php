<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Foto Kegiatan - Dashboard Orang Tua</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/galeri_master.css') }}">
    <style>
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; overflow-y: auto; }
        .modal-overlay.active { display: flex; }
        .galeri-modal { background: white; border-radius: 12px; max-width: 800px; width: 100%; max-height: 90vh; overflow-y: auto; display: flex; flex-direction: column; }
    </style>
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar_orang_tua', ['active' => 'foto-kegiatan'])

        <main class="main ot-main">

            <header class="galeri-header" style="align-items: center;">
                <div class="galeri-header-left">
                    <h1 class="galeri-title">Galeri Kegiatan</h1>
                    <p class="galeri-subtitle">Dokumentasi aktivitas ananda di sekolah.</p>
                </div>
                <div class="galeri-filters" style="display: flex; gap: 12px;">
                    <div class="search-wrapper" style="position: relative; display: flex; align-items: center;">
                        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position: absolute; left: 12px; color: #94a3b8;"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" id="search-galeri" class="search-input" placeholder="Cari kegiatan..." style="padding: 10px 16px 10px 36px; border: 1px solid #e2e8f0; border-radius: 8px; width: 250px; outline: none; font-size: 14px;">
                    </div>
                    
                    <select id="filter-kategori" style="padding: 8px 12px; border: 1px solid #e2e8f0; border-radius: 8px; outline: none; font-size: 14px; background: white; cursor: pointer; min-width: 130px; appearance: auto;">
                        <option value="">Semua Kategori</option>
                        <option value="Kunjungan">Kunjungan</option>
                        <option value="Seni & Kreativitas">Seni & Kreativitas</option>
                        <option value="Kompetisi">Kompetisi</option>
                        <option value="Olahraga">Olahraga</option>
                        <option value="Perayaan">Perayaan</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
            </header>

            <section class="activity-grid">
                @foreach($galeris as $galeri)
                @php
                    // Display only the first photo if it exists
                    $firstPhoto = (!empty($galeri->foto) && is_array($galeri->foto)) ? $galeri->foto[0] : null;
                    if (!$firstPhoto && is_string($galeri->foto)) {
                        $fotoArr = json_decode($galeri->foto, true);
                        if (is_array($fotoArr) && count($fotoArr) > 0) $firstPhoto = $fotoArr[0];
                    }
                    $photoCount = is_array($galeri->foto) ? count($galeri->foto) : (is_string($galeri->foto) ? count(json_decode($galeri->foto, true) ?? []) : 0);
                    
                    // Display only the first category as the main badge if it exists
                    $firstCat = (!empty($galeri->kategori) && is_array($galeri->kategori)) ? $galeri->kategori[0] : 'Umum';
                    if (is_string($galeri->kategori) && $galeri->kategori !== '') {
                        $catArr = json_decode($galeri->kategori, true);
                        if (is_array($catArr) && count($catArr) > 0) $firstCat = $catArr[0];
                    }
                    
                    // Simple logic to set badge color based on category text
                    $badgeClass = 'badge-kunjungan'; // default
                    if (str_contains(strtolower($firstCat), 'seni')) $badgeClass = 'badge-seni';
                    elseif (str_contains(strtolower($firstCat), 'kompetisi')) $badgeClass = 'badge-kompetisi';
                    elseif (str_contains(strtolower($firstCat), 'olahraga')) $badgeClass = 'badge-olahraga';
                    elseif (str_contains(strtolower($firstCat), 'perayaan')) $badgeClass = 'badge-perayaan';
                @endphp
                <article class="activity-card" role="button" tabindex="0"
                    data-title="{{ $galeri->judul }}"
                    data-categories="{{ !empty($galeri->kategori) && is_array($galeri->kategori) ? implode(',', $galeri->kategori) : 'Umum' }}"
                    data-category="{{ $firstCat }}"
                    data-category-class="{{ $badgeClass }}"
                    data-date="{{ $galeri->tanggal_kegiatan ? \Carbon\Carbon::parse($galeri->tanggal_kegiatan)->translatedFormat('d F Y') : ($galeri->created_at ? $galeri->created_at->translatedFormat('d F Y') : '-') }}"
                    data-photo-count="{{ $photoCount }} Foto"
                    data-images="{{ json_encode(is_array($galeri->foto) ? array_map('asset', $galeri->foto) : (is_string($galeri->foto) ? array_map('asset', json_decode($galeri->foto, true) ?? []) : [])) }}"
                    data-body="{{ htmlspecialchars($galeri->deskripsi ?? '') }}">
                    
                    <div class="activity-card-image">
                        <img src="{{ $firstPhoto ? asset($firstPhoto) : 'https://placehold.co/400x260/e2e8f0/64748b?text=No+Image' }}" alt="{{ $galeri->judul }}" loading="lazy">
                        <span class="activity-badge {{ $badgeClass }}">{{ $firstCat }}</span>
                    </div>
                    
                    <div class="activity-card-body">
                        <div class="activity-card-top">
                            <h3 class="activity-card-title">{{ $galeri->judul }}</h3>
                        </div>
                        <p class="activity-card-desc">{{ strip_tags($galeri->deskripsi) }}</p>
                        <footer class="activity-card-footer">
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                {{ $galeri->tanggal_kegiatan ? \Carbon\Carbon::parse($galeri->tanggal_kegiatan)->translatedFormat('d M Y') : ($galeri->created_at ? $galeri->created_at->translatedFormat('d M Y') : '-') }}
                            </span>
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                                {{ $photoCount }} Foto
                            </span>
                        </footer>
                    </div>
                </article>
                @endforeach
            </section>
            
            @if($galeris->isEmpty())
                <div style="grid-column: 1 / -1; padding: 40px; text-align: center; color: #64748b; background: white; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 24px;">
                    <h3 style="color: #64748b; font-size: 16px;">Belum ada Galeri Kegiatan</h3>
                    <p style="color: #94a3b8; font-size: 14px; margin-top: 8px;">Tidak ada foto kegiatan yang diunggah untuk kelas anak Anda.</p>
                </div>
            @endif

            @include('partials.footer')
        </main>

        <!-- Detail Galeri Modal (Preview Only) -->
        <div id="galeriModal" class="modal-overlay" aria-hidden="true">
            <div class="galeri-modal" role="dialog" aria-modal="true" aria-labelledby="galeriModalTitle">
                <header class="galeri-modal-header" style="display:flex; justify-content:space-between; align-items:center; padding:16px 24px; border-bottom:1px solid #e2e8f0;">
                    <h2 id="galeriModalTitle" class="galeri-modal-heading" style="margin:0; font-size:18px;">Detail Galeri Kegiatan</h2>
                    <button type="button" class="btn-close-modal" id="btnCloseGaleriDetail" aria-label="Tutup" style="background:none; border:none; font-size:24px; cursor:pointer;">&times;</button>
                </header>

                <div class="galeri-modal-body" style="padding:24px;">
                    <h3 id="modalGaleriTitle" class="galeri-modal-title" style="margin-top:0; margin-bottom:12px; font-size:20px;"></h3>
                    <div class="galeri-modal-datetime" style="display:flex; gap:8px; color:#64748b; font-size:14px; align-items:center; margin-bottom:16px;">
                        <span id="modalGaleriDate"></span> &bull; <span id="modalGaleriPhotos"></span>
                    </div>
                    <div id="modalGaleriBody" class="galeri-modal-content" style="line-height:1.6; color:#334155; margin-bottom:24px;"></div>

                    <div class="galeri-modal-lampiran">
                        <div class="galeri-modal-image-wrap" style="background:#f8fafc; border:1px solid #e2e8f0; position:relative;">
                            <img id="modalGaleriImage" class="galeri-modal-image" src="" alt="" style="border-radius:8px; aspect-ratio:auto; max-height:500px; object-fit:contain; width:100%;">
                            <a id="btnDownloadFoto" href="#" download class="btn-download-foto" style="position:absolute; top:16px; right:16px; background:rgba(255,255,255,0.9); color:#3b82f6; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; display:flex; align-items:center; gap:6px; box-shadow:0 2px 4px rgba(0,0,0,0.1); transition:0.2s; z-index:10;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                Unduh Foto
                            </a>
                            <span id="modalGaleriBadge" class="galeri-modal-badge activity-badge" style="position:absolute; bottom:16px; left:16px; z-index:10;"></span>
                        </div>
                        <div id="modalGaleriThumbnails" style="display:flex; gap:8px; margin-top:12px; overflow-x:auto; padding-bottom:8px;"></div>
                    </div>
                </div>

                <footer class="galeri-modal-footer" style="padding:16px 24px; border-top:1px solid #e2e8f0; display:flex; justify-content:flex-end;">
                    <button type="button" class="btn-selesai" id="btnSelesaiGaleri" style="padding:10px 20px; background:#ef4444; color:#fff; font-weight:600; border:none; border-radius:6px; cursor:pointer;">Tutup</button>
                </footer>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
            const btnDownloadFoto = document.getElementById('btnDownloadFoto');

            const openModalDetail = (card) => {
                modalTitle.textContent = card.dataset.title || '';
                modalDate.textContent = card.dataset.date || '';
                modalPhotos.textContent = card.dataset.photoCount || '';
                modalImage.alt = card.dataset.title || '';

                const images = JSON.parse(card.dataset.images || '[]');
                const thumbnailsContainer = document.getElementById('modalGaleriThumbnails');
                thumbnailsContainer.innerHTML = '';
                
                if (images.length > 0) {
                    modalImage.src = images[0];
                    btnDownloadFoto.href = images[0];
                    btnDownloadFoto.style.display = 'flex';
                    if (images.length > 1) {
                        images.forEach((imgSrc, idx) => {
                            const thumb = document.createElement('img');
                            thumb.src = imgSrc;
                            thumb.style.cssText = 'width:60px; height:60px; object-fit:cover; border-radius:6px; cursor:pointer; opacity:0.6; transition:0.2s; border:2px solid transparent; flex-shrink:0; background:#f1f5f9;';
                            if (idx === 0) {
                                thumb.style.opacity = '1';
                                thumb.style.borderColor = '#0ea5e9';
                            }
                            thumb.addEventListener('click', () => {
                                modalImage.src = imgSrc;
                                btnDownloadFoto.href = imgSrc;
                                Array.from(thumbnailsContainer.children).forEach(c => {
                                    c.style.opacity = '0.6';
                                    c.style.borderColor = 'transparent';
                                });
                                thumb.style.opacity = '1';
                                thumb.style.borderColor = '#0ea5e9';
                            });
                            thumbnailsContainer.appendChild(thumb);
                        });
                    }
                } else {
                    modalImage.src = 'https://placehold.co/600x400/e2e8f0/64748b?text=Tidak+Ada+Foto';
                    btnDownloadFoto.style.display = 'none';
                }

                // Render HTML directly instead of raw text, replace newlines/etc if needed
                let bodyHtml = card.dataset.body || '';
                const txt = document.createElement("textarea");
                txt.innerHTML = bodyHtml;
                modalBody.innerHTML = txt.value;

                modalBadge.className = 'galeri-modal-badge activity-badge ' + (card.dataset.categoryClass || 'badge-kunjungan');
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
                card.addEventListener('click', () => {
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

            // Search Logic
            const searchInput = document.getElementById('search-galeri');
            const filterKategori = document.getElementById('filter-kategori');
            
            const filterGaleri = () => {
                const query = searchInput ? searchInput.value.toLowerCase() : '';
                const kategori = filterKategori ? filterKategori.value.toLowerCase() : '';
                
                cards.forEach(card => {
                    const title = (card.dataset.title || '').toLowerCase();
                    const cardKategories = (card.dataset.categories || '').toLowerCase();
                    
                    const matchTitle = title.includes(query);
                    const matchKategori = kategori === '' || cardKategories.includes(kategori);
                    
                    if (matchTitle && matchKategori) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            };
            
            if (searchInput) {
                searchInput.addEventListener('input', filterGaleri);
            }
            if (filterKategori) {
                filterKategori.addEventListener('change', filterGaleri);
            }
        });
    </script>
</body>
</html>
