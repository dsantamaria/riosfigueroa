@extends('layouts.app')
@section('content')
    <div class="col-md-12">

        <h2 class="page-title">Panel de Actividad por Usuario</h2>

        <div id="messages" class="col-xs-12" style="display: none"></div>

        <div class=" row">
	        <div class="col-sm-6 col-sm-offset-1">
			    <div class="panel panel-primary">
			        <div class="panel-heading" id="list-products">
			            <div class="list-products-left">Accesos de Usuarios</div> 
			        </div>
			        <div class="panel-body">
			            <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	                        <table class="user_activity_table display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
	                            <thead>
	                            <tr role="row">
	                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending">Usuario</th>
	                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1">Accesos al Sistema</th>
	                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1">Tiempo Mínimo</th>
	                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1">Tiempo Máximo</th>
	                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1">Tiempo Promedio</th>
	                             </tr>
	                            </thead>
	                            <tbody>
                                    @if($all_logins)
                                        @foreach($all_logins as $login)
                                            <tr role="row">
                                                <td class="user_info_login"><a href="/user_activity/userInfo/{{$login['id']}}">{{$login['name']}}</a></td>
                                                <td>{{$login['count']}}</td>
                                                <td>{{$login['min']}} min</td>
                                                <td>{{$login['max']}} min</td>
                                                <td>{{$login['avg']}} min</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
	                        </table>
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
	                        <table class="user_activity_table display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
	                            <thead>
	                            <tr role="row">
	                                <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Compañía</th>
	                                <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Nombre Producto</th>
	                          	</tr>
	                            </thead>
	                            <tbody>
                                    @if($all_routes)
                                        @foreach($all_routes as $route => $count)
                                            <tr role="row">
                                                <td>{{$route}}</td>
                                                <td>{{$count}}</td>
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