@extends('layouts.app')

@section('content')
    <div class="row mb-5">
        <div class="col-md-3 mb-3">
            <div class="card dashboard-metrics shadow-sm px-4 py-2">
                <p>Total Donations</p>
                <h2 class="text-brown"><span class="strike-through">N</span>{{number_format($donation_sum)}}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card dashboard-metrics shadow-sm px-4 py-2">
                <p>Donor Count</p>
                <h2 class="text-brown">{{$donor_count}}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card dashboard-metrics shadow-sm px-4 py-2">
                <p>Support Applications</p>
                <h2 class="text-brown">{{$support_applications_count}}</h2>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card dashboard-metrics shadow-sm px-4 py-2">
                <p>Den Submissions</p>
                <h2 class="text-brown">{{$den_applications_count}}</h2>
            </div>
        </div>
    </div>

    <hr>
    <div class="row mt-3">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm md-p-4" style="border-radius: 15px; height: 100%">
                <h4 class="text-green mb-4">Donations</h4>
                <div class="lists-group">
                    @if(count($donations)>0)
                        @foreach($donations as $donation)
                        @php
                            $type = [
                                "it-equipment" => "IT Equipment",
                                "free-training" => "Free Training",
                                "financial" => "Financial Support"
                            ];
                        @endphp
                        <div class="d-flex align-items-center lists-items">
                            <img class="avatar" src="https://ui-avatars.com/api/?name={{$donation->user->first_name.'+'.$donation->user->last_name}}">
                            <div class="ml-3">
                                <h5 class="mb-0">{{$donation->user->first_name.' '.$donation->user->last_name}}</h5>
                                <p class="mb-0">
                                    <span>{{$type[$donation->donation_type]}}</span>
                                    <span style="font-weight:500">
                                        @if($donation->amount)
                                            {{' . '}}<span class="strike-through">N</span>{{number_format($donation->amount)}}
                                        @endif
                                    </span>
                                    <span>{{' . ' .$donation->created_at->diffForHumans()}}</span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>No Donations to show</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm md-p-4" style="border-radius: 15px">
                <h4 class="text-green mb-4">Support Applications</h4>
                <div class="lists-group">
                    @if(count($support_applications)>0)
                        @foreach($support_applications as $application)
                        @php
                            $type = [
                                "it-scholarship" => "IT Scholarship Programme",
                                "laptop" => "Laptop for Uni scheme"
                            ];
                        @endphp
                        <div class="d-flex align-items-center lists-items">
                            <img class="avatar" src="https://ui-avatars.com/api/?name={{$application->first_name.'+'.$application->last_name}}">
                            <div class="ml-3">
                                <div class="d-flex support-name">
                                    <h5 class="mb-0 mr-2">{{$application->first_name.' '.$application->last_name}}</h5>
                                    <p class="mb-0">{{' . ' .$type[$application->support_type]}}</p>
                                </div>
                                <p class="mb-0">
                                    <span style="font-weight:500">{{ucFirst($application->gender)}}</span>
                                    <span>{{' . ' .$application->phone}}</span>
                                    <span>{{' . ' .$application->created_at->diffForHumans()}}</span>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p>No applications to show</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card shadow-sm md-p-4" style="border-radius: 15px">
                <h4 class="text-green mb-4">Den Submissions</h4>
                <div class="row">
                    @if(count($den_applications) > 0)
                        @foreach($den_applications as $application)
                            <div class="col-md-4 mb-4">
                                <div class="card shadow-sm p-3 position-relative" style="border-radius: 10px;">

                                    {{-- Status & Stage Badges --}}

                                    {{-- Video Pitch --}}
                                    <div class="embed-responsive embed-responsive-16by9" style="border-radius: 10px;">
                                        <iframe class="embed-responsive-item" src="{{ $application->video_pitch }}"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                                        </iframe>
                                    </div>

                                    {{-- Applicant Details --}}
                                    <div class="card-body p-1 pt-4">
                                        <div class="d-flex justify-content-between mb-3">
                                            <span class="badge
                                                {{ $application->status == 'approved' ? 'bg-success' : ($application->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                                {{ ucfirst($application->status) }}
                                            </span>
                                            <span class="badge bg-dark text-white">
                                                Stage: {{ ucfirst($application->stage) }}
                                            </span>
                                        </div>
                                        <h5 class="card-title">{{ $application->first_name }} {{ $application->last_name }}</h5>
                                        <p class="card-text">
                                            <strong>Funding Amount:</strong> ${{ $application->funding_amount }}<br>
                                            <strong>Phone:</strong> {{ $application->phone }}<br>
                                            <strong>Submitted:</strong> {{ $application->created_at->diffForHumans() }}
                                        </p>

                                        {{-- Action Buttons --}}
                                        <div class="d-flex justify-content-between">
                                            <a href="{{ route('admin.den.application.details', $application->id) }}" target="_blank" class="btn btn-dark" style="border-radius: 20px; font-size:13px;">
                                                View
                                            </a>
                                            @if($application->status != 'approved')
                                            <div>
                                                <button class="btn btn-danger" style="border-radius: 20px; font-size:13px;" onclick="deleteApplication({{ $application->id }})">
                                                    Delete
                                                </button>
                                                <button id="approve-btn-{{ $application->id }}" class="btn submit-btn"
                                                    style="border-radius: 20px; font-size:13px;"
                                                    onclick="approveApplication({{ $application->id }})">
                                                    Approve
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center w-100">No applications to show</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection


