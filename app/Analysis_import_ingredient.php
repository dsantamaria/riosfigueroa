<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis_import_ingredient extends Model
{
    protected $fillable = ['ingrediente_activo', 'categoria_id'];

	public function analysis_import_list()
    {
        return $this->hasMany('App\Analysis_import_list');
    }
}
