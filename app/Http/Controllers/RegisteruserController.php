<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use Hash;
use Auth;

class RegisteruserController extends Controller
{
    public function user_register()
    {
        return view('register');
    }

    public function user_register_check(Request $request)
    {
        
        $request->validate([
          
            'name' => 'required|string',
            'email' => 'required|unique:users,email,id',
            'mobile' => 'required|digits:10',
            'password' => 'required|digits:8',
           
        ]);
 
        $user_register = new User;
        $user_register->name = $request->name;
        $user_register->email = $request->email;
        $user_register->mobile = $request->mobile;
        $user_register->password = Hash::make($request->password);
        $user_register->save();

        $userId = $user_register->id;
        $guest_id = session('guest_id');
        
        if($guest_id)
        {
            Cart::where('user_id',$guest_id)
                  ->update(['user_id'=>$userId]);
        }

        session('userId');
     

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('check.out')->with('success','Registration Add SuccessFully!');
        }
        return redirect()->back()->with('error', 'Please Enter Use Valid Email and Password');
    }
}
