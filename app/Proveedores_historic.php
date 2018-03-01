<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores_historic extends Model
{
    protected $table = 'proveedores_historics';

    protected $fillable = ['nombre_proveedor'];


    public function analysis_prices_product()
    {
        return $this->hasMany('App\Analysis_prices_product');
    }

    public static function getOrCreateProveedorByName($nombre_proveedor)
    {
        $query = self::select('id')->where('nombre_proveedor', 'LIKE', $nombre_proveedor);

        return $query->firstOrCreate(['nombre_proveedor' => $nombre_proveedor]);
    }

    public static function getProveedorArrayByName($nombre_proveedor)
    {
        return self::select('id')->where('nombre_proveedor', 'LIKE', '%'.$nombre_proveedor.'%')->pluck('id')->toArray();
    }
}
