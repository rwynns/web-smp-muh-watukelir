@extends('layouts.dashboard')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
@endsection

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-edit me-2"></i>Edit Berita</h5>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary btn-sm" id="btn-back">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
            </a>
        </div>

        <div class="content-card-body">
            <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data"
                id="form-berita">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label required-label">Judul Berita</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title', $berita->title) }}" required autofocus>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label required-label">Kategori</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category"
                                name="category" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $value => $label)
                                    <option value="{{ $value }}"
                                        {{ old('category', $berita->category) == $value ? 'selected' : '' }}>
                                        {{ $label }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Utama (Opsional)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal 5MB</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if ($berita->image)
                                <div class="current-image">
                                    <label class="form-label mb-2">Gambar Saat Ini:</label>
                                    <img src="{{ Storage::url($berita->image) }}" alt="Current Image" class="img-fluid">
                                    <div class="form-text mt-2">Pilih gambar baru untuk mengganti gambar ini</div>
                                </div>
                            @endif

                            <div id="image-preview-container" class="mt-2" style="display: none;">
                                <label class="form-label mb-2">Preview Gambar Baru:</label>
                                <img id="image-preview" class="image-preview" src="#" alt="Preview">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label required-label">Konten Berita</label>
                    <input id="content" type="hidden" name="content" value="{{ old('content', $berita->content) }}">
                    <trix-editor input="content" class="@error('content') is-invalid @enderror"></trix-editor>
                    @error('content')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between border-top pt-3 form-actions">
                    <button type="button" class="btn btn-outline-secondary" id="btn-cancel">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn-save">
                        <i class="fas fa-save me-1"></i> Update Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
    <script>
        // Fungsi untuk memeriksa apakah form telah diubah
        function isFormChanged() {
            const originalTitle = '{{ $berita->title }}';
            const originalCategory = '{{ $berita->category }}';
            const originalContent = {!! json_encode($berita->content) !!};

            const currentTitle = document.getElementById('title').value.trim();
            const currentCategory = document.getElementById('category').value;
            const currentContent = document.getElementById('content').value.trim();
            const currentImage = document.getElementById('image').value;

            return originalTitle !== currentTitle ||
                originalCategory !== currentCategory ||
                originalContent !== currentContent ||
                currentImage !== '';
        }

        // Fungsi untuk konfirmasi kembali/batal jika form sudah diubah
        function confirmCancel(event, redirectUrl) {
            if (isFormChanged()) {
                event.preventDefault();

                Swal.fire({
                    title: 'Perubahan Belum Disimpan',
                    text: 'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Tinggalkan',
                    cancelButtonText: 'Tetap di Halaman'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = redirectUrl;
                    }
                });
            } else {
                window.location.href = redirectUrl;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');
            const imagePreviewContainer = document.getElementById('image-preview-container');

            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreviewContainer.style.display = 'block';
                    };

                    reader.readAsDataURL(this.files[0]);
                } else {
                    imagePreviewContainer.style.display = 'none';
                }
            });

            // Konfirmasi saat tombol kembali/batal diklik
            document.getElementById('btn-back').addEventListener('click', function(e) {
                confirmCancel(e, "{{ route('admin.berita.index') }}");
            });

            document.getElementById('btn-cancel').addEventListener('click', function(e) {
                confirmCancel(e, "{{ route('admin.berita.index') }}");
            });

            // Validasi form sebelum submit dengan SweetAlert
            const form = document.getElementById('form-berita');
            let isSubmitting = false; // Tambahkan flag untuk tracking submit

            form.addEventListener('submit', function(e) {
                let isValid = true;
                let invalidFields = [];

                const title = document.getElementById('title');
                if (!title.value.trim()) {
                    title.classList.add('is-invalid');
                    isValid = false;
                    invalidFields.push('Judul Berita');
                } else {
                    title.classList.remove('is-invalid');
                }

                const category = document.getElementById('category');
                if (!category.value) {
                    category.classList.add('is-invalid');
                    isValid = false;
                    invalidFields.push('Kategori');
                } else {
                    category.classList.remove('is-invalid');
                }

                const content = document.getElementById('content');
                if (!content.value.trim()) {
                    document.querySelector('trix-editor').classList.add('is-invalid');
                    isValid = false;
                    invalidFields.push('Konten Berita');
                } else {
                    document.querySelector('trix-editor').classList.remove('is-invalid');
                }

                if (!isValid) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Form Belum Lengkap',
                        html: `<div class="text-start">Mohon lengkapi field berikut:<br><ul class="mt-2">${invalidFields.map(field => `<li>${field}</li>`).join('')}</ul></div>`,
                        icon: 'error',
                        confirmButtonColor: '#009384',
                        confirmButtonText: 'Baik, Saya Mengerti'
                    }).then(() => {
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                    });
                } else {
                    // Tampilkan konfirmasi update
                    e.preventDefault();

                    Swal.fire({
                        title: 'Update Berita?',
                        text: 'Apakah Anda yakin ingin menyimpan perubahan berita ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#009384',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Update!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Set flag bahwa form sedang di-submit
                            isSubmitting = true;
                            // Submit form tanpa validasi ulang
                            this.removeEventListener('submit', arguments.callee);
                            this.submit();
                        }
                    });
                }
            });

            function adjustLayoutForOrientation() {
                if (window.innerWidth < 768) {
                    const trixToolbar = document.querySelector('trix-toolbar');
                    if (trixToolbar) {
                        trixToolbar.style.overflowX = 'auto';
                        trixToolbar.style.whiteSpace = 'nowrap';
                    }
                }
            }

            adjustLayoutForOrientation();
            window.addEventListener('resize', adjustLayoutForOrientation);
        });

        // Konfigurasi Trix Editor - Nonaktifkan semua fitur upload
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        // Konfirmasi sebelum meninggalkan halaman jika ada perubahan
        window.addEventListener('beforeunload', function(e) {
            // Cek flag isSubmitting untuk menghindari konfirmasi saat submit
            if (isFormChanged() && !isSubmitting) {
                const message =
                    'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman ini?';
                e.returnValue = message;
                return message;
            }
        });
    </script>
@endsection
