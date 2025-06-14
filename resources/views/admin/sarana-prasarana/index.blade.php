@extends('layouts.dashboard')

@section('title', 'Manajemen Sarana Prasarana')
@section('page-title', 'Manajemen Sarana Prasarana')

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-building me-2"></i>Daftar Sarana dan Prasarana</h5>
            <a href="{{ route('admin.sarana-prasarana.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus-circle me-1"></i> Tambah Sarana Prasarana
            </a>
        </div>

        <div class="content-card-body">
            <!-- Filter dan Pencarian -->
            <div class="row mb-4 g-3">
                <div class="col-md-8">
                    <form action="{{ route('admin.sarana-prasarana.index') }}" method="GET" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari nama sarana prasarana..."
                                name="search" value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        @if (request('search'))
                            <a href="{{ route('admin.sarana-prasarana.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="col-md-4 text-md-end">
                    <div class="text-muted small pt-2">
                        Menampilkan {{ $saranaPrasarana->firstItem() ?? 0 }} - {{ $saranaPrasarana->lastItem() ?? 0 }} dari
                        {{ $saranaPrasarana->total() }} sarana prasarana
                    </div>
                </div>
            </div>

            <!-- Daftar Sarana Prasarana -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px">No</th>
                            <th style="min-width: 250px">Nama Sarana Prasarana</th>
                            <th>Deskripsi</th>
                            <th style="width: 140px">Tanggal Dibuat</th>
                            <th style="width: 120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($saranaPrasarana as $index => $item)
                            <tr>
                                <td>{{ $saranaPrasarana->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($item->gambar_path)
                                            <div class="sarana-thumbnail">
                                                <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" width="60"
                                                    height="60" class="rounded object-fit-cover">
                                            </div>
                                        @else
                                            <div class="sarana-thumbnail bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width:60px;height:60px">
                                                <i class="fas fa-building text-secondary"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $item->nama }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-muted small mb-0">
                                        {{ $item->deskripsi ?: 'Tidak ada deskripsi' }}
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
                                        <a href="{{ route('admin.sarana-prasarana.edit', $item) }}"
                                            class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
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
                                        <i class="fas fa-building fa-3x text-secondary mb-3"></i>
                                        <h6>Belum ada sarana dan prasarana</h6>
                                        <p class="text-muted">Tambahkan sarana dan prasarana baru dengan mengklik tombol
                                            'Tambah Sarana Prasarana'
                                        </p>
                                        <a href="{{ route('admin.sarana-prasarana.create') }}"
                                            class="btn btn-primary btn-sm mt-2">
                                            <i class="fas fa-plus-circle me-1"></i> Tambah Sarana Prasarana Sekarang
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
                {{ $saranaPrasarana->withQueryString()->links() }}
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
                    const nama = this.dataset.nama;

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `Apakah Anda yakin ingin menghapus sarana prasarana "${nama}"?`,
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
                            form.action =
                                `{{ route('admin.sarana-prasarana.index') }}/${id}`;

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
