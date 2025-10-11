<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Models\Category;
class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('createres' , compact('categories'));
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

        $pl = new Place();
        
        $pl->name = $request->name;
        $pl->category_id = $request->category_id;
         $pl->images = json_encode($imagepath);
         $pl->save();
         return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    
        $place = Place::findOrFail($id);

        // التأكد من وجود name و category_id لتجنب الخطأ
        $place->name = $request->input('name') ?? $place->name;
        $place->category_id = $request->input('category_id') ?? $place->category_id;
    
        // جلب الصور القديمة
        $existingImages = json_decode($place->images, true) ?? [];
    
        // رفع الصور الجديدة (إن وُجدت)
        if ($request->hasFile('images')) {
            $uploadedImages = [];
            foreach ($request->file('images') as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('images'), $imageName);
                $uploadedImages[] = $imageName;
            }
    
            // دمج الصور القديمة مع الجديدة
            $allImages = array_merge($existingImages, $uploadedImages);
            $place->images = json_encode($allImages);
        }
    
        $place->save();
    
        return redirect()->route('categories.index')->with('success', 'تم تحديث بيانات المطعم');
    
    
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pl = Place::findOrFail($id);

    
        $pl->delete();
        
        return redirect()->route('categories.index');
    }

}
