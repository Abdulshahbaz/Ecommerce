<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserlogedController extends Controller
{
    public function user_login()
    {
        return view('user.userloged');
    }

    public function user_loged(Request $request)
    {
        $request->validate([
                'email' => 'required',
                'password' => 'required',

            ]);
        $credentials = $request->only('email', 'password');
        $user_login = User::where('email', $credentials['email'])->first();

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('user.dashboard');
        }
        return redirect()->back()->with('error', 'Please Eneter a Valid Email and Pasword');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }
}
