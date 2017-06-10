<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Rios Figueroa</title>

        {!! Html::style('harmony/css/font-awesome.min.css') !!}
        {!! Html::style('harmony/css/bootstrap.min.css') !!}
        {!! Html::style('harmony/css/dataTables.bootstrap.min.css') !!}
        {!! Html::style('harmony/css/bootstrap-social.css') !!}
        {!! Html::style('harmony/css/bootstrap-select.css') !!}
        {!! Html::style('harmony/css/fileinput.min.css') !!}
        {!! Html::style('harmony/css/awesome-bootstrap-checkbox.css') !!}
        {!! Html::style('harmony/css/style.css') !!}
    </head>

    <body>
        <div class="brand clearfix">
            <a href="#" class="logo">Sistema de Manejo de Precios</a>
            @if (Auth::check())
                <ul class="ts-profile-nav">
                    <li><a href="{{ url('/logout') }}">Cerrar sesión</a></li>
                </ul>
            @endif
        </div>
        <div class="ts-main-content">
            @if (Auth::check())
                <nav class="ts-sidebar">
                    <ul class="ts-sidebar-menu">
                        <li class="ts-label">Dashboard</li>
                        <li>
                            <div class="more">

                            </div>
                            <a href="#" class="parent"><i class="fa fa-codepen"></i>Productos</a>
                            <ul>
                                <li><a href="{{ route('products.search') }}">Buscador de Productos</a></li>
                                <li><a href="{{ route('products.index') }}">Listado Productos</a></li>
                                @can('admin-role')
                                    <li><a href="{{ route('lista_precios.import') }}">Importar Lista de Precios</a></li>
                                    <li><a href="{{ route('uploadImage') }}">Subir Imagen</a></li>
                                @endcan
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="parent"><i class="fa fa-codepen"></i>Análisis por Categoría</a>
                            <ul>
                                <li><a href="{{ route('products.analisis' , ['analisis' => 'insecticidas']) }}">Insecticidas</a></li>
                                <li><a href="{{ route('products.analisis' , ['analisis' => 'herbicidas']) }}">Herbicidas</a></li>
                                <li><a href="{{ route('products.analisis' , ['analisis' => 'fungicidas']) }}">Fungicidas</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('proveedores.index') }}"><i class="fa fa-industry"></i>Empresas Comercializadoras</a></li>
                    </ul>
                </nav>
            @endif
                <div class="content-wrapper">
                <div class="container-fluid">
                    @if (Session::has('success'))
                        <div class="row">
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                <strong>{{Session::get('success')}}</strong>
                            </div>
                        </div>
                    @endif
                    @if (Session::has('warning'))
                        <div class="row">
                            <div class="alert alert-dismissible alert-warning">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                <strong>{{Session::get('warning')}}</strong>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        {!! Html::script('harmony/js/jquery.min.js') !!}
        {!! Html::script('harmony/js/bootstrap-select.min.js') !!}
        {!! Html::script('harmony/js/bootstrap.min.js') !!}
        {!! Html::script('harmony/js/jquery.dataTables.min.js') !!}
        {!! Html::script('harmony/js/dataTables.bootstrap.min.js') !!}
        {!! Html::script('harmony/js/Chart.min.js') !!}
        {!! Html::script('harmony/js/fileinput.js') !!}
        {!! Html::script('harmony/js/chartData.js') !!}
        {!! Html::script('harmony/js/main.js') !!}
    </body>
</html>
