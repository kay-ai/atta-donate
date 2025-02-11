@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <h3>Welcome, {{ ucfirst(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}</h3>

            <!-- Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="/" class="btn submit-btn px-4 py-2">Donate</a>
                <button type="submit" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 20px;">Logout</button>
            </form>
        </div>

        <!-- Donor Information -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Your Information</h5>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Total Donations:</strong> ${{ auth()->user()->donations->sum('amount') ?? 0 }}</p>
            </div>
        </div>
    </div>
@endsection

