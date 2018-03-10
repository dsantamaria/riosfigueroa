@extends('layouts.app')
@section('content')

<div class="col-md-12">

    <h2 class="page-title">Importar Archivos para Análisis de Importaciones</h2>
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Agregar archivo</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'process_import_analysis_historic_list',
                        'files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}

                        <div class="form-group">
                            <label class="col-md-2 control-label" id="label-historico-ingrediente-nuevo">Ingrediente Nuevo</label>
                            <div class="col-md-10">   
                               <div class="input-group">
                                    <span class="input-group-addon">
                                        {{ Form::checkbox('check_ingrediente', 1, true, ['id'=>"historico_checkbox_ingrediente"]) }}
                                    </span>
                                   {{ Form::text('nombre_ingrediente', null, ['class' => 'form-control', 'id'=>"historico_ingrediente_nuevo", 'required' => 'required']) }}
                               </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Unidad</label>
                            <div class="col-md-10">
                                {{ Form::select('unit', ['kilogramo' => 'Kilogramo', 'litro' => 'Litro'], 'kilogramo', ['class' => 'form-control', 'required' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Categoria</label>
                            <div class="col-md-10">
                                {{ Form::select('categoria_id', $categorias, null, ['class' => 'form-control', 'id'=>"historico_categoria_select", 'required' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" id="label-historico-ingrediente-existente">Ingrediente Existente</label>
                            <div class="col-md-10">
                                {{ Form::select('ingredient_id', $ingredients, null, ['placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled', 'id'=>"historico_ingrediente_existente", 'required' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Año</label>
                            <div class="col-md-10">
                                {{ Form::select('year', [2016 => '2016', 2017 => '2017', 2018 => '2018', 2019 => '2019', 2020 => '2020', 2021 => '2021', 2022 => '2022', 2023 => '2023'], '2018', ['class' => 'form-control', 'required' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Archivo</label>
                            <div class="col-md-10">
                                {!! Form::file('input-1', array('id'=>'input-1', 'required' => 'required')) !!}
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

</div>
@stop