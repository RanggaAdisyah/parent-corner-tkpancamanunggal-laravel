<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Buat Galeri - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/pengumuman_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <style>
        .buat-pengumuman-page {
            max-width: 860px;
            margin: 0 auto;
            padding: 32px 24px 48px;
        }
        .page-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 24px;
            text-decoration: none;
            transition: color 0.15s;
        }
        .page-back:hover { color: #3b82f6; }
        .page-back svg { flex-shrink: 0; }
        
        .form-layout {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }
        .responsive-container {
            padding: 32px;
            background: #ffffff;
            margin: 24px 32px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .responsive-container {
                padding: 20px;
                margin: 16px;
            }
            .page-header {
                padding: 16px 20px !important;
            }
        }
        
        /* Category grid */
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
        }
        .category-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fff;
            transition: 0.2s;
        }
        .category-card:has(input:checked) {
            border-color: #0ea5e9;
            background: #f0f9ff;
        }
    </style>
</head>
<body>
    <div class="dashboard-guru buat-pengumuman">
        @include('partials.sidebar_guru', ['active' => 'galeri-kegiatan'])

        <main class="main">
            <header class="page-header" style="flex-direction: column; align-items: flex-start; gap: 16px;">
                <a href="{{ route('guru.galeri') }}" class="page-back" style="display:inline-flex; align-items:center; gap:8px; color:#64748b; font-size:14px; text-decoration:none; font-weight:500;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Kembali
                </a>
                <div class="header-left">
                    <h1 class="header-title">Buat Galeri Baru</h1>
                    <p class="header-subtitle">Bagikan momen aktivitas siswa kepada orang tua murid dengan mudah.</p>
                </div>
            </header>

            <div class="responsive-container">
                <form id="formGaleri" method="POST" action="{{ route('guru.galeri.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cover_image" id="coverImageInput">
                    
                    <div class="form-layout">
                        <!-- Detail -->
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">1</div>
                                Detail Galeri
                            </h2>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Judul Kegiatan <span style="color:#ef4444">*</span></label>
                                <input type="text" name="judul" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Contoh: Kunjungan Museum" required value="{{ old('judul') }}" />
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Tanggal Kegiatan</label>
                                <input type="date" name="tanggal_kegiatan" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" value="{{ old('tanggal_kegiatan') }}" />
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Deskripsi Kegiatan</label>
                                <div id="editor-galeri" style="background:#fff; min-height: 150px;"></div>
                                <input type="hidden" name="deskripsi_kegiatan" id="deskripsiKegiatanHidden">
                            </div>

                            <div class="form-group">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Unggah Foto <span style="color:#ef4444">*</span></label>
                                <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click()" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 24px; text-align: center; cursor: pointer; background: #f8fafc;">
                                    <p style="margin:0; font-size:14px; color:#64748b;">Klik untuk upload gambar (JPG/PNG/WEBP Maks 5MB)</p>
                                </div>
                                <input type="file" id="fileInput" name="foto[]" multiple style="display:none;" accept=".jpg,.jpeg,.png,.webp" required>
                                <div id="fileNameDisplay" style="margin-top: 8px; font-size: 13px; color: #64748b; display:flex; flex-direction:column; gap:4px;"></div>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <div style="margin-bottom: 24px;">
                                <h2 style="font-size: 16px; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">2</div>
                                    Pilih Kategori
                                </h2>
                            </div>
                            <div class="category-grid">
                                <label class="category-card" style="border:1px solid #e2e8f0; border-radius:12px; padding:16px; cursor:pointer; display:flex; align-items:center; gap:12px; background:#fff; transition:0.2s;">
                                    <input type="radio" name="kategori[]" value="Kunjungan" style="width:18px; height:18px; cursor:pointer; accent-color:#0ea5e9;">
                                    <h4 style="margin: 0; font-size: 14px;">Kunjungan</h4>
                                </label>
                                <label class="category-card" style="border:1px solid #e2e8f0; border-radius:12px; padding:16px; cursor:pointer; display:flex; align-items:center; gap:12px; background:#fff; transition:0.2s;">
                                    <input type="radio" name="kategori[]" value="Seni & Kreativitas" style="width:18px; height:18px; cursor:pointer; accent-color:#0ea5e9;">
                                    <h4 style="margin: 0; font-size: 14px;">Seni & Kreativitas</h4>
                                </label>
                                <label class="category-card" style="border:1px solid #e2e8f0; border-radius:12px; padding:16px; cursor:pointer; display:flex; align-items:center; gap:12px; background:#fff; transition:0.2s;">
                                    <input type="radio" name="kategori[]" value="Kompetisi" style="width:18px; height:18px; cursor:pointer; accent-color:#0ea5e9;">
                                    <h4 style="margin: 0; font-size: 14px;">Kompetisi</h4>
                                </label>
                                <label class="category-card" style="border:1px solid #e2e8f0; border-radius:12px; padding:16px; cursor:pointer; display:flex; align-items:center; gap:12px; background:#fff; transition:0.2s;">
                                    <input type="radio" name="kategori[]" value="Olahraga" style="width:18px; height:18px; cursor:pointer; accent-color:#0ea5e9;">
                                    <h4 style="margin: 0; font-size: 14px;">Olahraga</h4>
                                </label>
                                <label class="category-card" style="border:1px solid #e2e8f0; border-radius:12px; padding:16px; cursor:pointer; display:flex; align-items:center; gap:12px; background:#fff; transition:0.2s;">
                                    <input type="radio" name="kategori[]" value="Perayaan" style="width:18px; height:18px; cursor:pointer; accent-color:#0ea5e9;">
                                    <h4 style="margin: 0; font-size: 14px;">Perayaan</h4>
                                </label>
                                <label class="category-card" style="border:1px solid #e2e8f0; border-radius:12px; padding:16px; cursor:pointer; display:flex; align-items:center; gap:12px; background:#fff; transition:0.2s;">
                                    <input type="radio" name="kategori[]" value="Lain-lain" style="width:18px; height:18px; cursor:pointer; accent-color:#0ea5e9;" checked>
                                    <h4 style="margin: 0; font-size: 14px;">Lain-lain</h4>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:16px; margin-top:40px; padding-top:24px; border-top:1px solid #e2e8f0;">
                        <a href="{{ route('guru.galeri') }}" style="padding:10px 24px; border-radius:8px; font-weight:600; font-size:14px; color:#111827; text-decoration:none; background:#f1f5f9;">Batal</a>
                        <button type="submit" style="padding:10px 24px; border-radius:8px; font-weight:600; font-size:14px; color:#fff; background:#3b82f6; border:none; cursor:pointer;">Unggah Galeri</button>
                    </div>
                </form>
            </div>

            @include('partials.footer')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quill
            const quill = new Quill('#editor-galeri', {
                theme: 'snow',
                placeholder: 'Tuliskan detail atau deskripsi dari galeri kegiatan ini...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['clean']
                    ]
                }
            });

            document.getElementById('formGaleri').addEventListener('submit', () => {
                document.getElementById('deskripsiKegiatanHidden').value = quill.root.innerHTML;
            });

            // File upload logic
            const fileInput = document.getElementById('fileInput');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            let dataTransfer = new DataTransfer();
            
            fileInput.addEventListener('change', function() {
                Array.from(this.files).forEach(file => {
                    const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
                    if (file.size > maxSizeInBytes) {
                        alert(`Gagal: Ukuran file "${file.name}" terlalu besar! Maksimal upload adalah 5MB.`);
                    } else {
                        dataTransfer.items.add(file);
                    }
                });
                fileInput.files = dataTransfer.files;
                renderFileList();
            });

            function renderFileList() {
                fileNameDisplay.innerHTML = '';
                Array.from(dataTransfer.files).forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.style.cssText = 'display:flex; align-items:flex-start; gap:8px; padding:8px 12px; background:#f1f5f9; border-radius:6px;';
                    
                    fileItem.innerHTML = `
                        <span style="flex-grow:1; color:#111827; word-break: break-all; display:flex; align-items:center; gap:6px;">
                            <span style="flex-shrink:0; font-size:16px;">📷</span> 
                            <span>${file.name}</span>
                        </span>
                        <div style="display:flex; align-items:center; gap:4px;">
                            <button type="button" class="btnSetCover" data-cover="new:${file.name}" style="color:#64748b; background:none; border:none; cursor:pointer; font-size:12px; font-weight:600; padding:4px;">☆ Jadikan Sampul</button>
                            <button type="button" class="btnRemoveFile" data-index="${index}" style="color:#ef4444; background:none; border:none; cursor:pointer; font-size:12px; font-weight:700; padding:4px; flex-shrink:0; white-space:nowrap;">✕ Batal</button>
                        </div>
                    `;
                    fileNameDisplay.appendChild(fileItem);
                });
                bindCoverButtons();

                document.querySelectorAll('.btnRemoveFile').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const indexToRemove = parseInt(this.getAttribute('data-index'));
                        const newDataTransfer = new DataTransfer();
                        Array.from(dataTransfer.files).forEach((f, i) => {
                            if (i !== indexToRemove) newDataTransfer.items.add(f);
                        });
                        dataTransfer = newDataTransfer;
                        fileInput.files = dataTransfer.files;
                        renderFileList();
                    });
                });
            }

            function bindCoverButtons() {
                const coverInput = document.getElementById('coverImageInput');
                document.querySelectorAll('.btnSetCover').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const val = this.getAttribute('data-cover');
                        coverInput.value = val;
                        
                        // Reset all buttons
                        document.querySelectorAll('.btnSetCover').forEach(b => {
                            b.textContent = '☆ Jadikan Sampul';
                            b.style.color = '#64748b';
                            b.parentElement.parentElement.style.border = 'none';
                        });
                        
                        // Highlight selected
                        this.textContent = '★ Sampul';
                        this.style.color = '#eab308'; // yellow
                        this.parentElement.parentElement.style.border = '2px solid #eab308';
                    });
                });
            }
        });
    </script>
</body>
</html>
