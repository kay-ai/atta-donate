@extends('layouts.app')

@section('content')
    <div class="row">
        <h3>Welcome, {{ucfirst(auth()->user()->first_name . ' ' . auth()->user()->last_name)}}</h3>
        <a href="/" class="login-text">Logout</a>
    </div>
@endsection
