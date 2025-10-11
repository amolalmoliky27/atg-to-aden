<?php

namespace App\Http\Controllers;

use App\Models\Sea;
use Illuminate\Http\Request;

class SeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seas = Sea::all();
        
        return view('sea' , compact('seas') );
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
        $sea = new Sea();
        $photo = $request->file('image');
        $filename = $photo->getClientOriginalName();
        $photo->move('images',$filename);
    
        $sea->name = $request->name;
        $sea->des = $request->des;
        $sea->adress = $request->adress;
        $sea->stars = $request->stars;
         $sea->image = $filename;
         $sea->save();
         return redirect()->route('sea.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sea $sea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sea $sea)
    {
        return view('editres', compact('sea'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sea $sea)
    {
        $sea->name = $request->name;
        $sea->des = $request->des;
        $sea->adress = $request->adress;
        $sea->stars = $request->stars;
    
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = $photo->getClientOriginalName();
            $photo->move('images', $filename);
            $sea->image = $filename;
        }
    
        $sea->save();
    
        return redirect()->route('sea.index');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $sea = Sea::findOrFail($id);

        $sea->delete();
        
        return redirect()->route('sea.index');
    }
}
