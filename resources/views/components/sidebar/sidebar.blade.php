<main class="sidebar bg-white shadow-sm" id="sidebar">
    <ul style="list-style-type: none; padding-left: 0px; padding-bottom: 2.5rem;">
        <a href="{{ route('setting.overview') }}" class="text-decoration-none text-dark">
            <li class="list-hover py-2 sidebar-padding-left text-truncate {{ Request::is(['settings']) ? 'sidebar-active' : '' }}">Overview</li>
        </a>
        <a href="{{ route('setting.account') }}" class="text-decoration-none text-dark">
            <li class="list-hover py-2 sidebar-padding-left text-truncate {{ Request::is(['setting/account']) ? 'sidebar-active' : '' }}">Account</li>
        </a>
    </ul>
</main>