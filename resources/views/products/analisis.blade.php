@extends('layouts.app')
@section('content')
    <div class="col-md-12">
        <h2 class="page-title">Listado de Imagenes</h2>
        <div id="messages" class="col-xs-12" style="display: none"></div>
        <div class="panel panel-primary">
            <div class="panel-heading">Listado de Imagenes</div>
            <div class="panel-body">
                <div id="zctb_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="zctb" class="display table table-striped table-bordered table-hover dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="zctb_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Imagen</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Titulo</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 600px">Descripción</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Fecha de carga</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Eliminar</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @if($category_images)
                                        @foreach($category_images as $image)
                                            <tr role="row" id="{{ $image->id }}">
                                                <td class="more-info-analysis cursor" path="{{ $image->path }}"><i class="fa fa-file-image-o fa-2x" aria-hidden="true"></i></td>
                                                <td>{{ $image->title }}</td>
                                                <td>{{ $image->description }}</td>
                                                <td>{{ date('d-m-Y', strtotime( $image->created_at )) }}</td>
                                                <td class="table-td-actions">
                                                    <div class="action-delete actions-btn delete-image" id="{{ $image->id }}" data_toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-analisis" style="padding-right: 20px">
        <div class="modal-dialog" role="document" style="width: 850px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body" style="text-align: center;"></div>
            </div>
        </div>
    </div>
@stop