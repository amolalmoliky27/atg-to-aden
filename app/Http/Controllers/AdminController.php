<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;

class AdminController extends Controller
{  

     
    public function index()
    { 
         $postsCount = Post::count();
        $usersCount = User::count();
        $commentsCount = Comment::count();
        $reactionsCount = DB::table('post_reactions')->count(); // جدول التفاعلات
        $mediaCount = Post::whereNull('image')
        ->orWhereNotNull('video_path')->count(); // الصور والفيديوهات

        $posts = Post::with('user')->withCount('comments')->latest()->take(10)->get();

        return view('admin.dashboard2', compact(
            'postsCount',
            'usersCount',
            'commentsCount',
            'reactionsCount',
            'mediaCount',
            'posts'
        ));

        if (!auth()->check()){
            return
            redirect()->route('login');}
            $user = auth()->user();
            if($user->is_admin !=1){ abort(403, 'غير مصرح لك بالدخول هنا');
            }
        
    

        $posts = Post::withCount('comments')->latest()->get();
        return view('admin.dashboard', compact('posts'));
    }

    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.dashboard2')->with('success', 'تم حذف المنشور بنجاح!');
    }
  

    public function manageComments()
{
    $comments = \App\Models\Comment::with(['user', 'post', 'parent'])
        ->latest()
        ->paginate(20);

    return view('admin.comments.index', compact('comments'));
}

    }
