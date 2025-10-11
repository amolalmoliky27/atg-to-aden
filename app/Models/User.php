<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'is_admin'
    ];

    public function getIsAdminAttribute($value)
    {
        return (bool) $value;
    }

    public function is_Admin()
    {
        return $this->is_admin == 1;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
     public function PostReactio()
    {
        return $this->hasMany(PostReaction::class);
    }
    

     public function favorites()
    {
    return $this->hasMany(Favorite::class);
    }

}
