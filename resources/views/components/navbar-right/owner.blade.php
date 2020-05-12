@if (Auth::user()->level == 'Owner')
<a href="{{ route('profile.index') }}" class="dropdown-item {{ Request::is(['profile', 'profile/*']) ? 'active' : '' }}">My Profile</a>
<a href="{{ route('invoices.index') }}" class="dropdown-item {{ Request::is('dashboard/invoices') ? 'active' : '' }}">All Transactions & Invoices</a>
@endif