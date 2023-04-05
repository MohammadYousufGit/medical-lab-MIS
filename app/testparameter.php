<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class testparameter extends Model
{
    protected $dates = ['created_at,updated_at'];
	
	public function pacienttestresult(){
		return $this->hasOne('App\pacienttestresult','parameter_id');
	}

	public function test(){
		return $this->belongsTo('App\test');
	}
	
}
