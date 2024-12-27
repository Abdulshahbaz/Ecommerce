<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banner_list = Banner::all();
       return view('admin.banner.banner-list',['banner_list'=>$banner_list]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.banner-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
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
          
        $banner_image_upload = new Banner;
        $banner_image_upload->image    = $imageName;
        $banner_image_upload->title    = $request->title;
        $banner_image_upload->subtitle = $request->subtitle;
        $banner_image_upload->btn_txt  = $request->btn_txt;
        $banner_image_upload->link_txt = $request->link_txt;
        $banner_image_upload->save();

        return redirect()->route('banner.index')->with('success','Banner Add SuccessFully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $banner_view = Banner::find($id);
        return view('admin.banner.banner-view',['banner_view'=>$banner_view]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner= Banner::find($id);
        return view('admin.banner.banner-edit',['banner'=>$banner]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            
            'image' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $banner = Banner::find($id);
        if($request->hasfile('image'))
        {
            $imageName = time().'.'.$request->image->extension();
            $reuest->image->move(public_path('admin/img'),$imageName);
        }
        else
        {
            $imageName=$banner->image;
        }

        $banner_image_upload = Banner::find($id);

        $banner_image_upload->image    = $imageName;
        $banner_image_upload->title    = $request->title;
        $banner_image_upload->subtitle = $request->subtitle;
        $banner_image_upload->btn_txt  = $request->btn_txt;
        $banner_image_upload->link_txt = $request->link_txt;
        $banner_image_upload->save();

        return redirect()->route('banner.index')->with('success','Banner Updated SuccessFully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Banner::destroy($id);
        return redirect()->back()->with('success','Banner Deleted SuccessFully!');
    }

    public function toggle_Banner(Request $request)
    {
        $banner = Banner::find($request->id);
    
        if ($request->toggle_type === 'status')
        {
           $banner->status = $request->value;
        }
    
        $banner->save();
    
        $message = ucfirst(str_replace('_', ' ', $request->toggle_type)) . 
                   ($request->value ? ' enabled successfully!' : ' disabled successfully!');
    
        return response()->json(['success' => true, 'message' => $message]);
    }
}
