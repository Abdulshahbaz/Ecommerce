<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 

class RemovetocartController extends Controller
{
    public function remove_to_cart($id)
    {
        $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());

        if (!auth()->check()) {
            session(['guest_id' => $userId]);
        } 

        $cartItem = Cart::where('user_id',$userId)->where('product_id', $id)->first();
        if (!$cartItem) {
            return response()->json(['message' => 'Product not found in cart!'], 404);
        }
        $cartItem->delete();

        return response()->json(['message' => 'Product removed from cart!']);
    }
}
