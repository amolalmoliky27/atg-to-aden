<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminNewsController extends Controller
{
    /**
     * عرض لوحة التحكم
     */
    public function dashboard()
    {
        return view('admin2.news-dash');
    }

    /**
     * جلب بيانات الأخبار كـ JSON
     */
    public function getNewsData()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return response()->json($news);
    }

    /**
     * تخزين خبر جديد
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:سياحة,فعاليات,ثقافة,تراث,تطوير',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'location' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        $news = News::create([
            'title'    => $request->input('title'),
            'content'  => $request->input('content'),
            'category' => $request->input('category'),
            'image'    => $imagePath,
            'location' => $request->input('location'),
            'author'   => $request->input('author'),
        ]);

        return response()->json($news, 201);
    }

    /**
     * عرض نموذج تعديل خبر
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return response()->json($news);
    }

    /**
     * تحديث خبر
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:سياحة,فعاليات,ثقافة,تراث,تطوير',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'location' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $news = News::findOrFail($id);

        $imagePath = $news->image;

        // معالجة حذف الصورة
        if ($request->has('delete_image') && $request->delete_image) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = null;
        }

        // معالجة تحديث الصورة
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        $news->update([
            'title'    => $request->input('title'),
            'content'  => $request->input('content'),
            'category' => $request->input('category'),
            'image'    => $imagePath,
            'location' => $request->input('location'),
            'author'   => $request->input('author'),
        ]);

        return response()->json($news);
    }

    /**
     * حذف خبر
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return response()->json(null, 204);
    }
}
