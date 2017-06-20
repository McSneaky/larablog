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


    // Define relations
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get all of the posts for the country.
     */
    public function comments()
    {
        return $this->hasManyThrough('App\Comment', 'App\Post');
    }

    /**
     * Get all of the posts for the country.
     */
    public function images()
    {
        return $this->hasManyThrough('App\Image', 'App\Post');
    }


    public function role()
    {
        return $this->belongsTo('App\Role')->first();
    }

    public function canModerate()
    {
        if (!$this->role()) { return false; }

        $slug = $this->role()->slug;
        if ($slug == 'admin' || $slug == 'modem') {
            return true;
        }
        
        return false;
    }


    public function greetingMessage()
    {
        // Check user role and give greeting message
        $message = null;
        $role = $this->role();
        
        if (!$role) { return; }

        if ($role->slug == 'admin') {
            $message = "admin";
        } else if ($role->slug == 'modem'){
            $message = "modem";
        }
        return $message;
    }
}
