<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Custom_note extends Model
{
    protected $fillable = [
	    'position', 'data_html', 
	];
}
