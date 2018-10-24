@extends('layouts.app')
@section('content')

<div class="col-md-12">

    <h2 class="page-title">Análisis del Mercado</h2>
    <div class="col-lg-3 col-md-12">
        {!! Form::open(['route' => 'saveImage','files' => true, 'class' => 'form-horizontal padd-30px', 'id' => 'form-market-price', 'method' => 'POST']) !!}
            
            <div class="form-group">
                <label class="col-lg-4 control-label padd-top-4">Análisis Especifico</label>
                <div class="col-lg-8">
                    {{ Form::select('analisis_especifico', [
                        'Analísis Historicos'  =>  [0 => 'Mercado Total', 1 => 'Mercado por Asociasion', 2 => 'Mercado por Sector'],
                        ], 0, ['class' => 'form-control', 'id' => 'market-analisys']) }}
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label padd-top-4">Año</label>
                <div class="col-lg-8">
                    {{ Form::select('year', $years, 0, ['class' => 'form-control', 'id' => 'market-year', 'disabled' => 'disabled']) }}
                </div>
            </div>

            <div class="col-md-12" style="padding-bottom: 20px">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="update-graphic-market">Analizar</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-lg-9 col-md-12" style="height: 600px">
        <div class="hidden" id="market-graph" style="width: 100%; height: 100%;"></div>
        <div id="market-graph-2" style="width: 100%; height: 100%;"></div>
        <input type="hidden" id="market-exchange">
    </div>
    <div class="col-lg-9 col-lg-offset-3 col-md-12" id="market-others">
        <div id="market-legend"></div>
        <div id="market-process-exchange" class="hidden">
            <p id="market-dol">Precios reflejados es Pesos Mexicanos</p>
            <p id="market-current" class="hidden">Tasa de Cambio del año seleccionado $<span></span></p>
            <button id="market-convert" status="dol" class="hidden">Convertir a Dolares</button>
            <button id="market-convert-2" status="dol" class="hidden">Convertir a Dolares</button>
        </div>
    </div>

</div>
@stop