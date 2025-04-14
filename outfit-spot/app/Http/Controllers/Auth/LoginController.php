<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginFrom()
    {
        return view('login-page');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            /* this is temporary until we have the index.html up and running */
            /* return redirect()->intended('/checkout'); */
            return redirect('/checkout');
        }

        return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    //
}

