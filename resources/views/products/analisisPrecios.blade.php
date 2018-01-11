@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h2 class="page-title">Analisis de Precios</h2>
    <div class="col-md-3">
        {!! Form::open(['route' => 'saveImage','files' => true, 'class' => 'form-horizontal padd-30px', 'id' => 'form-graph-analysis-price', 'method' => 'POST']) !!}
            
                <div class="form-group">
                    <label class="col-md-3 control-label">Análisis Especifico</label>
                    <div class="col-md-9">
                        {{ Form::select('analisis_especifico', [
                            'Analísis Simples'  =>  [0 => 'Promedio general', 1 => 'Precio mínimo registrado', 2 => 'Precio máximo registrado'], 'Analísis Complejos' => [4 => 'Mediana', 5 => 'Analísis Comparativo PE/PE', 6 => 'Analísis Comparativo PE/IA'],
                            ], 0, ['class' => 'form-control', 'id' => 'analisisEspecifico']) }}
                    </div>
                </div>
                <div class="form-group" id="analisisTipoG">
                    <label class="col-md-3 control-label">Tipo de Analísis</label>
                    <div class="col-md-9">
                        {{ Form::select('tipo_analisis', ['producto' => 'Por producto', 'ingrediente' => 'Por ingrediente'], 'producto', ['class' => 'form-control', 'id' => 'analisisTipo']) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tiempo</label>
                    <div class="col-md-9">
                        {{ Form::select('tiempo', [0 => 'Ultimas 10 actualizaciones', 1 => 'Todos lo años'], 0, ['class' => 'form-control', 'id' => 'analisisTiempo']) }}
                    </div>
                </div>
            <div id="first-graphic-prices" class="">
                <div class="form-group">
                    <label class="col-md-3 control-label">Categoría</label>
                    <div class="col-md-9">
                        {{ Form::select('categorias', ['Insecticida' => 'Insecticidas', 'Herbicida' => 'Herbicidas', 'Fungicida' => 'Fungicidas', 'Otros' => 'Otros'], 'Insecticidas', ['class' => 'form-control', 'id' => 'analisisCategorias']) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Complete el campo.</div>
                    <label class="col-md-3 control-label">Compañia</label>
                    <div class="col-md-9">
                        {{ Form::select('compañia', $proveedores_names, null, ['class' => 'form-control', 'id' => 'analisisCompany']) }}
                    </div>
                </div>
                <div class="form-group" id="analisisProducto">
                    <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Complete el campo.</div>
                    <label class="col-md-3 control-label">Producto</label>
                    <div class="col-md-9">
                        {{ Form::select('producto', ['empty'=>''], null, ['class' => 'form-control', 'id' => 'analisisProductoSelect']) }}
                    </div>
                </div>
                <div class="form-group display-none" id="analisisIngrediente">
                    <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Complete el campo.</div>
                    <label class="col-md-3 control-label">Ingrediente</label>
                    <div class="col-md-9">
                        {{ Form::select('ingrediente', ['empty'=>''], null, ['class' => 'form-control', 'id' => 'analisisIngredienteSelect']) }}
                    </div>
                </div>
            </div>

            <div id="second-graphic-prices" class="">
                <div class="form-group" id="categoria2" style="display: none;">
                    <label class="col-md-3 control-label">Categoría</label>
                    <div class="col-md-9">
                        {{ Form::select('categorias', ['Insecticida' => 'Insecticidas', 'Herbicida' => 'Herbicidas', 'Fungicida' => 'Fungicidas', 'Otros' => 'Otros'], 'Insecticidas', ['class' => 'form-control', 'id' => 'analisisCategorias2']) }}
                    </div>
                </div>
                <div class="form-group" id="analisisCompanyG2" style="display: none;">
                    <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Complete el campo.</div>
                    <label class="col-md-3 control-label">Compañia</label>
                    <div class="col-md-9">
                        {{ Form::select('compañia', $proveedores_names, null, ['class' => 'form-control', 'id' => 'analisisCompany2']) }}
                    </div>
                </div>
                <div class="form-group" id="analisisProducto2" style="display: none;">
                    <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Complete el campo.</div>
                    <label class="col-md-3 control-label">Producto</label>
                    <div class="col-md-9">
                        {{ Form::select('producto', ['empty'=>''], null, ['class' => 'form-control', 'id' => 'analisisProductoSelect2']) }}
                    </div>
                </div>
                <div class="form-group display-none" id="analisisIngrediente2">
                    <div class="help-block col-xs-offset-3 col-md-9" style="display: none; font-weight: bold;">Complete el campo.</div>
                    <label class="col-md-3 control-label">Ingrediente</label>
                    <div class="col-md-9">
                        {{ Form::select('ingrediente', ['empty'=>''], null, ['class' => 'form-control', 'id' => 'analisisIngredienteSelect2']) }}
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="padding-bottom: 20px">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="update-graphic-precio">Analizar</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-9">
        <div class="chart-container" style="position: relative;">
            <canvas id="chartAnalisisCategoria"></canvas>
        </div>
    </div>
</div>
@endsection