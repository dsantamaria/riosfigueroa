@extends('layouts.app')
@section('content')
    <div class="col-md-12">

        <h2 class="page-title">Subir Nueva Imagen</h2>

        <div class="panel panel-primary">
            <div class="panel-heading">Subir Imagen</div>
	            <div class="panel-body">
	                @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					{!! Form::open(['route' => 'saveImage','files' => true, 'class' => 'form-horizontal', 'method' => 'POST']) !!}
						{!! Form::file('input-image', array('id'=>'input-image')) !!}
						<div id="errorBlock2" class="help-block file-error-message" style="display: none;"></div>
                    	<div class="hr-dashed"></div>
						<div class="row">
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-primary">Upload Image</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
@stop