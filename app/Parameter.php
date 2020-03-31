<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    public function tests(){

    	return $this->belongsToMany(Test::class);
    }
}
