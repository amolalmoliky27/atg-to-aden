<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    
 protected $fillable = ['user_id', 'post_id', 'type'];
  public function user() { 
    return $this->belongsTo(User::class); }
     public function post() { 
        return $this->belongsTo(Post::class); } 
public function label() { $labels = 
    [ 'like' => '👍 أعجبني', 'love' => '❤️ أحببته', 'angry' => '😡 أغضبني',
     'haha' => '😂 أضحكني', 'sad' => '😢 أحزنني', ]; return $labels[$this->type] ?? '👍 أعجبني'; }

    use HasFactory;
}
