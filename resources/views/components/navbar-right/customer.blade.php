@if (Auth::user()->level == 'Customer')
<a href="{{ route('profile.index') }}" class="dropdown-item {{ Request::is('dashboard/profile') ? 'active' : '' }}">My Profile</a>
<a href="{{ route('invoices.index') }}" class="dropdown-item {{ Request::is('dashboard/invoices') ? 'active' : '' }}">Invoices</a>
@endif