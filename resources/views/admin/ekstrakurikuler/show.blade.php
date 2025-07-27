@extends('layouts.dashboard')

@section('title', 'Detail Ekstrakurikuler')
@section('page-title', 'Detail Ekstrakurikuler')

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-puzzle-piece me-2"></i>Detail Ekstrakurikuler</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.ekstrakurikuler.edit', $ekstrakurikuler) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="content-card-body">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Nama Ekstrakurikuler -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Nama Ekstrakurikuler</label>
                        <h4 class="text-primary">{{ $ekstrakurikuler->nama }}</h4>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <div class="border rounded p-3 bg-light">
                            <p class="mb-0" style="white-space: pre-wrap;">{{ $ekstrakurikuler->deskripsi }}</p>
                        </div>
                    </div>

                    <!-- Gambar Ekstrakurikuler -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Gambar Ekstrakurikuler</label>
                        @if ($ekstrakurikuler->gambar_path)
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $ekstrakurikuler->gambar_path) }}"
                                    alt="{{ $ekstrakurikuler->nama }}" class="img-fluid rounded shadow-sm"
                                    style="max-height: 400px; object-fit: cover;">
                            </div>
                        @else
                            <div class="text-center py-4 border rounded bg-light">
                                <i class="fas fa-image fa-3x text-secondary mb-3"></i>
                                <p class="text-muted mb-0">Tidak ada gambar</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Logo Ekstrakurikuler -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="card-title mb-0"><i class="fas fa-crown me-1"></i>Logo Ekstrakurikuler</h6>
                        </div>
                        <div class="card-body text-center">
                            @if ($ekstrakurikuler->logo_path)
                                <img src="{{ asset('storage/' . $ekstrakurikuler->logo_path) }}"
                                    alt="{{ $ekstrakurikuler->nama }} Logo" class="rounded shadow-sm"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <div class="py-4">
                                    <i class="fas fa-crown fa-4x text-secondary mb-3"></i>
                                    <p class="text-muted mb-0">Tidak ada logo</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Tambahan -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0"><i class="fas fa-info-circle me-1"></i>Informasi</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Dibuat pada:</strong>
                                <div class="text-muted">
                                    {{ $ekstrakurikuler->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <strong>Terakhir diupdate:</strong>
                                <div class="text-muted">
                                    {{ $ekstrakurikuler->updated_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <strong>Status Gambar:</strong>
                                <div class="text-muted">
                                    @if ($ekstrakurikuler->gambar_path)
                                        <i class="fas fa-check-circle text-success me-1"></i> Tersedia
                                    @else
                                        <i class="fas fa-times-circle text-danger me-1"></i> Tidak ada
                                    @endif
                                </div>
                            </div>
                            <div>
                                <strong>Status Logo:</strong>
                                <div class="text-muted">
                                    @if ($ekstrakurikuler->logo_path)
                                        <i class="fas fa-check-circle text-success me-1"></i> Tersedia
                                    @else
                                        <i class="fas fa-times-circle text-danger me-1"></i> Tidak ada
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
