<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog.blog-list',['blogs'=>$blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.blog.blog-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'title' =>  'required|string|max:255',
            'desc'  =>  'required|string|max:1000',
            'date'  =>   'required',

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

       $blog_insert = new Blog();
       $blog_insert->image = $imageName;
       $blog_insert->title =$request->title;
       $blog_insert->desc  =$request->desc;
       $blog_insert->date  = $request->date;
       $blog_insert->comment_count = $request->comment_count;
       $blog_insert->save();

       return redirect()->route('blog.index')->with('success','Blog Add SuccessFully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $blog_view = Blog::find($id);
       return view('admin.blog.blog-view',['blog_view'=>$blog_view]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $blog_edit = Blog::find($id);
      return view('admin.blog.blog-edit',['blog_edit'=>$blog_edit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'title' =>  'required|string|max:255',
            'desc'  =>  'required|string|max:1000',
            'date'  =>   'required',


       ]);

          $blog = Blog::find($id);
       if ($request->hasFile('image'))
       {
         $imageName = time().'.'.$request->image->extension();
         $request->image->move(public_path('admin/img'),$imageName);
       }
       else
       {
         $imageName=$blog->image;
       }

        $blog_update = Blog::find($id);
        $blog_update->image = $imageName;
        $blog_update->title =$request->title;
        $blog_update->desc  =$request->desc;
        $blog_update->date  = $request->date;
        $blog_update->save();

        return redirect()->route('blog.index')->with('success','Blog Update SuccessFully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Blog::destroy($id);
        return redirect()->route('blog.index')->with('success','Blog Deleted SuccessFully!');
    }

    public function toggle_Blog(Request $request)
    {
        $blog = Blog::find($request->id);
    
        if ($request->toggle_type === 'status')
        {
           $blog->status = $request->value;
        }
    
        $blog->save();
    
        $message = ucfirst(str_replace('_', ' ', $request->toggle_type)) . 
                   ($request->value ? ' enabled successfully!' : ' disabled successfully!');
    
        return response()->json(['success' => true, 'message' => $message]);
    }
}
