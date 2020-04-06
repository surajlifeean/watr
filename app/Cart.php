<?php

namespace App;
// use App\Test;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
        public function tests(){

    	return $this->belongsToMany(Test::class);
    }
}
