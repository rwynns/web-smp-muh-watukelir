@extends('layouts.main')

@section('content')
    <section>
        <div id="hero-area">
            <div id="hero-area-nav"></div>
            <div class="owl-carousel" id="hero-area-slider">
                <div class="hero-area-item">
                    <img class="img-fluid" src="{{ asset('img/SMPmuhkelir.jpg') }}" alt="Banner Slider 1">
                    <div class="hero-area-content">
                        <h2>Penerimaan Peserta Didik Baru TA 2025/2026 telah dibuka!</h2>
                        <p>Silahkan anda bisa akses <a href="">ppdb.smpmuhkelir</a> untuk mendapatkan semua
                            informasi terkait pendaftaran PPDB tahun ajaran 2025/2026 SMP MUHAMMADIYAH WATUKELIR.</p>
                        <a class="btn btn-utama">Daftar PPDB</a>
                    </div>
                </div>
                <div class="hero-area-item">
                    <img class="img-fluid" src="{{ asset('img/SMPmuhkelir.jpg') }}" alt="Banner Slider 1">
                    <div class="hero-area-content">
                        <h2>Title 2</h2>
                        <p>Lorem Ipsum Dolor Sit Amet...</p>
                        <a class="btn btn-utama">CTA button</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sambutan">
        <div class="container">
            <h2>Profil SMP MUHAMMADIYAH WATUKELIR</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="video-wrapper">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/xx" frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Sambutan Kepala Sekolah</h3>
                    <p style="font-size: 14px!important;">Assalamu'alaikum. Lorem ipsum dolor sit amet consectetur
                        adipisicing elit. Rem velit sit et dolorum quia fugiat mollitia voluptatum nemo. Explicabo,
                        itaque quaerat omnis ipsam ipsa maxime, praesentium quidem tempora quasi nemo illo architecto
                        aspernatur soluta! Quas animi, iusto a consectetur accusamus eligendi, repudiandae voluptatum
                        nobis inventore, non possimus blanditiis voluptates at.</p>
                    <a href="detail-post.html" class="btn btn-utama">Baca Selengkapnya</a>
                </div>
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section> <!-- #sambutan -->

    <section id="prestasi">
        <div class="container">
            <div class="section-title">
                <h2>Prestasi Terbaru</h2>
            </div>
            <div class="section-item">
                <div class="row">
                    <div class="col-md-6">
                        <a href="Isi_prestasi1.html"><img class="section-item-thumbnail"
                                src="{{ asset('img/prestasi1.webp') }}" alt=""></a>
                    </div>
                    <div class="col-md-6 col-item-kanan">
                        <div class="section-item-title">
                            <a href="Isi_prestasi1.html">
                                <h3>Medali Perak dalam IOI Olympiad in Informatics/IOI di Azerbaijan </h3>
                            </a>
                            <div class="section-item-meta">
                                <span><i class="far fa-calendar-alt"></i> 20 Agust, 2019 - 22 Agust, 2019</span>
                                <span><i class="fas fa-map-marked-alt"></i> Baku, Azerbaijan</span>
                            </div>
                        </div>
                        <div class="section-item-body">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem eaque, ad odit sapiente
                                rem accusamus tempore quas labore saepe sed enim non temporibus sequi! Nobis, quae?
                                Rerum at excepturi unde debitis. Nemo eius minus animi sequi quidem autem voluptas
                                rerum.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-item">
                <div class="row">
                    <div class="col-md-6">
                        <a href="detail-post.html"><img class="section-item-thumbnail" src="{{ asset('img/noimage.jpg') }}"
                                alt=""></a>
                    </div>
                    <div class="col-md-6 col-item-kanan">
                        <div class="section-item-title">
                            <a href="detail-post.html">
                                <h3>Medali Perak dalam IOI Olympiad in Informatics/IOI di Azerbaijan </h3>
                            </a>
                            <div class="section-item-meta">
                                <span><i class="far fa-calendar-alt"></i> 20 Agust, 2019 - 22 Agust, 2019</span>
                                <span><i class="fas fa-map-marked-alt"></i> Baku, Azerbaijan</span>
                            </div>
                        </div>
                        <div class="section-item-body">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem eaque, ad odit sapiente
                                rem accusamus tempore quas labore saepe sed enim non temporibus sequi! Nobis, quae?
                                Rerum at excepturi unde debitis. Nemo eius minus animi sequi quidem autem voluptas
                                rerum.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-item">
                <div class="row">
                    <div class="col-md-6">
                        <a href="detail-post.html"><img class="section-item-thumbnail" src="{{ asset('img/noimage.jpg') }}"
                                alt=""></a>
                    </div>
                    <div class="col-md-6 col-item-kanan">
                        <div class="section-item-title">
                            <a href="detail-post.html">
                                <h3>Medali Perak dalam IOI Olympiad in Informatics/IOI di Azerbaijan </h3>
                            </a>
                            <div class="section-item-meta">
                                <span><i class="far fa-calendar-alt"></i> 20 Agust, 2019 - 22 Agust, 2019</span>
                                <span><i class="fas fa-map-marked-alt"></i> Baku, Azerbaijan</span>
                            </div>
                        </div>
                        <div class="section-item-body">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Autem eaque, ad odit sapiente
                                rem accusamus tempore quas labore saepe sed enim non temporibus sequi! Nobis, quae?
                                Rerum at excepturi unde debitis. Nemo eius minus animi sequi quidem autem voluptas
                                rerum.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tombol-selengkapnya">
                <a href="list-post.html" class="btn btn-more">Lihat Prestasi Lainnya</a>
            </div>
        </div>
    </section>

    <section id="ekstrakulikuler">
        <div class="container">
            <div class="section-title">
                <h2>Ekstrakulikuler</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="detail-post.html">
                            <div class="section-body-item">
                                <div class="row row-2">
                                    <div class="col-md-3">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>Kepanduan Hizbul Wathon (HW)</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="detail-post.html">
                            <div class="section-body-item">
                                <div class="row row-2">
                                    <div class="col-md-3">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>Olah Raga Tapak Suci Putra Muhammadiyah (TSPM)</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="detail-post.html">
                            <div class="section-body-item">
                                <div class="row row-2">
                                    <div class="col-md-3">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>Palang Merah Remaja (PMR)</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="detail-post.html">
                            <div class="section-body-item">
                                <div class="row row-2">
                                    <div class="col-md-3">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>Futsal</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="detail-post.html">
                            <div class="section-body-item">
                                <div class="row row-2">
                                    <div class="col-md-3">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>Paskibra</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="detail-post.html">
                            <div class="section-body-item">
                                <div class="row row-2">
                                    <div class="col-md-3">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="col-md-9">
                                        <h4>Seni Tari</h4>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--.row-->
            </div>
        </div>
    </section>

    <section id="tenaga-pendidik">
        <div class="container">
            <div class="section-title">
                <h2>Tenaga Pendidik</h2>
            </div>
            <div class="section-body">
                <div id="slider-tools-1"></div>
                <div class="owl-carousel" id="tenaga-pendidik-slider">
                    <div class="section-item-slider">
                        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/foto-guru-1.jpg') }}"
                                alt=""></a>
                        <div class="section-item-caption">
                            <a href="detail-post.html">
                                <h5>SARNO, S.Pd., M.Pd</h5>
                            </a>
                            <h6>Guru Bahasa Indonesia</h6>
                        </div>
                    </div>
                    <div class="section-item-slider">
                        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/foto-guru-2.jpg') }}"
                                alt=""></a>
                        <div class="section-item-caption">
                            <a href="detail-post.html">
                                <h5>Drs. WARDANI</h5>
                            </a>
                            <h6>Guru Bimbingan Konseling</h6>
                        </div>
                    </div>
                    <div class="section-item-slider">
                        <a href="detail-post.html"> <img class="foto-guru" src="{{ asset('img/foto-guru-3.jpg') }}"
                                alt=""></a>
                        <div class="section-item-caption">
                            <a href="detail-post.html">
                                <h5>HARYANI, S.Pd., M.Pd</h5>
                            </a>
                            <h6>Guru Matematika</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tombol-selengkapnya">
            <a href="list-post.html" class="btn btn-more">Lihat Semua Guru</a>
        </div>
    </section>

    <section id="alumni">
        <div class="container">
            <div class="section-title">
                <h2>Profil Alumni</h2>
            </div>
            <div class="section-body">
                <div id="slider-tools-2"></div>
                <div class="owl-carousel" id="alumni-slider">
                    <div class="section-item-slider">
                        <div class="row">
                            <div class="col-md-5">
                                <a href="detail-post.html"><img class="foto-alumni"
                                        src="{{ asset('img/bu-susi-p.jpg') }}" alt=""></a>
                            </div>
                            <div class="col-md-7">
                                <div class="section-item-content">
                                    <a href="detail-post.html">
                                        <h3>Dr. (HC) Susi Pudjiastuti</h3>
                                    </a>
                                    <p>Menteri Kelautan dan Perikanan dari Kabinet Kerja 2014-2019 yang juga
                                        pengusaha pemilik dan Presdir PT ASI Pudjiastuti Marine Product,
                                        eksportir hasil-hasil perikanan dan PT ASI Pudjiastuti Aviation atau…
                                    </p>
                                    <a href="detail-post.html" class="more">Selengkapnya <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-item-slider">
                        <div class="row">
                            <div class="col-md-5">
                                <a href="detail-post.html"><img class="foto-alumni"
                                        src="{{ asset('img/prof-dwikorita.jpg') }}" alt=""></a>
                            </div>
                            <div class="col-md-7">
                                <div class="section-item-content">
                                    <a href="detail-post.html">
                                        <h3>Prof. Dwikorita Karnawati, M.Sc., Ph.D</h3>
                                    </a>
                                    <p>Prof. Dwikorita Karnawati, M.Sc., Ph.D adalah akademisi dan dosen
                                        Indonesia. Dwikorita merupakan Rektor wanita pertama Universitas Gadjah
                                        Mada, menggantikan Prof. Dr. Pratikno, M.Soc.Sc., yang...
                                    </p>
                                    <a href="detail-post.html" class="more">Selengkapnya <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="galeri">
        <div class="container">
            <div class="section-title">
                <h2>Galeri / Dokumentasi</h2>
            </div>
            <div class="section-body">
                <div id="slider-tools-3"></div>
                <div class="owl-carousel" id="galeri-slider">
                    <div class="section-item-slider">
                        <a href="detail-post.html"><img class="foto-galeri" src="{{ asset('img/galeri-1.jpg') }}"
                                alt=""></a>
                        <div class="section-item-caption">
                            <a href="detail-post.html">
                                <h5>Kegiatan Outbound 2019</h5>
                            </a>
                            <h6>Kaliboyong Camp, Pakem</h6>
                        </div>
                    </div>
                    <div class="section-item-slider">
                        <a href="detail-post.html"><img class="foto-galeri" src="{{ asset('img/galeri-2.jpeg') }}"
                                alt=""></a>
                        <div class="section-item-caption">
                            <a href="detail-post.html">
                                <h5>Album Ujian Nasional 2019</h5>
                            </a>
                            <h6>SMP MUHAMMADIYAH WATUKELIR</h6>
                        </div>
                    </div>
                    <div class="section-item-slider">
                        <div class="video-wrapper video-galeri">
                            <iframe src="https://www.youtube.com/embed/n0Q_XQgvaJQ" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                        <div class="section-item-caption">
                            <a href="detail-post.html">
                                <h5>Video Dokumentasi Reuni Akbar</h5>
                            </a>
                            <h6>Gedung SMP MUHAMMADIYAH WATUKELIR</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tombol-selengkapnya">
                <a href="list-post.html" class="btn btn-more">Lihat Galeri Lainnya</a>
            </div>
        </div>
    </section>

    <section id="berita" class="py-5 bg-light">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Berita Terbaru</h2>
                    <p class="section-subtitle">Informasi terkini seputar SMP Muhammadiyah Watukelir</p>
                </div>
            </div>

            <div class="row">
                @forelse($beritaTerbaru as $berita)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card berita-card h-100">
                            <div class="berita-image">
                                @if ($berita->gambar_path)
                                    <img src="{{ asset('storage/' . $berita->gambar_path) }}" class="card-img-top"
                                        alt="{{ $berita->judul }}">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="No Image">
                                @endif
                                <div class="berita-badge">
                                    <span>{{ $berita->kategori->nama ?? 'Berita' }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="berita-meta mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $berita->created_at->format('d M Y') }}
                                    </small>
                                </div>
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <p class="card-text text-muted">
                                    {{ Str::limit(strip_tags($berita->isi), 100) }}
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 pt-0">
                                <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-primary btn-sm">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i> Belum ada berita terbaru.
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="{{ route('berita.index') }}" class="btn btn-outline-primary">
                        Lihat Semua Berita <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </section> <!-- section #berita -->

    <div id="scroll-to-top">
        <a href="#topbar"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Hero Area Slider
            $("#hero-area-slider").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                nav: true,
                dots: true,
                navText: [
                    '<i class="fas fa-angle-left"></i>',
                    '<i class="fas fa-angle-right"></i>'
                ],
                navContainer: '#hero-area-nav'
            });

            // Tenaga Pendidik Slider
            $("#tenaga-pendidik-slider").owlCarousel({
                loop: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                nav: true,
                navText: [
                    '<i class="fas fa-angle-left"></i>',
                    '<i class="fas fa-angle-right"></i>'
                ],
                navContainer: '#slider-tools-1',
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            // Alumni Slider
            $("#alumni-slider").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                nav: true,
                navText: [
                    '<i class="fas fa-angle-left"></i>',
                    '<i class="fas fa-angle-right"></i>'
                ],
                navContainer: '#slider-tools-2'
            });

            // Galeri Slider
            $("#galeri-slider").owlCarousel({
                loop: true,
                margin: 30,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                nav: true,
                navText: [
                    '<i class="fas fa-angle-left"></i>',
                    '<i class="fas fa-angle-right"></i>'
                ],
                navContainer: '#slider-tools-3',
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Style untuk card berita di halaman index */
        .berita-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: none;
        }

        .berita-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .berita-image {
            position: relative;
            overflow: hidden;
        }

        .berita-image img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .berita-card:hover .berita-image img {
            transform: scale(1.05);
        }

        .berita-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--main-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .berita-card .card-title {
            font-weight: 600;
            margin-bottom: 10px;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .berita-card .card-text {
            font-size: 0.9rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
