<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{
    public function index(){
        return view('admin.modules.auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->only(['email', 'password']);
        $remember = ($request->input('remember')) ? 1 : 0;
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed...
            return redirect()->intended('/admin/dashboard');
        }
        return back()->withInput()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}
