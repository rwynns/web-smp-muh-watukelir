@extends('layouts.main')

@section('title', 'Prestasi - SMP Muhammadiyah Watukelir')

@section('content')
    <section>
        <div class="breadcrumb-box clearfix">
            <div class="container">
                <div class="breadcrumb-title">
                    <h3>Prestasi Sekolah</h3>
                    <p>Kumpulan Prestasi Siswa dan Sekolah - SMP Muhammadiyah Watukelir</p>
                </div>
                <nav aria-label="Page breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Prestasi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <div class="konten">
        <div class="container">
            @if ($prestasi->count() > 0)
                <!-- Header Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-white border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="mb-0">
                                        <i class="fas fa-trophy text-warning mr-2"></i>
                                        Prestasi Terbaru
                                    </h4>
                                    <span class="badge badge-primary">{{ $prestasi->total() }} Prestasi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Search Bar -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body py-3">
                                <form action="{{ route('prestasi.index') }}" method="GET" class="d-flex gap-2">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari prestasi..."
                                            name="search" value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i> Cari
                                            </button>
                                        </div>
                                    </div>
                                    @if (request('search'))
                                        <a href="{{ route('prestasi.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i> Reset
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prestasi Grid -->
                <div class="row">
                    @foreach ($prestasi as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card prestasi-card h-100 shadow-sm">
                                <!-- Image Slideshow Container -->
                                <div class="prestasi-image-container">
                                    @if ($item->image)
                                        <div id="carousel-{{ $item->id }}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <!-- Featured Image -->
                                                <div class="carousel-item active">
                                                    <img src="{{ Storage::url($item->image) }}"
                                                        class="d-block w-100 prestasi-image" alt="{{ $item->title }}">
                                                </div>

                                                <!-- Additional images from content (if any) -->
                                                @php
                                                    preg_match_all(
                                                        '/<img[^>]+src="([^"]+)"/',
                                                        $item->content,
                                                        $matches,
                                                    );
                                                    $contentImages = $matches[1] ?? [];
                                                    $additionalImages = array_slice($contentImages, 0, 4); // Max 4 additional images
                                                @endphp

                                                @foreach ($additionalImages as $imageUrl)
                                                    @if (str_contains($imageUrl, Storage::url('')))
                                                        <div class="carousel-item">
                                                            <img src="{{ $imageUrl }}"
                                                                class="d-block w-100 prestasi-image"
                                                                alt="{{ $item->title }}">
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <!-- Carousel Controls (only show if multiple images) -->
                                            @if (count($additionalImages) > 0)
                                                <a class="carousel-control-prev" href="#carousel-{{ $item->id }}"
                                                    role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel-{{ $item->id }}"
                                                    role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>

                                                <!-- Indicators -->
                                                <ol class="carousel-indicators">
                                                    <li data-target="#carousel-{{ $item->id }}" data-slide-to="0"
                                                        class="active"></li>
                                                    @foreach ($additionalImages as $index => $imageUrl)
                                                        @if (str_contains($imageUrl, Storage::url('')))
                                                            <li data-target="#carousel-{{ $item->id }}"
                                                                data-slide-to="{{ $index + 1 }}"></li>
                                                        @endif
                                                    @endforeach
                                                </ol>
                                            @endif
                                        </div>
                                    @else
                                        <div class="prestasi-image-placeholder">
                                            <i class="fas fa-trophy fa-3x text-warning"></i>
                                            <p class="text-muted mt-2">Tidak ada gambar</p>
                                        </div>
                                    @endif
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <!-- Title -->
                                    <h5 class="card-title mb-2">{{ Str::limit($item->title, 60) }}</h5>

                                    <!-- Excerpt -->
                                    <p class="card-text text-muted mb-3 flex-grow-1">
                                        {{ Str::limit($item->excerpt ?: strip_tags($item->content), 120) }}
                                    </p>

                                    <!-- Meta Info -->
                                    <div class="prestasi-meta mb-3">
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </small>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="mt-auto">
                                        <a href="{{ route('prestasi.show', $item->slug) }}"
                                            class="btn btn-primary btn-block">
                                            <i class="fas fa-eye me-1"></i> Lihat Detail Lengkap
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($prestasi->hasPages())
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                {{ $prestasi->withQueryString()->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-trophy fa-4x text-warning mb-4"></i>
                                <h4 class="text-muted mb-3">Belum Ada Prestasi</h4>
                                <p class="text-muted mb-4">
                                    Belum ada prestasi yang dipublikasikan. Silakan kembali lagi nanti untuk melihat
                                    prestasi terbaru sekolah.
                                </p>
                                <a href="{{ url('/') }}" class="btn btn-primary">
                                    <i class="fas fa-home me-1"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Custom CSS -->
    <style>
        .prestasi-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .prestasi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .prestasi-image-container {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .prestasi-image {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .prestasi-card:hover .prestasi-image {
            transform: scale(1.05);
        }

        .prestasi-image-placeholder {
            height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 10%;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.3), transparent);
        }

        .carousel-control-next {
            background: linear-gradient(to left, rgba(0, 0, 0, 0.3), transparent);
        }

        .carousel-indicators {
            bottom: 10px;
        }

        .carousel-indicators li {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin: 0 3px;
        }

        .prestasi-meta {
            border-top: 1px solid #eee;
            padding-top: 0.75rem;
        }

        .card-title {
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.3;
        }

        .btn-block {
            width: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .prestasi-image-container {
                height: 200px;
            }

            .prestasi-image {
                height: 200px;
            }

            .prestasi-image-placeholder {
                height: 200px;
            }
        }

        /* Search form styling */
        .input-group .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        /* Loading animation for images */
        .prestasi-image {
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all carousels with custom settings
            $('.carousel').carousel({
                interval: 4000,
                pause: 'hover',
                wrap: true
            });

            // Add loading effect for images
            const images = document.querySelectorAll('.prestasi-image');
            images.forEach(img => {
                img.addEventListener('load', function() {
                    this.style.opacity = '1';
                });
            });

            // Add smooth scrolling for pagination
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Scroll to top of content when pagination is clicked
                    setTimeout(() => {
                        document.querySelector('.konten').scrollIntoView({
                            behavior: 'smooth'
                        });
                    }, 100);
                });
            });

            // Enhanced card hover effects
            const cards = document.querySelectorAll('.prestasi-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
@endsection
