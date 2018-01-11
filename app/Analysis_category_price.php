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

    public static function getDatesAndProducts($producto_ingrediente, $tipo_analisis, $compania){
    	$producto_ingrediente_analisis = $tipo_analisis == "producto" ? 'nombre_producto' : 'ingrediente_activo';
    	$proveedor = $compania == "todas" ? '%' : $compania; 

    	$fechas_productos = self::with(['analysis_prices_products' => function($query) use ($producto_ingrediente, $producto_ingrediente_analisis, $proveedor){
    		$query->where($producto_ingrediente_analisis, '=', $producto_ingrediente)
		    	  ->where('proveedor_id', 'like', $proveedor);
    	}])->orderBy('date_list', 'desc')->get();

    	return $fechas_productos;
    }
}
