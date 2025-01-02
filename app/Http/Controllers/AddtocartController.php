<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 

class AddtocartController extends Controller
{
    public function add_to_cart(Request $request,$id)
    {
        $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());

        
        if (!auth()->check()) {
            session(['guest_id' => $userId]);
        }
    
       
        $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();
    
        if ($existingCartItem) {
            return response()->json(['message' => 'This product is already in your cart.']);
        }
    
             $product_id = $id;   
             $quantity = $request->input('quantity', 1);

             $cart = new Cart;
             $cart->product_id =$product_id;
             $cart->user_id =  $userId;
             $cart->qty = $quantity;
             $cart->save();
             return response()->json([
                'message' => 'Cart product added successfully!'
            ]);
    }
}
