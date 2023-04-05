<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
    protected $dates = ['created_at,updated_at'];
	
	public function pacient(){
		$this->hasMany('App\pacient','doctor_id');
	}
}
