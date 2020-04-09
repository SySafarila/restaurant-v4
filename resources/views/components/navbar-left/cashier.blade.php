@if (Auth::user()->level == 'Cashier')
<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::is('dashboard') ? 'active text-orange font-weight-bold' : '' }}">Dashboard</a>
</li>
<li class="nav-item">
    <a href="{{ route('cashier.index') }}" class="nav-link {{ Request::is(['cashier', 'cashier/payment/*']) ? 'active text-orange font-weight-bold' : '' }}">Cashier</a>
</li>
@endif