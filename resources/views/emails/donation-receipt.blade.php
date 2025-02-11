<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Generous Donation</title>
</head>
<body>
    @php
        $type = [
            "it-equipment" => "IT Equipment",
            "free-training" => "Free Training",
            "financial" => "Financial Support"
        ];
    @endphp

    <h2>Dear {{ $name }},</h2>

    <p>We sincerely appreciate your generous donation towards {{ $type[$donation_type] ?? $donation_type }}. Your support is making a significant impact in empowering underserved students with IT education and providing them with the tools they need to succeed.</p>

    @if($donation_type == 'financial')
        <p>Your contribution of ₦{{ number_format($amount) }} is helping us bridge the digital divide and create opportunities for those who need them most.</p>
    @else
    <p>Thanks to donors like you, we can continue to bridge the digital divide and create opportunities for those who need them most.
    </p>
    @endif

    @if(isset($password))
        <p>To keep you informed of how your contributions are making an impact, we have created an account for you on our donor portal.</p>
        <p><strong>Account Details:</strong></p>
        <p>Email: <strong>{{ $email }}</strong></p>
        <p>Password: <strong>{{ $password }}</strong></p>
        <p>Please log in and update your password: <a href="{{ $login_link }}">Login Here</a></p>
        <p>If you prefer not to have an account, you can opt out by clicking below:</p>
        <p style="margin: 30px 0;">
            <a href="{{ $opt_out_link }}" style="padding: 10px 20px; background-color: #ff4d4d; color: white; text-decoration: none; border-radius: 5px;">Opt Out</a>
        </p>
    @else
        <p>We appreciate your continued support and look forward to keeping you updated on our initiatives and success stories!</p>
    @endif

    <p>Once again, thank you for your kindness and generosity. Your support is truly transforming lives, and we are grateful to have you as part of the ATTA Initiative community.</p>

    <p>Best Regards,</p>
    <p><strong>ATTA Initiative Team</strong></p>
    <p><a href="{{ $website_url }}">{{ $website_url }}</a></p>
    <p>Contact us: <a href="mailto:{{ $contact_email }}">{{ $contact_email }}</a></p>
</body>
</html>
