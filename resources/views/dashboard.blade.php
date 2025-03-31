@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center px-3">
            <h3>Welcome, {{ ucfirst(auth()->user()->first_name . ' ' . auth()->user()->last_name) }}</h3>

            <!-- Logout Form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <a href="{{ route('donate') }}" class="btn submit-btn px-3 py-1" style="font-size: 12px;">Donate</a>
                <button type="submit" class="btn btn-outline-secondary px-3 py-1" style="border-radius: 20px; font-size: 12px;">Logout</button>
            </form>
        </div>

        <!-- Donor Information -->
        <div class="card mt-4 shadow-sm" style="border-radius: 15px">
            <div class="card-body">
                <h5 class="card-title">Your Information</h5>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Total Donations:</strong> ${{ auth()->user()->donations->sum('amount') ?? 0 }}</p>
            </div>
        </div>

        <div class="card mt-4 shadow-sm" style="border-radius: 15px">
            <div class="card-body">
                <h5 class="card-title">Your Donations</h5>
                @if(auth()->user()->donations->count() > 0)
                    @foreach(auth()->user()->donations as $donation)
                        @php
                            $type = [
                                "it-equipment" => "IT Equipment",
                                "free-training" => "Free Training",
                                "financial" => "Financial Support"
                            ];
                        @endphp
                        <div class="d-flex align-items-center lists-items border p-3 mb-3 rounded-4">
                            <img class="avatar" src="https://ui-avatars.com/api/?name={{ auth()->user()->first_name.'+'.auth()->user()->last_name }}" alt="Avatar">
                            <div class="ml-3">
                                <h5 class="mb-2">{{ $type[$donation->donation_type] }}</h5>
                                <p class="mb-0">
                                    <span style="font-weight:500">
                                        @if($donation->amount)
                                            {{' . '}}<span class="strike-through">N</span>{{ number_format($donation->amount) }}
                                        @endif
                                    </span>
                                    <span>{{ $donation->message }}</span>
                                    <span>{{' . ' . $donation->created_at->diffForHumans() }}</span>
                                </p>
                                <a href="#" class="btn submit-btn px-3 py-1 mt-2" style="font-size: 12px">Download Receipt</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No Donations to show</p>
                @endif
            </div>
        </div>

        <!-- Impact & Reports -->
        <div class="card mt-4 shadow-sm" style="border-radius: 15px">
            <div class="card-body">
                <h5 class="card-title">Impact & Reports</h5>
                <p>See how your donations are making a difference:</p>
                <a href="#" class="btn submit-btn px-3 py-1 mt-2" style="font-size: 12px">View Reports</a>
            </div>
        </div>

        <!-- Make a New Donation -->
        <div class="card mt-4 shadow-sm" style="border-radius: 15px">
            <div class="card-body">
                <h5 class="card-title">Make a New Donation</h5>
                <p>Your generosity helps us provide essential support, training, and resources to those in need. Every contribution makes a difference!</p>
                <a href="{{ route('donate') }}" class="btn submit-btn px-3 py-1 mt-2" style="font-size: 12px">Donate Now</a>
            </div>
        </div>


        <!-- Messages & Notifications -->
        {{-- <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Messages & Notifications</h5>
                @if(auth()->user()->notifications->count())
                    <ul class="list-group">
                        @foreach(auth()->user()->notifications as $notification)
                            <li class="list-group-item">{{ $notification->message }} <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small></li>
                        @endforeach
                    </ul>
                @else
                    <p>No new notifications.</p>
                @endif
            </div>
        </div> --}}

        <!-- Profile Management -->
        <div class="card mt-4 shadow-sm" style="border-radius: 15px">
            <div class="card-body">
                <h5 class="card-title">Manage Profile</h5>
                <a href="#" class="btn submit-btn px-3 py-1" style="font-size: 12px;">Edit Profile</a>
                <a href="#" class="btn btn-outline-danger px-3 py-1" style="border-radius: 20px; font-size: 12px;">Change Password</a>
            </div>
        </div>
    </div>
@endsection