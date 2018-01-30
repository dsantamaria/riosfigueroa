@extends('layouts.app')
@section('content')
	<div class="col-md-12">
        <h2 class="page-title">Listas para el Análisis de Importaciones</h2>
    </div>
    <div id="messages" class="col-xs-12" style="display: none"></div>
    <div class="col-md-8 col-md-offset-2 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Listas para el Análisis de Importaciones</div>
            <div class="panel-body">
                <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="zctb" class="display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_desc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="descending" aria-label="Name: activate to sort column descending">Ingrediente Activo</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Año</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @if($array_ingredientes)
                                        @foreach($array_ingredientes as $value)
                                            @foreach($value[0] as $year)
                                                <tr role="row">
                                                    <td>{{ $value[1][key($value[1])] }}</td>
                                                    <td id="historic-year">{{ $year }}</td>
                                                    <td class="table-td-actions">
                                                        <div class="actions-btn delete-list-historic action-delete" id="{{ key($value[1]) }}" data_toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                                    </td>
                                                </tr>
                                            @endforeach
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
@stop
