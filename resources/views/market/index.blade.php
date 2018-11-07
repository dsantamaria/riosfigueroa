@extends('layouts.app')
@section('content')

<div class="col-md-12">

    <h2 class="page-title">Análisis del Mercado</h2>
    <div class="col-md-12 radio-market no-padding">
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

    <div class="col-md-4 hidden go-back no-padding" id="back-market">
        <button> <i class="fa fa-arrow-circle-left"></i> Regresar al Mercado Total</button>
    </div>

    <div class="col-md-3 col-md-offset-5 select-market hidden no-padding">
        <select class="form-control">
            <option class="first-market-option" value="">Comparar Vs Año</option>
            @foreach($years as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-12 main-market" style="height: 620px">
        <div class="hidden col-sm-12" id="market-graph" style="height: 100%;"></div>
        <div class="hidden col-sm-6" id="market-graph-3" style="height: 100%;"></div>
        <div class="col-sm-12" id="market-graph-2" style="height: 100%;"></div>
        <input type="hidden" id="market-exchange">
        <div id="market-legend"></div>
    </div>
    <div class="col-md-12 no-padding" id="market-others">
        <div id="market-legend-2"></div>
        <div id="market-process-exchange" class="hidden">
            <p id="market-dol">Precios reflejados es Pesos Mexicanos</p>
            <p id="market-current" class="hidden">Tasa del año <span id="market-year"></span>: $<span></span></p>
            <p id="market-current-2" class="hidden">Tasa del año <span id="market-year-2"></span>: $<span></span></p>
            <button id="market-convert" status="dol">Convertir a Dolares</button>
        </div>
    </div>
</div>
@stop