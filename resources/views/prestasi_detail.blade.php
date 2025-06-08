@extends('layouts.main')

@section('title', $prestasi->title . ' - Prestasi SMP Muhammadiyah Watukelir')

@section('content')
    <section>
        <div class="breadcrumb-box clearfix">
            <div class="container">
                <div class="breadcrumb-title">
                    <h3>{{ Str::limit($prestasi->title, 80) }}</h3>
                </div>
                <nav aria-label="Page breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('prestasi.index') }}">Prestasi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="konten">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8 col-md-12">
                    <article class="prestasi-detail-card">
                        <!-- Article Header -->
                        <div class="article-header mb-4">
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge badge-warning badge-lg">
                                    <i class="fas fa-trophy me-1"></i> Prestasi Sekolah
                                </span>
                                <span class="badge badge-secondary badge-lg">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $prestasi->created_at->format('d F Y') }}
                                </span>
                            </div>

                            <h1 class="article-title">{{ $prestasi->title }}</h1>

                            <div class="article-meta mt-3">
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fas fa-user-edit me-2"></i>
                                    <span>Dipublikasikan oleh <strong>{{ $prestasi->user->name ?? 'Admin' }}</strong></span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $prestasi->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image & Gallery -->
                        @if ($prestasi->image)
                            <div class="article-featured-image mb-4">
                                <div class="image-container">
                                    <img src="{{ Storage::url($prestasi->image) }}" alt="{{ $prestasi->title }}"
                                        class="img-fluid rounded shadow-sm main-prestasi-image" data-bs-toggle="modal"
                                        data-bs-target="#imageModal">
                                </div>
                            </div>
                        @endif
                        <!-- Article Content -->
                        <div class="article-content">
                            <div class="content-body">
                                {!! $prestasi->content !!}
                            </div>
                        </div>

                        <!-- Share Section -->
                        <div class="article-share mt-5 pt-4 border-top">
                            <h6 class="mb-3"><i class="fas fa-share-alt me-2"></i>Bagikan Prestasi Ini</h6>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                    target="_blank" class="btn btn-facebook btn-sm">
                                    <i class="fab fa-facebook-f me-1"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($prestasi->title) }}"
                                    target="_blank" class="btn btn-twitter btn-sm">
                                    <i class="fab fa-twitter me-1"></i> Twitter
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($prestasi->title . ' - ' . request()->fullUrl()) }}"
                                    target="_blank" class="btn btn-whatsapp btn-sm">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>
                                <button type="button" class="btn btn-secondary btn-sm" onclick="copyToClipboard()">
                                    <i class="fas fa-copy me-1"></i> Copy Link
                                </button>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="article-navigation mt-5 pt-4 border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('prestasi.index') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Prestasi
                                    </a>
                                </div>
                                <div class="col-md-6 text-md-end mt-2 mt-md-0">
                                    <a href="{{ url('/') }}" class="btn btn-primary">
                                        <i class="fas fa-home me-1"></i> Beranda
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
                    <!-- Related Prestasi -->
                    @if ($relatedPrestasi->count() > 0)
                        <div class="widget">
                            <div class="widget-header">
                                <h5><i class="fas fa-trophy me-2"></i>Prestasi Terkait</h5>
                            </div>
                            <div class="widget-body">
                                @foreach ($relatedPrestasi as $related)
                                    <div class="related-item">
                                        <div class="row">
                                            <div class="col-4">
                                                @if ($related->image)
                                                    <img src="{{ Storage::url($related->image) }}"
                                                        alt="{{ $related->title }}"
                                                        class="img-fluid rounded related-image">
                                                @else
                                                    <div class="related-placeholder">
                                                        <i class="fas fa-trophy text-warning"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-8">
                                                <h6 class="related-title">
                                                    <a href="{{ route('prestasi.show', $related->slug) }}">
                                                        {{ Str::limit($related->title, 50) }}
                                                    </a>
                                                </h6>
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $related->created_at->format('d M Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Quick Info -->
                    <div class="widget">
                        <div class="widget-header">
                            <h5><i class="fas fa-info-circle me-2"></i>Informasi</h5>
                        </div>
                        <div class="widget-body">
                            <div class="info-item">
                                <strong>Tanggal Publikasi:</strong><br>
                                <span class="text-muted">{{ $prestasi->created_at->format('d F Y, H:i') }} WIB</span>
                            </div>
                            <div class="info-item">
                                <strong>Dipublikasikan oleh:</strong><br>
                                <span class="text-muted">{{ $prestasi->user->name ?? 'Admin' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="widget">
                        <div class="widget-header">
                            <h5><i class="fas fa-phone me-2"></i>Hubungi Kami</h5>
                        </div>
                        <div class="widget-body">
                            <p class="text-muted mb-3">Ingin tahu lebih lanjut tentang prestasi ini?</p>
                            <div class="contact-item">
                                <i class="fas fa-phone text-primary me-2"></i>
                                <span>(0274) 123-456</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <span>info@smpmuhwatukelir.sch.id</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                <span>Watukelir, Banguntapan, Bantul</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ $prestasi->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    @if ($prestasi->image)
                        <img src="{{ Storage::url($prestasi->image) }}" alt="{{ $prestasi->title }}" class="img-fluid">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .prestasi-detail-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .article-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #2c3e50;
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        .badge-lg {
            padding: 0.5rem 0.8rem;
            font-size: 0.85rem;
        }

        .image-container {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            cursor: pointer;
        }

        .main-prestasi-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-container:hover .image-overlay {
            opacity: 1;
        }

        .image-container:hover .main-prestasi-image {
            transform: scale(1.05);
        }

        .content-body {
            line-height: 1.8;
            font-size: 1.1rem;
            color: #444;
        }

        .content-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .content-body p {
            margin-bottom: 1.2rem;
        }

        .content-body h1,
        .content-body h2,
        .content-body h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .share-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .btn-facebook {
            background-color: #3b5998;
            border-color: #3b5998;
            color: white;
        }

        .btn-twitter {
            background-color: #1da1f2;
            border-color: #1da1f2;
            color: white;
        }

        .btn-whatsapp {
            background-color: #25d366;
            border-color: #25d366;
            color: white;
        }

        .widget {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .widget-header h5 {
            margin-bottom: 1rem;
            color: #2c3e50;
            font-weight: 600;
        }

        .related-item {
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .related-item:last-child {
            border-bottom: none;
        }

        .related-image {
            width: 100%;
            height: 60px;
            object-fit: cover;
        }

        .related-placeholder {
            width: 100%;
            height: 60px;
            background: #f8f9fa;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .related-title a {
            color: #2c3e50;
            text-decoration: none;
            font-weight: 500;
        }

        .related-title a:hover {
            color: #007bff;
        }

        .info-item {
            margin-bottom: 1rem;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .contact-item {
            margin-bottom: 0.8rem;
        }

        .contact-item:last-child {
            margin-bottom: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .prestasi-detail-card {
                padding: 1.5rem;
            }

            .article-title {
                font-size: 1.8rem;
            }

            .main-prestasi-image {
                height: 250px;
            }

            .share-buttons {
                justify-content: center;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Copy to clipboard function
        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(function() {
                // Show success message
                const button = event.target.closest('button');
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check me-1"></i> Tersalin!';
                button.classList.remove('btn-secondary');
                button.classList.add('btn-success');

                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('btn-success');
                    button.classList.add('btn-secondary');
                }, 2000);
            }).catch(function(err) {
                console.error('Gagal menyalin: ', err);
                alert('Gagal menyalin link. Silakan copy manual: ' + url);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Image lazy loading effect
            const images = document.querySelectorAll('.content-body img');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.style.opacity = '0';
                    this.style.animation = 'fadeIn 0.5s ease-in-out forwards';
                });
            });

            // Add fade in animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    to {
                        opacity: 1;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endsection
