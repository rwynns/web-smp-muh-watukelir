@extends('layouts.dashboard')

@section('title', 'Tambah Ekstrakurikuler')
@section('page-title', 'Tambah Ekstrakurikuler')

@section('content')
    <div class="content-card">
        <div class="content-card-header">
            <h5><i class="fas fa-puzzle-piece me-2"></i>Tambah Ekstrakurikuler Baru</h5>
        </div>

        <div class="content-card-body">
            <form action="{{ route('admin.ekstrakurikuler.store') }}" method="POST" enctype="multipart/form-data"
                id="form-ekstrakurikuler">
                @csrf

                <div class="row">
                    <div class="col-lg-8">
                        <!-- Nama Ekstrakurikuler -->
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama Ekstrakurikuler <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" required>

                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Deskripsi Ekstrakurikuler -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="6"
                                required>{{ old('deskripsi') }}</textarea>

                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">
                                Jelaskan tentang ekstrakurikuler, kegiatan yang dilakukan, manfaat, jadwal, dll.
                            </small>
                        </div>

                        <!-- Gambar Ekstrakurikuler -->
                        <div class="mb-4">
                            <label for="gambar" class="form-label">Gambar Ekstrakurikuler <small
                                    class="text-muted">(opsional)</small></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*">
                                <label class="input-group-text" for="gambar">Browse</label>

                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted">
                                Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 2MB. Ukuran terbaik 800x600 pixel.
                            </small>
                        </div>

                        <!-- Logo Ekstrakurikuler -->
                        <div class="mb-4">
                            <label for="logo" class="form-label">Logo Ekstrakurikuler <small
                                    class="text-muted">(opsional)</small></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                    id="logo" name="logo" accept="image/*">
                                <label class="input-group-text" for="logo">Browse</label>

                                @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted">
                                Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 2MB. Ukuran terbaik 200x200 pixel
                                (persegi).
                            </small>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Preview Gambar -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><i class="fas fa-eye me-1"></i>Preview Gambar</h6>
                            </div>
                            <div class="card-body text-center p-2">
                                <div class="preview-container">
                                    <!-- Image Preview -->
                                    <img id="imagePreview" src="" alt="Preview Gambar" class="hidden">

                                    <!-- No Image Message -->
                                    <div id="noImageMessage">
                                        <i class="fas fa-image fa-3x text-secondary mb-3"></i>
                                        <p class="text-muted mb-0">Pilih gambar untuk melihat preview</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Logo -->
                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><i class="fas fa-eye me-1"></i>Preview Logo</h6>
                            </div>
                            <div class="card-body text-center p-2">
                                <div class="preview-container">
                                    <!-- Logo Preview -->
                                    <img id="logoPreview" src="" alt="Preview Logo" class="hidden"
                                        style="width: 100px; height: 100px; object-fit: cover;">

                                    <!-- No Logo Message -->
                                    <div id="noLogoMessage">
                                        <i class="fas fa-crown fa-3x text-secondary mb-3"></i>
                                        <p class="text-muted mb-0">Pilih logo untuk melihat preview</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Publishing Info -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><i class="fas fa-info-circle me-1"></i>Informasi</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled small mb-0">
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-success me-1"></i>
                                        Ekstrakurikuler akan ditampilkan di halaman ekstrakurikuler website.
                                    </li>
                                    <li class="mb-2">
                                        <i class="fas fa-image text-primary me-1"></i>
                                        Gambar dan logo akan dioptimalkan untuk tampilan website.
                                    </li>
                                    <li>
                                        <i class="fas fa-edit text-warning me-1"></i>
                                        Anda dapat mengedit informasi ini kapan saja.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Ekstrakurikuler
                            </button>
                            <a href="{{ route('admin.ekstrakurikuler.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imagePreview = document.getElementById('imagePreview');
            const noImageMessage = document.getElementById('noImageMessage');
            const gambarInput = document.getElementById('gambar');

            const logoPreview = document.getElementById('logoPreview');
            const noLogoMessage = document.getElementById('noLogoMessage');
            const logoInput = document.getElementById('logo');

            // Handle gambar input change
            gambarInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Set image source
                        imagePreview.src = e.target.result;

                        // Show image preview, hide no image message
                        imagePreview.classList.remove('hidden');
                        noImageMessage.classList.add('hidden');
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    // Hide image preview, show no image message
                    imagePreview.classList.add('hidden');
                    noImageMessage.classList.remove('hidden');
                }
            });

            // Handle logo input change
            logoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Set logo source
                        logoPreview.src = e.target.result;

                        // Show logo preview, hide no logo message
                        logoPreview.classList.remove('hidden');
                        noLogoMessage.classList.add('hidden');
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    // Hide logo preview, show no logo message
                    logoPreview.classList.add('hidden');
                    noLogoMessage.classList.remove('hidden');
                }
            });

            // Form validation
            const formEkstrakurikuler = document.getElementById('form-ekstrakurikuler');

            formEkstrakurikuler.addEventListener('submit', function(event) {
                const nama = document.getElementById('nama').value.trim();
                const deskripsi = document.getElementById('deskripsi').value.trim();
                let isValid = true;

                if (!nama) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: 'Nama ekstrakurikuler harus diisi!',
                        confirmButtonColor: '#3085d6'
                    });
                    isValid = false;
                    return;
                }

                if (!deskripsi) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: 'Deskripsi ekstrakurikuler harus diisi!',
                        confirmButtonColor: '#3085d6'
                    });
                    isValid = false;
                    return;
                }

                if (isValid) {
                    // Tampilkan loading
                    Swal.fire({
                        title: 'Menyimpan Data',
                        html: 'Mohon tunggu, data sedang disimpan...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                }
            });
        });
    </script>
@endsection
