<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Restaurant @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand text-success my-font" href="{{ url('/') }}">
                    Restaurant v4
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="material-icons">menu_open</span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Auth::user())
                            <li class="nav-item">
                                <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('menus.index') }}" class="nav-link {{ Request::is('dashboard/menus') ? 'active' : '' }}">Menus</a>
                            </li>
                        @endif
                    </ul>

                    {{-- center navbar --}}
                    @if (Auth::user())
                    <ul class="navbar-nav mx-auto d-none d-md-block">
                        <li class="nav-item">
                            {{-- <form action="#" method="get"> --}}
                                <div class="d-flex">
                                    <input type="text" name="" id="" class="form-control form-control-sm d-none d-md-block d-lg-none" placeholder="What are you looking for ?" style="width:150px">
                                    <input type="text" name="" id="" class="form-control form-control-sm d-none d-lg-block d-xl-none" placeholder="What are you looking for ?" style="width:300px">
                                    <input type="text" name="" id="" class="form-control form-control-sm d-none d-xl-block" placeholder="What are you looking for ?" style="width:600px;">
                                    <button type="submit" class="btn btn-sm btn-outline-success ml-1"><i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">search</i></button>
                                </div>
                            {{-- </form> --}}
                        </li>
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('dashboard/orders') ? 'active' : '' }}">Orders <span class="badge badge-pill badge-success align-middle">{{ Auth::user()->orders->where('status', 'Pending')->count() }}</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" title="{{ '@' . Auth::user()->username }}" class="nav-link {{ Request::is('dashboard/profile') ? 'active' : '' }} dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ '@' . Str::limit(Auth::user()->username, 8, ' . .') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right mb-1" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('profile.index') }}" class="dropdown-item {{ Request::is('dashboard/profile') ? 'active' : '' }}">My Profile</a>
                                    <a href="{{ route('orders.invoices') }}" class="dropdown-item {{ Request::is('dashboard/invoices') ? 'active' : '' }}">Invoices</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">power_settings_new</i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            {{-- mobile --}}
                            <li class="nav-item d-sm-block d-md-none mt-2">
                                {{-- <form action="#" method="get"> --}}
                                    <div class="d-flex">
                                        <input type="text" name="" id="" class="form-control form-control-sm" placeholder="What are you looking for ?">
                                        <button type="submit" class="btn btn-sm btn-outline-success ml-1"><i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">search</i></button>
                                    </div>
                                {{-- </form> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-3 py-md-2 py-lg-3">
            @yield('content')
        </main>
    </div>
</body>
</html>
