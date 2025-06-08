@extends('layouts.main')

@section('title', $berita->title)

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section bg-light py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('berita.index', $berita->category) }}">{{ $berita->category_name }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($berita->title, 50) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content-section py-5">
        <div class="container">
            <div class="row">
                <!-- Article Content -->
                <div class="col-lg-8">
                    <!-- Article Header -->
                    <div class="article-header mb-4">
                        <span class="badge bg-primary mb-3">{{ $berita->category_name }}</span>
                        <h1 class="article-title mb-3">{{ $berita->title }}</h1>
                        <div class="article-meta text-muted mb-4">
                            <small>
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $berita->created_at->format('d F Y') }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-clock me-1"></i>
                                {{ $berita->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if ($berita->image)
                        <div class="article-image mb-4">
                            <img src="{{ Storage::url($berita->image) }}" class="img-fluid rounded shadow-sm"
                                alt="{{ $berita->title }}" style="width: 100%; max-height: 400px; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Article Body -->
                    <div class="article-content">
                        {!! $berita->content !!}
                    </div>

                    <!-- Article Footer -->
                    <div class="article-footer mt-5 pt-4 border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    Dipublikasikan {{ $berita->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('berita.index', $berita->category) }}"
                                    class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Kembali ke {{ $berita->category_name }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Berita Terbaru -->
                    @if ($relatedNews->count() > 0)
                        <div class="sidebar-section mb-4">
                            <h5 class="sidebar-title mb-3">{{ $berita->category_name }} Terbaru</h5>
                            @foreach ($relatedNews as $related)
                                <div class="card mb-3 border-0 shadow-sm">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            @if ($related->image)
                                                <img src="{{ Storage::url($related->image) }}"
                                                    class="img-fluid rounded-start"
                                                    style="height: 80px; object-fit: cover; width: 100%;"
                                                    alt="{{ $related->title }}">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center rounded-start"
                                                    style="height: 80px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body p-2">
                                                <h6 class="card-title mb-1" style="font-size: 0.9rem;">
                                                    <a href="{{ route('berita.show', [$related->category, $related->slug]) }}"
                                                        class="text-decoration-none text-dark">
                                                        {{ Str::limit($related->title, 60) }}
                                                    </a>
                                                </h6>
                                                <small class="text-muted">
                                                    {{ $related->created_at->format('d M Y') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-center">
                                <a href="{{ route('berita.index', $berita->category) }}" class="btn btn-primary btn-sm">
                                    Lihat Semua {{ $berita->category_name }}
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Kategori -->
                    <div class="sidebar-section">
                        <h5 class="sidebar-title mb-3">Kategori Berita</h5>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('berita.index', 'berita_sekolah') }}"
                                class="list-group-item list-group-item-action border-0 px-0 {{ $berita->category == 'berita_sekolah' ? 'active' : '' }}">
                                <i class="fas fa-school me-2 text-primary"></i>
                                Berita Sekolah
                            </a>
                            <a href="{{ route('berita.index', 'pengumuman') }}"
                                class="list-group-item list-group-item-action border-0 px-0 {{ $berita->category == 'pengumuman' ? 'active' : '' }}">
                                <i class="fas fa-bullhorn me-2 text-primary"></i>
                                Pengumuman
                            </a>
                            <a href="{{ route('berita.index', 'agenda') }}"
                                class="list-group-item list-group-item-action border-0 px-0 {{ $berita->category == 'agenda' ? 'active' : '' }}">
                                <i class="fas fa-calendar me-2 text-primary"></i>
                                Agenda
                            </a>
                            <a href="{{ route('berita.index', 'prestasi') }}"
                                class="list-group-item list-group-item-action border-0 px-0 {{ $berita->category == 'prestasi' ? 'active' : '' }}">
                                <i class="fas fa-trophy me-2 text-primary"></i>
                                Prestasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Same CSS styles as before -->
    <style>
        /* Konsisten dengan styling berita_sekolah.blade.php */
        .section-title,
        .sidebar-title {
            color: var(--primary);
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after,
        .sidebar-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary);
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: var(--primary);
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        /* Article specific styles */
        .article-title {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1.2;
            color: #333;
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4,
        .article-content h5,
        .article-content h6 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #333;
            font-weight: 600;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1.5rem 0;
        }

        .article-content blockquote {
            padding: 1rem 1.5rem;
            border-left: 4px solid var(--primary);
            background-color: #f8f9fa;
            margin: 1.5rem 0;
            font-style: italic;
        }

        .article-content ul,
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .article-content strong {
            font-weight: 600;
        }

        .article-content em {
            font-style: italic;
        }

        /* Sidebar styles */
        .sidebar-section {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
            border: 1px solid #e9ecef;
        }

        .sidebar-section .card {
            transition: transform 0.2s ease;
        }

        .sidebar-section .card:hover {
            transform: translateY(-2px);
        }

        .list-group-item:hover {
            background-color: rgba(var(--primary-rgb), 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .article-title {
                font-size: 1.8rem;
            }

            .article-content {
                font-size: 1rem;
            }

            .sidebar-section {
                margin-top: 3rem;
            }
        }
    </style>
@endsection
