<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\ManualPasswordResetController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Models\Product;


Route::get('/', fn() => view('welcome'))->name('welcome');

Route::get('/dashboard', function () {
    $query = Product::query();


    if (request('category')) {
        $query->where('category', request('category'));
    }

    $products = $query->orderBy('created_at', 'desc')->paginate(10);
    $categories = Product::distinct()->pluck('category');

    return view('dashboard', compact('products', 'categories'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/verify-email', fn() => view('auth.verify-email'))
    ->middleware('auth')->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Verification link sent!');
})->middleware(['auth', 'throttle:1,60'])->name('verification.send');

// OTP Routes
Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp/send', [OtpController::class, 'sendOtp'])->name('otp.send');
Route::get('/otp/verify', [OtpController::class, 'showVerifyForm'])->name('otp.verify.form');
Route::post('/otp/verify', [OtpController::class, 'verifyOtp'])->name('otp.verify');

// Manual Password Reset Routes
Route::get('/password/manual/reset', function () {
    $email = session('otp_verified_email');
    if (!$email) {
        return redirect()->route('otp.form')->withErrors(['email' => 'Akses tidak sah.']);
    }
    return view('auth.reset-password-manual', ['email' => $email]);
})->name('password.manual.form');
Route::post('/otp/resend', [OtpController::class, 'resend'])->name('otp.resend');


Route::post('/password/manual/reset', [ManualPasswordResetController::class, 'submit'])
    ->name('password.manual.submit');;

    Route::resource('products', ProductController::class)->middleware('auth');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


require __DIR__.'/auth.php';