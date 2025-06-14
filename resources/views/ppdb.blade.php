@extends('layouts.main')

@section('title', 'PPDB')
@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-box">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="breadcrumb-title">
                        <h3>PPDB Online</h3>
                        <p>Penerimaan Peserta Didik Baru</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">PPDB</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container konten">
        <!-- Alert Info Memanjang -->
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info ppdb-alert-full">
                    <h4><i class="fas fa-info-circle"></i> Informasi PPDB SMP Muhammadiyah Watukelir</h4>
                    <p>Selamat datang di halaman Penerimaan Peserta Didik Baru (PPDB) SMP Muhammadiyah Watukelir.
                        Berikut informasi penting seputar proses pendaftaran:</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Konten Utama -->
            <div class="col-lg-6">
                <div class="ppdb-info-card">
                    <!-- Jadwal Pendaftaran -->
                    <div class="ppdb-section">
                        <h5><i class="fas fa-calendar-alt text-primary"></i> Jadwal Pendaftaran</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-circle text-success"></i> Pendaftaran dibuka: 1 Juni 2025</li>
                            <li><i class="fas fa-circle text-warning"></i> Pendaftaran ditutup: 31 Juli 2025</li>
                            <li><i class="fas fa-circle text-info"></i> Pengumuman hasil seleksi: 5 Agustus 2025</li>
                        </ul>
                    </div>

                    <!-- Persyaratan -->
                    <div class="ppdb-section">
                        <h5><i class="fas fa-clipboard-list text-primary"></i> Persyaratan</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success"></i> Scan Akta Kelahiran</li>
                            <li><i class="fas fa-check text-success"></i> Scan Kartu Keluarga</li>
                            <li><i class="fas fa-check text-success"></i> Pas foto ukuran 3x4 (5 lembar)</li>
                            <li><i class="fas fa-check text-success"></i> Raport SD (foto menyusul jika belum keluar)</li>
                        </ul>
                    </div>

                    <!-- Alamat Sekolah -->
                    <div class="ppdb-section">
                        <h5><i class="fas fa-map-marker-alt text-primary"></i> Alamat Sekolah</h5>
                        <p>Watukelir, Jetakrejolangu, Kec. Walikk, Kab. Sumenep, Jawa Tengah 57382</p>
                    </div>

                    <!-- Kontak -->
                    <div class="ppdb-section">
                        <h5><i class="fas fa-phone text-primary"></i> Kontak</h5>
                        <p>0877 3313415<br>smpmuhkelir@gmail.com</p>
                    </div>

                    <!-- Peta Lokasi -->
                    <div class="ppdb-section">
                        <h5><i class="fas fa-map text-primary"></i> Lokasi Sekolah</h5>
                        <div class="map-container">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.9986573742!2d110.40851931477589!3d-7.769531994388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59f0e0e0e0e0%3A0x0!2sWatukelir%20Sumenep!5e0!3m2!1sid!2sid!4v1625000000000!5m2!1sid!2sid"
                                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pendaftaran -->
            <div class="col-lg-6">
                <div class="ppdb-form-card">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5><i class="fas fa-user-plus"></i> Formulir Pendaftaran</h5>
                            <small>Silakan lengkapi data formulir pendaftaran sesuai dengan berkas berikut:</small>
                        </div>
                        <div class="card-body">
                            <!-- Tombol Download Template -->
                            <div class="text-center mb-3">
                                <a href="{{ route('ppdb.download-template') }}" class="btn btn-outline-primary btn-block">
                                    <i class="fas fa-download"></i> Download Template Formulir
                                </a>
                                <small class="text-muted">Download template untuk diisi secara manual (format DOCX)
                                </small>
                            </div>

                            <hr class="my-3">

                            <!-- Form Upload -->
                            <form action="{{ route('ppdb.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="upload-section">
                                    <h6><i class="fas fa-upload text-primary"></i> Unggah Formulir</h6>

                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="namaLengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap"
                                            value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="formulirFile">Unggah Formulir (PDF) <span class="text-danger">*</span>
                                        </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="formulirFile"
                                                name="formulir_file" accept=".pdf" required>
                                            <label class="custom-file-label" for="formulirFile">Pilih file PDF...</label>
                                        </div>
                                        <small class="text-muted">Format: PDF, Maksimal 10MB</small>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-paper-plane"></i> Kirim Formulir Pendaftaran
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Custom file input handler (tanpa jQuery)
        document.querySelectorAll(".custom-file-input").forEach(function(input) {
            input.addEventListener('change', function() {
                var fileName = this.value.split("\\").pop();
                this.nextElementSibling.classList.add("selected");
                this.nextElementSibling.innerHTML = fileName || "Pilih file PDF...";
            });
        });
    });
</script>
