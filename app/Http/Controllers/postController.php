<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // ✅ عرض كل المنشورات مع البحث والتفاعل
    public function index(Request $request)
    {
        $query = Post::with(['comments', 'reactions']);

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest()->paginate(9);

        // ✅ جلب تفاعلات المستخدم على كل منشور
        $userReactions = [];
        if (auth()->check()) {
            foreach ($posts as $post) {
                $reaction = $post->reactions->where('user_id', auth()->id())->first();
                if ($reaction) {
                    $userReactions[$post->id] = $reaction;
                }
            }
        }

        return view('posts.index', compact('posts', 'userReactions'));
    }

    // ✅ عرض صفحة إنشاء منشور
    public function create()
    {
        return view('posts.create');
    }

    // ✅ حفظ منشور جديد مع صورة وفيديو
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'nullable|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
            'video'   => 'nullable|mimes:mp4,mov,avi|max:10000',
        ]);

        // تخزين الصورة إن وجدت
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // تخزين الفيديو إن وجد
        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }

        // إنشاء المنشور
        Post::create([
            'title'      => $request->title,
            'content'    => $request->content,
            'image'      => $imagePath,
            'video_path' => $videoPath,
            'user_id'    => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', '✅ تم نشر المشاركة بنجاح!');
    }

    // ✅ عرض منشور واحد مع التفاعل
    public function show($id)
    {
        $post = Post::with([
            'user',
            'images',
            'comments.user',
            'comments.replies.user',
            'reactions'
        ])->findOrFail($id);

        $userReaction = null;
        if (auth()->check()) {
            $userReaction = $post->reactions()->where('user_id', auth()->id())->first();
        }

        // ✅ حساب عدد التفاعلات والتعليقات
        $reactionsCount = $post->reactions()->count();
        $commentsCount = $post->comments()->whereNull('parent_id')->count();

        return view('posts.show', compact('post', 'userReaction', 'reactionsCount', 'commentsCount'));
    }

    // ✅ عرض صفحة تعديل المنشور للمشرف أو صاحب المنشور
    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'غير مصرح لك بالدخول');
        }

        return view('posts.edit', compact('post'));
    }

    // ✅ تحديث المنشور للمشرف أو صاحب المنشور
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'غير مصرح لك بالتحديث');
        }

        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        // حذف الصورة القديمة إن وُجدت
        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path('storage/' . $post->image))) {
                unlink(public_path('storage/' . $post->image));
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->title   = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('posts.show', $post)->with('success', 'تم تعديل المنشور بنجاح');
    }

    // ✅ حذف منشور (للمشرف أو صاحب المنشور)
    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->user_id && !auth()->user()->is_admin) {
            abort(403, 'غير مصرح لك بحذف هذا المنشور');
        }

        if ($post->image && file_exists(public_path('storage/' . $post->image))) {
            unlink(public_path('storage/' . $post->image));
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'تم حذف المنشور بنجاح');
    }

    // ✅ تعديل المنشور للمستخدم العادي (جديد)
    public function userEdit(Post $post)
    {
     if ($post->user_id !== auth()->id() && ! auth()->user()->is_admin) {
            abort(403, 'غير مصرح لك بتعديل هذا المنشور.');
        }

        return view('posts.edit', compact('post'));
    }

    // ✅ حفظ تعديل المنشور للمستخدم العادي (جديد)
    public function userUpdate(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id() && ! auth()->user()->is_admin) {
            abort(403, 'غير مصرح لك بتحديث هذا المنشور.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path('storage/' . $post->image))) {
                unlink(public_path('storage/' . $post->image));
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
        }

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        return redirect()->route('posts.show', $post)->with('success', 'تم تعديل المنشور بنجاح!');
    }
}