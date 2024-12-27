<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogdetailsController extends Controller
{
    public function blog_details()
    {
        return view('blog-details');
    }
}
