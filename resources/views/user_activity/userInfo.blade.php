@extends('layouts.app')
@section('content')
    <div class="col-md-12">

        <h2 class="page-title">Información de Usuario</h2>

        <div id="messages" class="col-xs-12" style="display: none"></div>

        <div class="row">
			<div class="col-md-12 col-sm-offset-1 go-back">
				<a href="/user_activity/index"> <i class="fa fa-arrow-circle-left"></i> Regresar al listado de Usuarios</a>
			</div>        	
        </div>

        <div class=" row">
	        <div class="col-sm-6 col-sm-offset-1">
			    <div class="panel panel-primary">
			        <div class="panel-heading" id="list-products">
			            <div class="list-products-left">Accesos de {{ $logins[0]->user->name }}</div> 
			        </div>
			        <div class="panel-body">
			        	<div class="row">
			        		<div class="col-sm-6">
					            <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			                        <table class="user_activity_info_table display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
			                            <thead>
			                            <tr role="row">
			                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending">Fecha de Acceso</th>
			                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1">Tiempo de conexión</th>
			                             </tr>
			                            </thead>
			                            <tbody>
		                                    @if($logins)
		                                        @foreach($logins as $login)
		                                            <tr role="row">
		                                            	<td><a href="#" class="date-in-info" id="{{ $login['id'] }}">{{$login['date_in']}}</a></td>
		                                                <td>{{ ceil($login['time']/60) }} min</td>
		                                            </tr>
		                                        @endforeach
		                                    @endif
		                                </tbody>
			                        </table>
					            </div>
					        </div>
					        <div class="col-sm-6">
					        	<div id="date-login">{{$logins[0]['date_in']}}</div>
					        	<div>
					        		<ul id="current-date-info">
							        	@foreach($first_date_routes as $value)
							        		<li> {{ $value->route->route }}</li>
							        	@endforeach
						        	</ul>
						        </div>
					        </div>
					    </div>
			        </div>
			    </div>
			</div>

			<div class="col-sm-4">
			    <div class="panel panel-primary">
			        <div class="panel-heading" id="list-products">
			            <div class="list-products-left">Herramientas más Usadas</div> 
			        </div>
			        <div class="panel-body">
			            <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	                        <table class="user_activity_info_table display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
	                            <thead>
	                            <tr role="row">
	                                <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Herramienta</th>
	                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Cantida de Uso</th>
	                          	</tr>
	                            </thead>
	                            <tbody>
	                                @if($routes_visited)
	                                    @foreach($routes_visited as $route)
	                                        <tr role="row">
	                                        	<td>{{$route[0]->route->route}}</td>
	                                            <td>{{ count($route) }} </td>
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
    @include('partials.modal')
@stop