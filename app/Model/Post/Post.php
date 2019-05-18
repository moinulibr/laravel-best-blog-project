<?php

namespace App\Model\Post;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Category\Category;
use App\Model\Tag\Tag;
use App\Model\Comment\Comment;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title','slug','photo','body','view_count','is_approved','status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class)->withTimestamps();      //[belognsToMany]
    }
    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();           //[belognsToMany]
    }


    public function favorite_to_users(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);  //[hasMasny]
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopePublish($query)
    {
        return $query->where('is_approved', 1);
    }

}
