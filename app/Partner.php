<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
        public function tests(){

    	return $this->belongsToMany(Test::class);
    }
}
