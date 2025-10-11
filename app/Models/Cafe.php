<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CafeImage;
class Cafe extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','image','type','linke'];
public function images()
{
    return
     $this->hasMany(CafeImage::class);
}
}
