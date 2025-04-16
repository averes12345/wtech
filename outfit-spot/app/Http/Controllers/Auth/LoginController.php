<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoggedIn;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $credentials['is_admin'] = true;
        if (Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            /* this is temporary until we have the index.html up and running */
            /* return redirect()->intended('/checkout'); */
            return redirect('/admin/home');
        }

        $credentials['is_admin'] = false;
        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        $user = Auth::user() ?? Auth::guard('admin')->user();
        if ($user !== null ){
            event(new UserLoggedIn($user));
        }

        return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    //
}

