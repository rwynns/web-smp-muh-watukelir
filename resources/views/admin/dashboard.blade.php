@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="dashboard-stats">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="stat-card bg-primary-gradient">
                    <div class="stat-card-body">
                        <div class="stat-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-details">
                            <h3 class="stat-count">{{ $stats['total_berita'] }}</h3>
                            <p class="stat-label">Total Berita</p>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <i class="fas fa-arrow-up me-1"></i> {{ $stats['berita_bulan_ini'] }} berita bulan ini
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-warning-gradient">
                    <div class="stat-card-body">
                        <div class="stat-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-details">
                            <h3 class="stat-count">{{ $stats['total_prestasi'] }}</h3>
                            <p class="stat-label">Total Prestasi</p>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <i class="fas fa-award me-1"></i> Prestasi siswa terdokumentasi
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card bg-info-gradient">
                    <div class="stat-card-body">
                        <div class="stat-icon">
                            <i class="fas fa-image"></i>
                        </div>
                        <div class="stat-details">
                            <h3 class="stat-count">{{ $stats['total_galeri'] }}</h3>
                            <p class="stat-label">Total Foto Galeri</p>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <i class="fas fa-camera me-1"></i> Dokumentasi kegiatan sekolah
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="content-card-header">
                    <h5><i class="fas fa-chart-line me-2"></i>Aktivitas Terkini</h5>
                    <div class="card-actions">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sync-alt me-2"></i>Refresh</a>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Download</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-card-body">
                    <div class="activity-timeline">
                        @if ($activities->count() > 0)
                            @foreach ($activities as $activity)
                                <div class="activity-item">
                                    <div class="activity-icon bg-{{ $activity['color'] }}">
                                        <i class="{{ $activity['icon'] }}"></i>
                                    </div>
                                    <div class="activity-content">
                                        <h6>{{ $activity['title'] }}</h6>
                                        <p>{{ $activity['description'] }}</p>
                                        <span class="activity-time">
                                            <i class="far fa-clock me-1"></i>
                                            {{ $activity['formatted_time'] }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <div class="mb-3">
                                    <i class="fas fa-info-circle fa-3x text-muted"></i>
                                </div>
                                <h5 class="text-muted">Belum Ada Aktivitas</h5>
                                <p class="text-muted mb-0">
                                    Tidak ada aktivitas terkini yang dapat ditampilkan.
                                    Mulai mengelola konten untuk melihat aktivitas di sini.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="content-card-footer text-center">
                    @if ($activities->count() > 0)
                        <a href="#" class="btn btn-sm btn-primary">Lihat Semua Aktivitas</a>
                    @else
                        <small class="text-muted">Aktivitas akan muncul ketika Anda mulai mengelola konten</small>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="content-card-header">
                    <h5><i class="fas fa-tasks me-2"></i>Menu Cepat</h5>
                </div>
                <div class="content-card-body p-0">
                    <div class="quick-actions">
                        <a href="{{ route('admin.berita.create') }}" class="quick-action-item">
                            <div class="quick-action-icon bg-primary-soft">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div class="quick-action-text">
                                <h6>Tambah Berita</h6>
                                <p>Buat berita atau pengumuman baru</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.prestasi.create') }}" class="quick-action-item">
                            <div class="quick-action-icon bg-success-soft">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="quick-action-text">
                                <h6>Tambah Prestasi</h6>
                                <p>Rekam prestasi baru siswa</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.galeri.create') }}" class="quick-action-item">
                            <div class="quick-action-icon bg-info-soft">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="quick-action-text">
                                <h6>Upload Foto</h6>
                                <p>Tambahkan foto ke galeri</p>
                            </div>
                        </a>
                        <a href="{{ route('admin.ppdb.index') }}" class="quick-action-item">
                            <div class="quick-action-icon bg-warning-soft">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="quick-action-text">
                                <h6>Kelola PPDB</h6>
                                <p>Lihat data pendaftaran PPDB</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
