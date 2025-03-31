@extends('layouts.app')

@section('content')
    <div class="row mb-5 px-3">
        <h4 class="text-green">Support Applications</h4>
    </div>

    <div class="table-responsive">
        <table class="table data-table table-striped table-bordered">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Support Type</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Area of Interest</th>
                    <th>CV</th>
                    <th style="min-width:200px">Message</th>
                    <th>Institution</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $key => $application)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $application->support_type }}</td>
                        <td>{{ $application->first_name .' '. $application->last_name}}</td>
                        <td>{{ $application->gender }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->phone }}</td>
                        <td>{{ $application->area_of_interest }}</td>
                        <td>
                            @if($application->cv)
                                <a href="{{ asset('storage/' . $application->cv) }}" target="_blank">View CV</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $application->message }}</td>
                        <td>{{ $application->institution }}</td>
                        <td>{{ $application->created_at->format('d-m-Y H:i:s') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection