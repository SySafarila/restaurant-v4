@if (Auth::user()->level == 'Cashier')
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('cashier.index')}}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Payment</h5>
            <h6 class="card-subtitle mb-0 text-muted">Checkout Users Orders</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm h-100">
        <a href="{{ route('notifications.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Notifications</h5>
            <h6 class="card-subtitle mb-0 text-muted">
                @if (Auth::user()->notifications->where('status', false)->count() == 0)
                    See all notifications
                @else
                    @if (Auth::user()->notifications->where('status', true)->count() == 1)
                        You have 1 new notification
                    @else
                        You have {{ Auth::user()->notifications->where('status', false)->count() }} new notifications
                    @endif
                @endif
            </h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('setting.overview') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Setting</h5>
            <h6 class="card-subtitle mb-0 text-muted">Go to setting center</h6>
        </a>
    </div>
</div>
@endif