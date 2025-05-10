<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class RegistrationController extends Controller
{
    public function showForm(){
        return view('registration-page');
    }
    public function store(Request $request){
        /* dd($request); */
        $validator = Validator::make($request->all(), [
            'first-name' => 'required|string|max:255',
            'last-name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8',
        ]);
        /* dd($request, $validator); */

        if ($validator->fails()) {
            /* dd($validator); */
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'first_name' => $validator->validated()['first-name'],
            'last_name' => $validator->validated()['last-name'],
            'email' => $validator->validated()['email'],
            'password' => Hash::make($validator->validated()['password']),
        ]);

        $request->session()->regenerate();
        Auth()->guard('web')->login($user);
        return redirect('/');
    }
}
