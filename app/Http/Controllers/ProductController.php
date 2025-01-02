<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart; 
use App\Models\Product;
use App\Models\Category; 

class ProductController extends Controller
{
   
    public function products(Request $request)
    {  

        $category_name      = Category::where('status',1)->get();
        $latest_products    =  Product::where('latest_product',1)->get();
        $top_rated_products =  Product::where('top_rated_product',1)->get();

        $query = $request->input('query');
        $categoryId = $request->id;
        
        $productQuery = Product::where('status', 1)
            ->with('category');
        
        if ($query) {
            $productQuery->where('name', 'LIKE', "%{$query}%");
        }
        
        if ($categoryId) {
            $productQuery->where('category_id', $categoryId);
        }
        
        $product_name = $productQuery->paginate(6);
        


        return view('products',['category_name'=>$category_name,
                                'latest_products'=>$latest_products,
                                'top_rated_products' =>$top_rated_products,
                                'product_name' => $product_name
                                
                                ]);
    }
   
   
   
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
        $itemId = $request->input('id');
        $quantity = $request->input('qty');

         $cartItem = Cart::find($itemId);

        if ($cartItem) {
            $cartItem->qty = $quantity;
            $cartItem->save();
        }
        
        return response()->json(['message' => 'Cart updated successfully']);
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

// public function fillter_price(Request $request)
// {
//     dd($request);
// }
}
