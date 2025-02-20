<div class="admin-contain">
    @include('partials.admin.sidebar')
    <div class="main-content">
        @include('partials.admin.header')
        <div class="admin-contain-content">
            @yield('content')
        </div>
    </div>
</div>
