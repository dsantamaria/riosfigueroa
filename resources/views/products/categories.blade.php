@extends('layouts.app')
@section('content')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">Filtrar Productos por Categorias</div>
            <div class="panel-body">
                {!! Form::open(['method'=>'get','route'=>'products.index',
                'class'=>'form-horizontal','role'=>'categories'])  !!}
                <div class="form-group">
                    <label class="col-md-3 control-label">Categorias</label>
                    <div class="col-md-8">
                        {!! Form::text('nombre_producto', '',  array('id' => 'nombre_producto', 'class' => 'form-control')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop