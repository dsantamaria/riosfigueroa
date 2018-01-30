@extends('layouts.app')
@section('content')
    <div class="col-md-12">

        <h2 class="page-title">Subir Nueva Imagen</h2>
        <div class="col-md-8 col-md-offset-2">
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
							<div class="form-group">
			                    <label class="col-md-3 control-label">Imagen</label>
			                    <div class="col-md-8">
			                        {!! Form::file('input-image', array('id'=>'input-image')) !!}
			                    </div>
			                </div>
							<div class="form-group">
			                    <label class="col-md-3 control-label">Categoría</label>
			                    <div class="col-md-8">
			                        {{ Form::select('categorias', $categorias, null, ['class' => 'form-control']) }}
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-md-3 control-label">Titulo</label>
			                    <div class="col-md-8">
			                         {!! Form::text('title', '',  array('class' => 'form-control')) !!}
			                    </div>
			                </div>
			                <div class="form-group">
			                    <label class="col-md-3 control-label">Descripción</label>
			                    <div class="col-md-8">
			                         {!! Form::textarea('description', '',  array('class' => 'form-control')) !!}
			                    </div>
			                </div>
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
    </div>
@stop