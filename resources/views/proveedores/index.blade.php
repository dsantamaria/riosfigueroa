@extends('layouts.app')
@section('content')
    <div class="col-md-12">

        <h2 class="page-title">Listado de Proveedores</h2>

        <div class="panel panel-default">
            <div class="panel-heading">Table by DataTables plugin</div>
            <div class="panel-body">
                <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="zctb" class="display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info" style="width: 100%;">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Nombre</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($proveedores as $proveedor)
                                        <tr role="row">
                                            <td>{{$proveedor->nombre_proveedor}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop