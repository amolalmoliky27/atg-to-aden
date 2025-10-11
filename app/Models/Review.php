<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Review extends Model
{
    protected $fillable = ['name', 'rating', 'comment', 'sentiment'];

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    // دالة لتحويل التقييم إلى نجوم
    public function stars()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<i class="fas fa-star"></i>';
            } else {
                $stars .= '<i class="far fa-star"></i>';
            }
        }
        return $stars;
    }
}
