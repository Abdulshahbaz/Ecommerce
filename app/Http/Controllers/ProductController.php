<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 

class ProductController extends Controller
{
    public function get_cart_product()
    {
        $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());

        if (!auth()->check()) {
            session(['guest_id' => $userId]);
        } 

        $cartProducts = Cart::where('user_id', $userId)->pluck('product_id')->toArray(); 
        return response()->json($cartProducts);
    }
    
    public function update(Request $request)
{
    $cartItemId = $request->id; 
    $newQty = $request->qty; 

    $cartItem = Cart::findOrFail($cartItemId);
    $cartItem->qty = $newQty;
    $cartItem->save();

    return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
}

public function destroy($id)
{
    $cartItem = Cart::findOrFail($id);
    $cartItem->delete();
   
    if ($cartItem) {
        $cartItem->delete();
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 404);
}
}
