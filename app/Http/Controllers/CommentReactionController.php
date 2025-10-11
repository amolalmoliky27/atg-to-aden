<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentReaction;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentReactionController extends Controller
{
    public function store(Request $request, $commentId)
{
    $request->validate([
        'type' => 'required|string|in:like,love,angry,haha,sad',
    ]);

    $userId = auth()->id();

    // احذف التفاعل السابق إن وُجد
    CommentReaction::where('comment_id', $commentId)->where('user_id', $userId)->delete();

    // إذا كان نوع التفاعل جديدًا، خزّنه
    if ($request->type !== 'null') {
        $newReaction = CommentReaction::create([
            'comment_id' => $commentId,
            'user_id' => $userId,
            'type' => $request->type,
        ]);

        return response()->json([
            'status' => 'success',
            'reaction' => $newReaction,
        ]);
    }

    // في حال حذف التفاعل فقط (بدون إنشاء جديد)
    return response()->json([
        'status' => 'success',
        'reaction' => null,
    ]);
}
}