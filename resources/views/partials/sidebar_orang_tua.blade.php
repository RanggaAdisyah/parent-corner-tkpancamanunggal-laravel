<style>
    .aside { transition: width 0.3s ease; }

    .aside.collapsed,
    @media (max-width: 991px) {
        .aside { width: 80px !important; min-width: 80px !important; flex: none !important; }
    }

    .aside.collapsed .text, .aside.collapsed .text-wrapper,
    .aside.collapsed .text-2, .aside.collapsed .text-3,
    .aside.collapsed .text-4, .aside.collapsed .text-5,
    .aside.collapsed .text-wrapper-2, .aside.collapsed .text-wrapper-3,
    .aside.collapsed .text-wrapper-4, .aside.collapsed .text-wrapper-5,
    .aside.collapsed .margin, .aside.collapsed .container,
    .aside.collapsed .container-wrapper { display: none !important; }

    .aside.collapsed .div-wrapper.toggle-wrapper { margin: 0 auto !important; }

    @media (max-width: 991px) {
        #mainSidebar { display: none !important; }
        body { padding-top: 56px !important; }
        .dashboard-guru { flex-direction: column !important; }
        .dashboard-guru .main { margin-left: 0 !important; width: 100% !important; }
    }

    /* ── Hamburger Topbar ── */
    .ot-topbar {
        display: none;
    }
    @media (max-width: 991px) {
        .ot-topbar {
            display: flex;
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 56px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 8px rgba(0,0,0,0.06);
            z-index: 9999;
            align-items: center;
            padding: 0 16px;
            gap: 12px;
        }
        .ot-topbar__title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            flex: 1;
        }
        .ot-hamburger {
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            color: #475569;
            display: flex;
            align-items: center;
        }
    }

    /* ── Drawer ── */
    .ot-drawer-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.35);
        z-index: 10000;
    }
    .ot-drawer-backdrop.open { display: block; }

    .ot-drawer {
        position: fixed;
        top: 0; left: 0; bottom: 0;
        width: 280px;
        background: #fff;
        z-index: 10001;
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }
    .ot-drawer.open { transform: translateX(0); }

    .ot-drawer__header {
        padding: 20px 16px 16px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .ot-drawer__logo {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
    }
    .ot-drawer__logo span { color: #3b82f6; }
    .ot-drawer__close {
        background: none;
        border: none;
        cursor: pointer;
        color: #94a3b8;
        padding: 4px;
    }

    .ot-drawer__nav { flex: 1; padding: 12px 0; }

    /* Direct link item */
    .ot-drawer__link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        text-decoration: none;
        color: #475569;
        font-size: 14px;
        font-weight: 500;
        transition: background 0.15s, color 0.15s;
        border-radius: 0;
    }
    .ot-drawer__link:hover { background: #f8fafc; color: #3b82f6; }
    .ot-drawer__link.active { background: #eff6ff; color: #3b82f6; font-weight: 600; }
    .ot-drawer__link svg { width: 18px; height: 18px; flex-shrink: 0; }

    /* Accordion group */
    .ot-drawer__group {}
    .ot-drawer__group-btn {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 20px;
        background: none;
        border: none;
        cursor: pointer;
        color: #475569;
        font-size: 14px;
        font-weight: 500;
        text-align: left;
        transition: background 0.15s, color 0.15s;
    }
    .ot-drawer__group-btn:hover { background: #f8fafc; color: #3b82f6; }
    .ot-drawer__group-btn.active { color: #3b82f6; font-weight: 600; }
    .ot-drawer__group-btn svg { width: 18px; height: 18px; flex-shrink: 0; }
    .ot-drawer__chevron {
        margin-left: auto;
        transition: transform 0.2s;
        width: 16px; height: 16px;
    }
    .ot-drawer__group-btn.open .ot-drawer__chevron { transform: rotate(180deg); }

    .ot-drawer__subnav {
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.3s ease;
        background: #f8fafc;
    }
    .ot-drawer__subnav.open { max-height: 400px; }
    .ot-drawer__sublink {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px 10px 48px;
        text-decoration: none;
        color: #64748b;
        font-size: 13px;
        transition: color 0.15s;
    }
    .ot-drawer__sublink:hover { color: #3b82f6; }
    .ot-drawer__sublink.active { color: #3b82f6; font-weight: 600; }
    .ot-drawer__sublink svg { width: 15px; height: 15px; flex-shrink: 0; }

    .ot-drawer__divider {
        height: 1px;
        background: #f1f5f9;
        margin: 8px 0;
    }

    .ot-drawer__footer {
        padding: 16px 20px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .ot-drawer__avatar {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 700; font-size: 14px;
    }
    .ot-drawer__user-name { font-size: 14px; font-weight: 600; color: #1e293b; }
    .ot-drawer__user-role { font-size: 12px; color: #94a3b8; }
</style>

{{-- Desktop Sidebar (tidak berubah) --}}
<aside class="aside" id="mainSidebar" aria-label="Sidebar navigasi orang tua">
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
                    <div class="text-wrapper">Parent Corner & Staff</div>
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
        <a href="{{ url('/orang-tua/dashboard') }}" class="{{ isset($active) && $active == 'beranda' ? 'link' : 'link-2' }}" {{ isset($active) && $active == 'beranda' ? 'aria-current="page"' : '' }} title="Beranda">
            <div class="div"><img class="img" src="{{ asset('icon/guru/dashboard.svg') }}" alt="" /></div>
            <div class="div-wrapper"><div class="{{ isset($active) && $active == 'beranda' ? 'text-2' : 'text-3' }}">Beranda</div></div>
        </a>

        <div class="container"><div class="text-wrapper-2">AKADEMIK</div></div>

        <a href="{{ url('/orang-tua/lihat-nilai') }}" class="{{ isset($active) && $active == 'lihat-nilai' ? 'link' : 'link-2' }}" title="Lihat Nilai">
            <div class="div"><img class="icon-2" src="{{ asset('icon/guru/nilai.svg') }}" alt="" /></div>
            <div class="div-wrapper"><div class="{{ isset($active) && $active == 'lihat-nilai' ? 'text-2' : 'text-wrapper-3' }}">Lihat Nilai</div></div>
        </a>

        <a href="{{ url('/orang-tua/lihat-jadwal') }}" class="{{ isset($active) && $active == 'lihat-jadwal' ? 'link' : 'link-2' }}" title="Lihat Jadwal">
            <div class="div"><img class="icon-3" src="{{ asset('icon/guru/jadwal.svg') }}" alt="" /></div>
            <div class="div-wrapper"><div class="{{ isset($active) && $active == 'lihat-jadwal' ? 'text-2' : 'text-3' }}">Lihat Jadwal</div></div>
        </a>

        <a href="{{ url('/orang-tua/lihat-kehadiran') }}" class="{{ isset($active) && $active == 'lihat-kehadiran' ? 'link' : 'link-2' }}" title="Lihat kehadiran">
            <div class="div"><img class="icon-2" src="{{ asset('icon/guru/kehadiran.svg') }}" alt="" /></div>
            <div class="div-wrapper"><div class="{{ isset($active) && $active == 'lihat-kehadiran' ? 'text-2' : 'text-wrapper-3' }}">Lihat kehadiran</div></div>
        </a>

        <a href="{{ url('/orang-tua/unduh-laporan') }}" class="{{ isset($active) && $active == 'unduh-laporan' ? 'link' : 'link-2' }}" title="Unduh Laporan">
            <div class="div"><img class="icon-2" src="{{ asset('icon/guru/nilai.svg') }}" alt="" /></div>
            <div class="div-wrapper"><div class="{{ isset($active) && $active == 'unduh-laporan' ? 'text-2' : 'text-wrapper-3' }}">Unduh Laporan</div></div>
        </a>

        <div class="container"><div class="text-wrapper-2">KOMUNIKASI & INFO</div></div>

        <a href="{{ url('/orang-tua/lihat-pengumuman') }}" class="{{ isset($active) && $active == 'pengumuman' ? 'link' : 'link-2' }}" title="Pengumuman">
            <div class="div"><img class="icon-4" src="{{ asset('icon/guru/pengumuman.svg') }}" alt="" /></div>
            <div class="div-wrapper"><div class="{{ isset($active) && $active == 'pengumuman' ? 'text-2' : 'text-4' }}">Pengumuman</div></div>
        </a>

        <a href="{{ url('/orang-tua/foto-kegiatan') }}" class="{{ isset($active) && $active == 'foto-kegiatan' ? 'link' : 'link-2' }}" title="Foto Kegiatan">
            <div class="div"><img class="icon-5" src="{{ asset('icon/guru/foto.svg') }}" alt="" /></div>
            <div class="div-wrapper"><div class="{{ isset($active) && $active == 'foto-kegiatan' ? 'text-2' : 'text-5' }}">Foto Kegiatan</div></div>
        </a>

        <a href="{{ url('/orang-tua/hubungi-guru') }}" class="{{ isset($active) && $active == 'hubungi-guru' ? 'link' : 'link-2' }}" title="Hubungi Guru">
            <div class="div"><img class="icon-2" src="{{ asset('icon/guru/kehadiran.svg') }}" alt="" /></div>
            <div class="div-wrapper"><div class="{{ isset($active) && $active == 'hubungi-guru' ? 'text-2' : 'text-wrapper-3' }}">Hubungi Guru</div></div>
        </a>
    </nav>

    <div class="container-wrapper">
        <div class="container-2">
            <div class="admin-profile" role="img" aria-label="Foto profil Orang Tua"></div>
            <div class="margin">
                <div class="div-2">
                    <div class="div-2"><div class="text-wrapper-4">Ibu Sarah</div></div>
                    <div class="div-2"><div class="text-wrapper-5">Wali Murid Budi</div></div>
                </div>
            </div>
            <div class="div-wrapper">
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button class="button" type="submit" aria-label="Logout" title="Logout" style="border: none; background: transparent; cursor: pointer; padding: 0;">
                        <div class="icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>

@php
    $akademikPages = ['lihat-nilai', 'lihat-jadwal', 'lihat-kehadiran', 'unduh-laporan'];
    $komunikasiPages = ['pengumuman', 'foto-kegiatan', 'hubungi-guru'];
    $isAkademikActive = isset($active) && in_array($active, $akademikPages);
    $isKomunikasiActive = isset($active) && in_array($active, $komunikasiPages);
@endphp

{{-- Mobile Topbar --}}
<header class="ot-topbar">
    <button class="ot-hamburger" id="otHamburger" aria-label="Buka menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
    </button>
    <span class="ot-topbar__title">TK Panca Manunggal</span>
</header>

{{-- Backdrop --}}
<div class="ot-drawer-backdrop" id="otBackdrop"></div>

{{-- Drawer --}}
<div class="ot-drawer" id="otDrawer" aria-label="Menu navigasi">
    <div class="ot-drawer__header">
        <div class="ot-drawer__logo">Parent <span>Corner</span></div>
        <button class="ot-drawer__close" id="otDrawerClose" aria-label="Tutup menu">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>

    <nav class="ot-drawer__nav">
        {{-- Beranda --}}
        <a href="{{ url('/orang-tua/dashboard') }}" class="ot-drawer__link {{ isset($active) && $active == 'beranda' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Beranda
        </a>

        <div class="ot-drawer__divider"></div>

        {{-- Akademik Accordion --}}
        <div class="ot-drawer__group">
            <button class="ot-drawer__group-btn {{ $isAkademikActive ? 'active open' : '' }}" id="btnGrpAkademik">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                Akademik
                <svg class="ot-drawer__chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="ot-drawer__subnav {{ $isAkademikActive ? 'open' : '' }}" id="subnavAkademik">
                <a href="{{ url('/orang-tua/lihat-nilai') }}" class="ot-drawer__sublink {{ isset($active) && $active == 'lihat-nilai' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    Lihat Nilai
                </a>
                <a href="{{ url('/orang-tua/lihat-jadwal') }}" class="ot-drawer__sublink {{ isset($active) && $active == 'lihat-jadwal' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Lihat Jadwal
                </a>
                <a href="{{ url('/orang-tua/lihat-kehadiran') }}" class="ot-drawer__sublink {{ isset($active) && $active == 'lihat-kehadiran' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
                    Lihat Kehadiran
                </a>
                <a href="{{ url('/orang-tua/unduh-laporan') }}" class="ot-drawer__sublink {{ isset($active) && $active == 'unduh-laporan' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    Unduh Laporan
                </a>
            </div>
        </div>

        {{-- Komunikasi Accordion --}}
        <div class="ot-drawer__group">
            <button class="ot-drawer__group-btn {{ $isKomunikasiActive ? 'active open' : '' }}" id="btnGrpKomunikasi">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Komunikasi & Informasi
                <svg class="ot-drawer__chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </button>
            <div class="ot-drawer__subnav {{ $isKomunikasiActive ? 'open' : '' }}" id="subnavKomunikasi">
                <a href="{{ url('/orang-tua/lihat-pengumuman') }}" class="ot-drawer__sublink {{ isset($active) && $active == 'pengumuman' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3z"/></svg>
                    Pengumuman
                </a>
                <a href="{{ url('/orang-tua/foto-kegiatan') }}" class="ot-drawer__sublink {{ isset($active) && $active == 'foto-kegiatan' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    Foto Kegiatan
                </a>
                <a href="{{ url('/orang-tua/hubungi-guru') }}" class="ot-drawer__sublink {{ isset($active) && $active == 'hubungi-guru' ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Hubungi Guru
                </a>
            </div>
        </div>

        <div class="ot-drawer__divider"></div>

        {{-- Profil --}}
        <a href="#" class="ot-drawer__link {{ isset($active) && $active == 'profil' ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Profil
        </a>
    </nav>

    <div class="ot-drawer__footer">
        <div class="ot-drawer__avatar">S</div>
        <div style="flex: 1;">
            <div class="ot-drawer__user-name">Ibu Sarah</div>
            <div class="ot-drawer__user-role">Wali Murid Budi</div>
        </div>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" aria-label="Logout" style="background: none; border: none; cursor: pointer; color: #ef4444; padding: 8px; border-radius: 6px; display: flex; align-items: center; justify-content: center;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='none'">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Desktop sidebar toggle
    const sidebar = document.getElementById('mainSidebar');
    const toggleBtn = document.getElementById('toggleButton');
    if (toggleBtn) {
        if (localStorage.getItem('sidebarOrangTuaCollapsed') === 'true') sidebar.classList.add('collapsed');
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebarOrangTuaCollapsed', sidebar.classList.contains('collapsed'));
        });
    }

    // Mobile hamburger drawer
    const hamburger = document.getElementById('otHamburger');
    const backdrop  = document.getElementById('otBackdrop');
    const drawer    = document.getElementById('otDrawer');
    const closeBtn  = document.getElementById('otDrawerClose');

    const openDrawer  = () => { drawer.classList.add('open'); backdrop.classList.add('open'); };
    const closeDrawer = () => { drawer.classList.remove('open'); backdrop.classList.remove('open'); };

    if (hamburger) hamburger.addEventListener('click', openDrawer);
    if (closeBtn)  closeBtn.addEventListener('click', closeDrawer);
    if (backdrop)  backdrop.addEventListener('click', closeDrawer);

    // Accordion
    document.querySelectorAll('.ot-drawer__group-btn').forEach(btn => {
        const subnav = btn.nextElementSibling;
        btn.addEventListener('click', () => {
            const isOpen = btn.classList.contains('open');
            // close all
            document.querySelectorAll('.ot-drawer__group-btn').forEach(b => {
                b.classList.remove('open');
                b.nextElementSibling.classList.remove('open');
            });
            if (!isOpen) { btn.classList.add('open'); subnav.classList.add('open'); }
        });
    });
});
</script>
