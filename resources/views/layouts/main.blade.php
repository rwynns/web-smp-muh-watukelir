<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Web SMP MUHAMMADIYAH Watukelir')</title>

    <!-- Replace Bootstrap CSS with CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Keep your other CSS files -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>

<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    <div id="scroll-to-top">
        <a href="#topbar"><i class="fas fa-angle-up"></i></a>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="footer-col">
                        <div class="brand">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo">
                            <h1>SMP MUHAMMADIYAH WATUKELIR</h1>
                        </div>
                        <p class="tentang">Sekolah berbasis nilai-nilai Islam yang berkomitmen mencetak generasi cerdas, 
                            berakhlak mulia, dan siap menghadapi tantangan masa depan.
                            Didukung oleh tenaga pendidik profesional, fasilitas lengkap, dan lingkungan belajar yang nyaman serta inspiratif..</p>
                        <ul class="sosmed">
                            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href=""><i class="fab fa-instagram"></i></a></li>
                            <li><a href=""><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class="footer-col">
                        <h2>Kontak Kami</h2>
                        <p class="alamat">Watukelir, Jatingarang, Kec. Weru, Kabupaten Sukoharjo, Jawa Tengah 57562</p>
                        <ul class="kontak">
                            <li><i class="fas fa-phone"></i> Telp/Fax : 2147483647</li>
                            <li><i class="fas fa-envelope"></i> Email : smpmuhkelir@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="footer-col">
                        <h2>Navigasi</h2>
                        <ul class="footer-nav">
                            <li><a href="{{ url('/profile') }}">Profil</a></li>
                            <li><a href="{{ url('/profile') }}">Visi dan Misi</a></li>
                            <li><a href="{{ url('/berita') }}">Berita Sekolah</a></li>
                            <li><a href="{{ url('/ppdb') }}">Pendaftaran PPDB 2025 <span>info</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- .container -->
        <div class="footer-copyright">
            <div class="container text-center">
                <h6><a href="#">smpmuhkelir.co.id</a> &copy; 2025 - All right reserved.</h6>
                <span class="credit"><a target="_blank" href="https://facebook.com/arbisyarifudin"></a></span>
            </div>
        </div>
    </footer>

    <!-- Replace jQuery and Bootstrap JS with CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    @stack('scripts')
</body>

</html>
