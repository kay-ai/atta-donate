<!DOCTYPE html>
<html>
<head>
    <title>New ATTA's Den Application</title>
</head>
<body>
    <p><strong>A new application has been submitted!</strong></p>

    <p>Here are the details:</p>

    <ul>
        <li><strong>Name:</strong> {{ $application->first_name }} {{ $application->last_name }}</li>
        <li><strong>Email:</strong> {{ $application->email }}</li>
        <li><strong>Phone:</strong> {{ $application->phone }}</li>
        <li><strong>Country:</strong> {{ $application->country }}</li>
        <li><strong>City:</strong> {{ $application->city }}</li>
        <li><strong>Business Name:</strong> {{ $application->business_name ?? 'N/A' }}</li>
        <li><strong>Industry:</strong> {{ $application->industry }}</li>
        <li><strong>Idea Title:</strong> {{ $application->idea_title }}</li>
        <li><strong>Funding Amount:</strong> ${{ number_format($application->funding_amount, 2) }}</li>
        <li><strong>Business Stage:</strong> {{ $application->business_stage }}</li>
    </ul>

    <p>Log in to the admin panel to review the application.</p>
    <p>
        <a href="{{ route('admin.dashboard') }}" style="padding: 10px 20px; background-color: #abde3d; color: white; text-decoration: none; border-radius: 15px;">
            View Application
        </a>
    </p>

    <p>Best Regards,</p>
    <p><strong>ATTA's Den System</strong></p>
</body>
</html>
