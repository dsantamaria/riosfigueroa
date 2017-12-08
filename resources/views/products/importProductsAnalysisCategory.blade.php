@extends('layouts.app')
@section('content')

<div class="col-md-12">

    <h2 class="page-title">Importar Lista de Precios</h2>

        <div class="panel panel-default">
            <div class="panel-heading">Agregar archivo</div>
            <div class="panel-body">
                {!! Form::open(['route' => 'process_import_products_analysis_category',
                    'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}

                    <div class="form-group">
                        <label class="col-md-2 control-label">Archivo</label>
                        <div class="col-md-10">
                            {!! Form::file('input-1', array('id'=>'input-1')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label">Fecha de lista</label>
                        <div class="col-md-10">
                            {{ Form::date('fecha_lista', \Carbon\Carbon::create(2009, 1, 1), ['class' => 'form-control', 'id' => 'fechaLista',  'min' => '2009-01-01', 'max' => \Carbon\Carbon::today()->toDateString()]) }}
                        </div>
                    </div>


                    <div id="errorBlock1" class="help-block file-error-message" style="display: none;"></div>
                    <div class="hr-dashed"></div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button class="btn btn-default" type="submit">Cancel</button>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                        </div>
                    </div>
                {!! Form::close()  !!}
            </div>
        </div>

</div>
@stop