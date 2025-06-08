@extends('layouts.dashboard')

@section('title', 'Detail Berita')
@section('page-title', 'Detail Berita')

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-newspaper me-2"></i>Detail Berita</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $berita->id }}"
                    data-title="{{ $berita->title }}">
                    <i class="fas fa-trash me-1"></i> Hapus
                </button>
            </div>
        </div>

        <div class="content-card-body">
            <div class="row">
                <div class="col-md-10">
                    <h1 class="article-title mb-3">{{ $berita->title }}</h1>

                    <div class="d-flex flex-wrap gap-2 mb-4">
                        <span
                            class="badge bg-{{ $berita->category == 'berita_sekolah' ? 'primary' : ($berita->category == 'pengumuman' ? 'warning' : ($berita->category == 'agenda' ? 'success' : 'info')) }} p-2">
                            <i class="fas fa-tag me-1"></i> {{ $berita->category_name }}
                        </span>

                        <span class="badge bg-secondary p-2">
                            <i class="fas fa-calendar-alt me-1"></i> {{ $berita->created_at->format('d M Y H:i') }}
                        </span>
                    </div>

                    @if ($berita->image)
                        <div class="article-featured-image mb-4">
                            <img src="{{ Storage::url($berita->image) }}" alt="{{ $berita->title }}"
                                class="img-fluid rounded">
                        </div>
                    @endif

                    <div class="article-content">
                        <div class="article-body">
                            {!! $berita->content !!}
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
                        text: `Apakah Anda yakin ingin menghapus berita "${title}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.getElementById('delete-form');
                            form.action = `{{ route('admin.berita.destroy', $berita) }}`;
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
