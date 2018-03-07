@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h2 class="page-title">Análisis Histórico</h2>
    <div class="col-md-offset-3 col-md-9 padd-left-44" style="font-size: 30px;">Análisis Trimestral de Importaciones</div>
    <div class="col-md-3">
        {!! Form::open(['route' => 'saveImage','files' => true, 'class' => 'form-horizontal padd-30px', 'id' => 'form-graph-analisis-historic', 'method' => 'POST']) !!}
            <div class="form-group">
                <label class="col-md-3 control-label">Categoría</label>
                <div class="col-md-9">
                    {{ Form::select('categorias', $categorias, null, ['class' => 'form-control', 'id' => 'analisisCategoriasHistorico']) }}
                </div>
            </div>
            <div class="form-group hidden">
                <label class="col-md-3 control-label">Análisis Especifico</label>
                <div class="col-md-9">
                    {{ Form::select('analisis_especifico', [
                        'Analísis simples'  =>  [0 => 'Promedio general', 1 => 'Volumnen Importado'],
                        'Analísis complejos' => [2 => 'Analísis comparativo PE/IA']
                    ], 0, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group" id="analisisIngredienteHistorico">
                <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Complete el campo.</div>
                <label class="col-md-3 control-label padd-top-4">Ingrediente Activo</label>
                <div class="col-md-9">
                    {{ Form::select('ingrediente', $ingredientes, null, ['class' => 'form-control', 'id' => 'selectAnalisisIngredienteHistorico']) }}
                </div>
            </div>
            <div class="form-group" id="analisisYearHistorico">
                <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Complete el campo.</div>
                <label class="col-md-3 control-label">Año</label>
                <div class="col-md-9">
                    {{ Form::select('ingrediente', [], null, ['class' => 'form-control', 'id' => 'selectAnalisisYearHistorico']) }}
                </div>
            </div>
            <div class="hr-dashed"></div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary" id="update-graphic-historic">Analizar</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-8">
        <div class="chart-container" style="position: relative;">
            <canvas id="chartAnalisisHistorico"></canvas>
        </div>
        <div class="row">
            <div class="col-md-12 padd-left-44" style="font-size: 15px;font-weight: bold">Precio total promedio = <span id="importaciones_precio_total">0</span> USD/kg</div>
            <div class="col-md-12 padd-left-44" style="font-size: 15px;font-weight: bold">Importación total en el año = <span id="importaciones_volumen_total">0</span> Tons</div>
        </div>
    </div>
</div>
@endsection