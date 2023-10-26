<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class User extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['login', 'password'];
    function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
