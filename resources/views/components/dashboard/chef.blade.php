@if (Auth::user()->level == 'Chef')
<div class="col-md-4 col-12 mb-3">
    <div class="card shadow-sm h-100">
        <a href="{{ route('kitchen.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Kitchen</h5>
            <h6 class="card-subtitle mb-0 text-muted">Pending & Cooking panel</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-3">
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
<div class="col-md-4 col-12 mb-3">
    <div class="card shadow-sm h-100">
        <a href="{{ route('setting.overview') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Setting</h5>
            <h6 class="card-subtitle mb-0 text-muted">Go to setting center</h6>
        </a>
    </div>
</div>
@endif