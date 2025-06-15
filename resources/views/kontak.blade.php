@extends('layouts.main')

@section('content')
    <section>
        <div class="breadcrumb-box clearfix">
            <div class="container">
                <div class="breadcrumb-title">
                    <h3>Kontak</h3>
                    <p>Hubungi SMP Muhammadiyah Watukelir</p>
                </div>
                <nav aria-label="Page breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Beranda</li>
                        <li class="breadcrumb-item">Kontak</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="konten">
        <div class="container">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4><i class="fas fa-envelope mr-1"></i> Kontak Kami</h4>
                    </div>
                    <div class="card-body">
                        <p>Silakan hubungi kami melalui informasi di bawah ini atau isi formulir kontak untuk pertanyaan
                            lebih lanjut.</p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h5><i class="fas fa-map-marker-alt"></i> Alamat</h5>
                                <p>Watukelir, Jatingarang, Kec. Weru, Kab. Sukoharjo, Jawa Tengah 57562</p>

                                <h5><i class="fas fa-phone"></i> Telepon</h5>
                                <p>0273 5331415</p>

                                <h5><i class="fas fa-envelope"></i> Email</h5>
                                <p><a href="mailto:smpmuhkelir@gmail.com">smpmuhkelir@gmail.com</a></p>

                                <h5><i class="fas fa-map"></i> Lokasi di Peta</h5>
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.123456789!2d110.7686!3d-7.7898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a123456789abc%3A0xabcdef123456789!2sSMP%20Muhammadiyah%20Watukelir!5e0!3m2!1sen!2sid!4v1612345678901!5m2!1sen!2sid"
                                    width="100%" height="300" style="border:0;" allowfullscreen=""
                                    loading="lazy"></iframe>
                            </div>

                            <div class="col-md-6">
                                <h5><i class="fas fa-paper-plane"></i> Formulir Kontak</h5>
                                <form action="#" method="POST">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Pesan</label>
                                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- .card -->
            </div>
        </div> <!-- .container -->
    </div>




    </div>

    <div id="scroll-to-top">
        <a href="#topbar"><i class="fas fa-angle-up"></i></a>
    </div>

    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe.
              It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides.
                            PhotoSwipe keeps only 3 of them in the DOM to save memory.
                            Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">
                <div class="pswp__top-bar">
                    <!--  Controls are self-explanatory. Order can be changed. -->
                    <div class="pswp__counter"></div>
                    <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--share" title="Share"></button>
                    <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                    <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                    <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                    <!-- element will get class pswp__preloader--active when preloader is running -->
                    <div class="pswp__preloader">
                        <div class="pswp__preloader__icn">
                            <div class="pswp__preloader__cut">
                                <div class="pswp__preloader__donut"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>
                <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                </button>
                <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                </button>
                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="scroll-to-top">
        <a href="#topbar"><i class="fas fa-angle-up"></i></a>
    </div>
@endsection
