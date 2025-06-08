<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="brand">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
            <span class="brand-text">SMP Muh Watukelir</span>
        </div>
        <button class="btn-toggle-menu d-md-none" id="sidebarToggler">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <nav class="sidebar-nav">
        <ul class="nav-list">
            <li class="nav-title">Menu Utama</li>
            <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/berita*') ? 'active' : '' }}">
                <a href="{{ route('admin.berita.index') }}" class="nav-link">
                    <i class="fas fa-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/prestasi*') ? 'active' : '' }}">
                <a href="{{ route('admin.prestasi.index') }}" class="nav-link">
                    <i class="fas fa-trophy"></i>
                    <span>Prestasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-images"></i>
                    <span>Galeri</span>
                </a>
            </li>

            <li class="nav-title">Pengguna & Pengaturan</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Pengguna</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>
