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
        {{-- <x-mini-navbar /> --}}
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
            <div class="container-fluid">
                @auth
                <button class="navbar-toggler border-0 position-relative" type="button">
                    @if (Auth::user()->notifications->count() - Auth::user()->notifications->sum('status') > 0)
                        <span class="material-icons position-absolute text-success" style="font-size: 1rem; left: 1.5rem;">fiber_manual_record</span>
                    @endif
                    <a href="{{ route('notifications.index') }}" class="material-icons pt-1 text-decoration-none {{ Request::is('notifications') ? ' text-orange ' : 'text-muted' }}">notifications_none</a>
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
                    <x-navbar-left />

                    {{-- center navbar --}}
                    <x-navbar-center />

                    <!-- Right Side Of Navbar -->
                    <x-navbar-right />
                </div>
            </div>
        </nav>

        <x-sidebar.sidebar-toggle />
        <x-sidebar.sidebar />
        <main class="pt-3 main">
            @yield('content')
        </main>

        <footer class="main">
            <div class="container-fluid">
                <hr>
                <p class="text-muted text-center">&copy; 2020 <a href="https://instagram.com/sysafarila" target="_blank" class="text-decoration-none text-muted">SySafarila <i class="material-icons align-middle pb-1" style="font-size:1rem;">launch</i></a></p>
                <p class="text-muted text-center">
                    <a href="https://github.com/sysafarila/restaurant-v4" target="_blank"><img src="{{ asset('svg/github.svg') }}" alt="Github" class="github"></a>
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