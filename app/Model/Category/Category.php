<?php

namespace App\Model\Category;

use Illuminate\Database\Eloquent\Model;
use App\Model\Post\Post;

class Category extends Model
{
    protected $fillable = [
        'name', 'description','photo','slug','verified','status',
    ];

    public function posts(){
        return $this->belongsToMany(Post::class)->withTimestamps();           //[belognsToMany]
    }
}
