<?php

namespace App\Model\Role;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'verified','status',
    ];

        public function users()
        {
            return $this->hasMany(User::class);
        }
}
