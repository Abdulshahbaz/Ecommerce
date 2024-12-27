<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategorysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorys = Category::all();
        return view('admin.category.category-list',['categorys'=>$categorys]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.category-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug_name'     => 'required|unique:categories',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image'))
        {
          $imageName = time().'.'.$request->image->extension();
          $request->image->move(public_path('admin/img'),$imageName);
        }
        else
        {
          $imageName=null;
        }

        $category_insert = new Category;
        $category_insert->category_name = $request->category_name;
        $category_insert->slug_name     = $request->category_name;
        $category_insert->image         = $imageName;
        
        $category_insert->save();

        return redirect()->route('category.index')->with('success','Category Add SuccessFully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category_view = Category::find($id);
        return view('admin.category.category-view',['category_view'=>$category_view]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('admin.category.category-edit',['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug_name'     => 'required|string|max:255',
            'image'         => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $category = Category::find($id);

        if ($request->hasFile('image'))
        {
          $imageName = time().'.'.$request->image->extension();
          $request->image->move(public_path('admin/img'),$imageName);
        }
        else
        {
          $imageName=$category->image;
        }

        $category_update = Category::find($id);
        $category_update->category_name = $request->category_name;
        $category_update->slug_name     = $request->slug_name;
        $category_update->image         = $imageName;
        $category_update->save();

        return redirect()->route('category.index')->with('success','Category Updated SuccessFully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->back()->with('success','Category Deleted SuccessFully!');
    }

    public function toggle_Category(Request $request)
    {
        $category = Category::find($request->id);
    
        if ($request->toggle_type === 'status')
        {
           $category->status = $request->value;
        }
        $category->save();
    
        $message = ucfirst(str_replace('_', ' ', $request->toggle_type)) . 
                   ($request->value ? ' enabled successfully!' : ' disabled successfully!');
    
        return response()->json(['success' => true, 'message' => $message]);
    }
}
