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
        return $this->belongsTo('App\Role');
    }


    public function isAdmin()
    {
        $role = $this->role()->first();
        if ($role && $role->slug == 'admin') {
            return true;
        }

        return false;
    }

    public function isModem()
    {
        $role = $this->role()->first();
        if ($role && $this->role()->first()->slug == 'modem') {
            return true;
        }

        return false;
    }

    public function canModerate()
    {
        // No point 2 queries
        if (!$this->role()->first()) {
            return false;
        }

        if ($this->isAdmin() || $this->isModem()) {
            return true;
        }

        return false;
    }

    public function greetingMessage()
    {
        // Check user role and give greeting message
        $message = null;
        $role = $this->role()->first();
        
        if (!$role) { return; }

        if ($this->isAdmin()) {
            $message = "admin";

        } else if ($this->isModem()){
            $message = "modem";
        }
        return $message;
    }
}
