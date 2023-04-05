<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pacienttestresult extends Model
{
    protected $dates = ['created_at,updated_at'];
	
	public function pacienttest(){
		return $this->belongsTo('App\pacienttest');
	}

	public function paramter(){
		return $this->belongsTo('App\testparameter','parameter_id')	;
	}

	public function user(){
		return $this->belongsTo('App\user');
	}
}
