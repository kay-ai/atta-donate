@extends('layouts.app')

@section('content')
    <div class="row" style="height: 100%">
        <div class="col-md-5">
            <a href="https://www.atta.ng" class="n-link">
                <i class="fa fa-long-arrow-left" aria-hidden="true" style="font-size: 18px;"></i>
            </a>
            <div class="d-flex justify-content-center" style="flex-direction: column; height:95%">
                <h3>Support the ATTA Initiative:</h3>
                <h5>Empower Lives Through IT Education</h5>

                <a href="/" class="login-text">Donate</a>
            </div>
        </div>
        <div class="col-md-7 d-flex justify-content-center" style="flex-direction: column">
            @include('includes.messages')
            <h3 class="mb-5">Login</h3>
            <form id="donationForm" action="{{route('login')}}" method="POST">
                @csrf
                <div class="row " style="height: 100%">
                    <div class="form-group col-md-12">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="phone">Password</label>
                        <input type="password" class="form-control" name="password" id="phone" placeholder="Enter password">
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" id="donateButton" class="btn submit-btn px-4 py-2">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
