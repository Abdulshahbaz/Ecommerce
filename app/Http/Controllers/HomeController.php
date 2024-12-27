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
    public function index()
    {
        $category_name      = Category::all();
        $product_name       =  Product::all();
        $banner_image       =  Banner::all();
        $latest_products    =  Product::where('latest_product',1)->get();
        $top_rated_products =  Product::where('top_rated_product',1)->get();
        $review_products    =  Product::where('review_product',1)->get();
        $blogs              =  Blog::all();

        return view('index',['category_name'      =>$category_name,
                             'product_name'       =>$product_name,
                              'banner_image'      =>$banner_image,
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
