<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Model\Role\Role;
use App\Model\Post\Post;
use App\Model\Comment\Comment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','name','username','mobile', 'email', 'password','image','about','verified','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return  $this->belongsTo(Role::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function favorite_posts(){
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);  //[hasMany]
    }

    public function scopeAuthors($query)
    {
        return $query->where('role_id', 2);
    }
}
