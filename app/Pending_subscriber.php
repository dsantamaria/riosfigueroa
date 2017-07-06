<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pending_subscriber extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
