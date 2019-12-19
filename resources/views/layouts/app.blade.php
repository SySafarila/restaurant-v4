<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Menus Branch Restaurant @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
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
                                    <input type="text" name="" id="" class="form-control form-control-sm" placeholder="What are you looking for ?">
                                    <button type="submit" class="btn btn-sm btn-success ml-1">Search</button>
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
                                <a href="#" class="nav-link">Orders <span class="badge badge-secondary align-middle">3</span></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link {{ Request::is('dashboard/profile') ? 'active' : '' }} dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ '@' . Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right mb-2" aria-labelledby="navbarDropdown">
                                    <a href="{{ route('profile.index') }}" class="dropdown-item">My Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            {{-- mobile --}}
                            <li class="nav-item d-sm-block d-md-none">
                                {{-- <form action="#" method="get"> --}}
                                    <div class="d-flex">
                                        <input type="text" name="" id="" class="form-control form-control-sm" placeholder="What are you looking for ?">
                                        <button type="submit" class="btn btn-sm btn-success ml-1">Search</button>
                                    </div>
                                {{-- </form> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
