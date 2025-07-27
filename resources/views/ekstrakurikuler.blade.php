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
                            @if ($item->gambar_path)
                                <img src="{{ asset('storage/' . $item->gambar_path) }}" class="card-img-top"
                                    alt="{{ $item->nama }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="ekskul-no-image" style="display: none;">
                                    <div class="no-image-content">
                                        @if ($item->logo_path)
                                            <img src="{{ asset('storage/' . $item->logo_path) }}" class="ekskul-logo-large"
                                                alt="{{ $item->nama }} Logo"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <i class="fas fa-puzzle-piece fa-4x text-secondary" style="display: none;"></i>
                                        @else
                                            <i class="fas fa-puzzle-piece fa-4x text-secondary"></i>
                                        @endif
                                        <h5 class="mt-3 text-center">{{ $item->nama }}</h5>
                                    </div>
                                </div>
                            @else
                                <div class="ekskul-no-image">
                                    <div class="no-image-content">
                                        @if ($item->logo_path)
                                            <img src="{{ asset('storage/' . $item->logo_path) }}" class="ekskul-logo-large"
                                                alt="{{ $item->nama }} Logo"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <i class="fas fa-puzzle-piece fa-4x text-secondary" style="display: none;"></i>
                                        @else
                                            <i class="fas fa-puzzle-piece fa-4x text-secondary"></i>
                                        @endif
                                        <h5 class="mt-3 text-center"></h5>
                                    </div>
                                </div>
                            @endif
                            <div class="ekskul-badge">
                                <span>Ekstrakurikuler</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                @if ($item->logo_path && $item->gambar_path)
                                    <img src="{{ asset('storage/' . $item->logo_path) }}" class="ekskul-logo-small me-2"
                                        alt="{{ $item->nama }} Logo">
                                @endif
                                <h5 class="card-title mb-0">{{ $item->nama }}</h5>
                            </div>
                            <p class="card-text text-muted">
                                {{ Str::limit($item->deskripsi, 120) }}
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <button type="button" class="btn btn-primary btn-detail" data-bs-toggle="modal"
                                data-bs-target="#ekskulModal" data-id="{{ $item->id }}"
                                data-nama="{{ $item->nama }}" data-deskripsi="{{ $item->deskripsi }}"
                                data-gambar="{{ $item->gambar_path ? asset('storage/' . $item->gambar_path) : '' }}"
                                data-logo="{{ $item->logo_path ? asset('storage/' . $item->logo_path) : '' }}"
                                data-has-gambar="{{ $item->gambar_path && !empty($item->gambar_path) ? 'true' : 'false' }}"
                                data-has-logo="{{ $item->logo_path && !empty($item->logo_path) ? 'true' : 'false' }}">
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
                            <div id="modalImageContainer">
                                <img id="modalImage" src="" alt="" class="img-fluid rounded"
                                    style="display: none;">
                                <div id="modalNoImage" class="modal-no-image text-center" style="display: none;">
                                    <div class="modal-no-image-content">
                                        <img id="modalLogo" src="" alt="" class="modal-logo"
                                            style="display: none;">
                                        <i id="modalIcon" class="fas fa-puzzle-piece fa-5x text-secondary"
                                            style="display: none;"></i>
                                        <h5 id="modalTitleInImage" class="mt-3"></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex align-items-center mb-3">
                                <img id="modalLogoSmall" src="" alt="" class="modal-logo-small me-2"
                                    style="display: none;">
                                <h4 id="modalTitle" class="mb-0"></h4>
                            </div>
                            <div id="modalContent" class="text-muted" style="text-align: justify; line-height: 1.6;">
                            </div>
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
                var logo = button.data('logo');
                var hasGambar = button.data('has-gambar') === 'true' || button.data('has-gambar') === true;
                var hasLogo = button.data('has-logo') === 'true' || button.data('has-logo') === true;

                var modal = $(this);

                // Set title and content
                modal.find('#modalTitle').text(nama);
                modal.find('#modalTitleInImage').text(nama);
                modal.find('#modalContent').text(deskripsi);

                // Reset all elements
                modal.find('#modalImage').hide();
                modal.find('#modalNoImage').hide();
                modal.find('#modalLogoSmall').hide();
                modal.find('#modalLogo').hide();
                modal.find('#modalIcon').hide();

                // Handle image display
                if (hasGambar && gambar && gambar.trim() !== '') {
                    // Show image
                    var modalImage = modal.find('#modalImage');
                    modalImage.attr('src', gambar).attr('alt', nama);

                    // Add error handler for image
                    modalImage.off('error').on('error', function() {
                        $(this).hide();
                        modal.find('#modalNoImage').show();
                        if (hasLogo && logo && logo.trim() !== '') {
                            modal.find('#modalLogo').attr('src', logo).attr('alt', nama + ' Logo')
                                .show();
                        } else {
                            modal.find('#modalIcon').show();
                        }
                    });

                    modalImage.show();

                    // Show small logo next to title if available
                    if (hasLogo && logo && logo.trim() !== '') {
                        var modalLogoSmall = modal.find('#modalLogoSmall');
                        modalLogoSmall.attr('src', logo).attr('alt', nama + ' Logo');
                        modalLogoSmall.off('error').on('error', function() {
                            $(this).hide();
                        });
                        modalLogoSmall.show();
                    }
                } else {
                    // Hide image, show no-image container
                    modal.find('#modalNoImage').show();

                    // Show logo in no-image container if available
                    if (hasLogo && logo && logo.trim() !== '') {
                        var modalLogo = modal.find('#modalLogo');
                        modalLogo.attr('src', logo).attr('alt', nama + ' Logo');
                        modalLogo.off('error').on('error', function() {
                            $(this).hide();
                            modal.find('#modalIcon').show();
                        });
                        modalLogo.show();
                    } else {
                        modal.find('#modalIcon').show();
                    }
                }
            });
        });
    </script>
@endpush
