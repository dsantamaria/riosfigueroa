@extends('layouts.app')
@section('content')

<div class="col-md-12">

    <h2 class="page-title">Importar Nueva Lista de Precios</h2>

        <div class="panel panel-default">
            <div class="panel-heading">Agregar archivo</div>
            <div class="panel-body">
                {!! Form::open(['route' => 'lista_precios.process',
                    'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}


                    {!! Form::file('input-1', array('id'=>'input-1')) !!}


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