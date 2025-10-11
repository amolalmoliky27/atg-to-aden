<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class APINewsController extends Controller
{
    // جلب  الأخبار
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5); // عدد الأخبار لكل صفحة
        $page = $request->input('page', 1);       // رقم الصفحة المطلوبة
        $category = $request->input('category', 'all'); // الفئة المطلوبة

        $query = News::orderBy('created_at', 'desc');

        // التصفية حسب الفئة إذا لم تكن "all"
        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $news = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json($news);
    }



    // جلب خبر واحد
    public function show($id)
    {
        return response()->json(News::findOrFail($id));
    }

    // إضافة خبر جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:سياحة,فعاليات,ثقافة,تراث,تطوير',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'location' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news_images', 'public');
        }

        $news = News::create($data);

        return response()->json($news, 201);
    }

    // تحديث خبر
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:سياحة,فعاليات,ثقافة,تراث,تطوير',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'location' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'delete_image' => 'nullable|boolean',
        ]);

        // حذف الصورة إذا طلب المستخدم
        if (!empty($data['delete_image']) && $news->image) {
            Storage::disk('public')->delete($news->image);
            $data['image'] = null;
        }

        // تحديث الصورة
        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news_images', 'public');
        }

        $news->update($data);

        return response()->json($news);
    }

    // حذف خبر
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
