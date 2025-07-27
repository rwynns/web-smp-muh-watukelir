@extends('layouts.dashboard')

@section('title', 'Data Guru')
@section('page-title', 'Data Guru')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
            <a href="{{ route('admin.guru.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Guru
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guru as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($item->foto_exists)
                                            <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}" class="img-thumbnail"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('img/fotokosong.jpg') }}" alt="No Photo"
                                                class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        @if (is_array($item->jabatan))
                                            @foreach ($item->jabatan as $jabatan)
                                                <span class="badge bg-primary mb-1">{{ $jabatan }}</span><br>
                                            @endforeach
                                        @else
                                            <span class="badge bg-primary">{{ $item->jabatan }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.guru.show', $item->id) }}" class="btn btn-info btn-sm"
                                            title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.guru.edit', $item->id) }}" class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm btn-delete-guru" title="Hapus"
                                            data-id="{{ $item->id }}" data-nama="{{ $item->nama }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data guru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                },
                "responsive": true,
                "pageLength": 10,
                "ordering": true,
                "searching": true
            });

            // SweetAlert untuk hapus guru
            document.querySelectorAll('.btn-delete-guru').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.dataset.id;
                    var nama = this.dataset.nama;
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: `Apakah Anda yakin ingin menghapus guru "${nama}"?`,
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
                            form.action = `{{ url('admin/guru') }}/${id}`;
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
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
