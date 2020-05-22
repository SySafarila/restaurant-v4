@if (session('status-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status-success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('status-warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status-warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('status-danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('status-danger') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif