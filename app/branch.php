<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
	protected $dates = ['created_at,updated_at'];
	
	public function users(){
		return $this->hasMany('App\user','branch_id');
	}

	public function material(){
		return $this->hasMany('App\material','branch_id');
	}

	public function pacient(){
		return $this->hasMany('App\pacient','branch_id');
	}

}
