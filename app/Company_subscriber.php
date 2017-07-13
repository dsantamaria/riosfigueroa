<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_subscriber extends Model
{
    protected $fillable = [
        'company_name', 'email', 
    ];

    public static function save_company_subscriber($data){
    	$flight = self::create([
    		'company_name' => $data['company_name'],
    		'email' => $data['email'],
    	]);
    }
}
