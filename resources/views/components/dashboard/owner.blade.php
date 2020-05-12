@if (Auth::user()->level == 'Owner')
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('users.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Users</h5>
            <h6 class="card-subtitle mb-2 text-muted">See all users</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('employees.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Employees</h5>
            <h6 class="card-subtitle mb-2 text-muted">See all employees</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="#" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Transactions</h5>
            <h6 class="card-subtitle mb-2 text-muted">List of transactions</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('menus.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Menus</h5>
            <h6 class="card-subtitle mb-2 text-muted">See all menus</h6>
        </a>
    </div>
</div>
<div class="col-md-4 col-12 mb-4">
    <div class="card shadow-sm">
        <a href="{{ route('addAdmin.index') }}" class="card-body text-decoration-none">
            <h5 class="card-title text-dark">Admin's</h5>
            <h6 class="card-subtitle mb-2 text-muted">Admin's manager</h6>
        </a>
    </div>
</div>
@endif