<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') | SMP Muhammadiyah Watukelir</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- Additional CSS -->
    @yield('styles')
</head>

<body>
    <div class="dashboard-container">
        @include('partials.sidebar')

        <main class="main-content">
            <!-- Topbar -->
            <header class="topbar">
                <!-- Toggle button for mobile (visible on small screens) -->
                <button class="btn-toggle-sidebar d-md-none" id="toggleSidebarMobile">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Toggle button for desktop (visible on medium screens and up) -->
                <button class="btn-toggle-sidebar d-none d-md-block" id="toggleSidebarDesktop">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="page-title">
                    <h4>@yield('page-title', 'Dashboard')</h4>
                </div>

                <div class="topbar-actions">
                    <a href="/" class="btn btn-outline-primary btn-sm ms-2" target="_blank">
                        <i class="fas fa-globe"></i> Lihat Website
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content-wrapper">
                <!-- Alert container for JS-based alerts -->
                <div id="alert-container"></div>

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Overlay untuk mobile sidebar -->
    <div id="sidebarOverlay"></div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <!-- Additional Scripts -->
    @yield('scripts')

    <script>
        // Handle session flash messages with SweetAlert
        document.addEventListener('DOMContentLoaded', function() {
            // Success message
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#009384'
                });
            @endif

            // Error message
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#dc3545'
                });
            @endif
        });

        // Global SweetAlert helper functions
        window.showAlert = {
            success: function(message) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: message,
                    confirmButtonColor: '#009384'
                });
            },
            error: function(message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    text: message,
                    confirmButtonColor: '#dc3545'
                });
            },
            warning: function(message) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: message,
                    confirmButtonColor: '#ffc107'
                });
            },
            info: function(message) {
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: message,
                    confirmButtonColor: '#17a2b8'
                });
            },
            confirm: function(message, callback) {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: message,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#009384',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Ya, lanjutkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed && typeof callback === 'function') {
                        callback();
                    }
                });
            },
            // Alert untuk konfirmasi hapus data
            delete: function(message, url, token) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: message || "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.createElement('form');
                        form.setAttribute('method', 'POST');
                        form.setAttribute('action', url);
                        form.innerHTML = `
                            <input type="hidden" name="_token" value="${token}">
                            <input type="hidden" name="_method" value="DELETE">
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        };

        // Sidebar toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleDesktop = document.getElementById('toggleSidebarDesktop');
            const toggleMobile = document.getElementById('toggleSidebarMobile');
            const mainContent = document.querySelector('.main-content');
            const body = document.body;

            console.log('Sidebar elements found:', {
                sidebar: !!sidebar,
                overlay: !!overlay,
                toggleDesktop: !!toggleDesktop,
                toggleMobile: !!toggleMobile
            });

            // Desktop toggle functionality
            if (toggleDesktop) {
                toggleDesktop.addEventListener('click', function() {
                    console.log('Desktop toggle clicked');
                    sidebar.classList.toggle('collapsed');
                    if (mainContent) {
                        mainContent.classList.toggle('expanded');
                    }
                });
            }

            // Mobile toggle functionality
            if (toggleMobile) {
                toggleMobile.addEventListener('click', function() {
                    console.log('Mobile toggle clicked');
                    const isOpen = sidebar.classList.contains('sidebar-open');

                    if (isOpen) {
                        // Close sidebar
                        sidebar.classList.remove('sidebar-open');
                        overlay.classList.remove('show');
                        body.classList.remove('sidebar-open-mobile');
                        console.log('Sidebar closed');
                    } else {
                        // Open sidebar
                        sidebar.classList.add('sidebar-open');
                        overlay.classList.add('show');
                        body.classList.add('sidebar-open-mobile');
                        console.log('Sidebar opened');
                    }
                });
            }

            // Close sidebar when clicking overlay
            if (overlay) {
                overlay.addEventListener('click', function() {
                    console.log('Overlay clicked');
                    sidebar.classList.remove('sidebar-open');
                    overlay.classList.remove('show');
                    body.classList.remove('sidebar-open-mobile');
                });
            }

            // Close sidebar when clicking nav link on mobile
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        console.log('Nav link clicked on mobile');
                        sidebar.classList.remove('sidebar-open');
                        overlay.classList.remove('show');
                        body.classList.remove('sidebar-open-mobile');
                    }
                });
            });

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    // Desktop view - clean up mobile classes
                    sidebar.classList.remove('sidebar-open');
                    overlay.classList.remove('show');
                    body.classList.remove('sidebar-open-mobile');
                }
            });
        });

        console.log('jQuery version:', typeof $ === 'function' ? $.fn.jquery : 'NOT LOADED');
    </script>

    <style>
        /* Reset any existing sidebar styles for mobile */
        @media (max-width: 767.98px) {
            .sidebar {
                position: fixed !important;
                left: -280px !important;
                top: 0 !important;
                width: 280px !important;
                height: 100vh !important;
                background: #fff !important;
                z-index: 1050 !important;
                transition: left 0.3s ease !important;
                box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2) !important;
                transform: none !important;
                margin-left: 0 !important;
            }

            .sidebar.sidebar-open {
                left: 0 !important;
            }

            #sidebarOverlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1049;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            #sidebarOverlay.show {
                display: block !important;
                opacity: 1;
            }

            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
            }

            .dashboard-container {
                overflow-x: hidden;
            }

            /* Prevent body scroll when sidebar is open */
            body.sidebar-open-mobile {
                overflow: hidden;
            }
        }

        /* Desktop Sidebar Styles */
        @media (min-width: 768px) {
            #sidebarOverlay {
                display: none !important;
            }
        }

        /* Common toggle button styles */
        .btn-toggle-sidebar {
            background: none !important;
            border: none !important;
            color: #333 !important;
            font-size: 18px !important;
            padding: 8px 12px !important;
            border-radius: 4px !important;
            transition: background-color 0.3s !important;
            cursor: pointer !important;
        }

        .btn-toggle-sidebar:hover {
            background-color: rgba(0, 0, 0, 0.1) !important;
        }

        .btn-toggle-sidebar:focus {
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(0, 147, 132, 0.3) !important;
        }
    </style>
</body>

</html>
