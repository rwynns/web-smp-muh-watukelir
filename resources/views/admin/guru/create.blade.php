@extends('layouts.dashboard')

@section('title', 'Tambah Guru')
@section('page-title', 'Tambah Guru')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Guru</h1>
            <a href="{{ route('admin.guru.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Tambah Guru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.guru.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="nama">Nama Guru <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="jabatan-container">Jabatan <span class="text-danger">*</span></label>
                                <div id="jabatan-container">
                                    @php
                                        $jabatanArray = old('jabatan', []);
                                        if (!is_array($jabatanArray)) {
                                            $jabatanArray = [$jabatanArray];
                                        }
                                    @endphp

                                    @foreach ($jabatanArray as $index => $jabatan)
                                        <div class="input-group mb-2">
                                            <input type="text"
                                                class="form-control @error('jabatan.' . $index) is-invalid @enderror"
                                                name="jabatan[]" placeholder="Masukkan jabatan" value="{{ $jabatan }}"
                                                required>
                                            @if ($index === 0)
                                                <button type="button" class="btn btn-success btn-add-jabatan">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger btn-remove-jabatan">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach

                                    @if (count($jabatanArray) === 0)
                                        <div class="input-group mb-2">
                                            <input type="text"
                                                class="form-control @error('jabatan.0') is-invalid @enderror"
                                                name="jabatan[]" placeholder="Masukkan jabatan" required>
                                            <button type="button" class="btn btn-success btn-add-jabatan">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                                @error('jabatan')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                @error('jabatan.*')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Anda dapat menambahkan beberapa jabatan dengan menekan tombol +
                                </small>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="foto">Foto Guru</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" name="foto" accept="image/*" onchange="previewImage(this)">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Format: JPEG, PNG, JPG, GIF, WEBP. Max: 2MB
                                </small>
                            </div>

                            <div class="form-group mb-3">
                                <label>Preview Foto</label>
                                <div class="preview-container">
                                    <img id="preview-image" src="{{ asset('img/fotokosong.jpg') }}" alt="Preview"
                                        class="img-thumbnail" style="width: 200px; height: 200px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('admin.guru.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Preview image
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-image').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Add/Remove jabatan fields
        $(document).ready(function() {
            // Add jabatan field
            $(document).on('click', '.btn-add-jabatan', function() {
                let newField = `
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="jabatan[]" 
                           placeholder="Masukkan jabatan" required>
                    <button type="button" class="btn btn-danger btn-remove-jabatan">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
                $('#jabatan-container').append(newField);
            });

            // Remove jabatan field
            $(document).on('click', '.btn-remove-jabatan', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
@endsection
