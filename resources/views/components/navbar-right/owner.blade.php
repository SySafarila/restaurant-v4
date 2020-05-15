@if (Auth::user()->level == 'Owner')
<a href="{{ route('setting.index') }}" class="dropdown-item {{ Request::is(['setting/account']) ? 'active' : '' }}">Account</a>
<a href="{{ route('invoices.index') }}" class="dropdown-item {{ Request::is('dashboard/invoices') ? 'active' : '' }}">All Transactions & Invoices</a>
<a href="{{ route('setting.index') }}" class="dropdown-item {{ Request::is('setting') ? 'active' : '' }}">Setting</a>
@endif