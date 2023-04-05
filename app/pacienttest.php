<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pacienttest extends Model
{
   protected $dates = ['created_at,updated_at'];
   public $table = "pacienttests";
	
    public function pacient(){
            return $this->belongsTo('App\pacient');
        }

	public function test(){
		return $this->belongsTo('App\test');
	}

	public function pacienttestresult(){
		return $this->hasMany('App\pacienttestresult','pacienttest_id');
	}



}
