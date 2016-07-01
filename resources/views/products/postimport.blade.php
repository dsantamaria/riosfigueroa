@extends('layouts.app')
@section('content')

<div class="col-md-12">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body bk-primary text-light">
                    <div class="stat-panel text-center">
                        <div class="stat-panel-number h1 ">{{$total_count}}</div>
                        <div class="stat-panel-title text-uppercase">Productos evaluados</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body bk-success text-light">
                    <div class="stat-panel text-center">
                        <div class="stat-panel-number h1 ">{{$new_products_count}}</div>
                        <div class="stat-panel-title text-uppercase">Nuevos productos agregados</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body bk-info text-light">
                    <div class="stat-panel text-center">
                        <div class="stat-panel-number h1 ">{{$exists_count}}</div>
                        <div class="stat-panel-title text-uppercase">Registros ya existentes</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body bk-warning text-light">
                    <div class="stat-panel text-center">
                        <div class="stat-panel-number h1 ">{{$error_count}}</div>
                        <div class="stat-panel-title text-uppercase">Errores en registros</div>
                    </div>
                </div>
                <a href="#" class="block-anchor panel-footer text-center">Ver Errores &nbsp; <i class="fa fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>

@stop