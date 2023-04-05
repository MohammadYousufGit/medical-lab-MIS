<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pacient_test extends Model
{
    protected $table = 'pacient_test';
    protected $dates = ['created_at,updated_at'];


    public function pacient(){
        return $this->belongsTo('App\pacient');
    }
public function test(){
		return $this->belongsTo('App\test');
	}

    public function pacienttestresult()
    {
        return $this->hasMany('App\pacienttestresult', 'pacienttest_id');
    }
}
