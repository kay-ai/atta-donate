<?php

use App\Http\Controllers\DonationController;
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
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/get-support', function () {
    return view('apply.get-support');
});


Route::post('/donation/save', [DonationController::class, 'store'])->name('donation.save');
Route::post('/verify-payment', [DonationController::class, 'verifyPayment'])->name('verify.payment');
Route::get('/thank-you/{reference?}', [DonationController::class, 'thankYou'])->name('thank.you');
Route::post('/support/apply', [SupportApplicationController::class, 'apply'])->name('support.apply');
Route::get('/opt-out', [OptOutController::class, 'optOut'])->name('opt-out');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
