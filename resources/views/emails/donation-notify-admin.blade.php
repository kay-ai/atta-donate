<!DOCTYPE html>
<html>
<head>
    <title>New Donation Received</title>
</head>
<body>
    @php
        $type = [
            "it-equipment" => "IT Equipment",
            "free-training" => "Free Training",
            "financial" => "Financial Support"
        ];
    @endphp

    <h2>New Donation Alert</h2>

    <p><strong>Donor Name:</strong> {{ $name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Donation Type:</strong> {{ $type[$donation_type] ?? $donation_type }}</p>

    @if($donation_type == 'financial')
        <p><strong>Amount:</strong> ₦{{ number_format($amount) }}</p>
    @endif

    <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($date)->format('d-m-Y H:i:s') }}</p>

    @if(isset($password))
        <div style="margin-top: 30px">
            <p>An account has been created for this donor on the donor portal.</p>
            <p><strong>Login Details:</strong></p>
            <p>Email: <strong>{{ $email }}</strong></p>
            <p>Password: <strong>{{ $password }}</strong></p>
        </div>
    @endif

    <br>
    <p>You can manage this donation and view donor details in the admin dashboard:</p>
    <p>
        <a href="{{ route('admin.dashboard') }}" style="padding: 10px 20px; background-color: #abde3d; color: white; text-decoration: none; border-radius: 15px;">View in Dashboard</a>
    </p>
    <br>
    <p>Best Regards,</p>
    <p><strong>ATTA Initiative</strong></p>
</body>
</html>
