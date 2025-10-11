<?php

namespace App\Http\Controllers;

use App\Models\Tran;
use Illuminate\Http\Request;

class TranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trans = Tran::all();
        
        return view('tran' , compact('trans') );
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
        $tran = new Tran();
        $photo = $request->file('image');
        $filename = $photo->getClientOriginalName();
        $photo->move('images',$filename);
    
        $tran->name = $request->name;
        $tran->des = $request->des;
        
         $tran->image = $filename;
         $tran->save();
         return redirect()->route('tran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tran $tran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tran $tran)
    {
        return view('editres', compact('tran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tran $tran)
    {
        $tran->name = $request->name;
        $tran->des = $request->des;
    
        // إذا تم رفع صورة جديدة
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = $photo->getClientOriginalName();
            $photo->move('images', $filename);
            $tran->image = $filename;
        }
    
        $tran->save();
        return redirect()->route('tran.index');
    }
    
    
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $tran= Tran::findOrFail($id);

        $tran->delete();
        
        return redirect()->route('tran.index');
    }
}
