<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
class OrderController extends Controller
{
    public function order_list()
    {
        //$user =Auth::guard('web')->user()->name;
        $user_order = auth()->user()->orders()->paginate(10); 
      //  dd($user_order);
        return view('user.order-list',['user_order' => $user_order]);
    }
}
