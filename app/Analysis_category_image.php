<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis_category_image extends Model
{

    public function categorias()
    {
        return $this->belongsTo('App\Categorias', 'categoria_id');
    }
}
