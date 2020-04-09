@if (Auth::user()->level == 'Admin')
<a href="{{ route('profile.index') }}" class="dropdown-item {{ Request::is('dashboard/profile') ? 'active' : '' }}">My Profile</a>
<a href="{{ route('invoices.index') }}" class="dropdown-item {{ Request::is('dashboard/invoices') ? 'active' : '' }}">All Invoices</a>
@endif