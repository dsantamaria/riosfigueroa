<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis_import_list extends Model
{
    protected $fillable = ['analysis_import_ingredient_id', 'year', 'trimestre', 'price', 'amount', 'unit'];

	public function analysis_import_ingredient()
    {
        return $this->belongsTo('App\Analysis_import_ingredient', 'analysis_import_ingredient_id');
    }
}
