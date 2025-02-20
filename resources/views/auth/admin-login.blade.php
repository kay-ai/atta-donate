@extends('layouts.app')

@section('content')
    <div class="row justify-content-center" style="height: 100%">
        <div class="col-md-5 d-flex justify-content-center shadow p-5 bg-light" style="flex-direction: column; border-radius: 15px;">
            @include('includes.messages')
            <h3 class="mb-5">Login</h3>
            <form action="{{route('admin.login')}}" method="POST">
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
