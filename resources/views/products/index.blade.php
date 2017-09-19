@extends('layouts.app')
@section('content')
    <div class="col-md-12">

        <h2 class="page-title">Listado de Productos</h2>

        <div id="messages" class="col-xs-12" style="display: none"></div>

        <div class="panel panel-primary">
            <div class="panel-heading" id="list-products">
                <div class="list-products-left">Listado de Productos</div> 
                @can('admin-role')
                    <div class="btn btn-warning btn-sm edit-products">Editar Tabla</div>
                    <div class="btn btn-success btn-sm hidden save-products">Salvar</div>
                    <div class="btn btn-danger btn-sm hidden cancel-products list-products-cancel">Cancelar</div>
                @endcan
            </div>
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
                                                <td class="edit-cell name-product">{{$product->nombre_producto}}</td>
                                                <td>{{$product->presentacion}}</td>
                                                <td class="edit-cell ing-product">{{$product->ingrediente_activo}}</td>
                                                <td>{{$product->concentracion}}</tpriceMedd>
                                                <td>{{$product->unidad}}</td>
                                                <td class="edit-cell price-product-uni">{{$product->precio_comercial}}</td>
                                                <td class="edit-cell price-product-med">{{$product->precio_por_medida}}</td>
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