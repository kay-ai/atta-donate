@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-metrics shadow-sm px-4 py-2">
                <p>Total Donations</p>
                <h2>₦ {{number_format($donation_sum)}}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-metrics shadow-sm px-4 py-2">
                <p>Donor Count</p>
                <h2>{{$donor_count}}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-metrics shadow-sm px-4 py-2">
                <p>Support Applications</p>
                <h2>{{$support_applications_count}}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-metrics shadow-sm px-4 py-2">
                <p>Den Submissions</p>
                <h2>0</h2>
            </div>
        </div>
    </div>
@endsection

