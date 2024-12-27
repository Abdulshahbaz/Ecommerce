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


class PaymentController extends Controller
{
    public function get_file()
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
        if ([$total_amount, $cart_items]) {
            return response()->json([
                'success' => true,
                'fileContent' => view('shopingcart', compact('total_amount','cart_items'))->render(),
            ]);
        }
    
        return response()->json(['success' => false, 'message' => 'Data not found']);
    }
    
    
    public function verify_payment(Request $request)
        {
            $input = $request->all();
    
            $api = new \Razorpay\Api\Api(env('STRIPE_KEY'), env('STRIPE_SECRET'));
    
            try {
                // Verify payment signature
                $api->utility->verifyPaymentSignature([
                    'razorpay_order_id' => $input['order_id'],
                    'razorpay_payment_id' => $input['payment_id'],
                    'razorpay_signature' => $input['signature']
                ]);
       
                // Payment is valid, update the order status
                $order = Order::where('id', $input['main_order_id'])->first();
                $order->payment_status = 'completed';
                $order->transaction_id = $input['payment_id'];
                
                $order->save();
                // SendPaymentConfirmationEmail::dispatch($order);
                // MailFacade::to($order->email)->send(new PaymentConfirmationMail($order ));
    
    
                // session()->forget('cart');
    
                return response()->json(['status' => 'success']);
            } catch (\Exception $e) {
    
    
            $order = Order::where('id', $input['main_order_id'])->first();
            $order->status = 'failed';
            $order->payment_id = $input['payment_id'];
            $order->save();
            // Payment failed, handle the error
            return response()->json(['status' => 'failed']);
          }
        }
    
}
