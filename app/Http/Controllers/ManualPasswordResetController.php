<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ManualPasswordResetController extends Controller
{
    public function submit(Request $request)
    {
        // Logic untuk reset password
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('login')->with('status', 'Password berhasil diubah!');
    }
}