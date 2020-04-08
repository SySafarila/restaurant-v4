@if (Auth::user()->level == 'Owner')
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('users.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Users Panel</h5>
            <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="#" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Employees Panel</h5>
            <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="#" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Transactions Panel</h5>
            <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('menus.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Menus Panel</h5>
            <h6 class="card-subtitle mb-2 text-muted">Show, add, edit, or delete</h6>
        </a>
    </div>
</div>
@endif