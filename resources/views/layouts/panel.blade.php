<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Inventory</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link class="rounded-circle" rel="icon" href="{{ asset('assets/foto/avatar.png') }}" type="image/x-icon" />

    <script src="{{ asset('assets/panel/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/panel/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <link rel="stylesheet" href="{{ asset('assets/panel/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/panel/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/panel/assets/css/kaiadmin.min.css') }}" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* ================= SIDEBAR ================= */
        .sidebar,
        .sidebar[data-background-color=light] {
            background: #ffffff !important;
            color: #343a40 !important;
            box-shadow: 4px 4px 12px rgba(0, 0, 0, .08);
        }

        /* Menu link */
        .sidebar .nav a {
            color: #343a40 !important;
            font-weight: 500;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 10px;
            transition: all .25s ease;
        }

        /* Icon menu */
        .sidebar .nav i {
            color: rgba(0, 0, 0, 0.65) !important;
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Hover menu */
        .sidebar .nav a:hover {
            background: rgba(0, 146, 69, 0.1) !important;
            color: #009245 !important;
        }

        .sidebar .nav a:hover i {
            color: #009245 !important;
        }

        /* Active menu */
        .sidebar .nav-item.active>a {
            background: rgba(0, 146, 69, 0.15) !important;
            color: #009245 !important;
            font-weight: 600;
            box-shadow: inset 4px 0 #009245;
        }

        .sidebar .nav-item.active>a i {
            color: #009245 !important;
        }

        /* Section text */
        .sidebar .text-section {
            color: rgba(0, 0, 0, .5) !important;
            text-transform: uppercase;
            font-size: .75rem;
            letter-spacing: .6px;
            margin: 15px 0 5px;
        }

        /* Scrollbar */
        .sidebar-wrapper.scrollbar-inner::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-wrapper.scrollbar-inner::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, .2);
            border-radius: 3px;
        }

        /* Avatar & user info di sidebar */
        .sidebar-user .avatar {
            background: #009245 !important;
            color: #ffffff !important;
            font-weight: 700;
        }

        .sidebar-user .user-info .fw-semibold,
        .sidebar-user .user-info small {
            color: #343a40 !important;
        }

        /* ================= LOGO HEADER ================= */
        .logo-header[data-background-color=light] {
            background: #009245 !important;
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }

        .logo-header .logo,
        .logo-header .logo h4 {
            color: #ffffff !important;
            font-weight: 700;
        }

        /* Toggle buttons */
        .logo-header .btn-toggle,
        .logo-header .topbar-toggler.more {
            background: transparent !important;
            border: none;
        }

        .logo-header .btn-toggle i,
        .logo-header .topbar-toggler.more i {
            color: #ffffff !important;
            font-size: 18px;
        }

        .logo-header .btn-toggle:hover i,
        .logo-header .topbar-toggler.more:hover i {
            color: #c7d2fe !important;
        }

        /* ================= HEADER / NAVBAR ================= */
        .main-header {
            background: #009245 !important;
            min-height: 60px;
            width: calc(100% - 250px);
            position: fixed;
            z-index: 1001;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .08);
        }

        .main-header .nav-link,
        .main-header .navbar-brand,
        .main-header .navbar-text,
        .main-header i {
            color: #ffffff !important;
        }

        /* ================= BUTTON PRIMARY ================= */
        .btn-primary {
            background-color: #009245 !important;
            border-color: #009245 !important;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #007a3a !important;
            border-color: #007a3a !important;
        }

        .btn-primary:focus,
        .btn-primary:focus-visible {
            background-color: #007a3a !important;
            border-color: #007a3a !important;
            box-shadow: 0 0 0 .25rem rgba(0, 146, 69, 0.25) !important;
        }

        .btn-primary:active,
        .btn-primary.active {
            background-color: #006837 !important;
            border-color: #006837 !important;
        }

        .btn-primary:disabled {
            background-color: rgba(0, 146, 69, 0.5) !important;
            border-color: rgba(0, 146, 69, 0.5) !important;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="light">
            <div class="sidebar-logo">
                <div class="logo-header" data-background-color="light">
                    <a href="{{ route('panel.dashboard') }}" class="logo d-flex align-items-center">
                        <h4 class="mb-0 fw-bold text-white">Inventory</h4>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="sidebar-user px-3 py-3 mb-2">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-lg rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold me-3" style="width:48px;height:48px;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="user-info">
                                <div class="fw-semibold text-dark">
                                    {{ auth()->user()->name }}
                                </div>
                                <small class="text-muted">
                                    {{ auth()->user()->role }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <hr class="my-2" style="border-color: rgba(0,0,0,0.1)">

                    <ul class="nav nav-secondary">
                        {{-- Dashboard --}}
                        <li class="nav-item {{ Request::is('panel') ? 'active' : '' }}">
                            <a href="{{ route('panel.dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if (auth()->user()->role == 'Admin')
                            <li class="nav-section">
                                <h4 class="text-section">Master Data</h4>
                            </li>
                            <li class="nav-item {{ Request::is('panel/cabang*') ? 'active' : '' }}">
                                <a href="{{ route('cabang.index') }}">
                                    <i class="fas fa-store"></i>
                                    <p>Cabang</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('panel/barang*') ? 'active' : '' }}">
                                <a href="{{ route('barang.index') }}">
                                    <i class="fas fa-box-open"></i>
                                    <p>Barang</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('panel/stokgudang*') ? 'active' : '' }}">
                                <a href="{{ route('stokgudang.index') }}">
                                    <i class="fas fa-warehouse"></i>
                                    <p>Stok Gudang</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('panel/stokcabang*') ? 'active' : '' }}">
                                <a href="{{ route('stokcabang.index') }}">
                                    <i class="fas fa-boxes"></i>
                                    <p>Stok Cabang</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('panel/stokmasuk*') ? 'active' : '' }}">
                                <a href="{{ route('stokmasuk.index') }}">
                                    <i class="fas fa-truck-loading"></i>
                                    <p>Stok Masuk Gudang</p>
                                </a>
                            </li>

                            {{-- PEMINDAHAN 1: Halaman Permintaan sekarang berada di folder panel utama --}}
                            <li class="nav-item {{ Request::is('panel/permintaan') ? 'active' : '' }}">
                                <a href="{{ route('permintaan.index') }}">
                                    <i class="fas fa-paper-plane"></i>
                                    <p>Permintaan</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/laporan*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#menuLaporan">
                                    <i class="fas fa-file-contract"></i>
                                    <p>Laporan</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Request::is('panel/laporan*') ? 'show' : '' }}" id="menuLaporan">
                                    <ul class="nav nav-collapse">
                                        <li class="{{ Request::is('panel/laporan/stokmasuk') ? 'active' : '' }}">
                                            <a href="{{ route('laporan.stokmasuk') }}">
                                                <span class="sub-item">Stok Masuk</span>
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('panel/laporan/stokkeluar') ? 'active' : '' }}">
                                            <a href="{{ route('laporan.stokkeluar') }}">
                                                <span class="sub-item">Stok Keluar</span>
                                            </a>
                                        </li>

                                        {{-- PEMINDAHAN 2: Halaman Permintaan Cabang dimasukkan ke folder panel/laporan --}}
                                        <li class="{{ Request::is('panel/laporan/permintaancabang*') ? 'active' : '' }}">
                                            <a href="{{ route('permintaancabang.index') }}">
                                                <span class="sub-item">Permintaan Cabang</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item {{ Request::is('panel/pengguna*') ? 'active' : '' }}">
                                <a href="{{ route('pengguna.index') }}">
                                    <i class="fas fa-users-cog"></i>
                                    <p>Pengguna</p>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->role == 'Gudang')
                            <li class="nav-section">
                                <h4 class="text-section">Gudang</h4>
                            </li>
                            <li class="nav-item {{ Request::is('panel/stokgudang*') ? 'active' : '' }}">
                                <a href="{{ route('stokgudang.index') }}">
                                    <i class="fas fa-warehouse"></i>
                                    <p>Stok Gudang</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('panel/stokmasuk*') ? 'active' : '' }}">
                                <a href="{{ route('stokmasuk.index') }}">
                                    <i class="fas fa-truck-loading"></i>
                                    <p>Stok Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('panel/permintaan*') ? 'active' : '' }}">
                                <a href="{{ route('permintaan.index') }}">
                                    <i class="fas fa-clipboard-list"></i>
                                    <p>Permintaan</p>
                                </a>
                            </li>
                        @endif

                       @if (auth()->user()->role == 'Kasir')
                            <li class="nav-section">
                                <h4 class="text-section">Cabang</h4>
                            </li>
                            <li class="nav-item {{ Request::is('panel/stokcabang*') ? 'active' : '' }}">
                                <a href="{{ route('stokcabang.index') }}">
                                    <i class="fas fa-boxes"></i>
                                    <p>Stok</p>
                                </a>
                            </li>
                            {{-- Menu Stok Keluar untuk Kasir sudah di-hidden sesuai permintaan --}}
                            <li class="nav-item {{ Request::is('panel/permintaan*') ? 'active' : '' }}">
                                <a href="{{ route('permintaan.index') }}">
                                    <i class="fas fa-paper-plane"></i>
                                    <p>Permintaan</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="logo-header" data-background-color="light">
                        <a href="{{ route('panel.dashboard') }}" class="logo d-flex align-items-center">
                            @if (auth()->user()->fotoprofile != null)
                                <img src="{{ asset('storage/fotoprofile/' . auth()->user()->fotoprofile) }}" alt="Foto Profile" class="avatar-img rounded-circle" />
                            @else
                                <img src="{{ asset('assets/foto/avatar.png') }}" alt="logo" height="35" class="bg-white rounded p-1">
                            @endif
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                </div>
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                                    <div class="avatar-sm">
                                        @if (auth()->user()->fotoprofile != null)
                                            <img src="{{ asset('storage/fotoprofile/' . auth()->user()->fotoprofile) }}" alt="Foto Profile" class="avatar-img rounded-circle" />
                                        @else
                                            <img src="{{ asset('assets/foto/avatar.png') }}" alt="..." class="avatar-img rounded-circle" />
                                        @endif
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7 text-white">Hi,</span>
                                        <span class="fw-bold text-white">{{ auth()->user()->name }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    @if (auth()->user()->fotoprofile != null)
                                                        <img src="{{ asset('storage/fotoprofile/' . auth()->user()->fotoprofile) }}" alt="image profile" class="avatar-img rounded" />
                                                    @else
                                                        <img src="{{ asset('assets/foto/avatar.png') }}" alt="image profile" class="avatar-img rounded" />
                                                    @endif
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ auth()->user()->name }}</h4>
                                                    <p class="text-muted">{{ auth()->user()->email }}</p>
                                                    <a href="{{ route('profile.index') }}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ route('profile.index') }}">My Profile</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ url('logout') }}" onclick="return confirm('Yakin ingin logout?')">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            @yield('content')

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <div class="copyright">
                        {{ date('Y') }}, made with by
                        <a href="{{ url('/') }}">Gustandi</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/panel/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/jsvectormap/world.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('assets/panel/assets/js/setting-demo2.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errorMessages = `
            <ul style="text-align:left;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `;
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                html: errorMessages,
                confirmButtonColor: '#f0ad4e',
                confirmButtonText: 'Perbaiki'
            });
        </script>
    @endif

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>

    @yield('script')
</body>

</html>
