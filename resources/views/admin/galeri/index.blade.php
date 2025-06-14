@extends('layouts.dashboard')

@section('title', 'Manajemen Galeri')
@section('page-title', 'Manajemen Galeri')

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-images me-2"></i>Galeri Foto</h5>
            <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Foto
            </a>
        </div>

        <div class="content-card-body">
            <!-- Filter dan Pencarian -->
            <div class="row mb-4 g-3">
                <div class="col-md-8">
                    <form action="{{ route('admin.galeri.index') }}" method="GET" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari judul gambar..." name="search"
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        @if (request('search'))
                            <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="col-md-4 text-md-end">
                    <div class="text-muted small pt-2">
                        Menampilkan {{ $galeri->firstItem() ?? 0 }} - {{ $galeri->lastItem() ?? 0 }} dari
                        {{ $galeri->total() }} gambar
                    </div>
                </div>
            </div>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Galeri Grid -->
            <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-4">
                @forelse ($galeri as $item)
                    <div class="col">
                        <div class="card h-100">
                            <div class="position-relative">
                                <img src="{{ $item->gambar_url }}" class="card-img-top" alt="{{ $item->judul }}"
                                    style="height: 200px; object-fit: cover;">

                                <!-- Overlay with actions -->
                                <div class="position-absolute top-0 end-0 p-2">
                                    <div class="btn-group">
                                        <!-- Tambahkan tombol edit di sini -->
                                        <a href="{{ route('admin.galeri.edit', $item) }}" class="btn btn-sm btn-warning"
                                            data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Tombol delete yang sudah ada -->
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $item->id }}" data-judul="{{ $item->judul }}"
                                            data-bs-toggle="tooltip" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <h6 class="card-title text-truncate" data-bs-toggle="tooltip" title="{{ $item->judul }}">
                                    {{ $item->judul }}
                                </h6>
                                <p class="card-text">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        {{ $item->created_at->format('d M Y') }}
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-center min-vh-50 py-5">
                            <div class="text-center">
                                <i class="fas fa-images fa-3x text-secondary mb-3"></i>
                                <h5>Belum Ada Foto</h5>
                                <p class="text-muted">Silakan tambahkan foto untuk ditampilkan di galeri website</p>
                                <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-plus me-1"></i> Tambah Foto
                                </a>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="content-card-footer">
            <div class="d-flex justify-content-center">
                {{ $galeri->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <!-- Form for delete submission -->
    <form id="delete-form" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltips.forEach(tooltip => {
                new bootstrap.Tooltip(tooltip);
            });

            // Delete button click handler
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const judul = this.dataset.judul;

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `Apakah Anda yakin ingin menghapus foto "${judul}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('delete-form');
                            form.action = `{{ url('admin/galeri') }}/${id}`;
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
