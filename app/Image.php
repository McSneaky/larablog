<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
        
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['deleted_at'];


    public function post()
    {
    	return $this->belongsTo('App\Post');
    }
}
