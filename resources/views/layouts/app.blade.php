<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Rios Figueroa</title>

        {!! Html::style('harmony/css/font-awesome.min.css') !!}
        {!! Html::style('harmony/css/bootstrap.min.css') !!}
        {!! Html::style('harmony/css/dataTables.bootstrap.min.css') !!}
        {!! Html::style('harmony/css/bootstrap-social.css') !!}
        {!! Html::style('harmony/css/bootstrap-select.css') !!}
        {!! Html::style('harmony/css/fileinput.min.css') !!}
        {!! Html::style('harmony/css/awesome-bootstrap-checkbox.css') !!}
        {!! Html::style('harmony/css/style.css') !!}
        {!! Html::style('harmony/css/responsive.dataTable.min.css') !!}
    </head>

    <body oncopy='return false' oncut='return false' class="hidden-print">
        <div class="brand clearfix">
            <a href="/" class="logo fixlogo">Sistema de Información</a>
            <span class="menu-btn">
                <i class="fa fa-bars"></i>
            </span>
            @if (Auth::check())
                <ul class="ts-profile-nav">
                    <li><a href="{{ url('/logout') }}">Cerrar Sesión</a></li>
                </ul>
            @endif
        </div> 
        <div class="ts-main-content">
            @if (Auth::check())
                <nav class="ts-sidebar">
                    <ul class="ts-sidebar-menu">
                        <li class="ts-label">Dashboard</li>
                        <li>
                            <a href="#" class="parent"><i class="fa fa-codepen"></i>Productos</a>
                            <ul>
                                <li><a href="{{ route('products.search') }}">Buscador de Productos</a></li>
                                <li><a href="{{ route('products.index') }}">Listado Productos</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="parent parent-flex"><i class="fa fa-pie-chart"></i><div>Análisis del Mercado Mexicano</div></a>
                            <ul>
                                    <li><a href="{{ route('market.index') }}">Análisis del Mercado</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" class="parent"><i class="fa fa-line-chart"></i>Análisis Histórico</a>
                            <ul>
                                <li><a href="{{ route('analisisPrecios') }}">Análisis de Precios</a></li>
                                <li><a href="{{ route('analisisHistorico') }}"></i>Análisis de Importaciones</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('proveedores.index') }}"><i class="fa fa-industry"></i>Empresas Comercializadoras</a></li>

                        @can('admin-role')
                            <li>
                                <a href="#" class="parent"><i class="fa fa-desktop"></i>Administrador</a>
                                <ul>
                                    @can('super-role')
                                        <li class="second-level">
                                            <a href="#" class="parent"><i class="fa fa-circle"></i>Usuarios</a>
                                            <ul>
                                                <li><a href="{{ route('sendSubscription') }}">Suscribir Usuarios</a></li>
                                                <li><a href="{{ route('listActiveUsers') }}">Gestión de Usuarios</a></li>
                                                <li><a href="{{ route('user_activity.index') }}">Panel de Actividad por Usuario</a></li>
                                            </ul>
                                        </li>

                                        <li class="second-level">
                                            <a href="#" class="parent"><i class="fa fa-circle"></i>Admins</a>
                                            <ul>
                                                <li><a href="{{ route('admin.create') }}">Registrar Admin</a></li>
                                                <li><a href="{{ route('admin.index') }}">Gestión de Admins</a></li>
                                            </ul>
                                        </li>
                                    @endcan
                                    <li class="second-level">
                                        <a href="#" class="parent"><i class="fa fa-circle"></i>Importaciones de Listas</a>
                                        <ul>
                                            <li><a href="{{ route('lista_precios.import') }}">Importar Lista de Precios</a></li>
                                            <li><a href="{{ route('import_products_analysis_category') }}">Importar Archivos para Análisis de Precios</a></li>
                                            <li><a href="{{ route('import_analysis_historic_lists') }}">Importar Archivos para Análisis de Importaciones</a></li>
                                            <li><a href="{{ route('market_value') }}">Importar Archivos para Análisis del Valor del Mercado</a></li>
                                        </ul>
                                    </li>
                                    <li class="second-level">
                                        <a href="#" class="parent"><i class="fa fa-circle"></i>Gestión de Listas</a>
                                        <ul>
                                            <li><a href="{{ route('gestionListasAnalisisPrecios') }}">Gestión de Listas para Análisis de Precios</a></li>
                                            <li><a href="{{ route('gestionListasAnalisisHistoricos') }}">Gestión de Listas para Análisis de Importaciones</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('changePassword') }}">Cambiar Contraseña</a></li>
                                    <li><a href="{{ route('uploadImage') }}">Subir Imagen</a></li>
                                </ul>
                            </li>
                        @endcan
                        <ul class="ts-profile-nav">
                            <li>
                                <a href="{{ url('/logout') }}">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </ul>
                </nav>
            @endif
                <div class="content-wrapper">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="row">
                            <div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                <strong>{{ session('success') }}</strong>
                                {{ session()->forget('success') }}
                            </div>
                        </div>
                    @endif
                    @if (session('warning'))
                        <div class="row">
                            <div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                <strong>{{session('warning')}}</strong>
                                {{ session()->forget('warning') }}
                            </div>
                        </div>
                    @endif
                    @if(count($errors) > 0)
                        <div class="row">
                            <div class="alert alert-dismissible alert-danger col-xs-10 col-xs-offset-1">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <strong>
                                            <li>
                                                {{ $error }}
                                            </li>
                                        </strong>
                                    @endforeach
                                </ul>
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
        {!! Html::script('harmony/js/dataTable.responsive.min.js') !!}
        {!! Html::script('harmony/js/Chart.bundle.min.js') !!}
        {!! Html::script('harmony/js/fileinput.js') !!}
        {!! Html::script('harmony/js/chartData.js') !!}
        {!! Html::script('harmony/js/tinymce/tinymce.min.js') !!}
        {!! Html::script('harmony/js/amchart/amcharts.js') !!}
        {!! Html::script('harmony/js/amchart/serial.js') !!}
        {!! Html::script('harmony/js/amchart/pie.js') !!}
        {!! Html::script('harmony/js/amchart/animate.min.js') !!}
        {!! Html::script('harmony/js/amchart/responsive.min.js') !!}
        {!! Html::script('harmony/js/main.js') !!}
    </body>
</html>
