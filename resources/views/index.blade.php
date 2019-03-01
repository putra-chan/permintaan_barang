<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Permintaan ATK Pengadilan Negeri Medan')</title>
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/icon?family=Material+Icons') }}">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slim.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dataTables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dataTables/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <div class="row navbar-fixed">
            <nav>
                <div class="nav-wrapper bg-color">
                    {{-- <img src="{{ asset('img/pn.jfif') }}" alt="Logo Pengadilan Negeri Medan" width="64px" height="64px"> --}}
                    @guest
                    <a href="/" class="brand-logo" style="padding-left:20px">Pengadilan Negeri Medan</a>
                    @else
                    @if (Auth::user()->role == 0)
                    <a href="/home" class="brand-logo" style="padding-left:20px">Pengadilan Negeri Medan</a>
                    @elseif (Auth::user()->role == 1)
                    <a href="/admin" class="brand-logo" style="padding-left:20px">Pengadilan Negeri Medan</a>
                    @elseif (Auth::user()->role == 2)
                    <a href="/approve" class="brand-logo" style="padding-left:20px">Pengadilan Negeri Medan</a>
                    @endif
                    @endguest
                    <a href="#" data-activates="mobile-navbar" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down" style="padding-right:45px;">
                        @guest
                        <li><a href="/">Home</a></li>
                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li>
                            <a href="#" role="button" data-activates="dropdown-atuh">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                    <ul class="side-nav" id="mobile-navbar">
                        <li><a href="#">Home</a></li>
                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li>
                            <a class="btn " href="#" role="button" data-activates="dropdown-atuh">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-content" id="dropdown-auth">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        @endguest
                        @else
                        @if (Auth::user()->role == 0)
                        <li><a href="/">Dashboard</a></li>
                        <li><a href="/pr_home">Purchasing Request</a></li>
                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li>
                            <a href="#" role="button" data-activates="dropdown-atuh">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                    <ul class="side-nav" id="mobile-navbar">
                        <li><a href="/">Home</a></li>
                        <li><a href="/pr_home">Purchasing Request</a></li>
                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li>
                            <a class="btn " href="#" role="button" data-activates="dropdown-atuh">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-content" id="dropdown-auth">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        @endguest
                        @elseif (Auth::user()->role == 1)
                        <li><a href="/admin">Dashboard</a></li>
                        <li><a href="/product">Product</a></li>
                        <li><a href="#">Purchasing Request</a></li>
                        <li><a href="/purchasingOrder">Purchasing Order</a></li>
                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li>
                            <a href="#" role="button" data-activates="dropdown-atuh">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                    <ul class="side-nav" id="mobile-navbar">
                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li>
                            <a class="btn " href="#" role="button" data-activates="dropdown-atuh">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-content" id="dropdown-auth">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        @endguest
                        <li><a href="/admin">Dashboard</a></li>
                        <li><a href="/product">Product</a></li>
                        <li><a href="#">Purchasing Request</a></li>
                        <li><a href="/purchasingOrder">Purchasing Order</a></li>
                        @elseif (Auth::user()->role == 2)
                        <li><a href="/approve">Approve</a></li>
                        <li><a href="#">Data Bulanan</a></li>
                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li>
                            <a href="#" role="button" data-activates="dropdown-atuh">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        @endguest
                    </ul>
                    <ul class="side-nav" id="mobile-navbar">
                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                        @else
                        <li>
                            <a href="#">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                        @endguest
                        <li><a href="/approve">Approve</a></li>
                        <li><a href="#">Data Bulanan</a></li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endif
                        @endguest
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <main class="container content">
        @yield('content')
    </main>
    <div class="row mt151 footer">
        <div class="container center">
            <div class="copy-right">
                <div class="wrapper-copyright">
                    &copy;2018 Ahmad Syahputra
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slim.global.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slim.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/slim.kickstart.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dataTables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js')}}"></script>
    @yield('js')
</body>
</html>
