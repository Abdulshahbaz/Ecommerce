<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.product.product-list',['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category_names = Category::select('id','category_name')->get();
        return view('admin.product.product-add',['category_names'=>$category_names]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_id'       => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'slug_name'    => 'required|string|max:255|unique:products,slug',
            'image'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'short_desc'   => 'required|string|max:1000',
            'desc'         => 'required|string|max:1000',
            'mrp'          => 'required|numeric',
            'price'        => 'required|numeric',
        ]);
       
        if ($request->hasFile('image'))
        {
          $imageName = uniqid().'.'.$request->image->extension();
          $request->image->move(public_path('admin/img'),$imageName);
        }
        else
        {
          $imageName=null;
        }

        $product_insert = new Product;
        $product_insert->category_id  = $request->cat_id;
        $product_insert->name         = $request->product_name;
        $product_insert->slug         = $request->slug_name;
        $product_insert->image	      = $imageName;
        $product_insert->short_desc   = $request->short_desc;
        $product_insert->desc         = $request->desc;
        $product_insert->mrp          = $request->mrp;
        $product_insert->price        = $request->price;
       // dd($product_insert);
        $product_insert->save();

        return redirect()->route('product.index')->with('success','product Add SuccessFully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product_view = Product::with('category')->find($id);
        return view('admin.product.product-view',['product_view'=>$product_view]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product_edit = Product::find($id);
        $category_name = Category::all();
        return view('admin.product.product-edit',[
                                                   'product_edit' =>$product_edit,
                                                   'category_name'=>$category_name
                                                  ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cat_id'       => 'required|exists:categories,id',
            'product_name' => 'required|string|max:255',
            'slug_name'    => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'short_desc'   => 'required|string|max:1000',
            'desc'         => 'required|string|max:1000',
            'mrp'          => 'required|numeric',
            'price'        => 'required|numeric',
        ]);

        $product = Product::find($id);
       
        if ($request->hasFile('image'))
        {
          $imageName = time().'.'.$request->image->extension();
          $request->image->move(public_path('admin/img'),$imageName);
        }
        else
        {
          $imageName=$product->image;
        }

        $product_update = Product::find($id);
        $product_update->category_id  = $request->cat_id;
        $product_update->name         = $request->product_name;
        $product_update->slug         = $request->slug_name;
        $product_update->image	      = $imageName;
        $product_update->short_desc   = $request->short_desc;
        $product_update->desc         = $request->desc;
        $product_update->mrp          = $request->mrp;
        $product_update->price        = $request->price;
       // dd($product_update);
        $product_update->save();

        return redirect()->route('product.index')->with('success','product Updated SuccessFully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::destroy($id);
        return redirect()->back()->with('success','product Deleted SuccessFully!');
    }

    public function toggle_Product(Request $request)
{
    $product = Product::find($request->id);

    if ($request->toggle_type === 'latest_product')
     {
        $product->latest_product = $request->value;
    } 
    elseif ($request->toggle_type === 'top_rated_product') 
    {
        $product->top_rated_product = $request->value;
    } 
    elseif ($request->toggle_type === 'review_product') 
    {
        $product->review_product = $request->value;
    }
    elseif ($request->toggle_type === 'status')
    {
       $product->status = $request->value;
    }

    $product->save();

    $message = ucfirst(str_replace('_', ' ', $request->toggle_type)) . 
               ($request->value ? ' enabled successfully!' : ' disabled successfully!');

    return response()->json(['success' => true, 'message' => $message]);
}

}
