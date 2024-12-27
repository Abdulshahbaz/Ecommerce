<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
    public function user_profile()
    {
        $user_profile = auth()->user();
        // $get_user_profile= User::where('id',$user_profile->id)->first();
        return view('user.profile',['user_profile'=>$user_profile]);
    }

    public function user_profile_update(Request $request,$id)
    {
        $update_profile = User::find($id);
        $update_profile->name = $request->name;
        $update_profile->email = $request->email;
        $update_profile->mobile = $request->mobile;
        $update_profile->save();

        return redirect()->route('user.dashboard')->with('success','Profile Updated SuccessFully!');
    }
}
