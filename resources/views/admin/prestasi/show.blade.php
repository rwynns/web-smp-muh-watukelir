@extends('layouts.dashboard')

@section('title', 'Detail Prestasi')
@section('page-title', 'Detail Prestasi')

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-trophy me-2"></i>Detail Prestasi</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <a href="{{ route('admin.prestasi.edit', $prestasi) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $prestasi->id }}"
                    data-title="{{ $prestasi->title }}">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
            </div>
        </div>

        <div class="content-card-body">
            <div class="row">
                <div class="col-md-10">
                    <h1 class="article-title mb-3">{{ $prestasi->title }}</h1>

                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span class="badge bg-warning text-dark p-2">
                            <i class="fas fa-trophy me-1"></i> Prestasi Sekolah
                        </span>

                        <span class="badge bg-secondary p-2">
                            <i class="fas fa-calendar-alt me-1"></i> {{ $prestasi->created_at->format('d M Y H:i') }}
                        </span>

                        <span class="badge bg-info p-2">
                            <i class="fas fa-user me-1"></i> {{ $prestasi->user->name ?? 'Admin' }}
                        </span>
                    </div>

                    @if ($prestasi->image)
                        <div class="article-featured-image mb-4">
                            <img src="{{ Storage::url($prestasi->image) }}" alt="{{ $prestasi->title }}"
                                class="img-fluid rounded shadow-sm">
                        </div>
                    @endif

                    <div class="article-content">
                        <div class="article-body">
                            {!! $prestasi->content !!}
                        </div>
                    </div>
                </div>
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
            // Delete button click handler
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const title = this.dataset.title;

                    Swal.fire({
                        title: 'Konfirmasi Hapus',
                        text: `Apakah Anda yakin ingin menghapus prestasi "${title}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('delete-form');
                            form.action =
                                `{{ route('admin.prestasi.destroy', $prestasi) }}`;
                            form.submit();
                        }
                    });
                });
            });

            // Handle external link
            const externalLinks = document.querySelectorAll('a[target="_blank"]');
            externalLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Optional: Add analytics tracking or confirmation
                    console.log('Opening public prestasi page:', this.href);
                });
            });
        });
    </script>
@endsection
