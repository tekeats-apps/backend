<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('store.modules.auth.login');
    }

    public function login(Request $request){
        $credentials = $request->only(['email', 'password']);
        $remember = ($request->input('remember')) ? 1 : 0;
        if (Auth::guard('store')->attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended('/store/dashboard');
        }
        return back()->withInput()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::guard('store')->logout();
        return redirect()->route('store.auth.login');
    }
}
