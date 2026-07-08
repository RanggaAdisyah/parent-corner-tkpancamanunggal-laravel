<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>Edit Pengumuman - Dashboard Guru</title>
    <link rel="stylesheet" href="{{ url('/css/global.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/guru/daftar_pengumuman.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/dashboard_master.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style/Operator/buat_pengumuman.css') }}">
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
    </style>
</head>
<body>
    <div class="dashboard-guru buat-pengumuman">
        @include('partials.sidebar_guru', ['active' => 'pengumuman'])

        <main class="main">
            <header class="page-header" style="flex-direction: column; align-items: flex-start; gap: 16px;">
                <a href="{{ route('guru.daftar-pengumuman') }}" class="page-back" style="display:inline-flex; align-items:center; gap:8px; color:#64748b; font-size:14px; text-decoration:none; font-weight:500;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    Kembali
                </a>
                <div class="header-left">
                    <h1 class="header-title">Edit Pengumuman</h1>
                    <p class="header-subtitle">Ubah informasi pengumuman yang sudah ada.</p>
                </div>
            </header>

            <div class="responsive-container">
                <form id="formPengumuman" method="POST" action="{{ route('guru.pengumuman.update', $pengumuman->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="remove_file" id="removeFileInput" value="0">
                    
                    <div class="form-layout">
                        <!-- Form Detail -->
                        <div>
                            <h2 style="font-size: 16px; font-weight: 700; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                                <div style="width: 28px; height: 28px; background: #0ea5e9; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px;">1</div>
                                Detail Pengumuman
                            </h2>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Judul Pengumuman <span style="color:#ef4444">*</span></label>
                                <input type="text" name="judul" class="form-input" style="width:100%; padding:12px; border:1px solid #e2e8f0; border-radius:8px; background:#f8fafc;" placeholder="Contoh: Kegiatan Outbound Semester 1" required value="{{ old('judul', $pengumuman->judul) }}" />
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Isi Pesan <span style="color:#ef4444">*</span></label>
                                <div id="editor-pengumuman" style="background:#fff; min-height: 200px;">{!! old('isi_pengumuman', $pengumuman->isi_pesan) !!}</div>
                                <input type="hidden" name="isi_pengumuman" id="isiPesanHidden">
                            </div>

                            <div class="form-group">
                                <label class="form-label" style="display:block; margin-bottom:8px; font-weight:600; font-size:14px;">Lampiran (Opsional)</label>
                                <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click()" style="border: 2px dashed #cbd5e1; border-radius: 12px; padding: 24px; text-align: center; cursor: pointer; background: #f8fafc;">
                                    <p style="margin:0; font-size:14px; color:#64748b;">Klik untuk upload gambar atau dokumen PDF (Maks 5MB)</p>
                                </div>
                                <input type="file" id="fileInput" name="lampiran" style="display:none;" accept=".jpg,.jpeg,.png,.webp">
                                
                                <div id="fileNameDisplay" style="margin-top: 8px; font-size: 13px; color: #64748b; display:flex; flex-direction:column; gap:4px;">
                                    @if(!empty($pengumuman->lampiran) && is_array($pengumuman->lampiran))
                                        @foreach($pengumuman->lampiran as $lampiran)
                                            <div class="existing-file" style="display:flex; align-items:flex-start; gap:8px; padding:8px 12px; background:#f1f5f9; border-radius:6px;">
                                                <span style="flex-grow:1; color:#111827; word-break: break-all; display:flex; align-items:flex-start; gap:6px;">
                                                    <span style="flex-shrink:0; margin-top:2px;">📎</span> 
                                                    <span>{{ basename($lampiran) }}</span>
                                                </span>
                                                <button type="button" class="btnRemoveExisting" style="color:#ef4444; background:none; border:none; cursor:pointer; font-size:12px; font-weight:700; padding:4px; flex-shrink:0; white-space:nowrap;">✕ Hapus</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:16px; margin-top:40px; padding-top:24px; border-top:1px solid #e2e8f0;">
                        <a href="{{ route('guru.daftar-pengumuman') }}" style="padding:10px 24px; border-radius:8px; font-weight:600; font-size:14px; color:#111827; text-decoration:none; background:#f1f5f9;">Batal</a>
                        <button type="submit" style="padding:10px 24px; border-radius:8px; font-weight:600; font-size:14px; color:#fff; background:#3b82f6; border:none; cursor:pointer;">Simpan Perubahan</button>
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

            const btnRemoveExisting = document.querySelector('.btnRemoveExisting');
            if (btnRemoveExisting) {
                btnRemoveExisting.addEventListener('click', function() {
                    this.parentElement.remove();
                    document.getElementById('removeFileInput').value = '1';
                });
            }

            // File upload display logic
            const fileInput = document.getElementById('fileInput');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            let dataTransfer = new DataTransfer();
            
            fileInput.addEventListener('change', function() {
                document.getElementById('removeFileInput').value = '1';
                // Remove existing file display if a new one is selected
                document.querySelectorAll('.existing-file').forEach(el => el.remove());

                Array.from(this.files).forEach(file => {
                    const maxSizeInBytes = 5 * 1024 * 1024; // 5MB
                    if (file.size > maxSizeInBytes) {
                        alert(`Gagal: Ukuran file "${file.name}" terlalu besar! Maksimal upload adalah 5MB.`);
                    } else {
                        dataTransfer = new DataTransfer(); // Allow only 1 file
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
                        <span style="flex-grow:1; color:#111827; word-break: break-all; display:flex; align-items:flex-start; gap:6px;">
                            <span style="flex-shrink:0; margin-top:2px;">📎</span> 
                            <span>${file.name}</span>
                        </span>
                        <button type="button" class="btnRemoveFile" data-index="${index}" style="color:#ef4444; background:none; border:none; cursor:pointer; font-size:12px; font-weight:700; padding:4px; flex-shrink:0; white-space:nowrap;">✕ Hapus</button>
                    `;
                    fileNameDisplay.appendChild(fileItem);
                });

                document.querySelectorAll('.btnRemoveFile').forEach(btn => {
                    btn.addEventListener('click', function() {
                        dataTransfer = new DataTransfer();
                        fileInput.files = dataTransfer.files;
                        renderFileList();
                    });
                });
            }

        });
    </script>
</body>
</html>
