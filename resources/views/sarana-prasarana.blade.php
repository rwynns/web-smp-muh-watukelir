@extends('layouts.main')
@section('content')
    <section>
        <div class="breadcrumb-box clearfix">
            <div class="container">
                <nav aria-label="breadcrumb sarana-prasarana">
                    <ol class="breadcrumb brd-detail">
                        <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sarana dan Prasarana</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="konten">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10 col-md-9">
                    <section id="fasilitas">
                        <div class="container">
                            <article>
                                <div class="section-body">
                                    <h1 class="section-post-title">Sarana dan Prasarana</h1>
                                    <div class="section-post-content">
                                        <p>SMP Muhammadiyah Watukelir menyediakan berbagai sarana dan prasarana yang
                                            menunjang proses belajar mengajar secara optimal. Fasilitas yang tersedia
                                            telah dirancang untuk menciptakan lingkungan belajar yang aman, nyaman, dan
                                            mendukung perkembangan akademik maupun non-akademik siswa.</p>

                                        <div class="row">
                                            <div class="col-md-6 mb-4">
                                                <div class="facility-box p-3 shadow-sm rounded bg-light h-100">
                                                    <h5><i class="fas fa-school text-primary me-2"></i>Ruang Kelas
                                                        Nyaman</h5>
                                                    <p>Seluruh ruang kelas dilengkapi dengan meja kursi ergonomis,
                                                        pencahayaan yang baik, dan ventilasi yang memadai.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="facility-box p-3 shadow-sm rounded bg-light h-100">
                                                    <h5><i class="fas fa-desktop text-success me-2"></i>Laboratorium
                                                        Komputer</h5>
                                                    <p>Dilengkapi komputer modern dan akses internet untuk mendukung
                                                        pembelajaran berbasis teknologi.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="facility-box p-3 shadow-sm rounded bg-light h-100">
                                                    <h5><i class="fas fa-book-reader text-warning me-2"></i>Perpustakaan
                                                    </h5>
                                                    <p>Koleksi buku yang lengkap dan suasana membaca yang tenang untuk
                                                        menumbuhkan minat baca siswa.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="facility-box p-3 shadow-sm rounded bg-light h-100">
                                                    <h5><i class="fas fa-dumbbell text-danger me-2"></i>Lapangan
                                                        Olahraga</h5>
                                                    <p>Sarana olahraga seperti lapangan futsal dan voli untuk kegiatan
                                                        fisik dan ekstrakurikuler siswa.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="facility-box p-3 shadow-sm rounded bg-light h-100">
                                                    <h5><i class="fas fa-clinic-medical text-info me-2"></i>UKS</h5>
                                                    <p>Unit Kesehatan Sekolah sebagai tempat pertolongan pertama jika
                                                        siswa mengalami gangguan kesehatan ringan.</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <div class="facility-box p-3 shadow-sm rounded bg-light h-100">
                                                    <h5><i class="fas fa-mosque text-secondary me-2"></i>Musholla</h5>
                                                    <p>Tempat ibadah yang bersih dan nyaman untuk menunjang kegiatan
                                                        keagamaan siswa dan guru.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section-post-share">
                                        <ul class="list-unstyled">
                                            <li>Bagikan:</li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div> <!-- .row -->
    </div> <!-- .container -->

    <div id="scroll-to-top">
        <a href="#topbar"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection
