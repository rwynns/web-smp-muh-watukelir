@extends('layouts.dashboard')

@section('title', 'Manajemen Berita')
@section('page-title', 'Manajemen Berita')

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-newspaper me-2"></i>Daftar Berita</h5>
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle me-1"></i> Tambah Berita
            </a>
        </div>

        <div class="content-card-body">
            <!-- Filter dan Pencarian -->
            <div class="row mb-4 g-3">
                <div class="col-md-8">
                    <form action="{{ route('admin.berita.index') }}" method="GET" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari judul atau konten..."
                                name="search" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <select class="form-select w-auto" name="category" onchange="this.form.submit()">
                            <option value="all">Semua Kategori</option>
                            @foreach ($categories as $value => $label)
                                <option value="{{ $value }}" {{ request('category') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>

                        @if (request('search') || (request('category') && request('category') != 'all'))
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="col-md-4 text-md-end">
                    <div class="text-muted small pt-2">
                        Menampilkan {{ $berita->firstItem() ?? 0 }} - {{ $berita->lastItem() ?? 0 }} dari
                        {{ $berita->total() }} berita
                    </div>
                </div>
            </div>

            <!-- Daftar Berita -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px">No</th>
                            <th style="min-width: 250px">Judul & Kategori</th>
                            <th>Isi Berita</th>
                            <th style="width: 140px">Tanggal</th>
                            <th style="width: 120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berita as $index => $item)
                            <tr>
                                <td>{{ $berita->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($item->image)
                                            <div class="berita-thumbnail">
                                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}"
                                                    width="60" height="60" class="rounded object-fit-cover">
                                            </div>
                                        @else
                                            <div class="berita-thumbnail bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width:60px;height:60px">
                                                <i class="fas fa-newspaper text-secondary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ Str::limit($item->title, 50) }}</h6>
                                            <div class="mt-1">
                                                <span
                                                    class="badge bg-{{ $item->category == 'berita_sekolah' ? 'primary' : ($item->category == 'pengumuman' ? 'warning' : ($item->category == 'agenda' ? 'success' : 'info')) }}">
                                                    {{ $item->category_name }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-muted small mb-0">
                                        {{ Str::limit($item->excerpt, 120) }}
                                    </p>
                                </td>
                                <td>
                                    <div class="small">
                                        <div class="mb-1">
                                            <i class="fas fa-calendar-alt text-secondary me-1"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </div>
                                        <div>
                                            <i class="fas fa-clock text-secondary me-1"></i>
                                            {{ $item->created_at->format('H:i') }}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.berita.show', $item) }}" class="btn btn-sm btn-info"
                                            data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn-sm btn-warning"
                                            data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $item->id }}" data-title="{{ $item->title }}"
                                            data-bs-toggle="tooltip" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-newspaper fa-3x text-secondary mb-3"></i>
                                        <h6>Belum ada berita</h6>
                                        <p class="text-muted">Tambahkan berita baru dengan mengklik tombol 'Tambah Berita'
                                        </p>
                                        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm mt-2">
                                            <i class="fas fa-plus-circle me-1"></i> Tambah Berita Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-card-footer">
            <div class="d-flex justify-content-center">
                {{ $berita->withQueryString()->links() }}
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
                    const title = this.dataset.title;

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `Apakah Anda yakin ingin menghapus berita "${title}"?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Buat form delete secara dinamis
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `{{ route('admin.berita.index') }}/${id}`;

                            // Tambahkan CSRF token
                            const csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = '{{ csrf_token() }}';
                            form.appendChild(csrfInput);

                            // Tambahkan method DELETE
                            const methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'DELETE';
                            form.appendChild(methodInput);

                            // Submit form
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
