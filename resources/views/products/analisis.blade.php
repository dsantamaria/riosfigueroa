@extends('layouts.app')
@section('content')
    <div class="col-md-12">

        <h2 class="page-title">Listado de Imagenes</h2>

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
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Descripción</th>
                                    <th class="sorting" tabindex="0" aria-controls="zctb" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Fecha de carga</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr role="row" id="t" class="modal-analisis">
                                        <td class="cursor"><i class="fa fa-file-image-o fa-2x" aria-hidden="true"></i></td>     
                                        <td>Abamectina</td>
                                        <td>Agregar descripcion</td>
                                        <td>24 de mayo de 2017</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-analisis">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Análisis de imagen: Abamectina</h3>
            </div>
            <div class="modal-body" style="text-align: center;">
                {!! Html::image('imgDemo.png', 'alt') !!}
            </div>
            <p style="padding: 5px; text-align: center">Texto descriptivo</p>
        </div>
    </div>
</div>
@stop