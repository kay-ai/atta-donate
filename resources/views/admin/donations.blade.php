@extends('layouts.app')

@section('content')
    <div class="row mb-5 px-3">
        <h4 class="text-green">Donations</h4>
    </div>

    <div class="table-responsive">
        <table class="table data-table table-striped table-bordered">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Full Name</th>
                    <th>Amount</th>
                    <th>Donation Type</th>
                    <th>Location</th>
                    <th style="min-width:200px">Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donations as $key => $donation)
                    <tr>
                        <td>{{ $key + 1}}</td>
                        <td>{{ $donation->user->first_name . ' '. $donation->user->last_name}}</td>
                        <td>
                            @if($donation->amount)
                                <span class="strike-through">N</span>{{ number_format($donation->amount) }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $donation->donation_type }}</td>
                        <td>{{ $donation->location ?? 'N/A' }}</td>
                        <td>{{ $donation->message ?? 'N/A' }}</td>
                        <td>{{ $donation->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection