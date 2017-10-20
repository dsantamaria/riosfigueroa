@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h2 class="page-title">Analisis de Precios</h2>
    <div class="col-md-3">
        {!! Form::open(['route' => 'saveImage','files' => true, 'class' => 'form-horizontal padd-30px', 'id' => 'form-graph-analisis', 'method' => 'POST']) !!}
            <div class="form-group">
                <label class="col-md-3 control-label">Categoría</label>
                <div class="col-md-9">
                    {{ Form::select('categorias', ['Insecticidas' => 'Insecticidas', 'Herbicidas' => 'Herbicidas', 'Fungicidas' => 'Fungicidas', 'Otros' => 'Otros'], 'Insecticidas', ['class' => 'form-control', 'id' => 'analisisCategorias']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Análisis Especifico</label>
                <div class="col-md-9">
                    {{ Form::select('analisis_especifico', [
                        'Analísis simples'  =>  [0 => 'Promedio general', 1 => 'Precio mínimo registrado', 2 => 'Precio máximo registrado'],
                        'Analísis complejos' => [3 => 'Quartiles', 4 => 'Media', 5 => 'Mediana', 6 => 'Analísis comparativo PE/PE', 7 => 'Analísis comparativo PE/IA']
                    ], 0, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tipo de Analísis</label>
                <div class="col-md-9">
                    {{ Form::select('tipo_analisis', ['producto' => 'Por producto', 'ingrediente' => 'Por ingrediente'], 'producto', ['class' => 'form-control', 'id' => 'analisisTipo']) }}
                </div>
            </div>
            <div class="form-group" id="analisisProducto">
                <label class="col-md-3 control-label">Producto</label>
                <div class="col-md-9">
                    {{ Form::select('producto', [0 => 'Afalon 50', 1 => 'Akaroff', 2 => 'Ametrex 80 WG', 3 => 'Atraplex 50'], 'Insecticidas', ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group display-none" id="analisisIngrediente">
                <label class="col-md-3 control-label">Ingrediente</label>
                <div class="col-md-9">
                    {{ Form::select('ingrediente', [0 => 'Linuron yt', 1 => 'Amitraz', 2 => 'Ametrina', 3 => 'atrazina'], 'Insecticidas', ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Compañia</label>
                <div class="col-md-9">
                    {{ Form::select('compañia', [0 => 'Adama Mexico, S.A. de C.V.', 1 => 'Agrovana, S.A. de C.V.', 2 => 'BASF Mexicana, S.A de C.V', 3 => 'Cruposa, S.A. de C.V.'], 'Insecticidas', ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Tiempo</label>
                <div class="col-md-9">
                    {{ Form::select('tiempo', [0 => 'Ultimas 10 actualizaciones', 1 => 'Rango de fechas'], 0, ['class' => 'form-control', 'id' => 'analisisTiempo']) }}
                </div>
            </div>
            <div class="form-group display-none analisisRango">
                <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Error en las fechas.</div>
                <div class="marg-15px clearfix">
                    <label class="col-md-3 control-label">Inicio</label>
                    <div class="col-md-9">
                        {{ Form::date('rango_ inicial', \Carbon\Carbon::create(2009, 1, 1), ['class' => 'form-control', 'id' => 'analisisInicio',  'min' => '2009-01-01', 'max' => \Carbon\Carbon::today()->toDateString()]) }}
                    </div>
                </div>
                <div>
                    <label class="col-md-3 control-label">Fin</label>
                    <div class="col-md-9">
                        {{ Form::date('rango_ final', \Carbon\Carbon::now(), ['class' => 'form-control', 'id' => 'analisisFin', 'min' => '2009-01-01', 'max' => \Carbon\Carbon::today()->toDateString()]) }}
                    </div>
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
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
@endsection
