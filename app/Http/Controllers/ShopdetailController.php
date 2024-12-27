<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopdetailController extends Controller
{
    public function shop_details()
    {
        return view('shop-details');
    }
}
