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
    </head>

    <body oncopy='return false' oncut='return false' class="hidden-print">
        <div class="brand clearfix">
            <a href="#" class="logo">Sistema de Manejo de Precios</a>
            @if (Auth::check())
                <ul class="ts-profile-nav">
                    <li><a href="{{ url('/logout') }}">Cerrar Sesión</a></li>
                </ul>
            @endif
        </div>
        <div class="ts-main-content">
            <div class="content-wrapper" style="margin-left: 0px">
                <div class="container-fluid">
                    @if (Session::has('success'))
                        <div class="row">
                            <div class="alert alert-dismissible alert-success col-xs-10 col-xs-offset-1">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                <strong>{{Session::get('success')}}</strong>
                            </div>
                        </div>
                    @endif
                    @if (Session::has('warning'))
                        <div class="row">
                            <div class="alert alert-dismissible alert-warning col-xs-10 col-xs-offset-1">
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
