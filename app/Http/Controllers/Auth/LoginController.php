<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider; 

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(LoginRequest $req) {
        $req->authenticate();

        $req->session()->regenerate();

        switch (auth()->user()->role) {
            case 'admin':
                return redirect()->intended(RouteServiceProvider::ADMIN);
            default: 
                return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    public function logout(Request $req) {
        Auth::guard('web')->logout();

        $req->session()->invalidate();

        $req->session()->regenerateToken();

        return redirect('/login');
    }
}
