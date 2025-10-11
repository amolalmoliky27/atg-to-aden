<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentReaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment_id',
        'type',
    ];

    /**
     * علاقة التفاعل بمستخدم.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * علاقة التفاعل بالتعليق.
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * إرجاع نص مناسب للتفاعل (للاستخدام في الواجهة).
     */
    public function label(): string
    {
        return match ($this->type) {
            'like' => '👍 أعجبني',
            'love' => '❤️ أحببته',
            'angry' => '😡 أغضبني',
            'haha' => '😂 أضحكني',
            'sad'  => '😢 أحزنني',
            default => '👍 أعجبني',
        };
    }
}