<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
      return $this->hasMany(Post::class, 'author_id');
    }

    public function getRouteKeyName()
    {
      return 'slug';
    }

    public function getBioHtmlAttribute($value)
    {
      return $this->bio ? @markdown(e($this->bio)) : NULL;
    }

    public function gravatar()
    {
      $email = $this->email;
      $default = "https://upload.wikimedia.org/wikipedia/commons/f/f4/User_Avatar_2.png";
      $size = 100;

      return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    }
}
