<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';

    public $timestamps = false;

    protected $fillable = ['nombre_categoria'];



    public static function getOrCreateCategoriaByName($nombre_categoria)
    {
        $query = self::select('id')->where('nombre_categoria', 'LIKE', $nombre_categoria);

        return $query->firstOrCreate(['nombre_categoria' => $nombre_categoria]);
    }
}
