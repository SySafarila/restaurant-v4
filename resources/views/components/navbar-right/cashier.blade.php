@if (Auth::user()->level == 'Cashier')
<a href="{{ route('profile.index') }}" class="dropdown-item {{ Request::is(['profile', 'profile/*']) ? 'active' : '' }}">My Profile</a>
<a href="{{ route('notifications.index') }}" class="dropdown-item {{ Request::is('notifications') ? 'active' : '' }}">Notifications</a>
{{-- <a href="{{ route('invoices.index') }}" class="dropdown-item {{ Request::is('dashboard/invoices') ? 'active' : '' }}">All Invoices</a> --}}
@endif