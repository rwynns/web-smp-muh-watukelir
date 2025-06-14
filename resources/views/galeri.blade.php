@extends('layouts.main')

@section('title', 'Galeri - SMP Muhammadiyah Watukelir')

@section('content')
    <div class="container konten py-5">
        <div class="row mb-2">
            <div class="col-12 text-center">
                <h2 class="section-title">Galeri SMP Muhammadiyah Watukelir</h2>
                <p class="section-subtitle">Dokumentasi kegiatan dan momen berharga di sekolah kami</p>
            </div>
        </div>

        <!-- Galeri Grid dengan card modern -->
        <div class="row galeri-container">
            @forelse ($galeri as $item)
                <div class="col-sm-6 col-md-4 galeri-item mb-4">
                    <div class="galeri-card">
                        <div class="galeri-card-inner" data-src="{{ asset('storage/' . $item->file_path) }}"
                            data-judul="{{ $item->judul }}">
                            <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->judul }}"
                                class="img-fluid">
                            <div class="galeri-overlay">
                                <div class="galeri-info">
                                    <h5>{{ $item->judul }}</h5>
                                    <span class="galeri-date">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="empty-state">
                        <i class="fas fa-images fa-4x text-muted mb-3"></i>
                        <h4>Belum Ada Foto</h4>
                        <p class="text-muted">Galeri foto akan ditampilkan di sini segera.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $galeri->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Galeri -->
    <div class="galeri-modal" id="galeriModal">
        <div class="galeri-modal-content">
            <span class="galeri-close">&times;</span>
            <div class="galeri-modal-body">
                <img id="galeriModalImg" src="" alt="">
                <h3 id="galeriModalTitle" class="mt-3"></h3>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Galeri Styling */
        .section-title {
            font-weight: 700;
            color: var(--main-color);
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--main-color);
            margin: 0.5rem auto 0;
        }

        .section-subtitle {
            color: #6c757d;
            margin-bottom: 2rem;
        }

        /* Galeri Cards - Desain Modern */
        .galeri-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: white;
            height: 100%;
            padding: 10px;
        }

        .galeri-card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .galeri-card-inner {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            height: 0;
            padding-bottom: 75%;
            /* Aspect ratio 4:3 */
            cursor: pointer;
        }

        .galeri-card-inner img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .galeri-card:hover .galeri-card-inner img {
            transform: scale(1.1);
        }

        .galeri-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: flex-end;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .galeri-card:hover .galeri-overlay {
            opacity: 1;
        }

        .galeri-info {
            color: white;
            padding: 20px;
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
        }

        .galeri-info h5 {
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .galeri-date {
            display: block;
            font-size: 0.8rem;
            opacity: 0.8;
        }

        /* Modal Styling - Transparan & Modern */
        .galeri-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            padding: 0;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
            transition: all 0.3s ease;
            align-items: center;
            justify-content: center;
        }

        .galeri-modal-content {
            position: relative;
            margin: auto;
            width: 90%;
            max-width: 900px;
            background: transparent;
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .galeri-modal-body {
            padding: 20px;
            text-align: center;
        }

        .galeri-modal-body img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .galeri-modal-body h3 {
            color: white;
            margin-top: 20px;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .galeri-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: white;
            font-size: 40px;
            font-weight: 300;
            transition: 0.3s;
            z-index: 1060;
            cursor: pointer;
            background: rgba(0, 0, 0, 0.3);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 0;
        }

        .galeri-close:hover {
            color: var(--main-color);
            background: rgba(255, 255, 255, 0.2);
        }

        /* Empty State */
        .empty-state {
            padding: 50px;
            border-radius: 16px;
            background: #f8f9fa;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .galeri-modal-content {
                width: 95%;
            }

            .galeri-card {
                padding: 8px;
            }

            .galeri-info {
                padding: 15px;
            }

            .galeri-close {
                top: -35px;
                right: 0;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal variables
            const modal = document.getElementById('galeriModal');
            const modalImg = document.getElementById('galeriModalImg');
            const modalTitle = document.getElementById('galeriModalTitle');
            const closeBtn = document.getElementsByClassName('galeri-close')[0];

            // Get all galeri cards
            const galeriCards = document.querySelectorAll('.galeri-card-inner');

            // Open modal when card is clicked
            galeriCards.forEach(card => {
                card.addEventListener('click', function() {
                    const src = this.getAttribute('data-src');
                    const judul = this.getAttribute('data-judul');
                    openModal(src, judul);
                });
            });

            // Close modal when X is clicked
            closeBtn.addEventListener('click', function() {
                closeModal();
            });

            // Close modal when clicking outside the image
            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape" && modal.style.display === "flex") {
                    closeModal();
                }
            });

            // Function to open modal
            function openModal(src, title) {
                modalImg.src = src;
                modalTitle.textContent = title;
                modal.style.display = "flex";
                document.body.style.overflow = "hidden"; // Disable scrolling when modal is open
            }

            // Function to close modal
            function closeModal() {
                modal.style.display = "none";
                document.body.style.overflow = "auto"; // Enable scrolling again
            }
        });
    </script>
@endpush
