<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 

class CartcountController extends Controller
{
    public function cart_count()
    {
        $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());

        if (!auth()->check()) {
            session(['guest_id' => $userId]);
        }

        $count_items = Cart::where('user_id', $userId)->count(); 
        return response()->json(['count' => $count_items]);
     }
}
