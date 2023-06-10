<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vendor.modules.auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->only(['email', 'password']);
        $remember = ($request->input('remember')) ? 1 : 0;
        if (Auth::guard('vendor')->attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended('/vendor/dashboard');
        }
        return back()->withInput()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.auth.login');
    }
}
