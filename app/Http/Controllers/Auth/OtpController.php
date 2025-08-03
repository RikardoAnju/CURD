<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class OtpController extends Controller
{
    public function showOtpForm(Request $request)
    {
        $email = $request->input('email') ?? session('otp_email');
        return view('auth.otp-form', compact('email'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->email;

        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.'])->withInput();
        }

        $otp = sprintf('%06d', mt_rand(0, 999999));

        $cacheKey = 'otp_' . $email;
        Cache::put($cacheKey, [
            'code' => $otp,
            'attempts' => 0,
            'created_at' => now()
        ], now()->addMinutes(5));

        try {
            Mail::send('emails.otp', [
                'otp' => $otp,
                'user' => $user
            ], function ($message) use ($email) {
                $message->to($email)->subject('Kode Verifikasi OTP Anda');
            });

            Log::info("OTP untuk $email: $otp");

            session(['otp_email' => $email]);

            return redirect()->route('otp.verify.form', ['email' => $email])
                ->with('success', 'Kode OTP telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            Log::error("Gagal mengirim OTP ke $email: " . $e->getMessage());

            return back()->withErrors([
                'email' => 'Gagal mengirim OTP. Silakan coba lagi.'
            ])->withInput();
        }
    }


    

    public function showVerifyForm(Request $request)
    {
        $email = $request->query('email') ?? session('otp_email');

        if (!$email) {
            return redirect()->route('otp.form')->withErrors([
                'email' => 'Email diperlukan untuk verifikasi.'
            ]);
        }

        return view('auth.otp-verify', ['email' => $email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp'   => 'required|digits:6'
        ]);

        $email    = $request->email;
        $inputOtp = $request->otp;
        $cacheKey = 'otp_' . $email;

        $otpData = Cache::get($cacheKey);

        if (!$otpData) {
            return back()->withErrors(['otp' => 'Kode OTP telah kedaluwarsa.'])->withInput();
        }

        if ($otpData['attempts'] >= 3) {
            Cache::forget($cacheKey);
            return back()->withErrors(['otp' => 'Terlalu banyak percobaan. Silakan minta OTP baru.'])->withInput();
        }

        if ($inputOtp !== $otpData['code']) {
            $otpData['attempts']++;
            Cache::put($cacheKey, $otpData, now()->addMinutes(5));

            $remaining = 3 - $otpData['attempts'];
            return back()->withErrors([
                'otp' => "Kode OTP salah. Sisa percobaan: $remaining"
            ])->withInput();
        }

        // ✅ OTP valid
        Cache::forget($cacheKey);
        session()->forget('otp_email');
        session(['otp_verified_email' => $email]);

        return redirect()->route('password.manual.form')
            ->with('success', 'OTP berhasil diverifikasi. Silakan buat password baru.');
    }
}
