@extends('layouts.app')
@section('content')
@can('price')
    <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <div class="panel panel-primary" style="overflow: visible;">
            <div class="panel-heading">Filtrar Productos</div>
            <div class="panel-body">
                {!! Form::open(['method'=>'get','route'=>'products.index',
                'class'=>'form-horizontal','role'=>'search'])  !!}
                <div class="form-group">
                    <label class="col-md-3 control-label label-name-product">Nombre del Producto</label>
                    <div class="col-md-8">
                        {!! Form::text('nombre_producto', '',  array('id' => 'nombre_producto', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label label-name-inter">Nombre de la Empresa</label>
                    <div class="col-md-8">
                            {!! Form::text('nombre_empresa', '',  array('id' => 'nombre_empresa', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Ingrediente Activo</label>
                    <div class="col-md-8">
                        {!! Form::text('ingrediente_activo', '',  array('id' => 'ingrediente_activo', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="hr-dashed"></div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-5">
                        <button class="btn btn-primary" type="submit">Filtrar Productos</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endcan
@stop