@if (Auth::user()->level == 'Admin')
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('menus.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Menus</h5>
            <h6 class="card-subtitle mb-2 text-muted">Organizer Foods, Drinks, Desserts, Cakes, Etc</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('users.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Users</h5>
            <h6 class="card-subtitle mb-2 text-muted">Organizer Users</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="#" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Employees</h5>
            <h6 class="card-subtitle mb-2 text-muted">Organizer Employees</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('invoices.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Transactions</h5>
            <h6 class="card-subtitle mb-2 text-muted">Organizer Transactions</h6>
        </a>
    </div>
</div>
@endif