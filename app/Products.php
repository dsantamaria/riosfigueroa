<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    protected $table = 'products';

    public $timestamps = true;

    protected $fillable = ['nombre_producto', 'tipo_producto','ingrediente_activo', 'formulacion', 'concentracion', 'presentacion', 'unidad', 'empaque', 'precio_comercial', 'precio_por_medida', 'ultima_actualizacion', 'categoria_id',
        'proveedor_id', 'impuesto'];

    public function proveedores()
    {
        return $this->belongsTo('App\Proveedores', 'proveedor_id');
    }

    public function categorias()
    {
        return $this->belongsTo('App\Categorias', 'categoria_id');
    }

    public static function searchByFields($search_data = array())
    {
        $products = null;
        $query = self::select('*');

        if (!empty($search_data))
        {
            foreach ($search_data as $field => $value)
            {
                if($field == 'proveedor_id')
                {
                    $query->whereIn('proveedor_id', $value);
                }
                elseif($field == 'categoria_id' && $value == 'otros'){
                    $query->whereNotIn('categoria_id', [2,3,7]);
                }
                elseif ($field == 'ingrediente_activo') {
                    $query->where($field, 'LIKE', '%' . $value . '%')->orderBy('ingrediente_activo', 'asc');
                }
                else{
                    $query->where($field, 'LIKE', '%' . $value . '%');
                }
                    
            }
            
            $products = $query->get();
                
        }

        return $products;

    }

    public static function getIndividualInfo($id)
    {
        $product = self::where('id', $id)->with('categorias')->get();
        return $product;
    }

    public static function getProductsProveedor($id){
        $products = self::where('proveedor_id', $id)->with('categorias', 'proveedores')->get();
        return $products;
    } 

    public static function findByCategory($category = null)
    {
        
    }
}