<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Market_six_frame_usage extends Model
{
    protected $table = 'market_six_frame_usages';

    public $timestamps = true;

    protected $fillable = ['states', 'farms', 'sembradasHa', 'tratadasHA', 'spend', 'percentIncecticida', 'percentHerbicida', 'percentFungicida', 'percentOtros', 'user_id'];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function saveValues(string $states, string $farms, string $sembradasHa, string $tratadasHA, string $spend, int $percentIncecticida, string $percentHerbicida, string $percentFungicida, string $percentOtros, int $user_id)
    {
        return self::create([
            'states' => $states, 
            'farms' => $farms, 
            'sembradasHa' => $sembradasHa, 
            'tratadasHA' => $tratadasHA, 
            'spend' => $spend, 
            'percentIncecticida' => $percentIncecticida, 
            'percentHerbicida' => $percentHerbicida, 
            'percentFungicida' => $percentFungicida, 
            'percentOtros' => $percentOtros, 
            'user_id' => $user_id
        ]);
    }
}
