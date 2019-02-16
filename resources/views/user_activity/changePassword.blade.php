@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h2 class="page-title">Cambiar Contraseña</h2>
    <div class="col-md-12">


        {!! Form::open(['route' => 'savePassword', 'class'=>'form-horizontal', 'method' => 'POST']) !!}

        	 <div class="form-group">
                <label class="col-md-2 col-md-offset-2 control-label label-name-product">Contraseña</label>
                <div class="col-md-4">
                    {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required' => 'required']) }}
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 col-md-offset-2 control-label label-name-inter">Confirmar Contraseña</label>
                <div class="col-md-4">
                    {{ Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'required' => 'required']) }}
                </div>
            </div>
            </div>
            <div class="form-group">
                <div class="col-md-4 col-md-offset-5">
                    <button class="btn btn-primary" type="submit">Cambiar Contraseña</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection