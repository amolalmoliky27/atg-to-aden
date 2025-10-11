<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Cafe;
use App\Models\FoodApp;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $cafes = Cafe::all();
        $apps = FoodApp::all();
        return view('restaurant' , compact('categories' , 'cafes' ,'apps'));
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
        $cate = new Category();
        $photo = $request->file('image');
        $filename = $photo->getClientOriginalName();
        $photo->move('images',$filename);
    
        $cate->name = $request->name;
        $cate->facebook = $request->facebook;
        $cate->type = $request->type;
         $cate->image = $filename;
         $cate->save();
         return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $places = $category->places;
        return view('showres' , compact('category', 'places'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        $category = Category::with('places')->findOrFail($id);
    return view('editres', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        
        

        $category->name = $request->name;
        $category->facebook = $request->facebook;
        $category->type = $request->type;
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $category->image = $filename;
        }
    
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'تم تحديث بيانات المطعم');
    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $cate = Category::findOrFail($id);

        $cate->delete();
        
        return redirect()->route('categories.index');
    }
}
