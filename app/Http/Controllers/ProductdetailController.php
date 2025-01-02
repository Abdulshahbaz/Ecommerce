<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductdetailController extends Controller
{
    public function product_details($id)
    {
        $get_product_detail = Product::find($id); 
        $category_id = $get_product_detail->category_id ;
        $related_products = Product::where('category_id',$category_id)->get();
      
        return view('product-details',['get_product_detail' => $get_product_detail,
                                        'related_products' => $related_products]);
    }

    public function update(Request $request)
    {
        $itemId = $request->input('id');
        $quantity = $request->input('qty');
           
        $cartItem = Cart::find($itemId);
        if ($cartItem) {
            $cartItem->qty = $quantity;
            $cartItem->save();
        }
    
        return response()->json(['message' => 'Cart updated successfully']);
    }
}
