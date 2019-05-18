<?php

namespace App\Model\Tag;

use Illuminate\Database\Eloquent\Model;
use App\Model\Post\Post;

class Tag extends Model
{
    protected $fillable = [
        'name', 'description','slug','verified','status',
    ];

    public function posts(){
        return $this->belongsToMany(Post::class)->withTimestamps();           //[belognsToMany]
    }
}
