@extends('layouts.main')

@section('title', 'Ekstrakurikuler - SMP Muhammadiyah Watukelir')

@section('content')
    <div class="container konten py-5">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h2 class="section-title">Ekstrakurikuler</h2>
                <p class="section-subtitle">Kegiatan Pengembangan Minat dan Bakat Siswa</p>
            </div>
        </div>

        <div class="row">
            @forelse ($ekstrakurikuler as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card ekskul-card h-100">
                        <div class="ekskul-image">
                            <img src="{{ asset('storage/' . $item->gambar_path) }}" class="card-img-top"
                                alt="{{ $item->nama }}">
                            <div class="ekskul-badge">
                                <span>Ekstrakurikuler</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama }}</h5>
                            <p class="card-text text-muted">
                                {{ $item->deskripsi }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button type="button" class="btn btn-primary btn-detail" data-bs-toggle="modal"
                                data-bs-target="#ekskulModal" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}"
                                data-deskripsi="{{ $item->deskripsi }}"
                                data-gambar="{{ asset('storage/' . $item->gambar_path) }}">
                                Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Data ekstrakurikuler belum tersedia.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <div class="modal fade" id="ekskulModal" tabindex="-1" aria-labelledby="ekskulModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ekskulModalLabel">Detail Ekstrakurikuler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 mb-3 mb-md-0">
                            <img id="modalImage" src="" alt="" class="img-fluid rounded">
                        </div>
                        <div class="col-md-7">
                            <h4 id="modalTitle" class="mb-3"></h4>
                            <div id="modalContent" class="text-muted"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Handle modal data
            $('#ekskulModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nama = button.data('nama');
                var deskripsi = button.data('deskripsi');
                var gambar = button.data('gambar');

                var modal = $(this);
                modal.find('#modalTitle').text(nama);
                modal.find('#modalContent').text(deskripsi);
                modal.find('#modalImage').attr('src', gambar);
                modal.find('#modalImage').attr('alt', nama);
            });
        });
    </script>
@endpush
