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
            <i class="fa fa-pencil"></i> Edit
        </li>
    </ol>

    <div class="row">
		<div class="col-md-8 col-md-offset-2">

			{!! Form::model($tag, array('route' => array('admin.tag.update', $tag->id), 'method' => 'PUT')) !!}
	            <h2 class="">Edit Tag</h2>
		 
	            <div class="form-group">
	            	{!! Form::label('name', 'Name') !!}    
                    {!! Form::text('name', $tag->name, array('class' => 'form-control', 'placeholder' => 'Name')) !!}
	            </div>

	            <div class="form-group">
	                {!! Form::label('slug', 'Slug') !!}
	                {!! Form::text('slug', $tag->slug, array('class' => 'form-control', 'placeholder' => 'Slug')) !!}
	            </div>
				
				<div class="form-group">
	                {!! Form::label('color', 'Tag color') !!}&nbsp;<span style="background: <?php echo $tag->color; ?>; padding-right: 20px;"></span>
	                {!! Form::text('color', $tag->color, array('class' => 'form-control color', 'placeholder' => 'Color')) !!}
	            </div>

	            {!! Form::submit('Edit Tag', array('class'=>'btn btn-primary')) !!}
	            <a href="{{ route('admin.tag.index') }}" class="btn btn-default">Cancel</a>
	            
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