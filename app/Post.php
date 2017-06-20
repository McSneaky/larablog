<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    use SoftDeletes;

    
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['deleted_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    /**
     * Get the user who wrote this post
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the comments that belong to this post
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
     * Get the images that belong to this post
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
