<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    public function tests(){

    	return $this->belongsToMany(Test::class);
    }

       public function partners(){

    	return $this->belongsToMany(Partner::class);
    }

           public function recommendations(){

    	return $this->belongsToMany(Recommendation::class)->withPivot('outcome');
    }


}
