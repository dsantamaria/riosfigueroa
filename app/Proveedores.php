<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $table = 'proveedores';

    public $timestamps = false;

    protected $fillable = ['nombre_proveedor'];



    public static function getOrCreateProveedorByName($nombre_proveedor)
    {
        $query = self::select('id')->where('nombre_proveedor', 'LIKE', $nombre_proveedor);

        return $query->firstOrCreate(['nombre_proveedor' => $nombre_proveedor]);
    }

}
