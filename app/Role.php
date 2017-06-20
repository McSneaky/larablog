<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * Get users who belong to this role
     */
    public function users()
    {
    	$this->hasMany('App\User');
    }
}
