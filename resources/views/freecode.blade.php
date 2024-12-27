{{-- //controller file homecontroller --}}
<?php
// namespace App\Http\Controllers;
// use Razorpay\Api\Api;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;
// use App\Models\Category;
// use App\Models\Product;
// use App\Models\Banner;
// use App\Models\Blog;
// use App\Models\Cart; 
// use App\Models\Coupan;
// use App\Models\Order;
// use App\Models\Order_product_detail;
// use Auth;
// use Exception;
// class HomeController extends Controller
// {
//     public function index()
//     {
//         $category_name      = Category::all();
//         $product_name       =  Product::all();
//         $banner_image       =  Banner::all();
//         $latest_products    =  Product::where('latest_product',1)->get();
//         $top_rated_products =  Product::where('top_rated_product',1)->get();
//         $review_products    =  Product::where('review_product',1)->get();
//         $blogs              =  Blog::all();

//         return view('index',['category_name'      =>$category_name,
//                              'product_name'       =>$product_name,
//                               'banner_image'      =>$banner_image,
//                               'latest_products'   =>$latest_products,
//                               'top_rated_products'=>$top_rated_products,
//                               'review_products'   =>$review_products,
//                               'blogs'             =>$blogs,
//                             ]);
//     }
//     public function shop_grid()
//     {
//         return view('shop-grid');
//     }

//     public function blog()
//     {
//         return view('blog');
//     }

//     public function contact()
//     {
//         return view('contact');
//     }

//     public function shop_details()
//     {
//         return view('shop-details');
//     }

//     public function shoping_cart()
//     { 
//         $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());
        
//         if (!auth()->check()) {
//             session(['guest_id' => $userId]);
//         }
//         $cart_items = Cart::with('product')->where('user_id', $userId)->get();
//         $total_amount = 0;
//         foreach($cart_items as $items)
//         {
//             $total_amount += $items->qty * $items->product->price;
//         }
        
//         return view('shoping-cart',['cart_items'=>$cart_items,'total_amount'=>$total_amount]);
//     }

//     public function check_out()
//     {
        
//         $userId = auth()->id();
//         $cart_items = Cart::with('product')->where('user_id', $userId)->get();

//         $total_amount = 0;
//         foreach($cart_items as $items)
//         {
//             $total_amount += $items->qty * $items->product->price;
//         }
       
//         $discount = 0;
//         if (session()->has('coupan_code'))
//          {
//             $coupanCode = session('coupan_code');
//             $coupan = Coupan::where('coupan_code', $coupanCode)->first();
            
//             if ($coupan)
//             {
//            if ($coupan->type == 'fixed') 
//            {
//              $discount = $coupan->value; 
//             } 
//       elseif ($coupan->type == 'percent') 
//       {
//         $discount = round((float)$coupan->value * ((float)$total_amount / 100), 2);

//     }
//  }
 
// }
//       $total = $total_amount - $discount;

//         return view('check-out',['cart_items'=>$cart_items,'total_amount'=>$total_amount,'total'=>$total]);
//     }

//     public function check_out_add(Request $request)
//     {
         

//            $userId = auth()->id();
//             $request->validate([

//             'fname'   => 'required|string|max:255',
//             'lname'   => 'required|string|max:255',
//             'country' => 'required|string|max:255',
//             'address' => 'required|string|max:255',
//             'city'    => 'required|string|max:255',
//             'state'   => 'required|string|max:255',
//             'zip'     => 'required',
//             'phone'   => 'required',
//             // 'email'   => 'required|unique:orders,email,id',
//             'or_no'   => 'required|string|max:255',
          
//          ]);

       
//         $order = new Order;
//         $order->user_id = $userId;
//         $order->save();

//         $cart_items = Cart::with('product')->where('user_id', $userId)->get();
//         $total_amount = 0;

//         foreach($cart_items as $items)
//         {
//             $order_product_items = new Order_product_detail;
//             $order_product_items->product_id = $items->product_id;
//             $order_product_items->qty = $items->qty;
//             $order_product_items->amount =  $items->qty * $items->product->price;
//             $order_product_items->order_id = $order->id;
//             $order_product_items->save();   

//             $total_amount += $items->qty * $items->product->price;
//         }
    
//         $subtotal = $total_amount;

//         $apply_coupan = $request->coupan_code;
//         $coupan = Coupan::where('coupan_code', $apply_coupan)->first();
//         $coupan_id = $coupan ? $coupan->id : null;
       

//         $discount = 0;

//         if ($coupan){
//     if ($coupan->type == 'fixed') {
//         $discount = $coupan->value; 
//     } 
//     elseif ($coupan->type == 'percent') {
//         $discount = round((float)$coupan->value * ((float)$subtotal / 100), 2);

//     }
//  }
 
//         $total = $subtotal - $discount;

//         $order->fname   = $request->fname;
//         $order->lname   = $request->lname;
//         $order->country = $request->country;
//         $order->address = $request->address;
//         $order->city    = $request->city;
//         $order->state   = $request->state;
//         $order->zip     = $request->zip;
//         $order->phone   = $request->phone;
//         $order->email   = $request->email;
//         $order->or_no   = $request->or_no;
//         $order->subtotal= $subtotal;
//         $order->coupan_amount = $discount;
//         $order->total   = $total;
//         $order->payment_type = $request->payment_method;
//         $order->coupon_id  = $coupan_id;
//         $order->save();

//         $api =new \Razorpay\Api\Api(env('STRIPE_KEY'),env('STRIPE_SECRET'));

//         $payment_order = $api->order->create([
//             'receipt' => 'order_receiptid_'.$order->id,
//             'amount' => (int) $order->total * 100,
//             'currency' =>'INR',
//         ]);
//  //dd($payment_order['id']);
//      //   $order->update(['razorpay_order_id' =>$payment_order['id']]);
//      //   dd($order);

//         $totalamount=(int) $order->total * 100;
//         return view('orderview',['order'=>$order,
//                                 'totalamount'=>$totalamount,
//                                 'STRIPE_KEY' =>env('STRIPE_KEY'),
//                                 'razorpay_order_id'=>$payment_order['id'],
//     ]);
 
//     }

//     public function blog_details()
//     {
//         return view('blog-details');
//     }

//      public function addtocart($id)
//     {
//         $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());

        
//         if (!auth()->check()) {
//             session(['guest_id' => $userId]);
//         }
    
       
//         $existingCartItem = Cart::where('user_id', $userId)->where('product_id', $id)->first();
    
//         if ($existingCartItem) {
//             return response()->json(['message' => 'This product is already in your cart.']);
//         }
    
//              $product_id = $id;            
//              $cart = new Cart;
//              $cart->product_id =$product_id;
//              $cart->user_id =  $userId;
//              $cart->save();
//              return response()->json([
//                 'message' => 'Cart product added successfully!'
//             ]);
//     }

//     public function cartCount()
//     {
//         $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());

//         if (!auth()->check()) {
//             session(['guest_id' => $userId]);
//         }

//         $count_items = Cart::where('user_id', $userId)->count(); 
//         return response()->json(['count' => $count_items]);
//      }

//      public function removetocart($id)
//     {
//         $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());

//         if (!auth()->check()) {
//             session(['guest_id' => $userId]);
//         } 

//         $cartItem = Cart::where('user_id',$userId)->where('product_id', $id)->first();
//         if (!$cartItem) {
//             return response()->json(['message' => 'Product not found in cart!'], 404);
//         }
//         $cartItem->delete();

//         return response()->json(['message' => 'Product removed from cart!']);
//     }
     

//     public function getCartProducts()
//     {
//         $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());

//         if (!auth()->check()) {
//             session(['guest_id' => $userId]);
//         } 

//         $cartProducts = Cart::where('user_id', $userId)->pluck('product_id')->toArray(); 
//         return response()->json($cartProducts);
//     }
    
//     public function update(Request $request)
// {
//     $cartItemId = $request->id; 
//     $newQty = $request->qty; 

//     $cartItem = Cart::findOrFail($cartItemId);
//     $cartItem->qty = $newQty;
//     $cartItem->save();

//     return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
// }
// public function destroy($id)
// {
//     $cartItem = Cart::findOrFail($id);
//     $cartItem->delete();
   
//     if ($cartItem) {
//         $cartItem->delete();
//         return response()->json(['success' => true]);
//     }
//     return response()->json(['success' => false], 404);
// }

// public function applyCoupon(Request $request)
// {
//     $request->validate([
//         'coupan_code' => 'required'
//     ]);
   
//     $apply_coupan = $request->coupan_code;
//     $coupan = Coupan::where('coupan_code', $apply_coupan)->first();

//     if (!$coupan) {
//         return response()->json(['message' => 'Invalid Coupon Code. Please try again.'], 400);
//     }

//     if ($coupan->status != 1 || $coupan->used_count > $coupan->maxuse) {
//         return response()->json(['message' => 'Coupon is not valid or has exceeded its maximum uses.'], 400);
//     }

//     $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());
//         if (!auth()->check()) {
//             session(['guest_id' => $userId]);
//         }
//         $cart_items = Cart::with('product')->where('user_id', $userId)->get();
//         $total_amount = 0;
//         foreach($cart_items as $items)
//         {
//             $total_amount += $items->qty * $items->product->price;
//         }
    
//         $subtotal = $total_amount;

//         if ($coupan->cart_value > $subtotal) 
//         {
//             return response()->json(['message' => 'Coupon cannot be applied as the subtotal is less than the required cart value.'], 400);
//         }


//     $discount = 0;
//     if ($coupan->type == 'fixed') {
//         $discount = $coupan->value; 
//     } 
//     elseif ($coupan->type == 'percent') {
//       //  $discount = (float)($coupan->value)*((float)$subtotal/100); 
//         $discount = round((float)$coupan->value * ((float)$subtotal / 100), 2);

//     }

//     session([
//         'coupan_code' => $coupan->coupan_code,
//         'discount' => $discount, 
//     ]);

//    // $coupan->increment('used_count'); 
 
//     return response()->json([
//         'success' => true, 
//         'message' => 'Coupon applied successfully!',
//         'discount' => $discount,
//         'total_amount' => $subtotal - $discount 
//     ], 200);
// }

// public function removeCoupon(Request $request)
// {
//     if (session()->has('coupan_code')) {
//         session()->forget(['coupan_code', 'value', 'maxuse', 'used_count']);
//         return response()->json(['success' => true, 'message' => 'Coupon removed successfully!'], 200);
//     }

//     return response()->json(['success' => false, 'message' => 'No coupon found to remove.'], 400);
// }

// public function getFile()
// {
//     $userId = auth()->check() ? auth()->id() : session('guest_id', generateRandomId());
//         if (!auth()->check()) {
//             session(['guest_id' => $userId]);
//         }
//         $cart_items = Cart::with('product')->where('user_id', $userId)->get();
//         $total_amount = 0;
//         foreach($cart_items as $items)
//         {
//             $total_amount += $items->qty * $items->product->price;
//         }
//     if ([$total_amount, $cart_items]) {
//         return response()->json([
//             'success' => true,
//             'fileContent' => view('shopingcart', compact('total_amount','cart_items'))->render(),
//         ]);
//     }

//     return response()->json(['success' => false, 'message' => 'Data not found']);
// }


// public function verifyPayment(Request $request)
//     {
//         $input = $request->all();

//         $api = new \Razorpay\Api\Api(env('STRIPE_KEY'), env('STRIPE_SECRET'));

//         try {
//             // Verify payment signature
//             $api->utility->verifyPaymentSignature([
//                 'razorpay_order_id' => $input['order_id'],
//                 'razorpay_payment_id' => $input['payment_id'],
//                 'razorpay_signature' => $input['signature']
//             ]);
   
//             // Payment is valid, update the order status
//             $order = Order::where('id', $input['main_order_id'])->first();
//             $order->payment_status = 'completed';
//             $order->transaction_id = $input['payment_id'];
            
//             $order->save();
//             // SendPaymentConfirmationEmail::dispatch($order);
//             // MailFacade::to($order->email)->send(new PaymentConfirmationMail($order ));


//             // session()->forget('cart');

//             return response()->json(['status' => 'success']);
//         } catch (\Exception $e) {


//         $order = Order::where('id', $input['main_order_id'])->first();
//         $order->status = 'failed';
//         $order->payment_id = $input['payment_id'];
//         $order->save();
//         // Payment failed, handle the error
//         return response()->json(['status' => 'failed']);
//       }
//     }

//     public function success()
//     {
//         return view('success');
//     }
// }

// ---------------------------------------------------------------


// userlogincontrolller 

// public function user_register()
    // {
    //     return view('register');
    // }

    // public function user_register_check(Request $request)
    // {
        
    //     $request->validate([
          
    //         'name' => 'required|string',
    //         'email' => 'required|unique:users,email,id',
    //         'mobile' => 'required|digits:10',
    //         'password' => 'required|digits:8',
           
    //     ]);
 
    //     $user_register = new User;
    //     $user_register->name = $request->name;
    //     $user_register->email = $request->email;
    //     $user_register->mobile = $request->mobile;
    //     $user_register->password = Hash::make($request->password);
    //     $user_register->save();

    //     $userId = $user_register->id;
    //     $guest_id = session('guest_id');
        
    //     if($guest_id)
    //     {
    //         Cart::where('user_id',$guest_id)
    //               ->update(['user_id'=>$userId]);
    //     }

    //     session('userId');
     

    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         return redirect()->route('check.out')->with('success','Registration Add SuccessFully!');
    //     }
    //     return redirect()->back()->with('error', 'Please Enter Use Valid Email and Password');
    // }