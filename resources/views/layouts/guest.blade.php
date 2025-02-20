@if(route('admin.login'))
    <div class="contain">
        <div class="contain-content" style="background-color: unset;">
            @yield('content')
        </div>
    </div>
@else
    <div class="contain">
        <div class="contain-content">
            @yield('content')
        </div>
    </div>
@endif
