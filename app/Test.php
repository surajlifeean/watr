<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function parameters(){

    	return $this->belongsToMany(Parameter::class);
    }
}
