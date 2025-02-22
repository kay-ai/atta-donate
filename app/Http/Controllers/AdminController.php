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

        $user = User::where('email', $request->email)->where('user_type', 'admin')->first();

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

        $donor_count = User::where('user_type', 'donor')->count();

        $support_applications = SupportApplication::latest()->get();
        $support_applications_count = $support_applications->count();

        return view('admin.dashboard', compact('donations','donation_sum', 'donor_count', 'support_applications', 'support_applications_count'));
    }

    public function applications(){
        $applications = SupportApplication::latest()->get();
        return view('admin.applications', compact('applications'));
    }

    public function donations(){
        $donations = Donation::latest()->get();
        return view('admin.donations', compact('donations'));
    }
}
