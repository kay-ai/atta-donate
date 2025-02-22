<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Donation;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $reference = $request->reference;
        $paystackSecret = env('PAYSTACK_SECRET_KEY');

        // Verify payment with Paystack
        $response = Http::withHeaders([
            'Authorization' => "Bearer $paystackSecret"
        ])->get("https://api.paystack.co/transaction/verify/{$reference}");

        $paystackResponse = $response->json();

        Log::debug($paystackResponse);

        if (!$paystackResponse['status'] || $paystackResponse['data']['status'] !== 'success') {
            Log::debug('Verification Failed');
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 400);
        }

        Log::debug('Code Passed Success');

        $email = $request->email;
        $existingUser = User::where('email', $email)->first();
        $isReturningDonor = $existingUser ? true : false;

        // If user doesn't exist, create a new user
        if (!$existingUser) {
            $password = substr(md5(uniqid()), 0, 8);
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $email,
                'password' => Hash::make($password),
                'user_type' => 'donor',
            ]);

        } else {
            $user = $existingUser;
        }

        $verified_amount = $paystackResponse['data']['amount'] / 100;

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'reference' => $reference,
            'amount' => $verified_amount,
            'currency' => 'NGN',
            'status' => 'success'
        ]);

        $donation = Donation::create([
            'user_id' => $user->id,
            'transaction_id' => $transaction->id,
            'amount' => $verified_amount,
            'donation_type' => $request->donation_type,
        ]);

        $login_link = route('login');
        $opt_out_link = route('opt-out', ['email' => $email]);
        $website_url = config('app.url');
        $contact_email = config('mail.from.address');

        if (!$existingUser){
            // Send email with account details
            $name = $request->first_name . ' ' . $request->last_name;

            $this->sendEmail($name, $email, $password, $verified_amount, $request->donation_type, $login_link, $opt_out_link, $website_url, $contact_email);
        }
        $this->notifyAdminDonation($name, $email, $donation->created_at, $password, $verified_amount, $request->donation_type);

        return response()->json([
            'success' => true,
            'is_returning_donor' => $isReturningDonor,
            'redirect_url' => route('thank.you', ['reference' => $reference])
        ]);
    }

    public function store(Request $request)
    {
        // Validate input fields
        $validatedData = $request->validate([
            'donate_type' => 'required|string|in:financial,it-equipment,free-training',
            'first_name'  => 'required|string|max:255',
            'last_name'   => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'phone'       => 'nullable|string|max:20',
            'location'    => 'nullable|string|in:nigeria,africa,europe,asia',
            'amount'      => 'nullable|numeric|min:1',
            'message'     => 'nullable|string|max:1000',
        ]);

        if ($request->donate_type == 'financial') {
            $request->validate(['amount' => 'required|numeric|min:1']);
        }
        if ($request->donate_type == 'it-equipment') {
            $request->validate(['location' => 'required|string|in:nigeria,africa,europe,asia']);
        }

        $name = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
        $email = $validatedData['email'];
        $password = substr(md5(uniqid()), 0, 8);
        $donation_type = $validatedData['donate_type'];
        $location = $validatedData['location'] ?? null;
        $message = $validatedData['message'] ?? null;
        $amount = $validatedData['amount'] ?? null;

        $login_link = route('login');
        $opt_out_link = route('opt-out', ['email' => $email]);
        $website_url = config('app.url');
        $contact_email = config('mail.from.address');

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            // Create a new user
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name'  => $validatedData['last_name'],
                'email'      => $email,
                'phone'      => $validatedData['phone'] ?? null,
                'password'   => Hash::make($password),
                'user_type' => 'donor',
            ]);

            $this->sendEmail($name, $email, $password, $amount, $donation_type, $login_link, $opt_out_link, $website_url, $contact_email);
        }

        $donation = Donation::create([
            'user_id'     => $user->id,
            'donation_type' => $validatedData['donate_type'],
            'location'    => $location,
            'amount'      => $amount,
            'message'     => $message,
        ]);

        $this->notifyAdminDonation($name, $email, $donation->createed_at, $password, $amount, $donation_type);

        return redirect()->route('thank.you', ['email' => $user->email]);
    }

    private function sendEmail($name, $email, $password=null, $amount = null, $donation_type = null, $login_link = null, $opt_out_link = null, $website_url = null, $contact_email = null){
        Mail::send('emails.donation-receipt', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'amount' => $amount,
            'donation_type' => $donation_type,
            'login_link' => $login_link,
            'opt_out_link' => $opt_out_link,
            'website_url' => $website_url,
            'contact_email' => $contact_email,
        ], function ($mail) use ($email) {
            $mail->to($email)->subject("Donation Successful & Account Created");
        });
    }

    private function notifyAdminDonation($name, $email, $date, $password=null, $amount = null, $donation_type = null){
        $admin_email = env('ADMIN_EMAIL');

        Mail::send('emails.donation-notify-admin', [
            'name'=> $name,
            'email'=> $email,
            'password'=> $password,
            'amount'=> $amount,
            'date'=> $date,
            'donation_type'=> $donation_type,
        ], function ($mail) use ($admin_email) {
            $mail->to($admin_email)->subject("New Donation Alert");
        });
    }

    public function thankYou(Request $request, $reference = null)
    {
        if ($reference) {
            $transaction = Transaction::where('reference', $reference)->first();
            if (!$transaction) {
                abort(404);
            }
            $user = $transaction->user;
        } else {
            $user = User::where('email', $request->query('email'))->first();
            if (!$user) {
                abort(404);
            }
        }

        $name = $user->first_name . ' ' . $user->last_name;
        return view('thank-you', compact('name'));
    }

}
