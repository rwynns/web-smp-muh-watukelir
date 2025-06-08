<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Web SMP MUHAMMADIYAH Watukelir</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                            <img src="{{ asset('img/logo-toga.png') }}" alt="Logo">
                            <h1>SMP MUHAMMADIYAH WATUKELIR Teladan</h1>
                        </div>
                        <p class="tentang">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero
                            eos et accusam et justo duo dolores et ea rebum.</p>
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
                            <li><a href="">Profil</a></li>
                            <li><a href="">Visi dan Misi</a></li>
                            <li><a href="">Struktur Organisasi</a></li>
                            <li><a href="">Sumber Daya Manusia</a></li>
                            <li><a href="">Pendaftaran PPDB 2020 <span>info</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- .container -->
        <div class="footer-copyright">
            <div class="container text-center">
                <h6><a href="#">smpmuhkelir.co.id</a> &copy; 2025 - All right reserved.</h6>
                <span class="credit">Designed by <a target="_blank" href="https://facebook.com/arbisyarifudin">Bayu
                        Setia Abi</a></span>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            jQuery(function() {
                jQuery(this).bind("contextmenu", function(event) {
                    event.preventDefault();
                    // alert('Right click is forbidden!')
                });
            });
        });
    </script>
</body>

</html>
