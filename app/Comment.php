<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Comment;

class Comment extends Model
{
    protected $fillable = ['name', 'comment'];

    public function post()
    {
    	return $this->belongsTo(Comment::class);
    }
}
