<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;

class Market_fourth_frame_usage extends Model
{
    protected $table = 'market_fourth_frame_usages';

    public $timestamps = true;

    protected $fillable = ['farm', 'states', 'problem', 'sembradasHa', 'tratadasHa', 'product_id', 'priceDis', 'dosisHa', 'priceHa', 'cicloApp', 'priceApp', 'priceMarketPot', 'marketPotencialApp', 'probablyApp', 'marketProbably', 'objective', 'msHa', 'msWish', 'lt', 'user_id'];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public static function saveValues(string $farm, string $states, string $problem, string $sembradasHa, string $tratadasHa, int $product_id, string $priceDis, string $dosisHa, string $priceHa, string $cicloApp, string $priceApp, string $priceMarketPot, string $marketPotencialApp, string $probablyApp, string $marketProbably, string $objective, string $msHa, string $msWish, string $lt, int $user_id)
    {
        return self::create([
            'farm' => $farm, 
            'states' => $states, 
            'problem' => $problem, 
            'sembradasHa' => $sembradasHa, 
            'tratadasHa' => $tratadasHa, 
            'product_id' => $product_id, 
            'priceDis' => $priceDis, 
            'dosisHa' => $dosisHa, 
            'priceHa' => $priceHa, 
            'cicloApp' => $cicloApp, 
            'priceApp' => $priceApp, 
            'priceMarketPot' => $priceMarketPot, 
            'marketPotencialApp' => $marketPotencialApp, 
            'probablyApp' => $probablyApp, 
            'marketProbably' => $marketProbably, 
            'objective' => $objective, 
            'msHa' => $msHa, 
            'msWish' => $msWish, 
            'lt' => $lt,  
            'user_id' => $user_id
        ]);
    }
}
