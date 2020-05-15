@if (Auth::user()->level == 'Customer')
<a href="{{ route('setting.index') }}" class="dropdown-item {{ Request::is(['setting/account']) ? 'active' : '' }}">Account</a>
<a href="{{ route('notifications.index') }}" class="dropdown-item d-none d-md-block {{ Request::is('notifications') ? 'active' : '' }}">
    <div class="d-flex justify-content-between">
        <span>Notifications</span>
        @if (Auth::user()->notifications->count() - Auth::user()->notifications->sum('status') > 0)
        <span>
            <div class="spinner-grow spinner-grow-sm text-orange" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </span>
        @endif
    </div>
</a>
<a href="{{ route('invoices.index') }}" class="dropdown-item {{ Request::is(['invoices', 'invoice/*']) ? 'active' : '' }}">Invoices</a>
<a href="{{ route('setting.index') }}" class="dropdown-item {{ Request::is('setting') ? 'active' : '' }}">Setting</a>
@endif