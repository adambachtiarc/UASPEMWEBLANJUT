<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"><!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-perpus.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/sidebars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/library/bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/library/sweetalert2/dist/sweetalert2.min.css') }}">
    <title>{{ $title??"Perpustakaan Online" }}</title>
    <style>
        .loader {
            position: fixed;
            padding-top: 20vh;
            margin-top: 0;
            background-color: rgba(248, 247, 216, 0.7);
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        .loader-image {
            display: block;
            margin: 0 auto 0 auto;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="loader">
        <div class="loader-image">
            <img src="{{ asset('assets/gif/loading-bg-transparent-2.gif') }}" alt="loader" class="loader-image">
            <p class="h3 text-center text-danger" style="font-weight: bold">Silahkan tunggu...</p>
        </div>
    </div>
    <header class="d-flex flex-wrap justify-content-center py-3 border-bottom">
        <div class="container">
            <a href="/" class="mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="{{ asset('assets/images/logo-perpus.png') }}" alt="Logo" style="height: 3rem;">
                <span class="fs-4">Perpustakaan Online</span>
            </a>

            <ul class="nav nav-pills float-end">
                <li class="nav-item"><a href="{{ url('') }}" class="nav-link {{ Request::segment(1)==''?'active':'' }}"
                        aria-current="page">Home</a>
                </li>
                <li class="nav-item"><a href="{{ url('manajemen-buku') }}"
                        class="nav-link {{ Request::segment(1)=='manajemen-buku'?'active':'' }}">Manajemen Buku</a></li>
            </ul>
        </div>
    </header>
    <div style="min-height: 100vh" class="container">
        <div class="row">
            @if ($useSidebar??true)
            <div class="col-3">
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="height: 100%;min-height: 100vh;">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="{{ url('semua-buku') }}"
                                class="nav-link link-dark {{ Request::segment(1)=='semua-buku'?'active':'' }}">
                                Semua Buku
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a href="{{ url('buku-tersedia') }}"
                                class="nav-link link-dark {{ Request::segment(1)=='buku-tersedia'?'active':'' }}">
                                Buku Tersedia
                            </a>
                        </li>
                        <hr>
                        <li>
                            <a href="{{ url('buku-dipinjam') }}"
                                class="nav-link link-dark {{ Request::segment(1)=='buku-dipinjam'?'active':'' }}">
                                Buku Dipinjam
                            </a>
                        </li>
                        <hr>
                    </ul>
                </div>
            </div>
            @endif
            <div class="col">
                <div class="pt-3 w-100">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">Kelompok 3 &copy; {{ date('Y') }} </span>
        </div>
    </footer>

    <div id="baseurl" data-baseurl="{{ url('') }}"></div>
    <div class="flash-data" data-title="{{ Session::get('alert-title') }}" data-icon="{{ Session::get('alert-icon') }}"
        data-message="{{ Session::get('alert-message') }}"></div>

    <script src="{{ asset('assets/library/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/library/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets/library/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    @yield('js')

    <script>
        $(function(){
            $(".loader").hide()
        })
    </script>
</body>

</html>
