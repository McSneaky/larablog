<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
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
     * Get the user who wrote this comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the post that owns this comment.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
