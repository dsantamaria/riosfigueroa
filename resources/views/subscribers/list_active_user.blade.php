@extends('layouts.app')
@section('content')
	<div class="col-md-12 messages-resend">
        <h2 class="page-title">Listado de Usuarios</h2>
    </div>
    <div id="messages" class="col-xs-12" style="display: none"></div>
    <div class="col-md-10 col-md-offset-1 col-xs-12">
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
                                            @if(!in_array($user->roles[0]->permissions, ['super', 'admin']))
                                                <tr role="row">
                                                    <td>{{ $user->name }}</td>
                                                    <td id="email">{{ $user->email }}</td>
                                                    <td id="state">
                                                        <span id="state-active">
                                                            @if($user->active == 1 ) Activo 
                                                            @elseif($user->password == "" ) Solicitud sin respuesta 
                                                            @else Inactivo
                                                            @endif 
                                                        </span>
                                                        <span id="state-access">
                                                            @if($user->roles[0]->permissions == 'user_out_mx') - Acceso Global 
                                                            @elseif($user->password == "" )    
                                                            @else - Acceso solo en México
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td class="table-td-actions" style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                                                        @if($user->password == "")
                                                            <div style="display: flex;margin-bottom: 2px;">
                                                                <div class="actions-btn resend-request action-resend" email="{{ $user->email }}" data_toggle="tooltip" data-placement="bottom" title="Reenviar Solicitud"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></div>
                                                                <div class="actions-btn delete-user action-delete" id="{{ $user->id }}" data_toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                                            </div>
                                                        @else
                                                            <div style="display: flex;margin-bottom: 2px;">
                                                                @if($user->active == 1) <div class="actions-btn active-user action-desactive" id="{{ $user->id }}" state="0" data_toggle="tooltip" data-placement="bottom" title="Desactivar"><i class="fa fa-times" aria-hidden="true"></i></div>
                                                                @else <div class="actions-btn active-user action-active" id="{{ $user->id }}" state="1" data_toggle="tooltip" data-placement="bottom" title="Activar"><i class="fa fa-check" aria-hidden="true"></i></div>
                                                                @endif

                                                                <div class="actions-btn delete-user action-delete" id="{{ $user->id }}" data_toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                                                
                                                                @if($user->roles[0]->permissions == 'user_out_mx') <div class="actions-btn global-access active-global-user" id="{{ $user->id }}" state="0" data_toggle="tooltip" data-placement="bottom" title="Desactivar"><i class="fa fa-globe" aria-hidden="true"></i></div>
                                                                @else <div class="actions-btn global-access desactive-global-user" id="{{ $user->id }}" state="1" data_toggle="tooltip" data-placement="bottom" title="Activar"><i class="fa fa-globe" aria-hidden="true"></i></div>
                                                                @endif
                                                            </div>
                                                            <div style="display: flex">
                                                                @if(!$user->tools->contains('permissions', 'price')) <div class="actions-btn action-price active-price" id="{{ $user->id }}" state="1" data_toggle="tooltip" data-placement="bottom" title="Remover acceso al sistema de precios"><i class="fa fa-random" aria-hidden="true"></i></div>
                                                                @else <div class="actions-btn action-price desactive-price" id="{{ $user->id }}" state="0" data_toggle="tooltip" data-placement="left" title="Dar acceso al sistema de precios"><i class="fa fa-random" aria-hidden="true"></i></div>
                                                                @endif

                                                                @if(!$user->tools->contains('permissions', 'import')) <div class="actions-btn action-import active-import" id="{{ $user->id }}" state="1" data_toggle="tooltip" data-placement="bottom" title="Remover acceso al sistema de importaciones"><i class="fa fa-download" aria-hidden="true"></i></div>
                                                                @else <div class="actions-btn action-import desactive-import" id="{{ $user->id }}" state="0" data_toggle="tooltip" data-placement="bottom" title="Dar acceso al sistema de importaciones"><i class="fa fa-download" aria-hidden="true"></i></div>
                                                                @endif

                                                                @if(!$user->tools->contains('permissions', 'market')) <div class="actions-btn action-market active-market" id="{{ $user->id }}" state="1" data_toggle="tooltip" data-placement="bottom" title="Remover acceso al sistema de mercado"><i class="fa fa-pie-chart" aria-hidden="true"></i></div>
                                                                @else <div class="actions-btn action-market desactive-market" id="{{ $user->id }}" state="0" data_toggle="tooltip" data-placement="bottom" title="Dar acceso al sistema de mercado"><i class="fa fa-pie-chart" aria-hidden="true"></i></div>
                                                                @endif

                                                                @if(!$user->tools->contains('permissions', 'cultivo')) <div class="actions-btn action-farm active-market" id="{{ $user->id }}" state="1" data_toggle="tooltip" data-placement="bottom" title="Remover acceso al sistema de analissi por cultivos"><i class="fa fa-apple" aria-hidden="true"></i></div>
                                                                @else <div class="actions-btn action-farm  desactive-market" id="{{ $user->id }}" state="0" data_toggle="tooltip" data-placement="bottom" title="Dar acceso al sistema de analissi por cultivos"><i class="fa fa-apple" aria-hidden="true"></i></i></div>
                                                                @endif
                                                            </div>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endif
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
