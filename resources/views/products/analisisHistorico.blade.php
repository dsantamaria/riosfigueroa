@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h2 class="page-title">Analisis Historico</h2>
    <div class="col-md-3">
        {!! Form::open(['route' => 'saveImage','files' => true, 'class' => 'form-horizontal padd-30px', 'id' => 'form-graph-analisis', 'method' => 'POST']) !!}
            <div class="form-group">
                <label class="col-md-3 control-label">Categoría</label>
                <div class="col-md-9">
                    {{ Form::select('categorias', ['Insecticidas' => 'Insecticidas', 'Herbicidas' => 'Herbicidas', 'Fungicidas' => 'Fungicidas'], 'Insecticidas', ['class' => 'form-control', 'id' => 'analisisCategoriasHistorico']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Análisis Especifico</label>
                <div class="col-md-9">
                    {{ Form::select('analisis_especifico', [
                        'Analísis simples'  =>  [0 => 'Promedio general', 1 => 'Volumnen Importado'],
                        'Analísis complejos' => [2 => 'Analísis comparativo PE/IA']
                    ], 0, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group" id="analisisIngredienteHistorico">
                <label class="col-md-3 control-label">Ingrediente</label>
                <div class="col-md-9">
                    {{ Form::select('ingrediente', [0 => 'Linuron yt', 1 => 'Amitraz', 2 => 'Ametrina', 3 => 'atrazina'], 'Insecticidas', ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="hr-dashed"></div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary" id="update">Analizar</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        <div class="chart-container" style="position: relative;">
            <canvas id="chartAnalisisHistorico"></canvas>
        </div>
    </div>
</div>
@endsection