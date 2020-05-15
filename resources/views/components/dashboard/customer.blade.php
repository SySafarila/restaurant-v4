@if (Auth::user()->level == 'Customer')
<div class="col-md-4 col-12 mb-3">
    <div class="card shadow-sm h-100">
        <a href="{{ route('menus.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark"><i class="material-icons align-middle text-success" style="font-size:20px;padding-bottom:5px;">menu_book</i> Menus List</h5>
            <h6 class="card-subtitle mb-0 text-muted">Foods, Drinks, Desserts, Cakes, Etc.</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-3">
    <div class="card shadow-sm h-100">
        <a href="{{ route('orders.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">My Orders <span class="badge badge-pill badge-success align-middle">{{ Auth::user()->orders->where('status', 'Pending')->count() }}</span></h5>
            <h6 class="card-subtitle mb-0 text-muted">Pending, Cooking</h6>
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
        <a href="{{ route('invoices.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Invoices</h5>
            <h6 class="card-subtitle mb-0 text-muted">
                @if (Auth::user()->invoices->count() == 0)
                    You don't have any invoices
                @else
                    List an <i>Invoices</i>
                @endif
            </h6>
        </a>
    </div>
</div>
@endif