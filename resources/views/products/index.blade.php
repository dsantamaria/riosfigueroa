@extends('layouts.app')
@section('content')
    <div class="col-md-12">

        <h2 class="page-title">Listado de Productos</h2>

        <div class="panel panel-primary">
            <div class="panel-heading">Listado de Productos</div>
            <div class="panel-body">
                <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="zctb" class="display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Compañia</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Nombre Producto</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Presentacion</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Ingrediente(s) Activo(s)</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Concentración</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Unidad de Medida</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Precio por Unidad*</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Precio*/K o L</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">IEPS</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Ultima actualización</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @if($products)
                                        @foreach($products as $product)
                                            <tr role="row" id="{{$product->id}}" class="more-info-product">
                                                <td class="cursor">{{$product->proveedores->nombre_proveedor}}</td>
                                                <td>{{$product->nombre_producto}}</td>
                                                <td>{{$product->presentacion}}</td>
                                                <td>{{$product->ingrediente_activo}}</td>
                                                <td>{{$product->concentracion}}</td>
                                                <td>{{$product->unidad}}</td>
                                                <td>{{$product->precio_comercial}}</td>
                                                <td>{{$product->precio_por_medida}}</td>
                                                <td>{{$product->impuesto}}</td>
                                                <td>{{ date('d-m-Y', strtotime($product->ultima_actualizacion)) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.modal')
@stop