<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis_category_price extends Model
{
    protected $fillable = ['date_list'];

	public function analysis_prices_products()
    {
        return $this->hasMany('App\Analysis_prices_product');
    }
}
