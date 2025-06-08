@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Overview')

@section('content')
    <div class="dashboard-stats">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="stat-card bg-primary-gradient">
                    <div class="stat-card-body">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-details">
                            <h3 class="stat-count">{{ \App\Models\User::count() }}</h3>
                            <p class="stat-label">Total Users</p>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <i class="fas fa-arrow-up me-1"></i> 12.5% dari bulan lalu
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card bg-warning-gradient">
                    <div class="stat-card-body">
                        <div class="stat-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="stat-details">
                            <h3 class="stat-count">{{ \App\Models\User::where('role_id', 1)->count() }}</h3>
                            <p class="stat-label">Admin</p>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <i class="fas fa-minus me-1"></i> Tetap dari bulan lalu
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card bg-info-gradient">
                    <div class="stat-card-body">
                        <div class="stat-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="stat-details">
                            <h3 class="stat-count">{{ \App\Models\User::where('role_id', 2)->count() }}</h3>
                            <p class="stat-label">Siswa</p>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <i class="fas fa-arrow-up me-1"></i> 5.3% dari bulan lalu
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card bg-success-gradient">
                    <div class="stat-card-body">
                        <div class="stat-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-details">
                            <h3 class="stat-count">15</h3>
                            <p class="stat-label">Berita</p>
                        </div>
                    </div>
                    <div class="stat-footer">
                        <i class="fas fa-arrow-up me-1"></i> 3 berita baru bulan ini
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
                        <div class="activity-item">
                            <div class="activity-icon bg-primary">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Berita Baru Ditambahkan</h6>
                                <p>Admin menambahkan berita baru "Prestasi Siswa dalam Olimpiade Matematika"</p>
                                <span class="activity-time"><i class="far fa-clock me-1"></i>2 jam yang lalu</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-warning">
                                <i class="fas fa-edit"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Profil Sekolah Diperbarui</h6>
                                <p>Admin memperbarui informasi profil sekolah</p>
                                <span class="activity-time"><i class="far fa-clock me-1"></i>Kemarin, 15:30</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-success">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Pengguna Baru Terdaftar</h6>
                                <p>3 pengguna baru telah mendaftar ke sistem</p>
                                <span class="activity-time"><i class="far fa-clock me-1"></i>2 hari yang lalu</span>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon bg-info">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Galeri Foto Diperbarui</h6>
                                <p>Admin menambahkan 15 foto baru ke galeri kegiatan sekolah</p>
                                <span class="activity-time"><i class="far fa-clock me-1"></i>3 hari yang lalu</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-card-footer text-center">
                    <a href="#" class="btn btn-sm btn-primary">Lihat Semua Aktivitas</a>
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
                        <a href="#" class="quick-action-item">
                            <div class="quick-action-icon bg-primary-soft">
                                <i class="fas fa-newspaper"></i>
                            </div>
                            <div class="quick-action-text">
                                <h6>Tambah Berita</h6>
                                <p>Buat berita atau pengumuman baru</p>
                            </div>
                        </a>
                        <a href="#" class="quick-action-item">
                            <div class="quick-action-icon bg-success-soft">
                                <i class="fas fa-trophy"></i>
                            </div>
                            <div class="quick-action-text">
                                <h6>Tambah Prestasi</h6>
                                <p>Rekam prestasi baru siswa</p>
                            </div>
                        </a>
                        <a href="#" class="quick-action-item">
                            <div class="quick-action-icon bg-info-soft">
                                <i class="fas fa-image"></i>
                            </div>
                            <div class="quick-action-text">
                                <h6>Upload Foto</h6>
                                <p>Tambahkan foto ke galeri</p>
                            </div>
                        </a>
                        <a href="#" class="quick-action-item">
                            <div class="quick-action-icon bg-warning-soft">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="quick-action-text">
                                <h6>Tambah User</h6>
                                <p>Daftarkan pengguna baru</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
