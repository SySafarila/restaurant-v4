<ul class="navbar-nav mr-auto">
    @if (Auth::user())
        <x-navbar-left.owner />
        <x-navbar-left.admin />
        <x-navbar-left.cashier />
        <x-navbar-left.customer />
        <x-navbar-left.chef />
    @endif
</ul>