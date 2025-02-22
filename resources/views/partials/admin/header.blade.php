<div class="header">
    <h3 class="mb-0 dashboard-text">Dashboard</h2>
    <div class="user-profile">
        <span class="mr-3 welcome-text">Welcome, {{ ucfirst(Auth::guard('admin')->user()->first_name . ' ' . Auth::guard('admin')->user()->last_name) }}</span>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
            @csrf
        </form>
        <button type="submit" onclick="$('#logout-form').submit();" class="btn btn-outline-secondary logout-btn" style="border-radius: 20px;">Logout</button>
        <img src="https://ui-avatars.com/api/?name={{Auth::guard('admin')->user()->first_name.'+'.Auth::guard('admin')->user()->last_name}}">
    </div>
</div>
