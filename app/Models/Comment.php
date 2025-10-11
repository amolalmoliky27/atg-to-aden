<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'parent_id',
        'content',
        'is_active',
    ];

    /**
     * علاقة التعليق بمنشور.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * علاقة التعليق بمستخدم.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة التعليق بتفاعل المستخدمين.
     */
    public function reactions(): HasMany
    {
        return $this->hasMany(CommentReaction::class);
    }

    /**
     * الردود على هذا التعليق.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * التفاعل الخاص بالمستخدم الحالي (يتم إضافته يدويًا في الكود).
     */
    public function getUserReactionAttribute()
    {
        if (auth()->check()) {
            return $this->reactions->where('user_id', auth()->id())->first();
        }
        return null;
    }
     public function parent(){
        return
        $this->belongsTo(User::class , 'parent_id');
     }
}