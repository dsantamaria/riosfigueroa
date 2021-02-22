<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market_first_frame_usage extends Model
{
    protected $table = 'market_first_frame_usages';

    public $timestamps = true;

    protected $fillable = ['farm', 'state', 'user_id'];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function saveValues(string $farm, string $state, int $user_id)
    {
        return self::create(['farm' => $farm, 'state' => $state, 'user_id' => $user_id]);
    }
}
