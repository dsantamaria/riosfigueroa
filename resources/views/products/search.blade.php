@extends('layouts.app')
@section('content')

    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary" style="overflow: visible;">
            <div class="panel-heading">Filtrar Productos</div>
            <div class="panel-body">
                {!! Form::open(['method'=>'get','route'=>'products.index',
                'class'=>'form-horizontal','role'=>'search'])  !!}
                <div class="form-group">
                    <label class="col-md-3 control-label">Nombre del producto</label>
                    <div class="col-md-8">
                        {!! Form::text('nombre_producto', '',  array('id' => 'nombre_producto', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Nombre de la Empresa</label>
                    <div class="col-md-8">
                            {!! Form::text('nombre_empresa', '',  array('id' => 'nombre_empresa', 'class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Ingrediente Activo</label>
                    <div class="col-md-8">
                        {!! Form::select('categoria', ['2' => 'Insecticidas', '3' => 'Herbicidas', '7' => 'Fungicidas', 'otros' => 'Otros'], null, array('class' => 'selectpicker', 'placeholder' => 'Elige una categoria...')) !!}
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
@stop