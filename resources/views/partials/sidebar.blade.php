<style>
    /* Transisi untuk animasi ciut */
    .aside {
        transition: width 0.3s ease;
    }
    
    /* State Collapsed (Desktop & Mobile) */
    .aside.collapsed,
    @media (max-width: 991px) {
        .aside {
            width: 80px !important;
            min-width: 80px !important;
            flex: none !important;
        }
    }
    
    /* Sembunyikan elemen teks saat collapsed atau di layar mobile */
    .aside.collapsed .text,
    .aside.collapsed .text-wrapper,
    .aside.collapsed .text-2,
    .aside.collapsed .text-3,
    .aside.collapsed .text-4,
    .aside.collapsed .text-5,
    .aside.collapsed .text-wrapper-2,
    .aside.collapsed .text-wrapper-3,
    .aside.collapsed .text-wrapper-4,
    .aside.collapsed .text-wrapper-5,
    .aside.collapsed .margin,
    .aside.collapsed .container {
        display: none !important;
    }
    
    .aside.collapsed .div-wrapper.toggle-wrapper {
        margin: 0 auto !important;
    }

    @media (max-width: 991px) {
        #mainSidebar {
            position: fixed !important;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
            top: auto !important;
            width: 100vw !important;
            max-width: none !important;
            height: 60px !important;
            z-index: 9999 !important;
            display: flex !important;
            flex-direction: row !important;
            border-right: none !important;
            border-top: 1px solid #e2e8f0 !important;
            background: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.05) !important;
            transform: none !important;
        }

        #mainSidebar > *:not(.nav) {
            display: none !important;
        }

        #mainSidebar .nav {
            position: static !important;
            display: flex !important;
            flex-direction: row !important;
            width: 100% !important;
            max-width: 100% !important;
            justify-content: space-around !important;
            align-items: center !important;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 16px !important;
            gap: 0 !important;
            transform: none !important;
        }
        
        #mainSidebar .nav a {
            position: static !important;
            display: flex !important;
            flex-direction: row !important;
            justify-content: center !important;
            align-items: center !important;
            flex: 1 !important;
            width: auto !important;
            height: 100% !important;
            padding: 8px !important;
            margin: 0 !important;
            background: none !important;
            border: none !important;
            transform: none !important;
        }
        
        #mainSidebar .nav a * {
            position: static !important;
            transform: none !important;
            margin: 0 !important;
        }

        #mainSidebar .nav a div[class^="text-"],
        #mainSidebar .nav .container {
            display: none !important;
        }
        
        body {
            padding-bottom: 60px !important;
        }
        
        /* Penyesuaian Main Content (berlaku untuk class apa pun yg punya .main di dalam halaman) */
        [class*="-operator"] {
            flex-direction: column !important;
        }
        
        [class*="-operator"] .main {
            margin-left: 0 !important;
            width: 100% !important;
        }
    }
</style>

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
                    <div class="text-wrapper">Operator Panel</div>
                </div>
            </div>
        </div>

        <!-- Sidebar Toggle Button -->
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
        <a href="{{ route('operator.dashboard') }}" class="{{ isset($active) && $active == 'dashboard' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'dashboard' ? 'aria-current="page"' : '' }} title="Dashboard">
            <div class="div">
                <img class="img" src="{{ asset('icon/operator/dashboard.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'dashboard' ? 'text-2' : 'text-3' }}">Dashboard</div>
            </div>
        </a>

        <div class="container">
            <div class="text-wrapper-2">KELOLA DATA</div>
        </div>

        <a href="{{ route('operator.kelola-siswa') }}" class="{{ isset($active) && $active == 'akun-siswa' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'akun-siswa' ? 'aria-current="page"' : '' }} title="Akun Siswa">
            <div class="div">
                <img class="icon-2" src="{{ asset('icon/operator/akun.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'akun-siswa' ? 'text-2' : 'text-wrapper-3' }}">Akun Siswa</div>
            </div>
        </a>

        <a href="{{ route('operator.kelola-guru') }}" class="{{ isset($active) && $active == 'akun-guru' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'akun-guru' ? 'aria-current="page"' : '' }} title="Akun Guru">
            <div class="div">
                <img class="icon-2" src="{{ asset('icon/operator/akun.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'akun-guru' ? 'text-2' : 'text-wrapper-3' }}">Akun Guru</div>
            </div>
        </a>

        <a href="{{ route('operator.kelola-jadwal') }}" class="{{ isset($active) && $active == 'jadwal-pelajaran' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'jadwal-pelajaran' ? 'aria-current="page"' : '' }} title="Jadwal Pelajaran">
            <div class="div">
                <img class="icon-3" src="{{ asset('icon/operator/jadwal.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'jadwal-pelajaran' ? 'text-2' : 'text-3' }}">Jadwal Pelajaran</div>
            </div>
        </a>

        <div class="container">
            <div class="text-wrapper-2">KOMUNIKASI</div>
        </div>

        <a href="{{ route('operator.pengumuman') }}" class="{{ isset($active) && $active == 'pengumuman' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'pengumuman' ? 'aria-current="page"' : '' }} title="Pengumuman">
            <div class="div">
                <img class="icon-4" src="{{ asset('icon/operator/pengumuman.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'pengumuman' ? 'text-2' : 'text-4' }}">Pengumuman</div>
            </div>
        </a>

        <a href="{{ route('operator.galeri') }}" class="{{ isset($active) && $active == 'galeri-kegiatan' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'galeri-kegiatan' ? 'aria-current="page"' : '' }} title="Galeri Kegiatan">
            <div class="div">
                <img class="icon-5" src="{{ asset('icon/operator/galeri.svg') }}" alt="" />
            </div>
            <div class="div-wrapper">
                <div class="{{ isset($active) && $active == 'galeri-kegiatan' ? 'text-2' : 'text-5' }}">Galeri Kegiatan</div>
            </div>
        </a>
    </nav>

    <div class="container-wrapper">
        <div class="container-2">
            <div class="admin-profile" role="img" aria-label="Foto profil Admin Operator"></div>

            <div class="margin">
                <div class="div-2">
                    <div class="div-2">
                        <div class="text-wrapper-4">Admin Operator</div>
                    </div>
                    <div class="div-2">
                        <div class="text-wrapper-5">operator@tkpm.sch…</div>
                    </div>
                </div>
            </div>

            <div class="div-wrapper">
                <button class="button" type="button" aria-label="Opsi akun admin">
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
        
        // Check local storage for sidebar state
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
