<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Permintaan ATK Pengadilan Negeri Medan')</title>
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="navbar-fixed">
            <nav>
                <div class="nav-wrapper bg-color">
                    <a href="/" class="brand-logo center">Pengadilan Negeri Medan</a>
                </div>
            </nav>
        </div>
    </header>
    <div class="content">
        @yield('content')
    </div>
    <div class="wrapper bg-color footer">
        <div class="container center">
            <div class="copy-right">
                <div class="wrapper-copyright text">
                    &copy;2018 Ahmad Syahputra
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert2.min.js') }}"></script>
</body>

</html>
