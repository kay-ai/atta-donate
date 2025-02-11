<!DOCTYPE html>
<html>
<head>
    <title>ATTA Initiative Laptop for Uni</title>
</head>
<body>
    @php
        $type = [
            "it-scholarship" => "IT Scholarship Programme",
            "laptop" => "Laptop for Uni scheme"
        ];
    @endphp
    <p>Dear {{ $full_name }},</p>

    <p>Thank you for applying for the ATTA Initiative {{$type[$support_type]}}. We have received your application and appreciate your interest in {{$type[$support_type] == 'laptop' ? ' our program.' : ' advancing your IT skills through our program.'}} </p>

    <p>Due to the high demand for this initiative, we prioritize support for students who are most in need. @if($type[$support_type] == 'laptop') Each application is carefully reviewed to ensure that our donated laptops go to those who would benefit the most and lack the means to access one otherwise. @elseif($type[$support_type] == 'it-scholarship') Each application is carefully reviewed to ensure that our scholarships are awarded to individuals who would benefit the most from this opportunity based on academic merit and financial needs. @endif</p>

    <p>We will inform you of the outcome of your application in due course. While we strive to support as many students as possible, @if($type[$support_type] == 'laptop') we encourage all applicants to explore alternative resources as well. @elseif($type[$support_type] == 'it-scholarship') we encourage all applicants to explore alternative resources as well. @endif</p>

    <p>If you have any questions, please feel free to reach out to us. @if($type[$support_type] == 'laptop') Thank you for your patience and for your dedication to your education. @elseif($type[$support_type] == 'it-scholarship') Thank you for your patience and for your dedication to your education. @endif</p>

    <p>Best regards,</p>
    <p><strong>ATTA Initiative Team</strong></p>
    <p><a href="{{$website_url}}">{{$website_url}}</a></p>
    <p><a href="mailto:{{$contact_email}}">{{$contact_email}}</a></p>
</body>
</html>
