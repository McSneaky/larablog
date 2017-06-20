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


    /**
     * Get the posts made by this user
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get the comments made by this user
     */
    public function comments()
    {
        return $this->hasManyThrough('App\Comment', 'App\Post');
    }

    /**
     * Get the images uploaded by this user
     */
    public function images()
    {
        return $this->hasManyThrough('App\Image', 'App\Post');
    }

    /**
     * Get the role where user belongs to
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }


    /**
     * Check if user is admin
     * 
     * @return boolean
     */
    public function isAdmin()
    {
        $role = $this->role()->first();
        if ($role && $role->slug == 'admin') {
            return true;
        }
        return false;
    }

    /**
     * Check if user is moderator
     * 
     * @return boolean 
     */
    public function isModem()
    {
        $role = $this->role()->first();
        if ($role && $role->slug == 'modem') {
            return true;
        }
        return false;
    }

    /**
     * Check if is able to moderate posts
     *
     * @return boolean
     */
    public function canModerate()
    {
        // Check if user has role
        if (!$this->role()->first()) {
            return false;
        }

        // (Currently all roles are able to moderate posts, but it might change)

        // If user has role, check if hes admin or modem
        if ($this->isAdmin() || $this->isModem()) {
            return true;
        }

        return false;
    }

    /**
     * Generate greeting message for logged in user
     *  Currently only for admins and modems
     *  
     * @return string
     */
    public function greetingMessage()
    {
        // Check user role and give greeting message
        $message = null;
        $role = $this->role()->first();
        
        // if user has no role, then generate no message
        if (!$role) { return; }

        if ($this->isAdmin()) {
            $message = "admin";

        } else if ($this->isModem()){
            $message = "modem";
        }
        
        return $message;
    }
}
