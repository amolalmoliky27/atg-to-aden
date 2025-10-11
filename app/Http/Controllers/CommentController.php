<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {if(!Auth::check()){
        return
        redirect()->back()->withErrors(['auth' => 'يجب تسجيل الدخول  اولا']);
    }
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
            'author' => 'nullable|string|max:100',
        ]);
        Comment::create([
            'post_id' => $request->post_id,
            'author'  => $request->author,
            'content' => $request->content,
            'rating' => $request->rating,
            'user_id'=>auth()->id(),
        ]);

        return redirect()->back()->with('success', '✅ تم إضافة تعليقك بنجاح!');
    }

}
