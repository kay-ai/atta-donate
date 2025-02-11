<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class OptOutController extends Controller
{
    public function optOut(Request $request)
    {
        $email = $request->query('email');

        if (!$email) {
            return redirect('/')->with('error', 'Invalid request.');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect('/')->with('error', 'Email not found.');
        }

        // Add logic to opt-out the user, e.g., update a subscription status
        DB::table('users')->where('email', $email)->update(['is_subscribed' => false]);

        return redirect('/')->with('success', 'You have successfully opted out of emails.');
    }
}

