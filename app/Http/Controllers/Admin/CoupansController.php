<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupan;
class CoupansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupans = Coupan::all();
        return view('admin.coupan.coupan-list',['coupans'=>$coupans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupan.coupan-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupan_title' => 'required|string|max:255',
            'type'         =>  'required|in:fixed,percent',
            'coupan_code'  => 'required|unique:coupans',
            'coupan_value' => 'required', 
            'cart_value'   => 'required|numeric',
        ]);

        $coupan_insert = new Coupan;
        $coupan_insert->title         = $request->coupan_title;
        $coupan_insert->type          = $request->type;
        $coupan_insert->coupan_code   = $request->coupan_code;
        $coupan_insert->value         = $request->coupan_value;
        $coupan_insert->cart_value    = $request->cart_value;
       // dd($coupan_insert);
        $coupan_insert->save();

        return redirect()->route('coupan.index')->with('success','Coupan Add SuccessFully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $coupan_view = Coupan::find($id);
        return view('admin.coupan.coupan-view',['coupan_view'=>$coupan_view]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupan = Coupan::find($id);
        return view('admin.coupan.coupan-edit',['coupan'=>$coupan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
           'title' => 'required|string|max:255',
           'type'         =>  'required|in:fixed,percent',
           'coupan_code'  => 'required',
           'value' => 'required', 
           'cart_value'   => 'required|numeric',
    
        ]);

        $coupan_update = Coupan::find($id);
        $coupan_update->title         = $request->title;
        $coupan_update->type          = $request->type;
        $coupan_update->coupan_code   = $request->coupan_code;
        $coupan_update->value         = $request->value;
        $coupan_update->cart_value    = $request->cart_value;
        $coupan_update->save();

        return redirect()->route('coupan.index')->with('success','Coupan Updated SuccessFully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coupan::destroy($id);
        return redirect()->back()->with('success','Coupan Deleted SuccessFully!');
    }

    public function toggle_Coupan(Request $request)
    {
        $coupan = Coupan::find($request->id);
    
        if ($request->toggle_type === 'status')
        {
           $coupan->status = $request->value;
        }
        $coupan->save();
    
        $message = ucfirst(str_replace('_', ' ', $request->toggle_type)) . 
                   ($request->value ? ' enabled successfully!' : ' disabled successfully!');
    
        return response()->json(['success' => true, 'message' => $message]);
    }
}
