@extends('layouts.main')

@section('title', $pageTitle ?? 'Berita Sekolah')

@section('content')
    <section class="breadcrumb-section bg-light py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                    @if ($category)
                        <li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">Berita</li>
                    @endif
                </ol>
            </nav>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content-section py-5">
        <div class="container">
            @if ($beritas->count() > 0)
                <!-- Header dengan Filter Kategori -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="section-title mb-3">{{ $pageTitle ?? 'Semua Berita' }}</h2>

                        <!-- Filter Kategori -->
                        <div class="mb-3">
                            <div class="btn-group" role="group">
                                <a href="{{ route('berita.index') }}"
                                    class="btn {{ !$category ? 'btn-primary' : 'btn-outline-primary' }}">
                                    Semua Berita
                                </a>
                                @foreach ($categories as $key => $label)
                                    <a href="{{ route('berita.index', $key) }}"
                                        class="btn {{ $category == $key ? 'btn-primary' : 'btn-outline-primary' }}">
                                        {{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <p class="text-muted">Menampilkan {{ $beritas->count() }} dari {{ $beritas->total() }} berita</p>
                    </div>
                </div>

                <!-- Daftar Berita -->
                <div class="row">
                    @foreach ($beritas as $berita)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card" style="width: 100%;">
                                @if ($berita->image)
                                    <img src="{{ Storage::url($berita->image) }}" class="card-img-top"
                                        alt="{{ $berita->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                        style="height: 200px;">
                                        <i class="fas fa-image text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                @endif

                                <div class="card-body">
                                    <!-- Category Badge -->
                                    <span class="badge bg-primary mb-2">{{ $berita->category_name }}</span>

                                    <!-- Title -->
                                    <h5 class="card-title">{{ Str::limit($berita->title, 60) }}</h5>

                                    <!-- Excerpt -->
                                    <p class="card-text">{{ Str::limit(strip_tags($berita->content), 100) }}</p>

                                    <!-- Meta Info -->
                                    <small class="text-muted d-block mb-3">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $berita->created_at->format('d M Y') }}
                                    </small>

                                    <!-- Read More Button -->
                                    <a href="{{ route('berita.show', [$berita->category, $berita->slug]) }}"
                                        class="btn btn-primary">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($beritas->hasPages())
                    <div class="row mt-5">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $beritas->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="row">
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper text-muted mb-3" style="font-size: 4rem;"></i>
                            <h3 class="text-muted mb-3">Belum Ada Berita</h3>
                            <p class="text-muted mb-4">
                                Belum ada {{ strtolower($pageTitle ?? 'berita') }} yang dipublikasikan
                            </p>
                            <a href="{{ url('/') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

<style>
    .section-title {
        color: var(--primary);
        font-weight: 600;
        position: relative;
        padding-bottom: 10px;
    }

    .section-title::after {
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

    .card {
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }
</style>
