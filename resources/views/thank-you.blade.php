@extends('layouts.app')

@section('content')
<a href="https://www.atta.ng" class="n-link">
    <i class="fa fa-long-arrow-left" aria-hidden="true" style="font-size: 18px;"></i>
</a>
    <div class="row justify-content-center align-items-center" style="height: 95%">
        <div class="text-center">
            <img src="{{asset('/img/atta-logo.png')}}" class="atta-img">
            <h2>Thank You, {{$name}} for Your Donation!</h2>
            <p>We appreciate your generosity.</p>
        </div>
        {{-- <img src="{{asset('/img/celebration.png')}}" class="celebration-img"> --}}
    </div>
@endsection
