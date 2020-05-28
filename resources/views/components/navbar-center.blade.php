@if (Auth::user())
<ul class="navbar-nav mx-auto d-none d-md-block">
    <li class="nav-item">
        <form action="{{ route('menus.search') }}" method="get">
            <div class="d-flex">
                <input type="text" name="name" class="rounded-pill form-control form-control-sm d-none d-md-block search-top text-truncate" placeholder="Did You Looking for Food's or Drink's ?" required>
                <button type="submit" class="rounded-pill btn btn-sm btn-outline-success ml-1"><i class="material-icons align-middle" style="font-size:15px; padding-bottom:2px;">search</i></button>
            </div>
        </form>
    </li>
</ul>
@endif