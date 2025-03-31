@extends('layouts.app')

@section('content')
    <div class="row px-3">
        <div class="col-md-5">
            <a href="https://www.atta.ng" class="n-link">
                <i class="fa fa-long-arrow-left" aria-hidden="true" style="font-size: 18px;"></i>
            </a>
            <div class="d-flex justify-content-center" style="flex-direction: column; height:95%">
                <h3>Support the ATTA Initiative:</h3>
                <h5>Empower Lives Through IT Education</h5>

                <a href="/login" class="login-text">Login</a>
            </div>
        </div>
        <div class="col-md-7">
            @include('includes.messages')
            <h3>Donate</h3>
            <form id="donationForm" action="{{route('donation.save')}}" method="POST">
                @csrf
                <div class="d-flex py-4" id="moneyDiv" style="flex-wrap: wrap;">
                    <p class="money px-3 py-2">Custom</p>
                    <p class="money px-3 py-2" data-amount="50000"><span class="strike-through">N</span> 50,000</p>
                    <p class="money px-3 py-2" data-amount="100000"><span class="strike-through">N</span> 100,000</p>
                    <p class="money px-3 py-2" data-amount="200000"><span class="strike-through">N</span> 200,000</p>
                    <p class="money px-3 py-2" data-amount="500000"><span class="strike-through">N</span> 500,000</p>
                    <p class="money px-3 py-2" data-amount="1000000"><span class="strike-through">N</span> 1,000,000</p>
                </div>

                <p style="font-weight:500">Additional Information</p>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="donate_type">What will you donate? *</label>
                        <select class="form-control" name="donate_type" id="donate_type" required>
                            <option value="financial">Financial Aid</option>
                            <option value="it-equipment">IT Equipment</option>
                            <option value="free-training">Free Training</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="first_name">First Name *</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Last Name *</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email address *</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number</label>
                        <input type="phone" class="form-control" name="phone" id="phone" placeholder="Enter phone number">
                    </div>
                    <div class="form-group col-md-12 d-none" id="addLocation">
                        <label for="location">Location (Where will these items come from) *</label>
                        <select class="form-control" name="location" id="donate_type" required>
                            <option value="nigeria">Within Nigeria</option>
                            <option value="africa">Other African countries</option>
                            <option value="europe">Europe</option>
                            <option value="america">Americas</option>
                            <option value="middle-east-asia">Middle East & Asia</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12" id="amountField">
                        <label for="amount">Amount (NGN) *</label>
                        <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter the amount you want to donate">
                    </div>
                    <div class="form-group col-md-12 d-none" id="messageField">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="message" id="message" rows="3" placeholder="Leave a message"></textarea>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button type="submit" id="donateButton" class="btn submit-btn px-4 py-2">Donate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
