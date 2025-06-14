@extends('layouts.dashboard')

@section('title', 'Manajemen PPDB')
@section('page-title', 'Manajemen PPDB')

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-user-graduate me-2"></i>Daftar Pendaftaran PPDB</h5>
            <a href="{{ route('ppdb.download-template') }}" class="btn btn-success btn-sm">
                <i class="fas fa-download me-1"></i> Download Template Formulir
            </a>
        </div>

        <div class="content-card-body">
            <!-- Filter dan Pencarian -->
            <div class="row mb-4 g-3">
                <div class="col-md-8">
                    <form action="{{ route('admin.ppdb.index') }}" method="GET" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari nama pendaftar..." name="search"
                                value="{{ request('search') }}">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                        <select class="form-select w-auto" name="sort_by" onchange="this.form.submit()">
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                                Terbaru
                            </option>
                            <option value="nama_lengkap" {{ request('sort_by') == 'nama_lengkap' ? 'selected' : '' }}>
                                Nama A-Z
                            </option>
                        </select>

                        @if (request('search') || request('sort_by'))
                            <a href="{{ route('admin.ppdb.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="col-md-4 text-md-end">
                    <div class="text-muted small pt-2">
                        Menampilkan {{ $pendaftaran->firstItem() ?? 0 }} - {{ $pendaftaran->lastItem() ?? 0 }} dari
                        {{ $pendaftaran->total() }} pendaftar
                    </div>
                </div>
            </div>

            <!-- Daftar Pendaftaran -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 60px">No</th>
                            <th style="min-width: 200px">Nama Pendaftar</th>
                            <th>Formulir</th>
                            <th style="width: 200px">Tanggal Daftar</th>
                            <th style="width: 120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftaran as $index => $item)
                            <tr>
                                <td>{{ $pendaftaran->firstItem() + $index }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <h6 class="mb-0">{{ $item->nama_lengkap }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf text-danger me-2"></i>
                                        <!-- Gunakan URL yang benar untuk mengakses file -->
                                        <a href="{{ url('storage/' . $item->formulir_path) }}" target="_blank"
                                            class="text-decoration-none">
                                            Download Formulir
                                        </a>
                                    </div>
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
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-id="{{ $item->id }}" data-nama="{{ $item->nama_lengkap }}"
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
                                        <i class="fas fa-user-graduate fa-3x text-primary mb-3"></i>
                                        <h6>Belum ada pendaftar PPDB</h6>
                                        <p class="text-muted">Belum ada calon siswa yang mendaftar melalui sistem PPDB
                                            online</p>
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
                {{ $pendaftaran->withQueryString()->links() }}
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
                        text: `Apakah Anda yakin ingin menghapus pendaftaran atas nama "${nama}"?`,
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
                            form.action = `{{ route('admin.ppdb.index') }}/${id}`;

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
