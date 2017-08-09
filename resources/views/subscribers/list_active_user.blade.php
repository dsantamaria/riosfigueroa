@extends('layouts.app')
@section('content')
	<div class="col-md-12">
        <h2 class="page-title">Listado de Usuarios</h2>
    </div>
    <div id="messages" class="col-xs-12" style="display: none"></div>
    <div class="col-md-8 col-md-offset-2 col-xs-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Listado de Usuarios</div>
            <div class="panel-body">
                <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="zctb" class="display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Estado</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @if($users)
                                        @foreach($users as $user)
                                            <tr role="row">
                                                <td>{{ $user->name }}</td>
                                                <td id="email">{{ $user->email }}</td>
                                                <td id="state">
                                                    @if($user->active == 1 ) Activo
                                                    @else Inactivo
                                                    @endif 
                                                </td>
                                                <td class="table-td-actions">
                                                    @if($user->active == 1) <div class="actions-btn active-user action-desactive" id="{{ $user->id }}" state="0" data_toggle="tooltip" data-placement="bottom" title="Desactivar"><i class="fa fa-times" aria-hidden="true"></i></div>
                                                    @else <div class="actions-btn active-user action-active" id="{{ $user->id }}" state="1" data_toggle="tooltip" data-placement="bottom" title="Activar"><i class="fa fa-check" aria-hidden="true"></i></div>
                                                    @endif

                                                    <div class="actions-btn delete-user action-delete" id="{{ $user->id }}" data_toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                                </td>
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
@stop
