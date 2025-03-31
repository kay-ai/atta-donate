@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card shadow-sm p-4" style="border-radius: 15px;">

                {{-- Page Title --}}
                <h4 class="text-green mb-4">Application Details</h4>

                {{-- Status & Stage Badges --}}
                <div class="d-flex justify-content-between">
                    <span class="badge
                        {{ $denApplication->status == 'approved' ? 'bg-success' : ($denApplication->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                        Status: {{ ucfirst($denApplication->status) }}
                    </span>

                    <span class="badge bg-info">
                        Stage: {{ ucfirst($denApplication->stage) }}
                    </span>
                </div>

                {{-- Video Pitch --}}
                <div class="embed-responsive embed-responsive-16by9 my-4" style="border-radius: 10px;">
                    <iframe class="embed-responsive-item" src="{{ $denApplication->video_pitch }}"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>
                @if($denApplication->interview)
                    <div class="row mb-5">
                        <div class="col-md-12">
                            {{-- Interview Details --}}
                            <h5 class="mt-4">Interview Details</h5>
                            <span class="mb-1 mr-3">
                                <strong>Date:</strong>
                                {{ \Carbon\Carbon::parse($denApplication->interview->interview_date)->format('d M, Y') }}
                            </span> |
                            <span class="mb-1 mx-3">
                                <strong>Time:</strong>
                                {{ \Carbon\Carbon::parse($denApplication->interview->interview_time)->format('h:i A') }}
                            </span> |
                            <span class="mb-1 ml-3"><strong>Venue:</strong>
                                <a href="{{ $denApplication->interview->venue }}">
                                    {{ $denApplication->interview->venue }}
                                </a>
                            </span>
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        {{-- Applicant Details --}}
                        <h5 class="mb-3">{{ $denApplication->first_name }} {{ $denApplication->last_name }}</h5>
                        <p class="mb-1"><strong>Email:</strong> {{ $denApplication->email }}</p>
                        <p class="mb-1"><strong>Phone:</strong> {{ $denApplication->phone }}</p>
                        <p class="mb-1"><strong>Country:</strong> {{ $denApplication->country }}</p>
                        <p class="mb-1"><strong>City:</strong> {{ $denApplication->city }}</p>
                        <p class="mb-1"><strong>Submitted:</strong> {{ $denApplication->created_at->format('F j, Y, g:i a') }} ({{ $denApplication->created_at->diffForHumans() }})</p>
                    </div>
                    <div class="col-md-6">
                        {{-- Business Details --}}
                        <h5 class="mt-4 mb-3">Business Information</h5>
                        <p class="mb-1"><strong>Business Name:</strong> {{ $denApplication->business_name ?? 'N/A' }}</p>
                        <p class="mb-1"><strong>Website:</strong> <a href="{{ $denApplication->business_website }}" target="_blank">{{ $denApplication->business_website ?? 'N/A' }}</a></p>
                        <p class="mb-1"><strong>Industry:</strong> {{ ucfirst($denApplication->industry) }}</p>
                        <p class="mb-1"><strong>Business Stage:</strong> {{ ucfirst($denApplication->business_stage) }}</p>
                        <p class="mb-1"><strong>Idea Title:</strong> {{ $denApplication->idea_title }}</p>
                        <p class="mb-1"><strong>Business Description:</strong> {{ $denApplication->business_description }}</p>
                        <p class="mb-1"><strong>Problem Statement:</strong> {{ $denApplication->problem_statement }}</p>
                        <p class="mb-1"><strong>Target Audience:</strong> {{ $denApplication->target_audience }}</p>
                        <p class="mb-1"><strong>Revenue Model:</strong> {{ $denApplication->revenue_model }}</p>
                        <p class="mb-1"><strong>Competitors:</strong> {{ $denApplication->competitors }}</p>
                    </div>
                    <div class="col-md-6">
                        {{-- Funding Details --}}
                        <h5 class="mt-4 mb-3">Funding Information</h5>
                        <p class="mb-1"><strong>Funding Amount:</strong> ${{ number_format($denApplication->funding_amount, 2) }}</p>
                        <p class="mb-1"><strong>Funding Usage:</strong> {{ $denApplication->funding_usage }}</p>
                        <p class="mb-1"><strong>Previous Funding:</strong> {{ ucfirst($denApplication->previous_funding) }}</p>
                        <p class="mb-1"><strong>Funding Source:</strong> {{ $denApplication->funding_source ?? 'N/A' }}</p>

                        {{-- Co-founders --}}
                        <h5 class="mt-4 mb-3">Co-founders Information</h5>
                        <p class="mb-1"><strong>Co-founders:</strong> {{ ucfirst($denApplication->co_founders) }}</p>
                        <p class="mb-1"><strong>Co-founders Details:</strong> {{ $denApplication->co_founders_details ?? 'N/A' }}</p>
                    </div>
                </div>
                @if($denApplication->stage != 'funded')
                    <div class="row justify-content-center mt-5">
                        {{-- Change Application Stage Card --}}
                        <div class="col-md-6 card shadow-sm p-4" style="border-radius: 15px;">
                            <form action="{{ route('admin.den.application.updateStage', $denApplication->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="stage"><strong>Change Application Stage:</strong></label>
                                    <select name="stage" id="stage" class="form-control">
                                        <option value="submitted" {{ $denApplication->stage == 'submitted' ? 'selected' : '' }}>Submitted</option>
                                        <option value="review" {{ $denApplication->stage == 'review' ? 'selected' : '' }}>Under Review</option>
                                        <option value="interview" {{ $denApplication->stage == 'interview' ? 'selected' : '' }}>Interview Scheduled</option>
                                        <option value="funded" {{ $denApplication->stage == 'funded' ? 'selected' : '' }}>Funded</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn mt-2 submit-btn px-3 py-2" style="font-size: 13px;">Update Stage</button>
                            </form>
                        </div>
                    </div>
                @endif
                @if($denApplication->stage == 'review')
                    <div class="row justify-content-center mt-5">
                        {{-- Schedule Interview Card --}}
                        <div class="col-md-6 card shadow-sm p-4" style="border-radius: 15px;">
                            <form action="{{ route('admin.den.application.scheduleInterview', $denApplication->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="interview_date"><strong>Interview Date:</strong></label>
                                    <input type="date" name="interview_date" id="interview_date" class="form-control" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="interview_time"><strong>Interview Time:</strong></label>
                                    <input type="time" name="interview_time" id="interview_time" class="form-control" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="venue"><strong>Interview Venue:</strong></label>
                                    <input type="text" name="venue" id="venue" class="form-control" placeholder="Enter venue" required>
                                </div>
                                <button type="submit" class="btn mt-3 submit-btn px-3 py-2" style="font-size: 13px;">Schedule Interview</button>
                            </form>
                        </div>
                    </div>
                @endif



                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between mt-5">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary logout-btn" style="border-radius: 20px;">
                        ← Back to List
                    </a>

                    @if($denApplication->status != 'approved')
                    <div>
                        <button class="btn btn-danger logout-btn" style="border-radius: 20px;" onclick="deleteApplication({{ $denApplication->id }})">
                            Delete
                        </button>
                        <button id="approve-btn-{{ $denApplication->id }}" class="btn submit-btn logout-btn"
                            style="border-radius: 20px;"
                            onclick="approveApplication({{ $denApplication->id }})">
                            Approve
                        </button>

                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
