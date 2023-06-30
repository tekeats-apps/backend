<?php

namespace App\Http\Controllers\Vendor;

use Exception;
use Carbon\Carbon;
use App\Models\Vendor\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Vendor\ForgotPasswordMail;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Vendor\Auth\LoginRequest;
use App\Http\Requests\Vendor\Auth\ResetPasswordRequest;
use App\Http\Requests\Vendor\Auth\ForgotPasswordRequest;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vendor.modules.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $remember = ($request->input('remember')) ? 1 : 0;
        if (Auth::guard('vendor')->attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended('/vendor/dashboard');
        }
        return back()->withInput()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function forgetPassword()
    {
        return view('vendor.modules.auth.forget-password');
    }
    public function sendForgotPasswordEmail(ForgotPasswordRequest $request)
    {
        try {

            $email = $request->email;
            $user = User::where('email', $email)->first();

            if (!$user) {
                return redirect()->back()->with('error', 'User not found with the given email address.');
            }

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            // Send the forgot password email
            Mail::to($email)->send(new ForgotPasswordMail($user->name, $token));

            return redirect()->back()->with('success', 'Forgot password email sent successfully.');
        } catch (Exception $e) {
            // Log the error
            logger()->error('Failed to send forgot password email: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while sending the forgot password email.');
        }
    }
    public function showResetPasswordForm($token)
    {

        $passwordReset = DB::table('password_resets')
            ->where('token', $token)
            ->first();

        if (!$passwordReset) {
            // Token not found or expired, handle accordingly
            return redirect()->route('vendor.auth.forget.password')->with('error', 'Invalid or Expired token');
        }
        // Retrieve the user email using the password reset record
        $email = $passwordReset->email;
        return view('vendor.modules.auth.reset-password', compact('token', 'email'));
    }
    public function resetPassword(ResetPasswordRequest $request)
    {
        try {

            $updatePassword = DB::table('password_resets')
                ->where([
                    'email' => $request->email,
                    'token' => $request->token
                ])
                ->first();

            if (!$updatePassword) {
                return back()->with('error', 'Invalid token!');
            }

            User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where(['email' => $request->email])->delete();

            return redirect()->route('vendor.auth.login')->with('success', 'Your password has been changed!');
        } catch (Exception $e) {
            // Log the error
            logger()->error('Failed to reset password: ' . $e->getMessage());

            return redirect()->back()->with('error', 'An error occurred while resetting the password.');
        }
    }

    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.auth.login');
    }
}
