@if(Route::currentRouteName() === 'admin.index')
    <div class="contain">
        <div class="contain-content align-items-center" style="background-color: unset; blur(35px);">
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
