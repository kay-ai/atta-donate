<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\SupportApplication;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' =>'required|email',
            'password' => 'required|min:8'
        ]);

        $user = \App\Models\User::where('email', $request->email)->where('user_type', 'admin')->first();

        if (!$user) {
            return back()->withInput()->withErrors(['email' => 'Invalid Admin credentials']);
        }

        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function dashboard(){
        $donations = Donation::latest()->get();
        $donation_sum = $donations->sum('amount');

        $donors = User::where('user_type', 'donor')->latest()->get();
        $donor_count = $donors->count();

        $support_applications_count = SupportApplication::count();

        return view('admin.dashboard', compact('donation_sum', 'donor_count', 'support_applications_count'));
    }
}
