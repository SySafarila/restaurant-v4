@if (Auth::user()->level == 'Admin')
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active text-orange font-weight-bold' : '' }}">Dashboard</a>
</li>
<li class="nav-item">
    <a href="{{ route('menus.index') }}" class="nav-link {{ Request::is(['dashboard/menus/*', 'dashboard/menu/*', 'menus', 'menu/*']) ? 'active text-orange font-weight-bold' : '' }}">Menus</a>
</li>
@endif