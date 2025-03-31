<!DOCTYPE html>
<html>
<head>
    <title>Interview Scheduled</title>
</head>
<body>
    <p>Dear {{ $application->first_name }},</p>

    <p>Congratulations! Your application for ATTA's Den has progressed to the interview stage.</p>

    <p>Please find the interview details below:</p>

    <ul>
        <li><strong>Date:</strong> {{ \Carbon\Carbon::parse($interview->interview_date)->format('l, F j, Y') }}</li>
        <li><strong>Time:</strong> {{ \Carbon\Carbon::parse($interview->interview_time)->format('h:i A') }}</li>
        <li><strong>Venue:</strong> {{ $interview->venue }}</li>
    </ul>

    <p><strong>Important:</strong> During the interview, you will be required to present and defend your business plan. Ensure that you are well-prepared to discuss your business model, market strategy, and financial projections.</p>

    <p>We look forward to learning more about your vision and how it aligns with ATTA's Den.</p>

    <p>Best Regards,</p>
    <p><strong>ATTA's Den Team</strong></p>
</body>
</html>
