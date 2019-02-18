<?php

namespace App\Http\Middleware;

use Closure;
use App\User_route;
use App\Route;
use Gate;
use Log;

class SaveRouteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $route)
    {
        if(Gate::denies('admin-role')){
            $route_field = "";
            switch ($route) {
                case 'buscar_productos':
                    $route_field = 'Buscador de Productos';
                    break;
                case 'lista_productos':
                    $route_field = 'Listado de Productos';
                    break;
                case 'importaciones':
                    $route_field = 'Analisis de Importaciones';
                    break;
                case 'proveedores':
                    $route_field = 'Empresas Comercializadoras';
                    break;
                case 'analisis_del_mercado':
                    $route_field = 'Analisis del Mercado';
                    break;
                case 'precios':
                    $parameters = $request->route()->parameters()['analisis_especifico'];

                    /******* $analisis_especifico **********/
                    /*  0 = promedio general
                        1 = precio minimo registrado
                        2 = precio maximo registrado
                        4 = mediana
                        5 = analisis comparativo PE/PE
                        6 = analisis comparativo PE/IA
                        7 = analisis cuartiles
                    */
                    if($parameters == 0 ) $route_field = 'Analisis de Precios - Promedio General';
                    if($parameters == 1 ) $route_field = 'Analisis de Precios - Precio Mínimo';
                    if($parameters == 2 ) $route_field = 'Analisis de Precios - Precio Máximo';
                    if($parameters == 4 ) $route_field = 'Analisis de Precios - Mediana';
                    if($parameters == 5 ) $route_field = 'Analisis de Precios - Análisis Comparativo PE/PE';
                    if($parameters == 6 ) $route_field = 'Analisis de Precios - Analisis Comparativo PE/PA';
                    if($parameters == 7 ) $route_field = 'Analisis de Precios - Análisis Cuartil';
                    break;
            }

            $route_id = Route::getRoute($route_field)->id;
            User_route::saveRoute($route_id);
        }

        return $next($request);
    }
}
