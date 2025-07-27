@extends('layouts.dashboard')

@section('title', 'Detail Guru')
@section('page-title', 'Detail Guru')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Guru</h1>
            <div>
                <a href="{{ route('admin.guru.edit', $guru->id) }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                    <i class="fas fa-edit fa-sm text-white-50"></i> Edit
                </a>
                <a href="{{ route('admin.guru.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                    <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Foto Guru</h6>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $guru->foto_url }}" alt="{{ $guru->nama }}" class="img-fluid rounded"
                            style="max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Guru</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Nama</strong></td>
                                <td>:</td>
                                <td>{{ $guru->nama }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>
                                    @if (is_array($guru->jabatan))
                                        @foreach ($guru->jabatan as $jabatan)
                                            <span class="badge bg-primary mb-1 me-1">{{ $jabatan }}</span>
                                        @endforeach
                                    @else
                                        <span class="badge bg-primary">{{ $guru->jabatan }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Foto</strong></td>
                                <td>:</td>
                                <td>
                                    @if ($guru->foto_exists)
                                        <span class="badge bg-success">Ada</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak ada</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Dibuat</strong></td>
                                <td>:</td>
                                <td>{{ $guru->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Diupdate</strong></td>
                                <td>:</td>
                                <td>{{ $guru->updated_at->format('d M Y, H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.guru.edit', $guru->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                        <button type="button" class="btn btn-danger"
                            onclick="confirmDelete('{{ route('admin.guru.destroy', $guru->id) }}', 'Apakah Anda yakin ingin menghapus data guru ini?')">
                            <i class="fas fa-trash"></i> Hapus Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
