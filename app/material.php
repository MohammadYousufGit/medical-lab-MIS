<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    protected $dates = ['created_at,updated_at'];
	
	public function branch(){
		return $this->belongsTo('App\branch');
	}
	
	public function test(){
		return $this->belongsTo('App\test');
	}
}
