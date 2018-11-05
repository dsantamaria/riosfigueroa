@extends('layouts.app')
@section('content')

<div class="col-md-12">

    <h2 class="page-title">Análisis del Mercado</h2>
    <div class="col-md-12 radio-market">
        <div class="btn-group" data-toggle="buttons">
            <label class="btn active" id="market-1">
                <input type="radio" name="market" value="total" autocomplete="off" checked> Mercado Total 
            </label>
            <label class="btn" id="market-2">
                <input type="radio" name="market" value="insecticida" autocomplete="off"> Insecticida
            </label>
            <label class="btn" id="market-3">
                <input type="radio" name="market" value="herbicida" autocomplete="off"> Herbicida
            </label>
            <label class="btn" id="market-4">
                <input type="radio" name="market" value="fungicida" autocomplete="off"> Fungicida
            </label>
            <label class="btn" id="market-5">
                <input type="radio" name="market" value="otros" autocomplete="off"> Otros
            </label>
        </div>
    </div>
    <div class="col-md-12 hidden go-back" id="back-market">
        <a href="#"> <i class="fa fa-arrow-circle-left"></i> Regresar al Mercado Total</a>
    </div>
    <div class="col-md-12" style="height: 600px">
        <div class="" id="market-graph" style="width: 100%; height: 100%;"></div>
        <div id="market-graph-2" style="width: 100%; height: 100%;"></div>
        <input type="hidden" id="market-exchange">
    </div>
    <div class="col-md-12" id="market-others">
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