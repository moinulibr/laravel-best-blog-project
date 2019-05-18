<?php

namespace App\Model\Comment;

use Illuminate\Database\Eloquent\Model;
use App\Model\Post\Post;
use App\User;

class Comment extends Model
{
    protected $fillable= [
        'user_id','post_id','status'
    ];

    public function post(){
        return $this->belongsTo(Post::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

}
