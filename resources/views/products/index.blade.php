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
                                    <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Compañia</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Categoria</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Ingrediente Activo</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Formulación</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Concentración</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Presentación</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Empaque</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Precio Comercial</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Precio por medida</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Ultima actualización</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($products as $product)
                                        <tr role="row">
                                            <td>{{$product->nombre_producto}}</td>
                                            <td>{{$product->proveedor_id}}</td>
                                            <td>{{$product->categoria_id}}</td>
                                            <td>{{$product->ingrediente_activo}}</td>
                                            <td>{{$product->formulacion}}</td>
                                            <td>{{$product->concentracion}}</td>
                                            <td>{{$product->presentacion}}</td>
                                            <td>{{$product->empaque}}</td>
                                            <td>{{$product->precio_comercial}}</td>
                                            <td>{{$product->precio_por_medida}}</td>
                                            <td>{{$product->ultima_actualizacion}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop