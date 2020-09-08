<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    
    public function recommendations(){

    	return $this->belongsToMany(Recommendation::class);
    }

}
