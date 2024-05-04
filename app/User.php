<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password','bio','images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followings()
    {
        return $this->hasMany(Follow::class, 'followed_id', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function followingsCount()
    {
        return Follow::where('following_id', $this->id)
                    ->distinct('followed_id')
                    ->count('followed_id');
    }

    public function followersCount()
    {
        return Follow::where('followed_id', $this->id)
                    ->distinct('following_id')
                    ->count('following_id');
    }
}
