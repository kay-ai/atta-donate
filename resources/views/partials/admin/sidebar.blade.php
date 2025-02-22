<div class="sidebar-wrapper">
    <button id="sidebarToggle" class="sidebar-toggle">&#9776;</button>
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('img/atta-logo.png') }}" alt="Logo" width="50">
            <div class="ml-3">
                <h4 class="mb-0">ATTA</h4>
                <p class="mb-0">INITIATIVE</p>
            </div>
        </div>
        <nav class="nav-links">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.applications') }}" class="{{ request()->routeIs('admin.applications') ? 'active' : '' }}">Applications</a>
            <a href="{{ route('admin.donations') }}" class="{{ request()->routeIs('admin.donations') ? 'active' : '' }}">Donations</a>
            <a href="javascript:void(0)" onclick="$('#logout-form').submit();" class="mt-3 logout-link">Logout</a>
        </nav>
    </div>
</div>
