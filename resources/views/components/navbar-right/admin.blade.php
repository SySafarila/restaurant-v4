@if (Auth::user()->level == 'Admin')
<a href="{{ route('setting.account') }}" class="dropdown-item {{ Request::is(['setting/account']) ? 'active' : '' }}">Account</a>
<a href="{{ route('invoices.index') }}" class="dropdown-item {{ Request::is(['invoices', 'invoice/*']) ? 'active' : '' }}">All Invoices</a>
<a href="{{ route('setting.overview') }}" class="dropdown-item {{ Request::is('settings') ? 'active' : '' }}">Setting</a>
@endif