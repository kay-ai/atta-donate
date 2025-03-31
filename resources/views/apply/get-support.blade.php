@extends('layouts.app')

@section('content')
    <div class="row px-3 mb-5">
        <div class="col-md-5">
            <a href="https://www.atta.ng" class="n-link">
                <i class="fa fa-long-arrow-left" aria-hidden="true" style="font-size: 18px;"></i>
            </a>
            <div class="d-flex justify-content-center" style="flex-direction: column; height:95%">
                <h3>We are here to help</h3>
                <h5>Get Support from us</h5>
            </div>
        </div>
        <div class="col-md-7">
            @include('includes.messages')
            <h3 class="sub-title">Apply</h3>
            <form id="donationForm" action="{{route('support.apply')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <p style="font-weight:500">Personal Information</p>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="support_type">What support do you need? *</label>
                        <select class="form-control" name="support_type" id="support_type" required>
                            <option value="laptop">Laptop for Uni</option>
                            <option value="it-scholarship">IT Scholarship</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="first_name">First Name *</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="last_name">Last Name *</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter your last name" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="gender">Gender *</label>
                        <select class="form-control" name="gender" id="gender" required>
                            <option>-- Select your gender --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email address *</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number</label>
                        <input type="phone" class="form-control" name="phone" id="phone" placeholder="Enter phone number">
                    </div>
                    <div class="form-group col-md-6 d-none" id="areaOfInterest">
                        <label for="area_of_interest">Area of Interest *</label>
                        <select class="form-control" name="area_of_interest" required>
                            <option value="programming">Programming</option>
                            <option value="artificial-intelligence">Artificial Intelligence</option>
                            <option value="cyber-security">Cyber-Security</option>
                            <option value="networking">Networking</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 d-none" id="cvField">
                        <label for="amount">CV *</label>
                        <input type="file" class="form-control" name="cv" id="cv">
                    </div>
                    <div class="form-group col-md-12" id="institutionField">
                        <label for="Institution">Institution *</label>
                        <input type="text" class="form-control" name="institution" id="institution" placeholder="Enter the name of your institution">
                    </div>
                    <div class="form-group col-md-12" id="messageField">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="Leave a message"></textarea>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" id="donateButton" class="btn submit-btn px-4 py-2">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
