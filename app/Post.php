<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;

class Post extends Model
{
    protected $fillable = ['name', 'post'];

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
}
