<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    protected $dates = ['created_at,updated_at'];
	
	public function pacients(){
		return $this->belongsToMany('App\pacient');
	}
	
	public function material(){
		$this->hasMany('App\material','test_id');
	}

	public function testparameter(){
		return $this->hasMany('App\testparameter','test_id');
	}

	public function department(){
		return $this->belongsTo('App\department');
	}
	public function pacienttest(){
        return $this->hasMany('App\pacient_test');
	}

	
}
