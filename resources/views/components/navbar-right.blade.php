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
    <li class="nav-item d-none d-md-block position-relative">
        <a href="{{ route('notifications.index') }}" class="nav-link material-icons {{ Request::is(['notifications', 'notification/*']) ? 'active text-orange' : '' }}">notifications_none</a>
        <small class="badge badge-pill badge-success position-absolute border border-white" style="left: 1.4rem; top: 0rem;">{{ Auth::user()->notifications->where('status', false)->count() }}</small>
    </li>
    @if (Auth::user()->level == 'Customer')
    <li class="nav-item d-md-none">
        <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is(['orders', 'order/*']) ? 'active text-orange font-weight-bold' : '' }}">Orders <span class="badge badge-pill badge-success align-middle">{{ Auth::user()->orders->count() }}</span></a>
    </li>
    <li class="nav-item d-none d-md-block position-relative">
        <a href="{{ route('orders.index') }}" class="nav-link material-icons {{ Request::is(['orders', 'order/*']) ? 'active text-orange' : '' }}">shopping_cart</a>
        <small class="badge badge-pill badge-success position-absolute border border-white" style="left: 1.5rem; top: 0rem;">{{ Auth::user()->orders->count() }}</small>
    </li>
    @endif
    @if (Auth::user()->level == 'Owner')
    <li class="nav-item">
        <a href="{{ route('addAdmin.index') }}" class="nav-link {{ Request::is(['setting', 'setting/*']) ? 'active text-orange font-weight-bold' : '' }}">Admin's</a>
    </li>
    @endif
        <li class="nav-item dropdown">
            <a id="navbarDropdown" title="{{ '@' . Auth::user()->username }}" class="nav-link {{ Request::is(['profile', 'profile/*', 'invoices', 'invoice/*']) ? 'active text-orange font-weight-bold' : '' }} dropdown-toggle d-md-none" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                @if (Auth::user()->notifications->count() - Auth::user()->notifications->sum('status') > 0)
                <div class="spinner-grow spinner-grow-sm text-orange d-none d-md-inline-flex" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                @endif
                {{ '@' . Str::limit(Auth::user()->username, 8, ' . .') }} 
                <span class="caret"></span>
            </a>
            
            <a id="navbarDropdown" title="{{ '@' . Auth::user()->username }}" class="nav-link {{ Request::is(['settings', 'setting/account', 'invoices', 'invoice/*']) ? 'active text-orange font-weight-bold' : '' }} material-icons d-none d-md-block" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                account_circle
                <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right mb-1" aria-labelledby="navbarDropdown">
                <x-navbar-right.customer />
                <x-navbar-right.cashier />
                <x-navbar-right.admin />
                <x-navbar-right.owner />
                <x-navbar-right.chef />
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