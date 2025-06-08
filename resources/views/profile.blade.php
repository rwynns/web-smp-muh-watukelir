@extends('layouts.main')
@section('content')
    <section>
        <div class="breadcrumb-box clearfix">
            <div class="container">
                <nav aria-label="profile breadcrumb">
                    <ol class="breadcrumb brd-detail">
                        <li class="breadcrumb-item active" aria-current="profile">Beranda</li>
                        <li class="breadcrumb-item brd-post-title">Profil Kami</li>
                    </ol>
                </nav>

            </div>
        </div>
    </section>

    {{-- Buat Konten --}}
    <div class="konten">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10 col-md-9">
                    <section id="post">
                        <div class="container">
                            <article>
                                <div class="section-thumbnail thumb-post">
                                    <img class="img-fluid" src="{{ asset('img/profil.jpg') }}" alt="Latihan Kepemimpinan">
                                </div>
                                <div class="section-body">
                                    <h1 class="section-post-title">Profil Kami
                                    </h1>
                                    <div class="section-post-meta">
                                        <span><i class="fas fa-user"></i> Oleh: <a href="" class="author">Arbi
                                                Syarifudin</a></span>
                                        <span><i class="fas fa-clock"></i> 25 Oktober 2019</span>
                                        <span><i class="fas fa-eye"></i> 256 kali</span>
                                    </div>
                                    <div class="section-post-content">
                                        <p>SMP Muhammadiyah Watukelır: Menorehkan Prestasi di Bumi Sukoharjo
                                            SMP Muhammadiyah Watukelır, yang terletak di Watukelir Jatingarang Weru
                                            Sukoharjo, Jawa Tengah, merupakan lembaga pendidikan swasta yang telah
                                            berdiri sejak tahun 1974. Sekolah ini menaungi jenjang pendidikan SMP
                                            dengan waktu penyelenggaraan pagi selama 6 hari.
                                        </p>

                                        <p>SMP Muhammadiyah Watukelır dikenal dengan komitmennya dalam memberikan
                                            pendidikan berkualitas dan berakhlak mulia. Hal ini tercermin dari
                                            akreditasi A yang diraih pada tahun 2015, yang menjadi bukti nyata
                                            kualitas pendidikan yang diberikan. Sekolah ini juga didukung oleh
                                            fasilitas yang memadai, termasuk akses internet dan sumber listrik PLN.
                                        </p>

                                        <p>Dalam menjalankan operasionalnya, SMP Muhammadiyah Watukelır berada di
                                            bawah naungan Yayasan Pimpinan Daerah Muhammadiyah (PDM) Kab.
                                            Sukoharjo. Dengan luas tanah 1.458 meter persegi, sekolah ini memiliki
                                            ruang belajar yang nyaman dan lapang untuk menunjang proses
                                            pembelajaran.

                                            SMP Muhammadiyah Watukelır mempersiapkan para siswanya untuk menjadi
                                            generasi penerus bangsa yang cerdas, berakhlak mulia, dan mampu
                                            berkompetisi di era global. Selain mengutamakan pendidikan akademik,
                                            sekolah ini juga menanamkan nilai-nilai agama Islam melalui berbagai
                                            kegiatan keagamaan.</p>

                                        <p>Jika Anda mencari sekolah menengah pertama swasta di Sukoharjo yang
                                            memiliki reputasi baik, maka SMP Muhammadiyah Watukelır dapat menjadi
                                            pilihan yang tepat. Anda dapat menghubungi sekolah melalui nomor
                                            telepon 02735331415 atau email smpmuhkelir@gmail.com untuk informasi
                                            lebih lanjut.</p>
                                    </div> <!-- .section-post-content -->
                                    <div class="section-post-share">
                                        <ul class="list-unstyled">
                                            <li>Bagikan:</li>
                                            <li><a
                                                    href="https://www.facebook.com/sharer/sharer.php?u=demo.woapik.store%2Ftemplate%2Fwebsekolah%2Fdetail-post.html"><i
                                                        class="fab fa-facebook-f"></i></a></li>
                                            <li><a
                                                    href="https://twitter.com/intent/tweet?url=demo.woapik.store%2Ftemplate%2Fwebsekolah%2Fdetail-post.html&text=Coba%20lihat"><i
                                                        class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                            <!-- <li><a href=""><i class="fas fa-ellipsis"></i></a></li> -->
                                        </ul>
                                    </div> <!-- .section-post-share -->
                                </div> <!-- .section-post-content -->
                            </article>
                        </div> <!-- .container -->
                    </section> <!-- section #berita -->
                </div>

            </div> <!-- .row -->
        </div> <!-- .container -->

        <section id="galeri">
            <div class="container">
                <div class="section-title">
                    <h2>Galeri / Dokumentasi</h2>
                </div>
                <div class="section-body">
                    <div id="slider-tools-3"></div>
                    <div class="owl-carousel" id="galeri-slider">
                        <div class="section-item-slider">
                            <a href=""><img class="foto-galeri" src="{{ asset('img/berita1.jpg') }}"
                                    alt="Latihan kepemimpinan"></a>
                            <div class="section-item-caption">
                                <a href="">
                                    <h5>Latihan Kepemimpinan 2023</h5>
                                </a>
                                <h6>SMP MUHAMMADIYAH WATUKELIR</h6>
                            </div>
                        </div>
                        <div class="section-item-slider">
                            <a href=""><img class="foto-galeri" src="{{ asset('img/berita2.jpg') }}"
                                    alt="Latihan Kepemimpinan"></a>
                            <div class="section-item-caption">
                                <a href="">
                                    <h5>Pembekalan Pelatihan kepemimpinan</h5>
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
                                <a href="">
                                    <h5>.......</h5>
                                </a>
                                <h6>GOR SMP MUHAMMADIYAH WATUKELIR</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tombol-selengkapnya">
                    <a href="galeri.html" class="btn btn-more">Lihat Galeri Lainnya</a>
                </div>
            </div>
        </section>
    </div> <!-- konten -->

    <div id="scroll-to-top">
        <a href="#topbar"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection
