@extends('layouts.app')
@section('content')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">Buscar Productos</div>
            <div class="panel-body">
                {!! Form::open(['method'=>'get','route'=>'products.index',
                'class'=>'form-horizontal','role'=>'search'])  !!}
                <div class="form-group">
                    <label class="col-md-3 control-label">Nombre de Producto</label>
                    <div class="col-md-8">
                        {!! Form::text('nombre_producto', '',  array('id' => 'nombre_producto', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Concentración</label>
                    <div class="col-md-4">
                        <div class="input-group" id="concentracion">
                            {!! Form::text('concentracion', '',  array('id' => 'concentracion', 'class' => 'form-control')) !!}
                            <span class="input-group-addon">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Presentación</label>
                    <div class="col-md-4">
                        {!! Form::text('presentacion', '',  array('id' => 'presentacion', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="hr-dashed"></div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-5">
                        <button class="btn btn-primary" type="submit">Buscar Productos</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop