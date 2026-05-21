<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Toko Badminton — @yield('title', 'Dashboard')</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">

<div id="wrapper">

    <!-- SIDEBAR -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-futbol"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Toko Badminton</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <a class="nav-link" href="{{ url('/') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">Master Data</div>

        <li class="nav-item {{ request()->is('categories*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-fw fa-tags"></i>
                <span>Kategori</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('products*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('products.index') }}">
                <i class="fas fa-fw fa-box-open"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="nav-item {{ request()->is('transactions*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transactions.index') }}">
                <i class="fas fa-fw fa-receipt"></i>
                <span>Transaksi</span>
            </a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- END SIDEBAR -->

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

            <!-- TOPBAR -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <span class="nav-link font-weight-bold text-primary">
                            🏸 Toko Badminton
                        </span>
                    </li>
                </ul>
            </nav>

            <!-- CONTENT -->
            <div class="container-fluid">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <strong>Ada kesalahan:</strong>
                        <ul class="mb-0 mt-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </div>

        </div>

        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>🏸 Toko Badminton &copy; {{ date('Y') }}</span>
                </div>
            </div>
        </footer>
    </div>

</div>

<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
@stack('scripts')
</body>
</html>
