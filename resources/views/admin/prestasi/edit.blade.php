@extends('layouts.dashboard')

@section('title', 'Edit Prestasi')
@section('page-title', 'Edit Prestasi')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
@endsection

@section('content')
    <div class="content-card">
        <div class="content-card-header d-flex justify-content-between align-items-center">
            <h5><i class="fas fa-edit me-2"></i>Edit Prestasi</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-outline-secondary btn-sm" id="btn-back">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar
                </a>
                <a href="{{ route('admin.prestasi.show', $prestasi) }}" class="btn btn-info btn-sm">
                    <i class="fas fa-eye me-1"></i> Lihat Detail
                </a>
            </div>
        </div>

        <div class="content-card-body">
            <form action="{{ route('admin.prestasi.update', $prestasi) }}" method="POST" enctype="multipart/form-data"
                id="form-prestasi">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="title" class="form-label required-label">Judul Prestasi</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title', $prestasi->title) }}" required autofocus
                                placeholder="Contoh: Juara 1 Olimpiade Matematika Tingkat Kabupaten">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle text-info me-1"></i>
                                Slug URL saat ini: <code>{{ $prestasi->slug }}</code>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar Prestasi (Opsional)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image" accept="image/*">
                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal 5MB</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if ($prestasi->image)
                                <div class="current-image">
                                    <label class="form-label mb-2">Gambar Saat Ini:</label>
                                    <img src="{{ Storage::url($prestasi->image) }}" alt="Current Image"
                                        class="img-fluid rounded shadow-sm">
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
                    <label for="content" class="form-label required-label">Deskripsi Prestasi</label>
                    <p class="form-text mb-2">
                        <i class="fas fa-info-circle text-info me-1"></i>
                        Ceritakan detail prestasi, seperti: nama lomba, penyelenggara, tanggal, tingkat kompetisi,
                        pencapaian, dan dampaknya.
                        Anda dapat menambahkan gambar dengan menyeret file ke editor atau menggunakan tombol attachment.
                    </p>
                    <input id="content" type="hidden" name="content" value="{{ old('content', $prestasi->content) }}">
                    <trix-editor input="content" class="@error('content') is-invalid @enderror"
                        placeholder="Ceritakan detail prestasi secara lengkap..."></trix-editor>
                    @error('content')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Informasi Additional -->
                <div class="alert alert-light border-start border-warning border-4 mb-4">
                    <h6 class="alert-heading mb-2">
                        <i class="fas fa-lightbulb text-warning me-1"></i>
                        Informasi Prestasi
                    </h6>
                    <div class="row small">
                        <div class="col-md-6">
                            <strong>Dibuat:</strong> {{ $prestasi->created_at->format('d F Y, H:i') }} WIB<br>
                            <strong>Terakhir diubah:</strong> {{ $prestasi->updated_at->format('d F Y, H:i') }} WIB
                        </div>
                        <div class="col-md-6">
                            <strong>Penulis:</strong> {{ $prestasi->user->name ?? 'Admin' }}<br>
                            <strong>Ringkasan saat ini:</strong> {{ Str::limit($prestasi->excerpt, 80) }}...
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between border-top pt-3 form-actions">
                    <button type="button" class="btn btn-outline-secondary" id="btn-cancel">
                        <i class="fas fa-times me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn-save">
                        <i class="fas fa-save me-1"></i> Update Prestasi
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
            const originalTitle = {!! json_encode($prestasi->title) !!};
            const originalContent = {!! json_encode($prestasi->content) !!};

            const currentTitle = document.getElementById('title').value.trim();
            const currentContent = document.getElementById('content').value.trim();
            const currentImage = document.getElementById('image').value;

            return originalTitle !== currentTitle ||
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

            // Image preview functionality
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
                confirmCancel(e, "{{ route('admin.prestasi.index') }}");
            });

            document.getElementById('btn-cancel').addEventListener('click', function(e) {
                confirmCancel(e, "{{ route('admin.prestasi.index') }}");
            });

            // Validasi form sebelum submit dengan SweetAlert
            const form = document.getElementById('form-prestasi');
            form.addEventListener('submit', function(e) {
                let isValid = true;
                let invalidFields = [];

                const title = document.getElementById('title');
                if (!title.value.trim()) {
                    title.classList.add('is-invalid');
                    isValid = false;
                    invalidFields.push('Judul Prestasi');
                } else {
                    title.classList.remove('is-invalid');
                }

                const content = document.getElementById('content');
                if (!content.value.trim()) {
                    document.querySelector('trix-editor').classList.add('is-invalid');
                    isValid = false;
                    invalidFields.push('Deskripsi Prestasi');
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
                        title: 'Update Prestasi?',
                        text: 'Apakah Anda yakin ingin menyimpan perubahan prestasi ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#009384',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Update!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Show loading state
                            const submitBtn = document.getElementById('btn-save');
                            submitBtn.innerHTML =
                                '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
                            submitBtn.disabled = true;

                            // Submit form tanpa validasi ulang
                            this.removeEventListener('submit', arguments.callee);
                            this.submit();
                        }
                    });
                }
            });

            // Handle image upload untuk Trix Editor
            document.addEventListener('trix-attachment-add', function(event) {
                if (event.attachment.file) {
                    uploadFileAttachment(event.attachment);
                }
            });

            function uploadFileAttachment(attachment) {
                const formData = new FormData();
                formData.append('file', attachment.file);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route('admin.prestasi.upload-image') }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            attachment.setAttributes({
                                url: data.url,
                                href: data.url
                            });
                        } else {
                            attachment.remove();
                            Swal.fire({
                                title: 'Upload Gagal',
                                text: data.message || 'Gagal mengupload gambar',
                                icon: 'error',
                                confirmButtonColor: '#dc3545'
                            });
                        }
                    })
                    .catch(error => {
                        attachment.remove();
                        Swal.fire({
                            title: 'Upload Gagal',
                            text: 'Terjadi kesalahan saat mengupload gambar',
                            icon: 'error',
                            confirmButtonColor: '#dc3545'
                        });
                        console.error('Error:', error);
                    });
            }

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

        // Prevent file uploads except for images
        document.addEventListener('trix-file-accept', function(e) {
            if (!e.file.type.startsWith('image/')) {
                e.preventDefault();
                Swal.fire({
                    title: 'File Tidak Didukung',
                    text: 'Hanya file gambar yang dapat diupload (JPG, PNG, GIF)',
                    icon: 'warning',
                    confirmButtonColor: '#ffc107'
                });
            }
        });

        // Konfirmasi sebelum meninggalkan halaman jika ada perubahan
        window.addEventListener('beforeunload', function(e) {
            if (isFormChanged()) {
                const message =
                    'Anda memiliki perubahan yang belum disimpan. Yakin ingin meninggalkan halaman ini?';
                e.returnValue = message;
                return message;
            }
        });
    </script>
@endsection
