<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodApp;

class FoodAppController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'link' => 'required|url',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // حفظ الصورة
    $imageName = time() . '.' . $request->image->extension();
    $request->image->move(public_path('images'), $imageName);

    // إنشاء سجل جديد
    FoodApp::create([
        'image' => $imageName,
        'link' => $request->link,
        'rating' => $request->rating,
    ]);

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('categories.index')->with('success', 'تمت إضافة التطبيق بنجاح');
}
}
