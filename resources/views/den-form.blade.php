@extends('layouts.app')
@push('css')
<style>
    .title-height {
        flex-direction: column;
        height: 95vh;
    }
    @media (max-width: 768px) {
      .title-height {
        height: 20vh;
      }
    }
  </style>
@endpush
@section('content')
    <div class="row px-3 mb-5">
        <div class="col-md-5">
            <a href="https://www.atta.ng" class="n-link">
                <i class="fa fa-long-arrow-left" aria-hidden="true" style="font-size: 18px;"></i>
            </a>
            <div class="d-flex justify-content-center title-height">
                <h3>ATTA's Den</h3>
                <h5>Empowering IT Innovation and Excellence</h5>
            </div>
        </div>
        <div class="col-md-7">
            @include('includes.messages')
            <h3 class="mb-3">Application Form</h3>
            <form action="{{route('den.apply')}}" method="POST">
                @csrf
                <div class="row">
                    <p class="col-md-12" style="font-size:12px; font-weight:500">Personal Information</p>

                    <!-- Personal Information -->
                    <div class="form-group col-md-6">
                        <label for="first_name">First Name *</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Last Name *</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter your last name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email Address *</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="country">Country *</label>
                        <input type="text" class="form-control" name="country" id="country" placeholder="Enter your country" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="city">City *</label>
                         <input type="text" class="form-control" name="city" id="city" placeholder="Enter your city" required>
                    </div>

                    <p class="col-md-12" style="font-size:12px; font-weight:500">Business Information</p>

                    <!-- Business Information -->
                    <div class="form-group col-md-12">
                        <label for="business_name">Business Name (if applicable)</label>
                        <input type="text" class="form-control" name="business_name" id="business_name" placeholder="Enter your business name">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="business_website">Business Website (Optional)</label>
                        <input type="url" class="form-control" name="business_website" id="business_website" placeholder="Enter business website URL">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="industry">Industry *</label>
                        <select class="form-control" name="industry" id="industry" required>
                            <option value="tech">Technology (Required Category)</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="business_stage">Business Stage *</label>
                        <select class="form-control" name="business_stage" id="business_stage" required>
                            <option value="ideation">Ideation</option>
                            <option value="mvp">MVP</option>
                            <option value="scaling">Scaling</option>
                            <option value="revenue-generating">Revenue-Generating</option>
                        </select>
                    </div>

                    <p class="col-md-12" style="font-size:12px; font-weight:500">Your Business Idea</p>

                    <!-- Business Idea Details -->
                    <div class="form-group col-md-12">
                        <label for="idea_title">Idea Title *</label>
                        <input type="text" class="form-control" name="idea_title" id="idea_title" placeholder="Enter a catchy title for your idea" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="business_description">Describe Your Business Idea *</label>
                        <textarea class="form-control" name="business_description" id="business_description" rows="4" placeholder="Briefly describe your business idea" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="problem_statement">What Problem Does It Solve? *</label>
                        <textarea class="form-control" name="problem_statement" id="problem_statement" rows="3" placeholder="Describe the problem your business solves" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="target_audience">Target Audience/Customers *</label>
                        <textarea class="form-control" name="target_audience" id="target_audience" rows="3" placeholder="Who will benefit from your solution?" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="revenue_model">Revenue Model *</label>
                        <textarea class="form-control" name="revenue_model" id="revenue_model" rows="3" placeholder="How will your business generate revenue?" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="competitors">Competitors & Market Size *</label>
                        <textarea class="form-control" name="competitors" id="competitors" rows="3" placeholder="Mention competitors and potential market size" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="video_pitch">Video Pitch Link *</label>
                        <input type="url" class="form-control" name="video_pitch" id="video_pitch" placeholder="Paste your 2-minute video pitch link" required>
                    </div>

                    <p class="col-md-12" style="font-size:12px; font-weight:500">Funding Information</p>

                    <!-- Funding Information -->
                    <div class="form-group col-md-6">
                        <label for="funding_amount">How Much Funding Are You Seeking? *</label>
                        <input type="number" class="form-control" name="funding_amount" id="funding_amount" placeholder="Enter amount in USD or NGN" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="funding_usage">What Will the Funding Be Used For? *</label>
                        <textarea class="form-control" name="funding_usage" id="funding_usage" rows="3" placeholder="Provide a breakdown of how you will use the funds" required></textarea>
                    </div>

                    <p class="col-md-12" style="font-size:12px; font-weight:500">Additional Information</p>

                    <!-- Additional Questions -->
                    <div class="form-group col-md-6">
                        <label for="co_founders">Do You Have Any Co-Founders? *</label>
                        <select class="form-control" name="co_founders" id="co_founders" required>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 d-none" id="co_founders_names">
                        <label for="co_founders_details">Co-Founders’ Names & Roles</label>
                        <textarea class="form-control" name="co_founders_details" id="co_founders_details" rows="2" placeholder="Provide names and roles"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="previous_funding">Have You Received Any Previous Funding? *</label>
                        <select class="form-control" name="previous_funding" id="previous_funding" required>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 d-none" id="funding_details">
                        <label for="funding_source">If Yes, Mention Amount & Source</label>
                        <textarea class="form-control" name="funding_source" id="funding_source" rows="2" placeholder="Enter previous funding details"></textarea>
                    </div>

                    <!-- Submission Agreement -->
                    <div class="form-group col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I confirm that all information provided is accurate and agree to the initiative’s terms and conditions.
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-12 mt-4">
                        <button type="submit" id="applyButton" class="btn submit-btn px-4 py-2">Submit Application</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
