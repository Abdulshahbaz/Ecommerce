<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Product;
use App\Models\Order_product_detail;
use App\Models\User;
class AdminController extends Controller
{
    public function dashboard()
    {
        $all_products_count = Product::count();
        $sales_products_count = Order_product_detail::count();
        $all_users_count = User::count();
        return view('admin.dashboard',['all_products_count' => $all_products_count,
                                       'sales_products_count' => $sales_products_count,
                                       'all_users_count' => $all_users_count]);
    }

    public function login()
    {
        return view('admin.login');
    }

    public function admin_login_check(Request $request)
    {

         $request->validate([
             'email' => 'required',
             'password' => 'required'
         ]);
         
         if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password]))
         {
            $admin_name = Auth::guard('admin')->user()->name;
            return redirect()->route('admin.dashboard')->with('success','welcome to '. $admin_name);
         }
           return redirect()->back()->with('error','please Correct email and password');
    }

    public function logout(Request $request)
    {
        Auth::logout(); 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home.page');
    }

   
}
