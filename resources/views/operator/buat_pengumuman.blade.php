<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Buat Pengumuman - Operator Panel</title>
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
        .class-grid-responsive {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
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
    </style>
</head>
<body>
    <div class="dashboard-guru buat-pengumuman">
        @include('partials.sidebar', ['active' => 'pengumuman'])

        <main class="main">
            <header class="page-header" style="flex-direction: column; align-items: flex-start; gap: 16px;">
                <a href="{{ route('operator.pengumuman') }}" class="page-back" style="display:inline-flex; align-items:center; gap:8px; color:#64748b; font-size:14px; text-decoration:none; font-weight:500;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Kembali
                </a>
                <div class="header-left">
                    <h1 class="header-title">Buat Pengumuman Baru</h1>
                    <p class="header-subtitle">Buat dan sebarkan informasi penting kepada orang tua murid dengan mudah.</p>
                </div>
            </header>

            <div class="responsive-container">
                <form id="formPengumuman" method="POST" action="{{ route('operator.pengumuman.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-layout">
                        <!-- Kolom Kiri: Form Detail -->
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">1</div>
                                Detail Pengumuman
                            </h2>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Judul Pengumuman <span style="color:#ef4444">*</span></label>
                                <input type="text" name="judul" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Contoh: Kegiatan Outbound Semester 1" required value="{{ old('judul') }}" />
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Isi Pesan <span style="color:#ef4444">*</span></label>
                                <div id="editor-pengumuman" style="background:#fff; min-height: 200px;"></div>
                                <input type="hidden" name="isi_pesan" id="isiPesanHidden">
                            </div>

                            <div class="form-group">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Lampiran (Opsional)</label>
                                <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click()" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 24px; text-align: center; cursor: pointer; background: #f8fafc;">
                                    <p style="margin:0; font-size:14px; color:#64748b;">Klik untuk upload gambar atau dokumen PDF (Maks 50MB)</p>
                                </div>
                                <input type="file" id="fileInput" name="lampiran[]" multiple style="display:none;" accept=".jpg,.jpeg,.png,.pdf">
                                <div id="fileNameDisplay" style="margin-top: 8px; font-size: 13px; color: #64748b; display:flex; flex-direction:column; gap:4px;"></div>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Target Kelas -->
                        <div>
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
                                <h2 style="font-size: 16px; font-weight: 700; margin: 0; display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">2</div>
                                    Target Kelas
                                </h2>
                                <label style="display:flex; align-items:center; gap:8px; cursor:pointer; font-size:14px; font-weight:600; background:#f1f5f9; padding:6px 12px; border-radius:6px;" id="labelPilihSemua">
                                    <div class="radio-circle check-all-circle" style="width:16px; height:16px; border:1px solid #cbd5e1; border-radius:4px; display:flex; justify-content:center; align-items:center;" id="checkAllCircle"></div>
                                    Pilih Semua
                                </label>
                            </div>
                            
                            
                            <div class="class-grid-responsive">
                                @foreach($kelasList as $kelas)
                                <label class="class-card" style="border:1px solid #e2e8f0; border-radius:12px; padding:16px; cursor:pointer; display:flex; align-items:center; justify-content:space-between; background:#fff; transition:0.2s;">
                                    <input type="checkbox" name="target_kelas[]" value="{{ $kelas->id }}" style="display:none;" class="kelas-checkbox">
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        <div style="width:40px; height:40px; border-radius:50%; background:#e0f2fe; color:#0284c7; display:flex; align-items:center; justify-content:center; font-weight:600; font-size:14px;">
                                            {{ strtoupper(substr($kelas->nama_kelas, 0, 2)) }}
                                        </div>
                                        <div>
                                            <h4 style="margin:0 0 4px; font-size:14px; font-weight:700;">{{ $kelas->tingkat }}</h4>
                                            <p style="margin:0; font-size:12px; color:#64748b;">{{ $kelas->nama_kelas }}</p>
                                        </div>
                                    </div>
                                    <div class="radio-circle kelas-indicator" style="width:20px; height:20px; border:1px solid #cbd5e1; border-radius:50%; display:flex; justify-content:center; align-items:center;"></div>
                                </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:16px; margin-top:40px; padding-top:24px; border-top:1px solid #e2e8f0;">
                        <a href="{{ route('operator.pengumuman') }}" style="padding:10px 24px; border-radius:8px; font-weight:600; font-size:14px; color:#111827; text-decoration:none; background:#f1f5f9;">Batal</a>
                        <button type="submit" style="padding:10px 24px; border-radius:8px; font-weight:600; font-size:14px; color:#fff; background:#3b82f6; border:none; cursor:pointer;">Kirim Pengumuman</button>
                    </div>
                </form>
            </div>

            @include('partials.footer')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Quill
            const quill = new Quill('#editor-pengumuman', {
                theme: 'snow',
                placeholder: 'Tuliskan detail pengumuman yang ingin disampaikan secara lengkap...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ['link'],
                        ['clean']
                    ]
                }
            });

            document.getElementById('formPengumuman').addEventListener('submit', () => {
                document.getElementById('isiPesanHidden').value = quill.root.innerHTML;
            });

            // File upload display & remove logic
            const fileInput = document.getElementById('fileInput');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            let dataTransfer = new DataTransfer();
            
            fileInput.addEventListener('change', function() {
                // Add new files to dataTransfer with validation
                Array.from(this.files).forEach(file => {
                    const maxSizeInBytes = 50 * 1024 * 1024; // 50MB
                    if (file.size > maxSizeInBytes) {
                        alert(`Gagal: Ukuran file "${file.name}" terlalu besar! Maksimal upload adalah 50MB.`);
                    } else {
                        dataTransfer.items.add(file);
                    }
                });
                // Update input files
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
                            <span style="flex-shrink:0; font-size:16px;">📎</span> 
                            <span>${file.name}</span>
                        </span>
                        <div style="display:flex; align-items:center; gap:4px;">
                            <button type="button" class="btnRemoveFile" data-index="${index}" style="color:#ef4444; background:none; border:none; cursor:pointer; font-size:12px; font-weight:700; padding:4px; flex-shrink:0; white-space:nowrap;">✕ Batal</button>
                        </div>
                    `;
                    fileNameDisplay.appendChild(fileItem);
                });

                // Attach remove event listeners
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

            // Class card selection
            const classCards = document.querySelectorAll('.class-card');
            const checkAllCircle = document.getElementById('checkAllCircle');

            classCards.forEach(card => {
                card.addEventListener('click', function() {
                    const cb = this.querySelector('.kelas-checkbox');
                    cb.checked = !cb.checked;
                    const indicator = this.querySelector('.kelas-indicator');
                    this.classList.toggle('active', cb.checked);
                    indicator.classList.toggle('checked', cb.checked);
                    updateSelectAllState();
                });
            });

            document.getElementById('labelPilihSemua').addEventListener('click', function() {
                const isAllActive = document.querySelectorAll('.class-card.active').length === classCards.length;
                classCards.forEach(card => {
                    const cb = card.querySelector('.kelas-checkbox');
                    const indicator = card.querySelector('.kelas-indicator');
                    cb.checked = !isAllActive;
                    card.classList.toggle('active', !isAllActive);
                    indicator.classList.toggle('checked', !isAllActive);
                });
                updateSelectAllState();
            });

            function updateSelectAllState() {
                const total = classCards.length;
                const active = document.querySelectorAll('.class-card.active').length;
                checkAllCircle.classList.toggle('checked', total > 0 && total === active);
            }
        });
    </script>
</body>
</html>
