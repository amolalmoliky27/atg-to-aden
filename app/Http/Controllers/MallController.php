<?php

namespace App\Http\Controllers;

use App\Models\Mall;
use Illuminate\Http\Request;

class MallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $malls = Mall::all();
        
        return view('mall' , compact('malls') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('createres');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $images = $request->file('images') ;
        $imagepath = [];
        foreach($images as $image){
         $filename = time() . '_' .$image->getClientOriginalName();
           $image->move(public_path('images'),$filename);
           $imagepath[] = $filename;
          }
        
        $mall = new Mall();
        $photo = $request->file('image');
        $filename = $photo->getClientOriginalName();
        $photo->move('images',$filename);
    
        $mall->name = $request->name;
        $mall->des = $request->des;
         $mall->image = $filename;
        
         $mall->images = json_encode($imagepath);
         $mall->save();
         return redirect()->route('mall.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mall $mall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $mall = Mall::findOrFail($id); 
        return view('editres', compact('mall'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mall $mall)
    {
        $mall->name = $request->name; 
        $mall->des = $request->des; 
     
        // ثﯾدﺣﺗ ةروﺻﻟا ﺔﯾﺳﯾﺋرﻟا اذإ مﺗ ﻊﻓر ةدﺣاو ةدﯾدﺟ 
        if ($request->hasFile('image')) { 
            $photo = $request->file('image'); 
            $filename = time() . '_' . $photo->getClientOriginalName(); 
            $photo->move(public_path('images'), $filename); 
            $mall->image = $filename; 
        } 
     
        // ثﯾدﺣﺗ روﺻﻟا ﺔﯾﻓﺎﺿﻹا اذإ مﺗ ﺎﮭﻌﻓر 
        if ($request->hasFile('images')) { 
            $imagePaths = []; 
            foreach ($request->file('images') as $image) { 
                $filename = time() . '_' . $image->getClientOriginalName(); 
                $image->move(public_path('images'), $filename); 
                $imagePaths[] = $filename; 
            } 
            $mall->images = json_encode($imagePaths); 
        } 
     
        $mall->save(); 
     
        return redirect()->route('mall.index')->with('success', ' ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mall = Mall::findOrFail($id);

        $mall->delete();
        
        return redirect()->route('mall.index');
    }
}
