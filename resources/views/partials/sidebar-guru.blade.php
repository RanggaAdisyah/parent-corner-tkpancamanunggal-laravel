<aside class="aside" id="mainSidebar" aria-label="Sidebar navigasi">
    <div class="horizontal-border">
        <div class="overlay" aria-hidden="true">
            <img class="icon" src="{{ asset('img/icon-6.svg') }}" alt="" />
        </div>

        <div class="div-wrapper">
            <div class="div">
                <div class="div-2">
                    <div class="text">TK Panca<br />Manunggal</div>
                </div>
                <div class="div-2">
                    <div class="text-wrapper">Parent Corner &amp; Staff</div>
                </div>
            </div>
        </div>

        <div class="div-wrapper toggle-wrapper" style="margin-left: auto; padding-left: 0;">
            <button type="button" id="toggleButton" class="sidebar-toggle" aria-label="Toggle Sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>

    <nav class="nav" aria-label="Navigasi utama">
        <a href="{{ url('/guru/dashboard') }}" class="{{ isset($active) && $active == 'dashboard' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'dashboard' ? 'aria-current="page"' : '' }} title="Dashboard">
            <div class="div">
                <img class="img" src="{{ asset('icon/guru/dashboard.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'dashboard' ? 'text-2' : 'text-3' }}">Dashboard</div>
            </div>
        </a>

        <div class="container">
            <div class="text-wrapper-2">AKADEMIK</div>
        </div>

        <a href="{{ url('/guru/kehadiran') }}" class="{{ isset($active) && $active == 'input-kehadiran' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'input-kehadiran' ? 'aria-current="page"' : '' }} title="Input Kehadiran">
            <div class="div">
                <img class="icon-2" src="{{ asset('icon/guru/kehadiran.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'input-kehadiran' ? 'text-2' : 'text-wrapper-3' }}">Input Kehadiran</div>
            </div>
        </a>

        <a href="{{ url('/guru/nilai') }}" class="{{ isset($active) && $active == 'input-nilai' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'input-nilai' ? 'aria-current="page"' : '' }} title="Input Nilai">
            <div class="div">
                <img class="icon-2" src="{{ asset('icon/guru/nilai.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'input-nilai' ? 'text-2' : 'text-wrapper-3' }}">Input Nilai</div>
            </div>
        </a>

        <a href="{{ url('/guru/lihat-jadwal') }}" class="{{ isset($active) && $active == 'lihat-jadwal' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'lihat-jadwal' ? 'aria-current="page"' : '' }} title="Lihat Jadwal">
            <div class="div">
                <img class="icon-3" src="{{ asset('icon\guru\jadwal.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'lihat-jadwal' ? 'text-2' : 'text-3' }}">Lihat Jadwal</div>
            </div>
        </a>

        <div class="container">
            <div class="text-wrapper-2">KOMUNIKASI</div>
        </div>

        <a href="{{ url('/guru/unggah-foto') }}" class="{{ isset($active) && $active == 'unggah-foto' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'unggah-foto' ? 'aria-current="page"' : '' }} title="Unggah Foto">
            <div class="div">
                <img class="icon-5" src="{{ asset('icon\guru\foto.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'unggah-foto' ? 'text-2' : 'text-5' }}">Unggah Foto</div>
            </div>
        </a>

        <a href="{{ url('/guru/daftar-pengumuman') }}" class="{{ isset($active) && $active == 'buat-pengumuman' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'buat-pengumuman' ? 'aria-current="page"' : '' }} title="Buat Pengumuman">
            <div class="div">
                <img class="icon-4" src="{{ asset('icon\guru\pengumuman.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'buat-pengumuman' ? 'text-2' : 'text-4' }}">Buat Pengumuman</div>
            </div>
        </a>
    </nav>

    <div class="container-wrapper">
        <div class="container-2">
            <div class="admin-profile" role="img" aria-label="Foto profil Guru"></div>

            <div class="margin">
                <div class="div-2">
                    <div class="div-2">
                        <div class="text-wrapper-4">Ibu Siti Aminah</div>
                    </div>
                    <div class="div-2">
                        <div class="text-wrapper-5">Guru Kelas A</div>
                    </div>
                </div>
            </div>

            <div class="div-wrapper">
                <button class="button" type="button" aria-label="Opsi akun guru">
                    <div class="icon-wrapper">
                        <img class="icon-6" src="{{ asset('img/image.svg') }}" alt="" />
                    </div>
                </button>
            </div>
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('mainSidebar');
        const toggleBtn = document.getElementById('toggleButton');

        const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
        if (isCollapsed) {
            sidebar.classList.add('collapsed');
        }

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        });
    });
</script>

