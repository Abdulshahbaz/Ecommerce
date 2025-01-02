<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Cart; 
use App\Models\Coupan;
use App\Models\Order;


class HomeController extends Controller
{
    public function index(Request $request)
    {
            
        $query = $request->input('query');
        $categoryId = $request->id;
        
        $productQuery = Product::where('status', 1)
                                ->with('category')
                                ->where('status',1)
                                ->get();
        
        if ($query) {
            $productQuery->where('name', 'LIKE', "%{$query}%");
        }
        
        if ($categoryId) {
            $productQuery->where('category_id', $categoryId);
        }
        
        $product_name = $productQuery;

        $category_name      = Category::where('status',1)->get();
        $banner_images       =  Banner::all();
        

        if($banner_images->count() > 0) 
        {
            $first_image = $banner_images->first();
            $last_images = $banner_images->skip(1)->take(2);

       $banner_images = [
                'first_image' => $first_image,
                'last_images' => $last_images
            ];
        } 
        else {
            $banner_images = [];
        }
       
        $latest_products    =  Product::where('latest_product',1)->get();
        $top_rated_products =  Product::where('top_rated_product',1)->get();
        $review_products    =  Product::where('review_product',1)->get();
        $blogs              =  Blog::all();

        return view('index',['category_name'      =>$category_name,
                             'product_name'       =>$product_name,
                              'banner_images'      =>$banner_images,
                              'latest_products'   =>$latest_products,
                              'top_rated_products'=>$top_rated_products,
                              'review_products'   =>$review_products,
                              'blogs'             =>$blogs,
                            ]);
    }
   

    public function success()
    {
        return view('success');
    }

    
}
