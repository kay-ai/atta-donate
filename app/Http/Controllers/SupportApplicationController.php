<?php

namespace App\Http\Controllers;

use App\Models\SupportApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SupportApplicationController extends Controller
{
    public function apply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'support_type' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'email' => 'required|email|unique:support_applications,email',
            'phone' => 'nullable|string|max:20',
            'institution' => 'nullable|string|max:255',
            'area_of_interest' => 'nullable|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'message' => 'nullable|string',
        ]);

        if ($request->support_type === 'laptop') {
            $validator->addRules([
                'institution' => 'required|string|max:255',
            ]);
        }

        if ($request->support_type === 'it-scholarship') {
            $validator->addRules([
                'area_of_interest' => 'required|string',
                'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $cvPath = $request->file('cv') ? $request->file('cv')->store('cvs', 'public') : null;

        $application = SupportApplication::create([
            'support_type' => $request->support_type,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'area_of_interest' => $request->area_of_interest,
            'cv' => $cvPath,
            'institution' => $request->institution,
            'message' => $request->message
        ]);

        $email = $request->email;
        $website_url = config('app.url');
        $contact_email = config('mail.from.address');
        $full_name = $request->first_name . ' ' . $request->last_name;
        $support_type = $request->support_type;

        $emailData = [
            'full_name' => $full_name,
            'support_type' => $support_type,
            'website_url' => $website_url,
            'contact_email' => $contact_email
        ];

        if ($request->support_type === 'it-scholarship') {
            $subject = "Application Received - ATTA Initiative IT Scholarship";
        }elseif ($request->support_type === 'laptop') {
            $subject = "Application Received - ATTA Initiative Laptop for Uni";
        }

        Mail::send('emails.application-receipt', $emailData, function ($mail) use ($email, $subject) {
            $mail->to($email)->subject($subject);
        });

        $phone = $request->phone;
        $message = $request->message;

        $adminData = [
            'full_name' => $full_name,
            'support_type' => $support_type,
            'phone' => $phone,
            'email' => $email,
            'more_message' => $message,
            'application_date' => $application->created_date,
        ];

        $subject = "New Application Received";
        $admin_email = env('ADMIN_EMAIL');

        Mail::send('emails.application-notify-admin', $adminData, function ($mail) use ($admin_email, $subject) {
            $mail->to($admin_email)->subject($subject);
        });

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
