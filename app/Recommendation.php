<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    public function parameters(){

    	return $this->belongsToMany(Parameter::class);
    }
    
}
