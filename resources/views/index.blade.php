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
                <img src="{{ asset('img/fotokosong.jpg') }}" alt="Profil Sekolah" width="410" class="img-fluid rounded" />
            </div>

            <!-- Kolom Sambutan -->
            <div class="col-md-6">
                <h4><strong>Sambutan Kepala Sekolah</strong></h4>
                <p style="text-align: justify;">
                    Assalamu’alaikum Warahmatullahi Wabarakatuh. Segala puji syukur kita panjatkan ke hadirat Allah SWT atas segala limpahan rahmat dan karunia-Nya. Shalawat serta salam semoga tercurah kepada Nabi Muhammad SAW, suri teladan kita semua.
                    Selamat datang di website resmi SMP Muhammadiyah Watukelir. Website ini kami hadirkan sebagai sarana informasi dan komunikasi antara sekolah dengan masyarakat, khususnya para orang tua, peserta didik, dan seluruh pihak yang ingin mengetahui lebih jauh tentang profil dan perkembangan sekolah kami.
                    Sebagai sekolah yang berada di bawah naungan Persyarikatan Muhammadiyah, kami berkomitmen untuk mewujudkan generasi yang unggul dalam iman, ilmu, dan akhlak mulia, serta mampu menghadapi tantangan zaman dengan bekal karakter yang kuat dan wawasan global. 
                    Kami percaya bahwa pendidikan berkualitas tidak hanya mengedepankan aspek akademik, namun juga pembentukan karakter Islami yang holistik. Melalui berbagai kegiatan kurikuler dan ekstrakurikuler, kami senantiasa menumbuhkan semangat belajar, kepedulian sosial, dan nilai-nilai keislaman dalam diri setiap siswa.
                    Akhir kata, kami mengucapkan terima kasih atas kepercayaan dan dukungan semua pihak. Semoga website ini bermanfaat dan menjadi jendela informasi yang terbuka bagi semua. Wassalamu’alaikum Warahmatullahi Wabarakatuh.
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
                <!-- Prestasi 1 -->
                <div class="col-md-4 mb-4">
                    <a href="{{ url('/prestasi') }}">
                        <img class="section-item-thumbnail" src="{{ asset('img/prestasi1.webp') }}" alt="">
                    </a>
                    <div class="section-item-title mt-2">
                        <a href="{{ url('/prestasi') }}">
                            <h5>Meraih Medali Perak Pada Cabang Tapak Suci Di Ajang Olympicad 2025!</h5>
                        </a>
                        <div class="section-item-meta">
                            <span><i class="far fa-calendar-alt"></i> 2025</span><br>
                            <span><i class="fas fa-map-marked-alt"></i> </span>
                        </div>
                    </div>
                    <div class="section-item-body">
                        <p>Tiga siswa terbaik SMP Muhammadiyah Watukelir berhasil meraih medali perak dalam cabang Tapak Suci pada Olympicad 2025.</p>
                    </div>
                </div>

                <!-- Prestasi 2 -->
                <div class="col-md-4 mb-4">
                    <a href="{{ url('/prestasi') }}">
                        <img class="section-item-thumbnail" src="{{ asset('img/prestasi2.webp') }}" alt="">
                    </a>
                    <div class="section-item-title mt-2">
                        <a href="{{ url('/prestasi') }}">
                            <h5>Meraih Medali Perunggu Cabang Mipa Olympicad 2025</h5>
                        </a>
                        <div class="section-item-meta">
                            <span><i class="far fa-calendar-alt"></i> 15 mei, 2025</span><br>
                            <span><i class="fas fa-map-marked-alt"></i> Sragen, Jawa Tengah</span>
                        </div>
                    </div>
                    <div class="section-item-body">
                        <p>🎉 Selamat dan Sukses! 🏆
