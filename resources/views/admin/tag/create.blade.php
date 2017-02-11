@extends('layouts.layoutBack')

@section('css')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.0/css/bootstrap-colorpicker.css">
	<style>
		.colorpicker-2x .colorpicker-saturation {
	        width: 200px;
	        height: 200px;
	    }
	    .colorpicker-2x .colorpicker-hue,
	    .colorpicker-2x .colorpicker-alpha {
	        width: 30px;
	        height: 200px;
	    }
	    .colorpicker-2x .colorpicker-color,
	    .colorpicker-2x .colorpicker-color div{
	        height: 30px;
	    }
	</style>
@stop 

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-tags"></i>  <a href="{{ route('admin.tag.index') }}">Tags</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Create
        </li>
    </ol>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			{!! Form::open(array('route' => 'admin.tag.store', 'method' => 'POST' )) !!}
	            <h2>Create a new Tag</h2>
		 
	            <div class="form-group">
	             	{!! Form::label('name', 'Tag Name') !!}    
                    {!! Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name')) !!}
                </div>

	            <div class="form-group">
	            	{!! Form::label('slug', 'Tag slug') !!}    
                    {!! Form::text('slug', Input::old('slug'), array('class' => 'form-control', 'placeholder' => 'Slug')) !!}
	            </div>

	            <div class="form-group">
	                {!! Form::label('color', 'Tag color') !!}
	                {!! Form::text('color', Input::old('color'), array('class' => 'form-control color', 'placeholder' => 'Color')) !!}
	            </div>

	            {!! Form::submit('Create Tag', array('class'=>'btn btn-primary')) !!}
	           
	        {!! Form::close() !!}

	    </div><!-- /. col-md-8 -->
    </div><!-- /. row -->

@stop

@section('scripts')
	<!-- Color picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.0/js/bootstrap-colorpicker.min.js"></script>
	<script>
		$(function(){
		    $('.color').colorpicker({
           		customClass: 'colorpicker-2x',
	            sliders: {
	                saturation: {
	                    maxLeft: 200,
	                    maxTop: 200
	                },
	                hue: {
	                    maxTop: 200
	                },
	                alpha: {
	                    maxTop: 200
	                }
	            }
		    });
		});
	</script>
@stop