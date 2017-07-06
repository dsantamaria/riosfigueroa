@extends('layouts.app')
@section('content')

	@if (count($errors) > 0)
		<div class="alert alert-danger col-xs-10 col-xs-offset-1">
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
    
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-primary" style="overflow: visible;">
            <div class="panel-heading">Agregar suscriptores</div>
            <div class="panel-body">
                {!! Form::open(['method'=>'post','route'=>'sendSubscriptionEmail',
                'class'=>'form-horizontal'])  !!}
                <div class="form-group">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-8">
                            {!! Form::email('email', '',  array('id' => 'email', 'class' => 'form-control', 'required' => 'required')) !!}
                    </div>
                </div>
                <div class="hr-dashed"></div>
                <div class="form-group">
                    <div class="col-md-4 col-md-offset-5">
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop