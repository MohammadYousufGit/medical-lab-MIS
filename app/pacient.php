<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pacient extends Model
{
    protected $dates = ['created_at,updated_at'];
	
	public function branch(){
		return $this->belongsTo('App\branch');
	}

	public function doctor(){
		return $this->belongsTo('App\doctor');
	}

	public function tests(){
		return $this->belongsToMany('App\test');
	}
	public function pacienttest(){
	   return $this->hasMany('App\pacient_test');
	}


}
