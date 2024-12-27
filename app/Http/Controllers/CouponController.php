<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 
use App\Models\Coupan;

class CouponController extends Controller
{
    public function apply_coupon(Request $request)
    {
        $request->validate([
            'coupan_code' => 'required'
        ]);
       
        $apply_coupan = $request->coupan_code;
        $coupan = Coupan::where('coupan_code', $apply_coupan)->first();
    
        if (!$coupan) {
            return response()->json(['message' => 'Invalid Coupon Code. Please try again.'], 400);
        }
    
        if ($coupan->status != 1 || $coupan->used_count > $coupan->maxuse) {
            return response()->json(['message' => 'Coupon is not valid or has exceeded its maximum uses.'], 400);
        }
    
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
        
            $subtotal = $total_amount;
    
            if ($coupan->cart_value > $subtotal) 
            {
                return response()->json(['message' => 'Coupon cannot be applied as the subtotal is less than the required cart value.'], 400);
            }
    
    
        $discount = 0;
        if ($coupan->type == 'fixed') {
            $discount = $coupan->value; 
        } 
        elseif ($coupan->type == 'percent') {
          //  $discount = (float)($coupan->value)*((float)$subtotal/100); 
            $discount = round((float)$coupan->value * ((float)$subtotal / 100), 2);
    
        }
    
        session([
            'coupan_code' => $coupan->coupan_code,
            'discount' => $discount, 
        ]);
    
       // $coupan->increment('used_count'); 
     
        return response()->json([
            'success' => true, 
            'message' => 'Coupon applied successfully!',
            'discount' => $discount,
            'total_amount' => $subtotal - $discount 
        ], 200);
    }
    
    public function remove_coupon(Request $request)
    {
        if (session()->has('coupan_code')) {
            session()->forget(['coupan_code', 'value', 'maxuse', 'used_count']);
            return response()->json(['success' => true, 'message' => 'Coupon removed successfully!'], 200);
        }
    
        return response()->json(['success' => false, 'message' => 'No coupon found to remove.'], 400);
    }
}
