<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\DenApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class InterviewController extends Controller
{
    public function scheduleInterview(Request $request, $id)
    {
        $request->validate([
            'interview_date' => 'required|date',
            'interview_time' => 'required',
            'venue' => 'required|string|max:255',
        ]);

        // Find the application
        $application = DenApplication::findOrFail($id);

        // Save the interview
        $interview = Interview::create([
            'den_application_id' => $application->id,
            'interview_date' => $request->interview_date,
            'interview_time' => $request->interview_time,
            'venue' => $request->venue,
        ]);

        $application->stage = 'interview';
        $application->save();

        // Send Interview Email
        $email = $application->email;
        Mail::send('emails.den-interview-scheduled', [
            'application' => $application,
            'interview' => $interview,
        ], function ($mail) use ($email) {
            $mail->to($email)->subject("Interview Scheduled for Your ATTA's Den Application");
        });

        // Sync with Calendly (if API is available)
        // $this->syncWithCalendly($application, $interview);

        return redirect()->back()->with('success', 'Interview scheduled successfully!');
    }

    public function calenderInterview()
    {
        $interviews = Interview::with('denApplication')
            ->get()
            ->map(function ($interview) {
                return [
                    'title' => $interview->denApplication->first_name . ' ' . $interview->denApplication->last_name,
                    'start' => $interview->interview_date . 'T' . $interview->interview_time,
                    'description' => 'Venue: ' . $interview->venue,
                ];
            });

        return view('admin.calendar', compact('interviews'));
    }

    private function syncWithCalendly($application, $interview)
    {
        try {
            $calendlyApiKey = env('CALENDLY_API_KEY'); // Ensure this is set in .env

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $calendlyApiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.calendly.com/scheduled_events', [
                'event_type' => 'Interview with ' . $application->first_name . ' ' . $application->last_name,
                'start_time' => $interview->interview_date . 'T' . $interview->interview_time . ':00Z',
                'location' => $interview->venue,
                'invitees' => [
                    [
                        'email' => $application->email,
                        'name' => $application->first_name . ' ' . $application->last_name,
                    ],
                ],
            ]);

            if ($response->successful()) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
