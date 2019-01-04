@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h2 class="page-title">Análisis Histórico</h2>
    <div class="col-md-12" style="text-align: right;">
        <div class="checkbox checkbox-primary" id="import-vs">
            <input type="checkbox" id="import-checkbox">
            <label for="import-checkbox">Comparar Vs Año</label>
        </div>
    </div>
    <div class="col-lg-8 col-md-12 col-lg-offset-4 col-md-offset-0">
        {!! Form::open(['route' => 'saveImage', 'class' => 'row', 'id' => 'form-graph-analisis-historic', 'method' => 'POST']) !!}
            <div class="form-group col-md-4">
                {{ Form::select('categorias', $categorias, null, ['class' => 'form-control', 'id' => 'analisisCategoriasHistorico']) }}
            </div>
            <div class="form-group col-md-4" id="analisisIngredienteHistorico">
                {{ Form::select('ingrediente', $ingredientes, null, ['class' => 'form-control', 'id' => 'selectAnalisisIngredienteHistorico']) }}
            </div>
            <div class="form-group col-md-4" id="analisisYearHistorico">
                {{ Form::select('ingrediente', [], null, ['class' => 'form-control', 'id' => 'selectAnalisisYearHistorico']) }}
            </div>
            <div class="col-md-1 hidden" id="vs-text-import">
                vs año
            </div>
            <div class="form-group col-md-2 hidden">
                {{ Form::select('categorias', [], null, ['class' => 'form-control', 'id' => 'selectAnalisisYearHistorico2']) }}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-12">
        <div id="bar-import" style="height:600px;"></div>
        <div class="row hidden" id="import-extras">
            <div class="col-md-12 padd-left-55" style="font-size: 15px;font-weight: bold">
                Precio total promedio = <span id="importaciones_precio_total">0</span> USD/<span id="imp_kg_lt">Kg</span>
            </div>
            <div class="col-md-12 padd-left-55" style="font-size: 15px;font-weight: bold">Importación total en el año = <span id="importaciones_volumen_total">0</span></div>
        </div>
        <div class="col-md-6 hidden" id="import-extras-vs">
            <table class="table table-bordered table-hover">
                <thead>
                    <th></th>
                    <th id="title-an-1"></th>
                    <th id="title-an-2"></th>
                </thead>
                <tbody>
                    <tr>
                        <td>Precio total promedio</td>
                        <td id="precio-an-1"></td>
                        <td id="precio-an-2"></td>
                    </tr>
                    <tr>
                        <td>Importación total en el año</td>
                        <td id="impor-an-1"></td>
                        <td id="impor-an-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection