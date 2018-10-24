@extends('layouts.app')
@section('content')

<div class="col-md-12">
    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-body bk-primary text-light">
                    <div class="stat-panel text-center">
                        <div class="stat-panel-number h1 ">{{$total_count}}</div>
                        <div class="stat-panel-title text-uppercase">Registros evaluados</div>
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
                                        <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Nombre: activate to sort column ascending">Año</th>
                                        <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Empresa: activate to sort column ascending">Mensaje de Error</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if($error_count > 0)
                                            @foreach($errors as $key => $error)
                                                <tr role="row">
                                                    <td>{{$key}}</td>
                                                    <td>{{$error['year']}}</td>
                                                    <td>{{$error['error_msg']}}</td>
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