<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = History::all();
        
        return view('history' , compact('histories') );
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
        $history = new History();
        $photo = $request->file('image');
        $filename = $photo->getClientOriginalName();
        $photo->move('images',$filename);
    
        $history->name = $request->name;
        $history->des = $request->des;
        
         $history->image = $filename;
         $history->save();
         return redirect()->route('history.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        return view('editres', compact('history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        $history->name = $request->name;
        $history->des = $request->des;
    
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = $photo->getClientOriginalName();
            $photo->move('images', $filename);
            $history->image = $filename;
        }
    
        $history->save();
    
        return redirect()->route('history.index');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $history= History::findOrFail($id);

        $history->delete();
        
        return redirect()->route('history.index');
    }
}
