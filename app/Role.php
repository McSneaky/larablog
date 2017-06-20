<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        // 'slug',
    ];

    
    public function users()
    {
    	$this->hasMany('App\User');
    }
}
