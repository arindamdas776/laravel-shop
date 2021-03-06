<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guard = [];

    public function user(){
    	return $this->hasMany('App\User');
    }
}
