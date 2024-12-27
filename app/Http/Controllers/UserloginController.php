<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use Hash;
use Auth;
class UserloginController extends Controller
{   
    public function user_login()
    {
        return view('login');
    }

    public function user_login_check(Request $request)
    {
        $request->validate([
                'email' => 'required',
                'password' => 'required',

            ]);
        $credentials = $request->only('email', 'password');
        $user_login = User::where('email', $credentials['email'])->first();

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('check.out');
        }
        return redirect()->back()->with('error', 'Please Eneter Valid Email and Pasword');
    }
}
