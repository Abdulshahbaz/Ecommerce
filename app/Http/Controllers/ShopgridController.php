<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopgridController extends Controller
{
    public function shop_grid()
    {
        return view('shop-grid');
    }
}
