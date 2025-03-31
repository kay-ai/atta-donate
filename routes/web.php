<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DenApplicationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\OptOutController;
use App\Http\Controllers\SupportApplicationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('donate');
});

Route::get('/donate', function () {
    return view('welcome');
})->name('donate');

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/get-support', function () {
    return view('apply.get-support');
});

Route::get('/den', function () {
    return view('den-form');
});

Route::controller(DonationController::class)->group(function () {
    Route::post('/donation/save', 'store')->name('donation.save');
    Route::post('/verify-payment', 'verifyPayment')->name('verify.payment');
    Route::get('/thank-you/{reference?}', 'thankYou')->name('thank.you');
});

Route::controller(DenApplicationController::class)->group(function () {
    Route::post('/den-application/save', 'store')->name('den.apply');
});

Route::post('/support/apply', [SupportApplicationController::class, 'apply'])->name('support.apply');
Route::get('/opt-out', [OptOutController::class, 'optOut'])->name('opt-out');

Route::prefix('backend')->name('admin.')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('dashboard');
            Route::get('/applications', 'applications')->name('applications');
            Route::get('/donations', 'donations')->name('donations');
            Route::post('/logout', 'logout')->name('logout');
        });

        Route::controller(DenApplicationController::class)->group(function () {
            Route::get('/den-applications/{denApplication}', 'show')->name('den.application.details');
            Route::post('/den/application/{denApplication}/approve', 'approveDenApplication')->name('den.application.approve');
            Route::delete('/den/application/{denApplication}/delete', 'deleteDenApplication')->name('den.application.delete');
            Route::patch('/den-applications/{denApplication}/update-stage', 'updateStage')->name('den.application.updateStage');
        });

        Route::controller(InterviewController::class)->group(function () {
            Route::post('/den/application/{id}/schedule-interview', 'scheduleInterview')->name('den.application.scheduleInterview');
            Route::get('/calender', 'calenderInterview')->name('calendarInterview');
            // Route::get('/calendar', 'calendar')->name('calendar');
        });
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'login')->name('login');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
