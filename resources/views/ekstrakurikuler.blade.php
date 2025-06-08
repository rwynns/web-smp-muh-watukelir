@extends('layouts.main')
@section('content')
    <section>
        <div class="breadcrumb-box clearfix">
            <div class="container">
                <div class="breadcrumb-title">
                    <h3>Prestasi</h3>
                    <p>Kumpulan Prestasi Siswa dan Sekolah - SMP Muhammadiyah Watukelir</p>
                </div>
                <nav aria-label="Page breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Prestasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section id="sarana-prasarana" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary">Sarana dan Prasarana</h2>
                <p class="text-muted">Fasilitas unggulan SMP Muhammadiyah Watukelir dalam menunjang proses
                    pembelajaran.</p>
            </div>
            <div class="row g-4">
                <!-- Fasilitas -->
                <div class="col-md-4">
                    <a href="detail-post.html" class="text-decoration-none">
                        <div class="card shadow-sm h-100 text-center border-0">
                            <div class="card-body">
                                <div class="mb-3 text-primary fs-1"><i class="fas fa-school"></i></div>
                                <h5 class="card-title">Ruang Kelas</h5>
                                <p class="card-text text-muted">Nyaman, ber-AC, dan dilengkapi sarana multimedia.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="detail-post.html" class="text-decoration-none">
                        <div class="card shadow-sm h-100 text-center border-0">
                            <div class="card-body">
                                <div class="mb-3 text-success fs-1"><i class="fas fa-desktop"></i></div>
                                <h5 class="card-title">Lab Komputer</h5>
                                <p class="card-text text-muted">Fasilitas lengkap untuk mendukung pembelajaran TIK.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="detail-post.html" class="text-decoration-none">
                        <div class="card shadow-sm h-100 text-center border-0">
                            <div class="card-body">
                                <div class="mb-3 text-warning fs-1"><i class="fas fa-book-reader"></i></div>
                                <h5 class="card-title">Perpustakaan</h5>
                                <p class="card-text text-muted">Beragam koleksi buku dan literasi digital untuk siswa.
                                </p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="detail-post.html" class="text-decoration-none">
                        <div class="card shadow-sm h-100 text-center border-0">
                            <div class="card-body">
                                <div class="mb-3 text-danger fs-1"><i class="fas fa-dumbbell"></i></div>
                                <h5 class="card-title">Lapangan Olahraga</h5>
                                <p class="card-text text-muted">Fasilitas untuk mendukung aktivitas jasmani dan
                                    ekstrakurikuler.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="detail-post.html" class="text-decoration-none">
                        <div class="card shadow-sm h-100 text-center border-0">
                            <div class="card-body">
                                <div class="mb-3 text-info fs-1"><i class="fas fa-mosque"></i></div>
                                <h5 class="card-title">Musholla</h5>
                                <p class="card-text text-muted">Tempat ibadah yang nyaman bagi warga sekolah.</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a href="detail-post.html" class="text-decoration-none">
                        <div class="card shadow-sm h-100 text-center border-0">
                            <div class="card-body">
                                <div class="mb-3 text-danger fs-1"><i class="fas fa-clinic-medical"></i></div>
                                <h5 class="card-title">UKS</h5>
                                <p class="card-text text-muted">Unit Kesehatan Sekolah sebagai penunjang layanan
                                    kesehatan siswa.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>



    </div>

    <div id="scroll-to-top">
        <a href="#topbar"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection
