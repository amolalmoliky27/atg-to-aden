<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostImage;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image',
        'video_path',
        'user_id',
        'user_name',
     
    ];

    // 🧑‍💻 علاقة مع المستخدم (صاحب المنشور)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 💬 علاقة التعليقات
    public function comments()
    {
        return $this->hasMany(Comment::class)
        ->whereNull('parent_id')
        ->orderBy('created_at','desc'); 
        
    }

    // 💥 علاقة الردود داخل التعليقات (إن احتجتها)
    public function allComments()
    {
        return $this->hasMany(Comment::class); // تشمل الردود والتعليقات الأصلية
    }

    // 👍 علاقة التفاعلات
    public function reactions()
    {
        return $this->hasMany(PostReaction::class);
    }

    // 📷 لو عندك مرفقات صور متعددة (اختياري)
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    // ✅ هل أعجب المستخدم الحالي بالمنشور؟ (اختياري لاستخدامه في الواجهة)
    public function userReaction()
    {
        return $this->hasOne(PostReaction::class)->where('user_id', auth()->id());
    }
}