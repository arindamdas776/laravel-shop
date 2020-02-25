<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $guarded =[];

   public function products(){
   	return $this->belongsToMany('App\Product')->withTimeStamps();
   }
    public function children(){
    	return $this->belongsToMany('App\Category','category_parant','cat_id','parant_id');
    }
    public function user(){
    	return $this->belongsToMany('App\User');
    }
}
