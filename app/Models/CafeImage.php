<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CafeImage extends Model
{
    use HasFactory;
    protected $fillable = ['cafe_id','image'];
    public function cafe(){
        return
        $this->belongsTo(cafe::class);
    }
}
