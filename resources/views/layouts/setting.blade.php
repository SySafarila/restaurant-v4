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
    <link href="{{ asset('css/restaurantv4.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                @auth
                <button class="navbar-toggler border-0" type="button">
                    @if (Auth::user()->notifications->count() - Auth::user()->notifications->sum('status') > 0)
                    <div class="spinner-grow spinner-grow-sm text-orange mt-1" role="status" style="position:fixed;">
                        <span class="sr-only">Loading...</span>
                    </div>
                    @endif
                    <a href="{{ route('notifications.index') }}" class="material-icons pt-1 text-decoration-none @if(Auth::user()->notifications->count() - Auth::user()->notifications->sum('status') == 0) text-muted @else text-orange @endif">@if(Auth::user()->notifications->count() - Auth::user()->notifications->sum('status') == 0) notifications_none @else notification_important @endif</a>
                </button>
                @else
                <button class="navbar-toggler border-0" type="button">
                    <a href="#" class="material-icons pt-1 text-decoration-none text-muted">notifications_none</a>
                </button>
                @endauth
                <a class="navbar-brand text-success my-font mx-auto" href="{{ url('/') }}">Restaurant v4</a>
                <button class="navbar-toggler border-0" type="button" onclick="menuButtonClick()" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="material-icons pt-1 text-muted" id="menuButton">menu</span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Auth::user())
                            <x-navbar-left.owner />
                            <x-navbar-left.admin />
                            <x-navbar-left.cashier />
                            <x-navbar-left.customer />
                        @endif
                    </ul>

                    {{-- center navbar --}}
                    @if (Auth::user())
                    <ul class="navbar-nav mx-auto d-none d-md-block">
                        <li class="nav-item">
                            <form action="{{ route('menus.search') }}" method="get">
                                <div class="d-flex">
                                    <input type="text" name="name" class="rounded-pill form-control form-control-sm d-none d-md-block search-top text-truncate" placeholder="Did You Looking for Food's or Drink's ?">
                                    {{-- <input type="text" name="name" class="rounded-pill form-control form-control-sm d-none d-lg-block d-xl-none search-top" placeholder="Looking for Food's or Drink's ?">
                                    <input type="text" name="name" class="rounded-pill form-control form-control-sm d-none d-xl-block search-top" placeholder="Looking for Food's or Drink's ?"> --}}
                                    <button type="submit" class="rounded-pill btn btn-sm btn-outline-success ml-1"><i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">search</i></button>
                                </div>
                            </form>
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
                            <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is(['orders', 'order/*']) ? 'active text-orange font-weight-bold' : '' }}">Orders <span class="badge badge-pill badge-success align-middle">{{ Auth::user()->orders->where('status', 'Pending')->count() }}</span></a>
                        </li>
                        @endif
                        @if (Auth::user()->level == 'Owner')
                        <li class="nav-item">
                            <a href="{{ route('addAdmin.index') }}" class="nav-link {{ Request::is(['setting', 'setting/*']) ? 'active text-orange font-weight-bold' : '' }}">Admin's</a>
                        </li>
                        @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" title="{{ '@' . Auth::user()->username }}" class="nav-link {{ Request::is(['setting/*', 'invoices', 'invoice/*', 'notifications', 'notification/*']) ? 'active text-orange font-weight-bold' : '' }} dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (Auth::user()->notifications->count() - Auth::user()->notifications->sum('status') > 0)
                                    <div class="spinner-grow spinner-grow-sm text-orange d-none d-md-inline-flex" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    @endif
                                    {{ '@' . Str::limit(Auth::user()->username, 8, ' . .') }} 
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right mb-1" aria-labelledby="navbarDropdown">
                                    <x-navbar-right.customer />
                                    <x-navbar-right.cashier />
                                    <x-navbar-right.admin />
                                    <x-navbar-right.owner />
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
                                <form action="{{ route('menus.search') }}" method="get">
                                    <div class="d-flex">
                                        <input type="text" name="name" class="rounded-pill form-control form-control-sm" placeholder="Did You Looking for Food's or Drink's ?">
                                        <button type="submit" class="rounded-pill btn btn-sm btn-outline-success ml-1"><i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">search</i></button>
                                    </div>
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="sidebar-button" id="sidebar-button">
            <button type="button" class="btn material-icons sidebar-button-toggle" style="box-shadow: none;" onclick="sidebar()">more_vert</button>
        </div>
        <main class="sidebar bg-white shadow-sm" id="sidebar">
            <ul style="list-style-type: none; padding-left: 0px; padding-bottom: 2.5rem;">
                <a href="{{ route('setting.index') }}" class="text-decoration-none text-dark">
                    <li class="list-hover p-2 {{ Request::is(['setting/account']) ? 'sidebar-active' : '' }}">Account</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#3" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Employee's</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#3" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Employee's</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#3" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Employee's</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#3" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Employee's</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#3" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Employee's</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#3" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Employee's</li>
                </a>
                <a href="#2" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Restaurant</li>
                </a>
                <a href="#3" class="text-decoration-none text-dark">
                    <li class="list-hover p-2">Employee'ssss</li>
                </a>
            </ul>
        </main>
        <main class="pt-3 main">
            @yield('content')
        </main>

        <footer class="main">
            <div class="container-fluid">
                <hr>
                <p class="text-muted text-center">&copy; 2020 <a href="https://instagram.com/sysafarila" target="_blank" class="text-decoration-none text-muted">SySafarila <i class="material-icons align-middle pb-1" style="font-size:1rem;">launch</i></a></p>
                <p class="text-muted text-center">
                    <a href="https://github.com/sysafarila/restaurant-v4" target="_blank"><img src="{{ asset('svg/github.svg') }}" alt="Github"></a>
                </p>
            </div>
        </footer>
    </div>
    <script>
        function menuButtonClick() {
            if (document.getElementById('menuButton').innerHTML == 'menu') {
                document.getElementById('menuButton').innerHTML = 'menu_open';
                // console.log('true');
            } else {
                document.getElementById('menuButton').innerHTML = 'menu';
            }
        }

        function sidebar() {
            document.getElementById('sidebar').classList.toggle('sidebar-show');
            document.getElementById('sidebar-button').classList.toggle('sidebar-button-show');
        }
    </script>
    @yield('script')
</body>
<!-- Build With <3 -->
</html>