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
                @if($error_count > 0) <a href="#" class="block-anchor panel-footer text-center" id="see-errors-import">Ver Errores &nbsp; <i class="fa fa-arrow-right"></i></a> @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal-extra-info">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registros con Errores</h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="zctb" class="display table table-striped table-bordered table-hover dataTable table-scroll" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Nombre: activate to sort column ascending">Nombre Producto</th>
                                        <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Empresa: activate to sort column ascending">Nombre de la Empresa</th>
                                        <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Categria: activate to sort column ascending">Categoria</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($error_count > 0)
                                            @foreach($products_error as $error)
                                                <tr role="row">
                                                    <td>{{$error['id_fila_error']}}</td>
                                                    <td>{{$error['nombre_empresa_error']}}</td>
                                                    <td>{{$error['nombre_producto_error']}}</td>
                                                    <td>{{$error['nombre_categoria_error']}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop