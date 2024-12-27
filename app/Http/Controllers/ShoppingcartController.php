<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 

class ShoppingcartController extends Controller
{
    public function shoping_cart()
    { 
        $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());
        
        if (!auth()->check()) {
            session(['guest_id' => $userId]);
        }
        $cart_items = Cart::with('product')->where('user_id', $userId)->get();
        $total_amount = 0;
        foreach($cart_items as $items)
        {
            $total_amount += $items->qty * $items->product->price;
        }
        
        return view('shoping-cart',['cart_items'=>$cart_items,'total_amount'=>$total_amount]);
    }
}
