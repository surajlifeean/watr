<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
        public function parameters(){

    	return $this->belongsToMany(Parameter::class)->withPivot('cost');
    }

        public function orders(){

    	return $this->belongsToMany(Order::class);
    }
}
