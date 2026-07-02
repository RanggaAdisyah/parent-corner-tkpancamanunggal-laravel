<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Daftar Pengumuman - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/daftar_pengumuman.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/buat_pengumuman.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
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
        @include('partials.sidebar_guru', ['active' => 'buat-pengumuman'])

        <main class="main">
            <header class="page-header">
                <div class="header-left">
                    <h1 class="header-title">Daftar Pengumuman</h1>
                    <p class="header-subtitle">Kelola dan lihat semua pengumuman yang telah Anda bagikan.</p>
                </div>
                <a href="{{ route('guru.pengumuman') }}" class="btn-add" style="border: none; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; background-color: #3b82f6; color: white; padding: 10px 20px; border-radius: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Buat Pengumuman Baru
                </a>
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
                        @forelse($pengumumans as $p)
                        <tr>
                            <td>
                                <span class="announcement-title">{{ $p->judul }}</span>
                                <span class="announcement-preview">{!! Str::limit(strip_tags($p->isi_pengumuman), 50) !!}</span>
                            </td>
                            <td><span class="date-text">{{ $p->created_at->format('d M Y, H:i') }}</span></td>
                            <td>
                                <div class="action-buttons">
                                    <form action="{{ route('guru.pengumuman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align:center;">Belum ada pengumuman</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $pengumumans->links('pagination::default') }}
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
                            <h2 class="step-title">Isi Detail Pengumuman</h2>
                            <span class="badge-wajib">Wajib Diisi</span>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Judul Pengumuman <span class="required-asterisk">*</span></label>
                            <div class="input-wrapper">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 7 4 4 20 4 20 7"></polyline><line x1="9" y1="20" x2="15" y2="20"></line><line x1="12" y1="4" x2="12" y2="20"></line></svg>
                                </span>
                                <input type="text" class="form-input" placeholder="Contoh: Kegiatan Outbound Semester 1" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Isi Pesan <span class="required-asterisk">*</span></label>
                            <div id="editor-pengumuman" style="height: 150px; border-radius: 0 0 8px 8px;"></div>
                            <input type="hidden" name="isi_pesan" id="isiPesanHidden">
                            <div class="textarea-footer" style="margin-top: 8px;">
                                <span>Gunakan bahasa yang sopan dan jelas.</span>
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

            if(btnBuat) {
                btnBuat.addEventListener('click', function() {
                    document.querySelector('#modalPengumuman .page-title').textContent = 'Buat Pengumuman Baru';
                    document.querySelector('#modalPengumuman .btn-primary').textContent = 'Kirim Pengumuman';
                    document.querySelector('#modalPengumuman .form-input').value = '';
                    if(window.quillEditor) window.quillEditor.root.innerHTML = '';
                    openModal();
                });
            }
            if(btnClose) btnClose.addEventListener('click', closeModal);
            if(btnBatal) btnBatal.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => { if(e.target === modal) closeModal(); });


        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.quillEditor = new Quill('#editor-pengumuman', {
                theme: 'snow',
                placeholder: 'Tuliskan detail pengumuman yang ingin disampaikan secara lengkap...'
            });
            
            // Simpan data Quill ke hidden input saat ada perubahan
            window.quillEditor.on('text-change', function() {
                document.getElementById('isiPesanHidden').value = window.quillEditor.root.innerHTML;
            });

            // Global Edit Function
            window.openEditModal = function(btn) {
                const row = btn.closest('tr');
                const title = row.querySelector('.announcement-title').textContent;
                const preview = row.querySelector('.announcement-preview').textContent;
                
                document.querySelector('#modalPengumuman .page-title').textContent = 'Edit Pengumuman';
                document.querySelector('#modalPengumuman .btn-primary').textContent = 'Simpan Perubahan';
                document.querySelector('#modalPengumuman .form-input').value = title;
                window.quillEditor.root.innerHTML = preview;
                
                document.getElementById('modalPengumuman').classList.add('active');
            };
        });
    </script>
</body>
</html>
