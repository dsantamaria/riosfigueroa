<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analysis_prices_product extends Model
{
    protected $fillable = ['nombre_producto', 'tipo_producto','ingrediente_activo', 'formulacion', 'concentracion', 'presentacion', 'unidad', 'empaque', 'precio_comercial', 'precio_por_medida', 'ultima_actualizacion', 'categoria_id',
        'proveedor_id', 'analysis_category_price_id', 'impuesto'];

	public function analysis_category_price()
    {
        return $this->belongsTo('App\Analysis_category_price', 'analysis_category_price_id');
    }

    public function proveedores_historic()
    {
        return $this->belongsTo('App\Proveedores_historic', 'proveedor_id');
    }

    public function categoria_historic()
    {
        return $this->belongsTo('App\Categoria_historic', 'categoria_id');
    }
}