SMP Muhammadiyah Watukelir kembali menorehkan prestasi membanggakan! Tiga siswi terbaik kami — Alifa Nadayanti, Hadifa Fakhira, dan Leyvlia Artnezta — berhasil meraih Medali Perunggu dalam Cabang MIPA pada ajang Olympicad 2025.</p>
                    </div>
                </div>

                <!-- Prestasi 3 -->
                <div class="col-md-4 mb-4">
                    <a href="{{ url('/prestasi') }}">
                        <img class="section-item-thumbnail" src="{{ asset('img/prestasi3.jpg') }}" alt="">
                    </a>
                    <div class="section-item-title mt-2">
                        <a href="{{ url('/prestasi') }}">
                            <h5>JTim GSI SMP Muhammadiyah Watukelir Raih Juara III Tingkat Kabupaten Sukoharjo 2024</h5>
                        </a>
                        <div class="section-item-meta">
                            <span><i class="far fa-calendar-alt"></i> 5 Mei, 2025</span><br>
                            <span><i class="fas fa-map-marked-alt"></i> Solo, Jawa Tengah</span>
                        </div>
                    </div>
                    <div class="section-item-body">
                        <p>SMP Muhammadiyah Watukelir kembali mengukir prestasi membanggakan di dunia olahraga! Dalam ajang Gala Siswa Indonesia (GSI) SMP Tingkat Kabupaten Sukoharjo Tahun 2024, tim GSI Kecamatan Weru yang diperkuat oleh siswa-siswa terbaik kami — Ramadian, Rizal, dan Fadhil — berhasil meraih Juara III (tiga)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tombol-selengkapnya text-center mt-3">
            <a href="{{ url('/prestasi') }}" class="btn btn-more">Lihat Prestasi Lainnya</a>
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

                <!-- Hizbul Wathan -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="javascript:void(0);" onclick="toggleDeskripsi('hizbul')">
                        <div class="section-body-item">
                            <div class="row row-2">
                                <div class="col-md-3"><i class="fas fa-compass fa-2x"></i></div>
                                <div class="col-md-9"><h4>Kepanduan Hizbul Wathan (HW)</h4></div>
                            </div>
                        </div>
                    </a>
                    <div id="deskripsi-hizbul" style="display: none; padding-top: 10px;">
                        <p style="text-align: justify;">
                            Hizbul Wathan (HW) adalah organisasi kepanduan Muhammadiyah yang melatih kedisiplinan, cinta tanah air, dan kepemimpinan melalui kegiatan seperti baris-berbaris, penjelajahan, dan kegiatan sosial.
                        </p>
                    </div>
                </div>

                <!-- Tapak Suci -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="javascript:void(0);" onclick="toggleDeskripsi('tapaksuci')">
                        <div class="section-body-item">
                            <div class="row row-2">
                                <div class="col-md-3"><i class="fas fa-fist-raised fa-2x"></i></div>
                                <div class="col-md-9"><h4>Tapak Suci Putera Muhammadiyah (TSPM)</h4></div>
                            </div>
                        </div>
                    </a>
                    <div id="deskripsi-tapaksuci" style="display: none; padding-top: 10px;">
                        <p style="text-align: justify;">
                            Tapak Suci adalah perguruan pencak silat Muhammadiyah yang mengajarkan bela diri sekaligus membentuk karakter berani, disiplin, dan berbudi luhur melalui latihan fisik dan spiritual.
                        </p>
                    </div>
                </div>

                <!-- PMR -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="javascript:void(0);" onclick="toggleDeskripsi('pmr')">
                        <div class="section-body-item">
                            <div class="row row-2">
                                <div class="col-md-3"><i class="fas fa-briefcase-medical fa-2x"></i></div>
                                <div class="col-md-9"><h4>Palang Merah Remaja (PMR)</h4></div>
                            </div>
                        </div>
                    </a>
                    <div id="deskripsi-pmr" style="display: none; padding-top: 10px;">
                        <p style="text-align: justify;">
                            PMR adalah kegiatan ekstrakurikuler yang melatih siswa dalam pertolongan pertama, kepedulian sosial, dan hidup sehat sebagai bagian dari pendidikan kemanusiaan sejak dini.
                        </p>
                    </div>
                </div>

                <!-- Futsal -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="javascript:void(0);" onclick="toggleDeskripsi('futsal')">
                        <div class="section-body-item">
                            <div class="row row-2">
                                <div class="col-md-3"><i class="fas fa-futbol fa-2x"></i></div>
                                <div class="col-md-9"><h4>Futsal</h4></div>
                            </div>
                        </div>
                    </a>
                    <div id="deskripsi-futsal" style="display: none; padding-top: 10px;">
                        <p style="text-align: justify;">
                            Futsal adalah olahraga yang mengasah kekompakan tim, kebugaran fisik, dan strategi permainan. Ekstrakurikuler ini juga membentuk semangat sportivitas dan kerja sama antar siswa.
                        </p>
                    </div>
                </div>

                <!-- Paskibra -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="javascript:void(0);" onclick="toggleDeskripsi('paskibra')">
                        <div class="section-body-item">
                            <div class="row row-2">
                                <div class="col-md-3"><i class="fas fa-flag fa-2x"></i></div>
                                <div class="col-md-9"><h4>Paskibra</h4></div>
                            </div>
                        </div>
                    </a>
                    <div id="deskripsi-paskibra" style="display: none; padding-top: 10px;">
                        <p style="text-align: justify;">
                            Paskibra melatih siswa menjadi pribadi yang disiplin dan bertanggung jawab melalui latihan baris-berbaris, upacara, dan kegiatan nasionalisme. Siswa dibina untuk tampil percaya diri dan tertib.
                        </p>
                    </div>
                </div>

                <!-- Seni Tari -->
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="javascript:void(0);" onclick="toggleDeskripsi('senitari')">
                        <div class="section-body-item">
                            <div class="row row-2">
                                <div class="col-md-3"><i class="fas fa-theater-masks fa-2x"></i></div>
                                <div class="col-md-9"><h4>Seni Tari</h4></div>
                            </div>
                        </div>
                    </a>
                    <div id="deskripsi-senitari" style="display: none; padding-top: 10px;">
                        <p style="text-align: justify;">
                            Seni Tari adalah wadah bagi siswa untuk mengekspresikan kreativitas melalui gerak dan irama. Kegiatan ini membina kepercayaan diri, kebudayaan, dan keindahan dalam penampilan seni.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script>
    function toggleDeskripsi(id) {
        var deskripsi = document.getElementById("deskripsi-" + id);
        if (deskripsi.style.display === "none") {
            deskripsi.style.display = "block";
        } else {
            deskripsi.style.display = "none";
        }
    }
