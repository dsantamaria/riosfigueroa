<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = ['nombre_producto', 'ingrediente_activo', 'formulacion', 'concentracion', 'presentacion',
        'unidad', 'empaque', 'precio_comercial', 'precio_por_medida', 'ultima_actualizacion', 'categoria_id',
        'proveedor_id'];

    public function proveedores()
    {
        return $this->belongsTo('App\Proveedores', 'proveedor_id');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id');
    }
}
