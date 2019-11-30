<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Comment;
use app\User;

class Comment extends Model
{
    protected $fillable = ['name', 'user_id', 'comment'];

    public function post()
    {
    	return $this->belongsTo(Post::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
