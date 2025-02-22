<!DOCTYPE html>
<html>
<head>
    <title>New Support Application Notification</title>
</head>
<body>
    @php
        $type = [
            "it-scholarship" => "IT Scholarship Programme",
            "laptop" => "Laptop for Uni scheme"
        ];
    @endphp

    <h2>New Support Application Received</h2>

    <p><strong>Applicant Name:</strong> {{ $full_name }}</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone ?? 'N/A' }}</p>
    <p><strong>Support Type:</strong> {{ $type[$support_type] ?? $support_type }}</p>
    <p><strong>Application Date:</strong> {{ \Carbon\Carbon::parse($application_date)->format('d-m-Y H:i:s') }}</p>
    <p><strong>Message:</strong> {{ $more_message ?? 'No additional message provided.' }}</p>

    <br>
    <p>You can review the application in the admin dashboard:</p>
    <p>
        <a href="{{ route('admin.dashboard') }}" style="padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
            View Application
        </a>
    </p>

    <br>
    <p>Best Regards,</p>
    <p><strong>ATTA Initiative System</strong></p>
</body>
</html>
