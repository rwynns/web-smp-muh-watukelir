@extends('layouts.dashboard')

@section('title', 'Tambah Foto Galeri')
@section('page-title', 'Tambah Foto Galeri')

@section('content')
    <div class="content-card">
        <div class="content-card-header">
            <h5><i class="fas fa-image me-2"></i>Upload Foto Baru</h5>
        </div>

        <div class="content-card-body">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data" id="formGaleri">
                @csrf

                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-4">
                            <label for="judul" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul') }}" required>

                            @error('judul')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">Masukkan judul foto yang akan ditampilkan di galeri</small>
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="form-label">Upload Foto <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                    id="gambar" name="gambar" accept="image/*" required>
                                <label class="input-group-text" for="gambar">Browse</label>

                                @error('gambar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <small class="text-muted">Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 2MB.</small>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Preview Gambar -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><i class="fas fa-eye me-1"></i>Preview</h6>
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
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Foto
                            </button>
                            <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">
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

            // Form validation
            const formGaleri = document.getElementById('formGaleri');

            formGaleri.addEventListener('submit', function(event) {
                const judul = document.getElementById('judul').value.trim();
                const gambar = document.getElementById('gambar').value;

                if (!judul) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: 'Judul foto harus diisi!',
                        confirmButtonColor: '#3085d6'
                    });
                    return false;
                }

                if (!gambar) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Form Tidak Lengkap',
                        text: 'Anda harus memilih file foto!',
                        confirmButtonColor: '#3085d6'
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