</script>


</section>


<section id="tenaga-pendidik">
    <div class="container">
        <div class="section-title">
            <h2>Tenaga Pendidik</h2>
        </div>
        <div class="section-body">

            <!-- Slider Guru (Awal: 3 Guru) -->
            <div id="slider-tools"></div>
<div class="owl-carousel" id="tenaga-pendidik-slider">

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Hasan Azis, S.Pd.I.</h5></a>
            <h6>Kepala Sekolah</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Warsini, S.Pd</h5></a>
            <h6>Bahasa Inggris (7, 8ABD)<br>Wali Kelas 7B</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>May Wardani, S.IPust</h5></a>
            <h6>Pustakawan<br>Bahasa Jawa (9), Prakarya (7, 8C)</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Puput Widha Andani, S.Pd., Gr</h5></a>
            <h6>Bahasa Indonesia (7, 8CD)<br>Wali Kelas 7A, Bendahara BOS</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Heri Kristanto, S.Pd., Gr</h5></a>
            <h6>IPA (9), Bahasa Jawa (8)<br>Wali Kelas 9A, Waka Humas, Tim Kurikulum</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Triyatmi, S.Pd</h5></a>
            <h6>Bahasa Inggris (8C, 9), Bahasa Jawa (7)<br>Wali Kelas 9B, Waka Kesiswaan</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Kartini, S.Pd., Gr</h5></a>
            <h6>Bahasa Indonesia (8AB, 9)<br>Wali Kelas 8B, Bendahara Sekolah</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Asim Tri Cahyani, S.Pd</h5></a>
            <h6>BK (7, 9), Seni (9)<br>Wali Kelas 8A, Waka Kurikulum</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Untia Pungki Rastyanti, S.Pd., G</h5></a>
            <h6>IPA (7, 8)<br>Wali Kelas 9C</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Arizal Mulana Rusdi, S.Pd., Gr</h5></a>
            <h6>Al Islam (7B, 8), Informatika (9)<br>Wali Kelas 9D</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Handayani, S.Pd., Gr</h5></a>
            <h6>Al Islam (7A, 9), Bahasa Arab</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Irfan Nur Hidayat</h5></a>
            <h6>Kemuhammadiyahan, IPS (7)</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Ujang Naser, S.Pd</h5></a>
            <h6>PPKn</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Agus Taqwim Khoiri, S.Pd</h5></a>
            <h6>PJOK</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Nur Fatimah, S.Pd., Gr</h5></a>
            <h6>IPS (8, 9)</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Dwi Eta, S.Pd., M.Sc</h5></a>
            <h6>Matematika (7, 8ABD), Prakarya (8AB)</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Didi Haryanto, S.Pd</h5></a>
            <h6>Matematika (8C, 9)</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Deris Amung Prasetyo</h5></a>
            <h6>Informatika (7, 8)</h6>
        </div>
    </div>

    <div class="section-item-slider">
        <a href="detail-post.html"><img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt=""></a>
        <div class="section-item-caption">
            <a href="detail-post.html"><h5>Sutarno</h5></a>
            <h6>KTU</h6>
        </div>
    </div>

