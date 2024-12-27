<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Cart; 
use App\Models\Coupan;
use App\Models\Order;
use App\Models\Order_product_detail;
use Auth;
use Exception;

class CheckoutController extends Controller
{
    public function check_out()
    {
        
        $userId = auth()->id();
        $cart_items = Cart::with('product')->where('user_id', $userId)->get();

        $total_amount = 0;
        foreach($cart_items as $items)
        {
            $total_amount += $items->qty * $items->product->price;
        }
       
        $discount = 0;
        if (session()->has('coupan_code'))
         {
            $coupanCode = session('coupan_code');
            $coupan = Coupan::where('coupan_code', $coupanCode)->first();
            
            if ($coupan)
            {
           if ($coupan->type == 'fixed') 
           {
             $discount = $coupan->value; 
            } 
      elseif ($coupan->type == 'percent') 
      {
        $discount = round((float)$coupan->value * ((float)$total_amount / 100), 2);

    }
 }
 
}
      $total = $total_amount - $discount;

        return view('check-out',['cart_items'=>$cart_items,'total_amount'=>$total_amount,'total'=>$total]);
    }

    public function check_out_add(Request $request)
    {
         

           $userId = auth()->id();
            $request->validate([

            'fname'   => 'required|string|max:255',
            'lname'   => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city'    => 'required|string|max:255',
            'state'   => 'required|string|max:255',
            'zip'     => 'required',
            'phone'   => 'required',
            // 'email'   => 'required|unique:orders,email,id',
            'or_no'   => 'required|string|max:255',
          
         ]);

       
        $order = new Order;
        $order->user_id = $userId;
        $order->save();

        $cart_items = Cart::with('product')->where('user_id', $userId)->get();
        $total_amount = 0;

        foreach($cart_items as $items)
        {
            $order_product_items = new Order_product_detail;
            $order_product_items->product_id = $items->product_id;
            $order_product_items->qty = $items->qty;
            $order_product_items->amount =  $items->qty * $items->product->price;
            $order_product_items->order_id = $order->id;
            $order_product_items->save();   

            $total_amount += $items->qty * $items->product->price;
        }
    
        $subtotal = $total_amount;

        $apply_coupan = $request->coupan_code;
        $coupan = Coupan::where('coupan_code', $apply_coupan)->first();
        $coupan_id = $coupan ? $coupan->id : null;
       

        $discount = 0;

        if ($coupan){
    if ($coupan->type == 'fixed') {
        $discount = $coupan->value; 
    } 
    elseif ($coupan->type == 'percent') {
        $discount = round((float)$coupan->value * ((float)$subtotal / 100), 2);

    }
 }
 
        $total = $subtotal - $discount;

        $order->fname   = $request->fname;
        $order->lname   = $request->lname;
        $order->country = $request->country;
        $order->address = $request->address;
        $order->city    = $request->city;
        $order->state   = $request->state;
        $order->zip     = $request->zip;
        $order->phone   = $request->phone;
        $order->email   = $request->email;
        $order->or_no   = $request->or_no;
        $order->subtotal= $subtotal;
        $order->coupan_amount = $discount;
        $order->total   = $total;
        $order->payment_type = $request->payment_method;
        $order->coupon_id  = $coupan_id;
        $order->save();

        $api =new \Razorpay\Api\Api(env('STRIPE_KEY'),env('STRIPE_SECRET'));

        $payment_order = $api->order->create([
            'receipt' => 'order_receiptid_'.$order->id,
            'amount' => (int) $order->total * 100,
            'currency' =>'INR',
        ]);

        $totalamount=(int) $order->total * 100;
        return view('orderview',['order'=>$order,
                                'totalamount'=>$totalamount,
                                'STRIPE_KEY' =>env('STRIPE_KEY'),
                                'razorpay_order_id'=>$payment_order['id'],
    ]);
 
    }
}
