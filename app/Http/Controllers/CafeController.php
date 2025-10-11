<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use App\Models\Category;
class CafeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    $cafes = Cafe::where('type', 'independent')->get();  // الكافيهات المستقلة فقط
    $mallCafes = Cafe::where('type', 'mall')->get();     // كافيهات المولات
    $categories = Category::all();

    return view('cafe', compact('cafes', 'mallCafes', 'categories'));
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
    $request->validate([
        'name' => 'required',
        'des' => 'nullable',
        'type' => 'required|in:independent,mall',
        'image' => 'required|image',
        'gallery.*' => 'nullable|image',
        'link' => 'nullable|url',
    ]);

    $cafe = new Cafe();
    $photo = $request->file('image');
    $filename = time() . '_' . $photo->getClientOriginalName();
    $photo->move(public_path('images'), $filename);

    $cafe->name = $request->name;
    $cafe->des = $request->des;
    $cafe->image = $filename;
    $cafe->type = $request->type;
    $cafe->link = $request->link;
    $cafe->save();

    // رفع صور المعرض
 if ($request->hasFile('gallery')) {
    foreach ($request->file('gallery') as $galleryImage) {
        $originalName = $galleryImage->getClientOriginalName();
        $galleryName = time() . '_' . $originalName;

        // منع رفع صورة بنفس الاسم مرتين
        if (!$cafe->images()->where('image', $galleryName)->exists()) {
            $galleryImage->move(public_path('images/cafes'), $galleryName);
            $cafe->images()->create(['image' => $galleryName]);
        }
    }
}
    return redirect()->route('cafe.index')->with('success', 'تم إضافة الكافيه بنجاح');
}
    /**
     * Display the specified resource.
     */
    public function show(Cafe $cafe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cafe = Cafe::findOrFail($id);
    return view('editres', compact('cafe'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cafe $cafe)
    {
    

        $cafe->name = $request->name;
        $cafe->des = $request->des;
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $cafe->image = $filename;
        }
    
        $cafe->save();
    
        return redirect()->route('cafe.index')->with('success', 'تم تحديث بيانات الكافيه');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cafe = Cafe::findOrFail($id);

        $cafe->delete();
        
        return redirect()->route('cafe.index');
    }
}
