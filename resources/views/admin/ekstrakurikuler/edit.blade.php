@extends('layouts.dashboard')

@section('title', 'Edit Ekstrakurikuler')
@section('page-title', 'Edit Ekstrakurikuler')

@section('content')
    <div class="content-card">
        <div class="content-card-header">
            <h5><i class="fas fa-edit me-2"></i>Edit Ekstrakurikuler</h5>
        </div>

        <div class="content-card-body">
            <form action="{{ route('admin.ekstrakurikuler.update', $ekstrakurikuler) }}" method="POST"
                enctype="multipart/form-data" id="form-ekstrakurikuler">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama Ekstrakurikuler <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama', $ekstrakurikuler->nama) }}" required>

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
                                required>{{ old('deskripsi', $ekstrakurikuler->deskripsi) }}</textarea>

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
                            <small class="d-block text-warning mt-1">
                                <i class="fas fa-info-circle me-1"></i> Biarkan kosong jika tidak ingin mengganti gambar.
                                Jika Anda mengganti gambar, gambar lama akan dihapus.
                            </small>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Preview Gambar -->
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><i class="fas fa-eye me-1"></i>Gambar Saat Ini</h6>
                            </div>
                            <div class="card-body text-center p-2">
                                <div class="preview-container">
                                    <!-- Image Preview -->
                                    <img id="imagePreview" src="{{ asset('storage/' . $ekstrakurikuler->gambar_path) }}"
                                        alt="{{ $ekstrakurikuler->nama }}" class="img-fluid rounded">

                                    <!-- No Image Message (hidden by default) -->
                                    <div id="noImageMessage" class="hidden">
                                        <i class="fas fa-image fa-3x text-secondary mb-3"></i>
                                        <p class="text-muted mb-0">Pilih gambar untuk melihat preview</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light p-2 text-center">
                                <small class="text-muted">Gambar akan diganti jika Anda memilih file baru</small>
                            </div>
                        </div>

                        <!-- Update Info -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0"><i class="fas fa-info-circle me-1"></i>Informasi Update</h6>
                            </div>
                            <div class="card-body">
                                <div class="small mb-3">
                                    <strong>Dibuat pada:</strong>
                                    <div class="text-muted">
                                        {{ $ekstrakurikuler->created_at->format('d M Y, H:i') }}
                                    </div>
                                </div>
                                <div class="small">
                                    <strong>Terakhir diupdate:</strong>
                                    <div class="text-muted">
                                        {{ $ekstrakurikuler->updated_at->format('d M Y, H:i') }}
                                    </div>
                                </div>
                                <hr>
                                <ul class="list-unstyled small mb-0">
                                    <li class="mb-2">
                                        <i class="fas fa-check-circle text-success me-1"></i>
                                        Perubahan akan langsung ditampilkan di website.
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
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
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

            // Simpan URL gambar saat ini
            const currentImageUrl = imagePreview.src;

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
                    // Jika user membatalkan pemilihan file, kembalikan ke gambar saat ini
                    imagePreview.src = currentImageUrl;

                    // Pastikan preview tetap terlihat
                    imagePreview.classList.remove('hidden');
                    noImageMessage.classList.add('hidden');
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
                        title: 'Menyimpan Perubahan',
                        html: 'Mohon tunggu, data sedang diperbarui...',
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
