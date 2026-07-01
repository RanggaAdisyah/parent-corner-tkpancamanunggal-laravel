<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Galeri Kegiatan - Operator Panel</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/orang_tua/foto_kegiatan.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/galeri_kegiatan.css') }}">
    <style>
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; padding: 20px; overflow-y: auto; }
        .modal-overlay.active { display: flex; }
        .galeri-modal { background: white; border-radius: 12px; max-width: 800px; width: 100%; max-height: 90vh; overflow-y: auto; display: flex; flex-direction: column; }
    </style>
</head>
<body>
    <div class="dashboard-guru">
        @include('partials.sidebar', ['active' => 'galeri-kegiatan'])

        <main class="main ot-main">

            @if(session('success'))
                <div style="background-color: #dcfce7; color: #166534; padding: 16px; border-radius: 8px; margin-bottom: 24px; font-weight: 500;">
                    {{ session('success') }}
                </div>
            @endif

            <header class="galeri-header" style="align-items: center;">
                <div class="galeri-header-left">
                    <h1 class="galeri-title">Galeri Kegiatan</h1>
                    <p class="galeri-subtitle">Kelola dokumentasi aktivitas siswa di sekolah.</p>
                </div>
                <div class="galeri-filters" style="display: flex; gap: 12px;">
                    <a href="{{ route('operator.galeri.buat') }}" class="btn-add" style="text-decoration: none; border: none; cursor: pointer; background: #2563eb; color: white; padding: 10px 16px; border-radius: 8px; font-weight: 500; display: flex; align-items: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Buat Daftar Galeri
                    </a>
                </div>
            </header>

            <section class="activity-grid">
                @foreach($galeris as $galeri)
                @php
                    // Display only the first photo if it exists
                    $firstPhoto = (!empty($galeri->foto) && is_array($galeri->foto)) ? $galeri->foto[0] : null;
                    $photoCount = is_array($galeri->foto) ? count($galeri->foto) : 0;
                    
                    // Display only the first category as the main badge if it exists
                    $firstCat = (!empty($galeri->kategori) && is_array($galeri->kategori)) ? $galeri->kategori[0] : 'Umum';
                    
                    // Simple logic to set badge color based on category text
                    $badgeClass = 'badge-kunjungan'; // default
                    if (str_contains(strtolower($firstCat), 'seni')) $badgeClass = 'badge-seni';
                    elseif (str_contains(strtolower($firstCat), 'kompetisi')) $badgeClass = 'badge-kompetisi';
                    elseif (str_contains(strtolower($firstCat), 'olahraga')) $badgeClass = 'badge-olahraga';
                    elseif (str_contains(strtolower($firstCat), 'perayaan')) $badgeClass = 'badge-perayaan';
                @endphp
                <article class="activity-card" role="button" tabindex="0"
                    data-title="{{ $galeri->judul }}"
                    data-category="{{ $firstCat }}"
                    data-category-class="{{ $badgeClass }}"
                    data-date="{{ $galeri->tanggal_kegiatan ? \Carbon\Carbon::parse($galeri->tanggal_kegiatan)->translatedFormat('d F Y') : '-' }}"
                    data-photo-count="{{ $photoCount }} Foto"
                    data-images="{{ json_encode(is_array($galeri->foto) ? array_map('asset', $galeri->foto) : []) }}"
                    data-body="{{ htmlspecialchars($galeri->deskripsi ?? '') }}">
                    
                    <div class="activity-card-image">
                        <img src="{{ $firstPhoto ? asset($firstPhoto) : 'https://placehold.co/400x260/e2e8f0/64748b?text=No+Image' }}" alt="{{ $galeri->judul }}" loading="lazy">
                        <span class="activity-badge {{ $badgeClass }}">{{ $firstCat }}</span>
                    </div>
                    
                    <div class="activity-card-body">
                        <div class="activity-card-top">
                            <h3 class="activity-card-title">{{ $galeri->judul }}</h3>
                            <div style="display: flex; gap: 4px;">
                                <a href="{{ route('operator.galeri.edit', $galeri->id) }}" class="activity-menu-btn" aria-label="Edit" title="Edit" tabindex="-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                </a>
                                <form action="{{ route('operator.galeri.destroy', $galeri->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="activity-menu-btn" aria-label="Hapus" title="Hapus" tabindex="-1" style="color: #ef4444; background:transparent; border:none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p class="activity-card-desc">{{ strip_tags($galeri->deskripsi) }}</p>
                        <footer class="activity-card-footer">
                            <span class="activity-meta">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                {{ $galeri->tanggal_kegiatan ? \Carbon\Carbon::parse($galeri->tanggal_kegiatan)->translatedFormat('d M Y') : '-' }}
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
                <div style="text-align: center; padding: 60px 20px; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 24px;">
                    <h3 style="color: #64748b; font-size: 16px;">Belum ada Galeri Kegiatan</h3>
                    <p style="color: #94a3b8; font-size: 14px; margin-top: 8px;">Silakan buat daftar galeri baru untuk menampilkan aktivitas di sini.</p>
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
                        <div class="galeri-modal-image-wrap" style="background:#f8fafc; border:1px solid #e2e8f0;">
                            <img id="modalGaleriImage" class="galeri-modal-image" src="" alt="" style="border-radius:8px; aspect-ratio:auto; max-height:500px; object-fit:contain; width:100%;">
                            <span id="modalGaleriBadge" class="galeri-modal-badge activity-badge"></span>
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
                }

                // Render HTML directly instead of raw text, replace newlines/etc if needed
                // Using innerHTML since deskripsi uses Quill
                // Note: decoding HTML entities back to HTML
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
</body>
</html>
