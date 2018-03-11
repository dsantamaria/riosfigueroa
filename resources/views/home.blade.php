@extends('layouts.app')

@section('content')
    {!! Html::style('harmony/css/reset-css.css') !!}
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">Dashboard</div>

            <div class="panel-body unset-all">
            	@can('admin-role')
	                {!! Form::open(['route' => 'SaveCustomNotes','class' => 'form-horizontal', 'method' => 'POST']) !!}
	                    {!! Form::text('custom_notes', $custom_notes,  array('id' => 'custom_notes', 'class' => 'form-control')) !!}
	                    <div class="hr-dashed"></div>
		                <div class="form-group">
		                    <div class="col-md-4 col-md-offset-5">
		                        <button class="btn btn-primary" type="submit">Salvar Notas</button>
		                    </div>
		                </div>
	                {!! Form::close()  !!}
                @endcan
                @can('user-role')
                	{!! $custom_notes !!}
                @endcan
                @can('special-role')
                	{!! $custom_notes !!}
                @endcan
            </div>
        </div>
    </div>
@endsection
