@if (Auth::user()->level == 'Cashier')
<a href="{{ route('setting.account') }}" class="dropdown-item {{ Request::is(['setting/account']) ? 'active' : '' }}">Account</a>
<a href="{{ route('setting.overview') }}" class="dropdown-item {{ Request::is('settings') ? 'active' : '' }}">Setting</a>
@endif