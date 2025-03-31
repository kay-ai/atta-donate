<!DOCTYPE html>
<html>
<head>
    <title>Application Submission Confirmation</title>
</head>
<body>
    <h2>Hello {{ $data['first_name'] }},</h2>

    <p>Thank you for submitting your application. Below are the details you provided:</p>

    <h3>Personal Information</h3>
    <p><strong>Name:</strong> {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Location:</strong> {{ $data['city'] }}, {{ $data['country'] }}</p>

    <h3>Business Information</h3>
    <p><strong>Business Name:</strong> {{ $data['business_name'] ?? 'N/A' }}</p>
    <p><strong>Website:</strong> {{ $data['business_website'] ?? 'N/A' }}</p>
    <p><strong>Industry:</strong> {{ ucfirst($data['industry']) }}</p>
    <p><strong>Business Stage:</strong> {{ ucfirst($data['business_stage']) }}</p>

    <h3>Business Idea</h3>
    <p><strong>Idea Title:</strong> {{ $data['idea_title'] }}</p>
    <p><strong>Description:</strong> {{ $data['business_description'] }}</p>
    <p><strong>Problem Solved:</strong> {{ $data['problem_statement'] }}</p>
    <p><strong>Target Audience:</strong> {{ $data['target_audience'] }}</p>
    <p><strong>Revenue Model:</strong> {{ $data['revenue_model'] }}</p>
    <p><strong>Competitors & Market Size:</strong> {{ $data['competitors'] }}</p>
    <p><strong>Video Pitch:</strong> <a href="{{ $data['video_pitch'] }}">{{ $data['video_pitch'] }}</a></p>

    <h3>Funding Details</h3>
    <p><strong>Funding Amount:</strong> {{ $data['funding_amount'] }}</p>
    <p><strong>Funding Usage:</strong> {{ $data['funding_usage'] }}</p>

    <h3>Additional Information</h3>
    <p><strong>Co-Founders:</strong> {{ $data['co_founders'] == 'yes' ? 'Yes' : 'No' }}</p>
    @if($data['co_founders'] == 'yes')
        <p><strong>Co-Founders Details:</strong> {{ $data['co_founders_details'] ?? 'N/A' }}</p>
    @endif
    <p><strong>Previous Funding:</strong> {{ $data['previous_funding'] == 'yes' ? 'Yes' : 'No' }}</p>
    @if($data['previous_funding'] == 'yes')
        <p><strong>Funding Source:</strong> {{ $data['funding_source'] ?? 'N/A' }}</p>
    @endif

    <p>We will review your application and get back to you soon.</p>

    <p>Best regards,</p>
    <p><strong>The Team</strong></p>
</body>
</html>