</div>


<!-- Tampilan Guru Menyusun ke Bawah (Disembunyikan Awalnya) -->
<div class="row" id="list-guru" style="display: none; padding-top: 20px;">
    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Hasan Azis, S.Pd.I.</h5>
        <h6>Kepala Sekolah</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Warsini, S.Pd</h5>
        <h6>Bahasa Inggris (7, 8ABD)<br>Wali Kelas 7B</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">May Wardani, S.IPust</h5>
        <h6>Pustakawan<br>Bahasa Jawa (9), Prakarya (7, 8C)</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Puput Widha Andani, S.Pd., Gr</h5>
        <h6>Bahasa Indonesia (7, 8CD)<br>Wali Kelas 7A, Bendahara BOS</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Heri Kristanto, S.Pd., Gr</h5>
        <h6>IPA (9), Bahasa Jawa (8)<br>Wali Kelas 9A, Waka Humas, Tim Kurikulum</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Triyatmi, S.Pd</h5>
        <h6>Bahasa Inggris (8C, 9), Bahasa Jawa (7)<br>Wali Kelas 9B, Waka Kesiswaan</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Kartini, S.Pd., Gr</h5>
        <h6>Bahasa Indonesia (8AB, 9)<br>Wali Kelas 8B, Bendahara Sekolah</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Asim Tri Cahyani, S.Pd</h5>
        <h6>BK (7, 9), Seni (9)<br>Wali Kelas 8A, Waka Kurikulum</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Untia Pungki Rastyanti, S.Pd., G</h5>
        <h6>IPA (7, 8)<br>Wali Kelas 9C</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Arizal Mulana Rusdi, S.Pd., Gr</h5>
        <h6>Al Islam (7B, 8), Informatika (9)<br>Wali Kelas 9D</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Handayani, S.Pd., Gr</h5>
        <h6>Al Islam (7A, 9), Bahasa Arab</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Irfan Nur Hidayat</h5>
        <h6>Kemuhammadiyahan, IPS (7)</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Ujang Naser, S.Pd</h5>
        <h6>PPKn</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Agus Taqwim Khoiri, S.Pd</h5>
        <h6>PJOK</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Nur Fatimah, S.Pd., Gr</h5>
        <h6>IPS (8, 9)</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Dwi Eta, S.Pd., M.Sc</h5>
        <h6>Matematika (7, 8ABD), Prakarya (8AB)</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Didi Haryanto, S.Pd</h5>
        <h6>Matematika (8C, 9)</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Deris Amung Prasetyo</h5>
        <h6>Informatika (7, 8)</h6>
    </div>

    <div class="col-md-4 text-center mb-4">
        <img class="foto-guru" src="{{ asset('img/fotokosong.jpg') }}" alt="" style="width: 100%; height: auto;">
        <h5 class="mt-2">Sutarno</h5>
        <h6>KTU</h6>
    </div>
</div>



       <!-- Tombol Lihat Semua -->
<div class="tombol-selengkapnya text-center mt-3">
    <a href="javascript:void(0);" onclick="tampilkanSemuaGuru(this)" class="btn btn-more" id="btnToggleGuru">Lihat Semua Guru</a>
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
                                    <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top" alt="No Image">
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
