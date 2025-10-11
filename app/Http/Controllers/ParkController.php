<?php

namespace App\Http\Controllers;

use App\Models\Park;
use Illuminate\Http\Request;

class ParkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parks = Park::all();
        
        return view('park' , compact('parks') );
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
        $park = new Park();
        $photo = $request->file('image');
        $filename = $photo->getClientOriginalName();
        $photo->move('images',$filename);
    
        $park->name = $request->name;
        $park->des = $request->des;
        $park->loc = $request->loc;
        $park->space = $request->space;
         $park->image = $filename;
         $park->save();
         return redirect()->route('park.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Park $park)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Park $park)
    {
        return view('editres', compact('park'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Park $park)
    {
        
    $park->name = $request->name;
    $park->des = $request->des;
    $park->loc = $request->loc;
    $park->space = $request->space;

    if ($request->hasFile('image')) {
        $photo = $request->file('image');
        $filename = $photo->getClientOriginalName();
        $photo->move('images', $filename);
        $park->image = $filename;
    }

    $park->save();

    return redirect()->route('park.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $park= Park::findOrFail($id);

        $park->delete();
        
        return redirect()->route('parks.index');
    }
}
