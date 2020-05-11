@if (Auth::user()->level == 'Owner')
<a href="{{ route('profile.index') }}" class="dropdown-item {{ Request::is(['profile', 'profile/*']) ? 'active' : '' }}">My Profile</a>
<a href="{{ route('notifications.index') }}" class="dropdown-item d-none d-md-block {{ Request::is('notifications') ? 'active' : '' }}">
    {{-- <div class="d-flex justify-content-between">
        <span>Notifications</span>
        @if (Auth::user()->notifications->count() - Auth::user()->notifications->sum('status') > 0)
        <span>
            <div class="spinner-grow spinner-grow-sm text-orange" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </span>
        @endif
    </div> --}}
</a>
<a href="{{ route('invoices.index') }}" class="dropdown-item {{ Request::is('dashboard/invoices') ? 'active' : '' }}">All Transactions & Invoices</a>
@endif