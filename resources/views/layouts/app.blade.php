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
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/restaurantv4.css') }}" rel="stylesheet">
</head>
<body class="bg-white">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="material-icons pt-1">notifications_none</span>
                </button>
                <a class="navbar-brand text-success my-font mx-auto" href="{{ url('/') }}">Restaurant v4</a>
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="material-icons pt-1">menu_open</span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Auth::user())
                            <x-navbar-left.admin />
                            <x-navbar-left.cashier />
                            <x-navbar-left.customer />
                        @endif
                    </ul>

                    {{-- center navbar --}}
                    @if (Auth::user())
                    <ul class="navbar-nav mx-auto d-none d-md-block">
                        <li class="nav-item">
                            {{-- <form action="#" method="get"> --}}
                                <div class="d-flex">
                                    <input type="text" name="form" class="rounded-pill form-control form-control-sm d-none d-md-block d-lg-none" placeholder="What are you looking for ?" style="width:150px">
                                    <input type="text" name="form" class="rounded-pill form-control form-control-sm d-none d-lg-block d-xl-none" placeholder="What are you looking for ?" style="width:300px">
                                    <input type="text" name="form" class="rounded-pill form-control form-control-sm d-none d-xl-block" placeholder="What are you looking for ?" style="width:600px;">
                                    <button type="submit" class="rounded-pill btn btn-sm btn-outline-success ml-1"><i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">search</i></button>
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
                                <a class="nav-link {{ Request::is('login') ? 'active text-orange font-weight-bold' : '' }}" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('register') ? 'active text-orange font-weight-bold' : '' }}" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @if (Auth::user()->level == 'Customer')
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('dashboard/orders') ? 'active text-orange font-weight-bold' : '' }}">Orders <span class="badge badge-pill badge-success align-middle">{{ Auth::user()->orders->where('status', 'Pending')->count() }}</span></a>
                        </li>
                        @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" title="{{ '@' . Auth::user()->username }}" class="nav-link {{ Request::is(['profile', 'profile/*', 'dashboard/invoices', 'dashboard/profile/edit', 'dashboard/profile/login/edit']) ? 'active text-orange font-weight-bold' : '' }} dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ '@' . Str::limit(Auth::user()->username, 8, ' . .') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right mb-1" aria-labelledby="navbarDropdown">
                                    <x-navbar-right.customer />
                                    <x-navbar-right.cashier />
                                    <x-navbar-right.admin />
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
                                        <input type="text" name="" id="" class="rounded-pill form-control form-control-sm" placeholder="What are you looking for ?">
                                        <button type="submit" class="rounded-pill btn btn-sm btn-outline-success ml-1"><i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">search</i></button>
                                    </div>
                                {{-- </form> --}}
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-3">
            @yield('content')
        </main>

        <footer>
            <div class="container">
                <p class="text-muted text-center">&copy; 2020 <a href="http://instagram.com/sysafarila" target="_blank" class="text-decoration-none text-muted">SySafarila <i class="material-icons align-middle pb-1" style="font-size:1rem;">launch</i></a></p>
                <p class="text-muted text-center">
                    <a href="https://github.com/sysafarila/restaurant-v4" target="_blank"><svg class="svg-logo mb-1" height="20" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>GitHub</title><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg></a>
                </p>
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --}}
    @yield('script')
</body>
<!-- Build With <3 -->
</html>