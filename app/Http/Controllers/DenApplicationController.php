<?php

namespace App\Http\Controllers;

use App\Models\DenApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DenApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:den_applications,email',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'business_website' => 'nullable|url',
            'industry' => 'required|string|max:255',
            'business_stage' => 'required|string|max:255',
            'idea_title' => 'required|string|max:255',
            'business_description' => 'required|string',
            'problem_statement' => 'required|string',
            'target_audience' => 'required|string',
            'revenue_model' => 'required|string',
            'competitors' => 'required|string',
            'video_pitch' => 'required|url',
            'funding_amount' => 'required|numeric',
            'funding_usage' => 'required|string',
            'co_founders' => 'required|string',
            'co_founders_details' => 'nullable|string',
            'previous_funding' => 'required|string',
            'funding_source' => 'nullable|string',
            'terms' => 'required|accepted'
        ]);

        $validatedData['terms_accepted'] = true;

        $application = DenApplication::create($validatedData);

        $admin_email = env('ADMIN_EMAIL');
        $email = $validatedData['email'];

        Mail::send('emails.den-application-receipt', [
            'data'=> $validatedData,
        ], function ($mail) use ($email) {
            $mail->to($email)->subject("ATTA's Den Application Received");
        });

        // Send notification email to admin
        Mail::send('emails.den-application-notify-admin', [
            'application' => $application,
        ], function ($mail) use ($admin_email) {
            $mail->to($admin_email)->subject("New ATTA's Den Application Submitted");
        });

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(DenApplication $denApplication)
    {
        return view('den.view', compact('denApplication'));
    }

    public function updateStage(Request $request, DenApplication $denApplication)
    {
        $request->validate([
            'stage' => 'required|in:submitted,review,interview,funded',
        ]);

        $denApplication->stage = $request->stage;
        $denApplication->save();

        // Send email notification if the stage is changed to "review"
        if ($request->stage === 'review') {
            Mail::send('emails.den-application-review', [
                'application' => $denApplication,
            ], function ($mail) use ($denApplication) {
                $mail->to($denApplication->email)
                    ->subject("Your ATTA's Den Application is Now Under Review");
            });
        }

        return redirect()->back()->with('success', 'Den Application stage updated successfully!');
    }


    public function approveDenApplication(DenApplication $denApplication)
    {
        $application = $denApplication;
        $application->status = 'approved';
        $application->stage = 'review';
        $application->save();

        Mail::send('emails.den-application-review', [
            'application' => $application,
        ], function ($mail) use ($application) {
            $mail->to($application->email)
                ->subject("Your ATTA's Den Application is Now Under Review");
        });

        return response()->json(['success' => true]);
    }

    public function deleteDenApplication($id)
    {
        $application = DenApplication::findOrFail($id);
        $application->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DenApplication $denApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DenApplication $denApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DenApplication $denApplication)
    {
        //
    }
}
