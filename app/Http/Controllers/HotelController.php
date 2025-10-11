<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = Hotel::all();
        
        return view('hotel' , compact('hotels') );
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
        
        $hotel = new Hotel();
        $photo = $request->file('image');
        $filename = $photo->getClientOriginalName();
        $photo->move('images',$filename);
    
        $hotel->name = $request->name;
        $hotel->des = $request->des;
         $hotel->image = $filename;
         $hotel->link = $request->link;
         $hotel->stars = $request->stars;
         $hotel->images = json_encode($imagepath);
         $hotel->save();
         return redirect()->route('hotel.index')->with('donnnee');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('editres', compact('hotel'));
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $hotel->name = $request->name;
        $hotel->des = $request->des;
        $hotel->loc = $request->loc;
        $hotel->stars = $request->stars;
    
        // تحديث الصورة الرئيسية إن وُجدت
        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('images'), $filename);
            $hotel->image = $filename;
        }
    
        // تحديث الصور الإضافية إن وُجدت
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $filename);
                $imagePaths[] = $filename;
            }
            $hotel->images = json_encode($imagePaths);
        }
    
        $hotel->save();
    
        return redirect()->route('hotel.index')->with('success', 'تم التحديث بنجاح');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $hotel = Hotel::findOrFail($id);

        $hotel->delete();
        
        return redirect()->route('hotels.index');
    }
}
