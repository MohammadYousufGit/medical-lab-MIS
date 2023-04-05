<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $dates = ['created_at,updated_at'];
	
	public function test(){
		$this->hasMany('App\test','department_id');
	}
}
