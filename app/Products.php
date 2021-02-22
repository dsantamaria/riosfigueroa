<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Log;

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

    public function marketForthFrameUsage(){
        return $this->hasMany('App\Market_fourth_frame_usage');
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

    public static function findByCategory($categoryId = null)
    {   
        
    }

    public static function getIngredients($producto_ingrediente, $tipo_analisis, $compania){
        $proveedor = $compania == "todas" ? '%' : $compania; 
        $fechas_productos = self::where('ingrediente_activo', '=', $producto_ingrediente)
                                ->where('proveedor_id', 'like', $proveedor)->get();

        $fechas_productos = $fechas_productos->map(function($item, $key){
                                $precio_por_medida = ltrim($item->precio_por_medida, '$');
                                $item->precio_por_medida = floatval(str_replace(',', "", $precio_por_medida));
                                return $item;
                            });

        return $fechas_productos->sortBy('precio_por_medida')->values()->all();
    }

    public static function getByLt(){
        $data = self::all();
    
        return $data;
    }
}