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
                        <p>Silahkan anda bisa akses <a href="{{ url('/ppdb') }}">ppdb.smpmuhkelir</a>untuk mendapatkan semua
                            informasi terkait pendaftaran PPDB tahun ajaran 2025/2026 SMP MUHAMMADIYAH WATUKELIR.</p>
                        <a href="{{ url('/ppdb') }}" class="btn btn-utama">Daftar PPDB</a>
                    </div>
                </div>
                <div class="hero-area-item">
                    <img class="img-fluid" src="{{ asset('img/berita22.jpg') }}" alt="Banner Slider 1">
                    <div class="hero-area-content">
                        <h2>Selamat Datang di Website Resmi SMP Muhammadiyah Watukelir</h2>
                        <p>Sekolah yang membentuk karakter unggul, berakhlak mulia, dan berwawasan global</p>
                        <a href="{{ url('/profile') }}" class="btn btn-utama">Lihat Profil Sekolah</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sambutan">
        <div class="container">
            <h2 class="text-center mb-4">PROFIL SMP MUHAMMADIYAH WATUKELIR</h2>
            <div class="row align-items-center">
                <!-- Kolom Gambar -->
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('img/fotokosong.jpg') }}" alt="Profil Sekolah" width="410"
                        class="img-fluid rounded" />
                </div>

                <!-- Kolom Sambutan -->
                <div class="col-md-6">
                    <h4><strong>Sambutan Kepala Sekolah</strong></h4>
                    <p style="text-align: justify;">
                        Assalamu’alaikum Warahmatullahi Wabarakatuh. Segala puji syukur kita panjatkan ke hadirat Allah SWT
                        atas segala limpahan rahmat dan karunia-Nya. Shalawat serta salam semoga tercurah kepada Nabi
                        Muhammad SAW, suri teladan kita semua.
                        Selamat datang di website resmi SMP Muhammadiyah Watukelir. Website ini kami hadirkan sebagai sarana
                        informasi dan komunikasi antara sekolah dengan masyarakat, khususnya para orang tua, peserta didik,
                        dan seluruh pihak yang ingin mengetahui lebih jauh tentang profil dan perkembangan sekolah kami.
                        Sebagai sekolah yang berada di bawah naungan Persyarikatan Muhammadiyah, kami berkomitmen untuk
                        mewujudkan generasi yang unggul dalam iman, ilmu, dan akhlak mulia, serta mampu menghadapi tantangan
                        zaman dengan bekal karakter yang kuat dan wawasan global.
                        Kami percaya bahwa pendidikan berkualitas tidak hanya mengedepankan aspek akademik, namun juga
                        pembentukan karakter Islami yang holistik. Melalui berbagai kegiatan kurikuler dan ekstrakurikuler,
                        kami senantiasa menumbuhkan semangat belajar, kepedulian sosial, dan nilai-nilai keislaman dalam
                        diri setiap siswa.
                        Akhir kata, kami mengucapkan terima kasih atas kepercayaan dan dukungan semua pihak. Semoga website
                        ini bermanfaat dan menjadi jendela informasi yang terbuka bagi semua. Wassalamu’alaikum
                        Warahmatullahi Wabarakatuh.
                    </p>
                    <p>
                        <strong>Kepala Sekolah<br>
                            SMP Muhammadiyah Watukelir</strong>
                    </p>
                </div>
            </div>
        </div>
    </section>


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
                    @forelse($prestasiTerbaru as $item)
                        <div class="col-md-4 mb-4">
                            <a href="{{ route('prestasi.show', $item->slug) }}">
                                @if ($item->image)
                                    <img class="section-item-thumbnail" src="{{ Storage::url($item->image) }}"
                                        alt="{{ $item->title }}">
                                @else
                                    <img class="section-item-thumbnail" src="{{ asset('images/default-prestasi.jpg') }}"
                                        alt="{{ $item->title }}">
                                @endif
                            </a>
                            <div class="section-item-title mt-2">
                                <a href="{{ route('prestasi.show', $item->slug) }}">
                                    <h5>{{ Str::limit($item->title, 60) }}</h5>
                                </a>
                                <div class="section-item-meta">
                                    <span><i class="far fa-calendar-alt"></i>
                                        {{ $item->created_at->format('d M Y') }}</span><br>
                                </div>
                            </div>
                            <div class="section-item-body">
                                <p>{{ Str::limit($item->excerpt ?: strip_tags($item->content), 120) }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada prestasi yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tombol-selengkapnya text-center mt-3">
                <a href="{{ route('prestasi.index') }}" class="btn btn-more">Lihat Prestasi Lainnya</a>
            </div>
        </div>
    </section>


    <section id="ekstrakulikuler">
        <div class="container">
            <div class="section-title">
                <h2>Ekstrakurikuler</h2>
            </div>
            <div class="section-body">
                <div class="row">
                    @forelse($ekstrakurikuler as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="ekstrakurikuler-card"
                                onclick="showEkstrakurikulerModal('{{ $item->nama }}', '{{ $item->deskripsi }}', '{{ $item->logo_url }}')"
                                style="cursor: pointer;">
                                <div class="ekstrakurikuler-card-content">
                                    @if ($item->logo_path)
                                        <div class="ekstrakurikuler-logo">
                                            <img src="{{ asset('storage/' . $item->logo_path) }}"
                                                alt="{{ $item->nama }}" class="ekstrakurikuler-logo-img">
                                        </div>
                                    @endif
                                    <div class="ekstrakurikuler-title">
                                        <h4>{{ $item->nama }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada ekstrakurikuler yang tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Modal Ekstrakurikuler -->
        <div class="modal fade" id="ekstrakurikulerModal" tabindex="-1" aria-labelledby="ekstrakurikulerModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ekstrakurikulerModalLabel">Detail Ekstrakurikuler</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3 text-center" id="modalLogoContainer" style="display: none;">
                                <img id="modalLogo" src="" alt="" class="img-fluid rounded mb-3"
                                    style="max-width: 100px;">
                            </div>
                            <div class="col-md-12" id="modalContentFull">
                                <h4 id="modalTitle" class="mb-3"></h4>
                                <p id="modalDescription" style="text-align: justify; line-height: 1.6;"></p>
                            </div>
                            <div class="col-md-9" id="modalContentWithLogo" style="display: none;">
                                <h4 id="modalTitleWithLogo" class="mb-3"></h4>
                                <p id="modalDescriptionWithLogo" style="text-align: justify; line-height: 1.6;"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function showEkstrakurikulerModal(nama, deskripsi, logoUrl) {
            // Set modal title and description
            document.getElementById('modalTitle').textContent = nama;
            document.getElementById('modalDescription').textContent = deskripsi;
            document.getElementById('modalTitleWithLogo').textContent = nama;
            document.getElementById('modalDescriptionWithLogo').textContent = deskripsi;

            // Handle logo display
            if (logoUrl && logoUrl !== 'null' && logoUrl !== '') {
                document.getElementById('modalLogo').src = logoUrl;
                document.getElementById('modalLogo').alt = nama + ' Logo';
                document.getElementById('modalLogoContainer').style.display = 'block';
                document.getElementById('modalContentFull').className = 'col-md-9';
                document.getElementById('modalContentWithLogo').style.display = 'block';
                document.getElementById('modalContentFull').style.display = 'none';
            } else {
                document.getElementById('modalLogoContainer').style.display = 'none';
                document.getElementById('modalContentFull').className = 'col-md-12';
                document.getElementById('modalContentWithLogo').style.display = 'none';
                document.getElementById('modalContentFull').style.display = 'block';
            }

            // Show modal
            var modal = new bootstrap.Modal(document.getElementById('ekstrakurikulerModal'));
            modal.show();
        }
    </script>

    <section id="tenaga-pendidik">
        <div class="container">
            <div class="section-title">
                <h2>Tenaga Pendidik</h2>
            </div>
            <div class="section-body">

                <!-- Slider Guru (Data dari Database) -->
                <div id="slider-tools"></div>
                <div class="owl-carousel" id="tenaga-pendidik-slider">
                    @forelse($guruAll as $guru)
                        <div class="section-item-slider">
                            <a href="javascript:void(0);">
                                <img class="foto-guru" src="{{ $guru->foto_url }}" alt="{{ $guru->nama }}">
                            </a>
                            <div class="section-item-caption">
                                <a href="javascript:void(0);">
                                    <h5>{{ $guru->nama }}</h5>
                                </a>
                                <h6>{{ $guru->jabatan_string }}</h6>
                            </div>
                        </div>
                    @empty
                        <div class="section-item-slider">
                            <a href="javascript:void(0);">
                                <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="Tidak ada data">
                            </a>
                            <div class="section-item-caption">
                                <a href="javascript:void(0);">
                                    <h5>Belum ada data guru</h5>
                                </a>
                                <h6>Silakan tambahkan data guru melalui admin panel</h6>
                            </div>
                        </div>
                    @endforelse
                </div>


                <!-- Tampilan Guru Menyusun ke Bawah (Data dari Database) -->
                <div class="row" id="list-guru" style="display: none; padding-top: 20px;">
                    @forelse($guruAll as $guru)
                        <div class="col-md-4 text-center mb-4">
                            <img class="foto-guru" src="{{ $guru->foto_url }}" alt="{{ $guru->nama }}"
                                style="width: 100%; height: auto;">
                            <h5 class="mt-2">{{ $guru->nama }}</h5>
                            <h6>{{ $guru->jabatan_string }}</h6>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i> Belum ada data guru yang tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>



                <!-- Tombol Lihat Semua -->
                <div class="tombol-selengkapnya text-center mt-3">
                    <a href="javascript:void(0);" onclick="tampilkanSemuaGuru(this)" class="btn btn-more"
                        id="btnToggleGuru">Lihat Semua Guru</a>
                </div>

                <script>
                    function tampilkanSemuaGuru(button) {
                        var slider = document.getElementById('tenaga-pendidik-slider');
                        var listGuru = document.getElementById('list-guru');
                        var btnText = document.getElementById('btnToggleGuru');

                        if (slider.style.display !== 'none') {
                            // Sembunyikan slider, tampilkan daftar guru
                            slider.style.display = 'none';
                            listGuru.style.display = 'flex';
                            listGuru.style.flexWrap = 'wrap';
                            btnText.textContent = 'Tutup Daftar Guru';
                        } else {
                            // Tampilkan slider, sembunyikan daftar guru
                            slider.style.display = 'block';
                            listGuru.style.display = 'none';
                            btnText.textContent = 'Lihat Semua Guru';
                        }
                    }
                </script>


                <section id="berita" class="py-5">
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
                                            @if ($berita->image)
                                                <img src="{{ asset('storage/' . $berita->image) }}" class="card-img-top"
                                                    alt="{{ $berita->judul }}">
                                            @else
                                                <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top"
                                                    alt="No Image">
                                            @endif
                                            <div class="berita-badge">
                                                <span>{{ $berita->category_name }}</span>
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
                                                {{ $berita->excerpt ?? 'Tidak ada deskripsi.' }}
                                            </p>
                                        </div>
                                        <div class="card-footer bg-white border-0 pt-0">
                                            <a href="{{ url('/berita/' . ($berita->category ?? 'uncategorized') . '/' . $berita->slug) }}"
                                                class="btn btn-primary btn-sm">
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
