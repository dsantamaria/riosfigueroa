<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria_historic extends Model
{
    protected $table = 'categoria_historics';

    protected $fillable = ['nombre_categoria'];

    public function analysis_prices_product()
    {
        return $this->hasMany('App\Analysis_prices_product');
    }

    public static function getOrCreateCategoriaByName($nombre_categoria)
    {
        $query = self::select('id')->where('nombre_categoria', 'LIKE', $nombre_categoria);

        return $query->firstOrCreate(['nombre_categoria' => $nombre_categoria]);
    }

    public static function getCategoriasByName(array $nombre_categorias){
        $query = self::select('id', 'nombre_categoria')->whereIn('nombre_categoria', $nombre_categorias)->get();
    return $query;
    }
}
