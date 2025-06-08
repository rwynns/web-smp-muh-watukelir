<section>
    <div id="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-8 col-sm-12">
                    <ul class="top-nav kiri">
                        <li><a href="tel:085773716731"><i class="fas fa-phone"></i> 2147483647</a></li>
                        <li><a href="mailto:arbisyarifudin@gmail.com"><i class="fas fa-envelope"></i>
                                smpmuhkelir@gmail.com</a></li>
                        <li class="headline"><a href="#"><i class="fas fa-bullhorn"></i> Pendaftaran TA
                                2025/2026
                                telah dibuka!
                            </a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-12">
                    <ul class="top-nav kanan">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li class="admin-login-top"><a href="{{ url('/login') }}" title="Login Admin"><i
                                    class="fas fa-user-shield"></i> Admin</a></li>
                    </ul>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #topbar -->
</section>

<header>
    <div id="head">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="brand">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('img/logo-toga.png') }}" alt="Logo" title="Logo">
                        </a>
                        <div class="brand-title">
                            <a href="{{ url('/') }}">
                                <h1>SMP MUHAMMADIYAH WATUKELIR</h1>
                                <h4>SEKOLAH PENCETAK GENERASI TELADAN DAN BERPESTASI</h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div id="my-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item {{ Request::is('profile') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/profile') }}">Profile</a>
                    </li>
                    <li class="nav-item {{ Request::is('sarana-dan-prasarana') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/sarana-dan-prasarana') }}">Sarana dan Prasarana</a>
                    </li>
                    <li class="nav-item {{ Request::is('ekstrakurikuler') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('/ekstrakurikuler') }}">Ekstrakurikuler</a>
                    </li>
                    <li class="nav-item {{ Request::is('prestasi*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('prestasi.index') }}">Prestasi</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Berita
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('berita.index') }}">Semua Berita</a>
                            <a class="dropdown-item" href="{{ route('berita.index', 'berita_sekolah') }}">Berita
                                Sekolah</a>
                            <a class="dropdown-item" href="{{ route('berita.index', 'pengumuman') }}">Pengumuman</a>
                            <a class="dropdown-item" href="{{ route('berita.index', 'agenda') }}">Agenda</a>
                            <a class="dropdown-item" href="{{ route('berita.index', 'prestasi') }}">Prestasi</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="galeri.html">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Kontak.html">Kontak</a>
                    </li>
                </ul>

                <!-- Admin Login Button untuk Mobile Menu -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item admin-login-nav d-lg-none">
                        <a class="nav-link admin-login-btn" href="{{ url('/admin/login') }}">
                            <i class="fas fa-user-shield"></i> Login Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
