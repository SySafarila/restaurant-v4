@if (Auth::user()->level == 'Chef')
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active text-orange font-weight-bold' : '' }}">Dashboard</a>
</li>
<li class="nav-item">
    <a href="{{ route('kitchen.index') }}" class="nav-link {{ Request::is(['kitchen', 'kitchen/*']) ? 'active text-orange font-weight-bold' : '' }}">Kitchen</a>
</li>
@endif