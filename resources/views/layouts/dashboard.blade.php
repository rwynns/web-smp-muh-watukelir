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
                <button class="btn-toggle-sidebar d-none d-md-block" id="toggleSidebar">
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
        // Hapus Toast configuration dan ganti dengan SweetAlert biasa

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
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('expanded');
        });

        document.getElementById('sidebarToggler').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('mobile-open');
        });

        console.log('jQuery version:', typeof $ === 'function' ? $.fn.jquery : 'NOT LOADED');
    </script>
</body>

</html>
