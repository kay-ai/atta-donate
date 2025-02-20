<div class="sidebar">
    <div class="logo">
        <img src="{{ asset('img/atta-logo.png') }}" alt="Logo" width="50">
        <div class="ml-3">
            <h4 class="mb-0">ATTA</h4>
            <p class="mb-0">INITIATIVE</p>
        </div>
    </div>
    <nav class="nav-links">
        <a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a>
        <a href="{{ route('admin.applications') }}">Applications</a>
        <a href="{{ route('admin.donations') }}">Donations</a>
        <a href="{{ route('admin.logout') }}" onclick="$('#logout-form').submit();" class="mt-3 logout-link">Logout</a>
    </nav>
</div>
