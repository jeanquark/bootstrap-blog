@extends('layouts.layoutBack')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/highlight.js/latest/styles/github.min.css">
@stop

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-file-text"></i>  <a href="{{ route('admin.post.index') }}">Posts</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Edit
        </li>
    </ol>

    <div class="row">
		<div class="col-md-8 col-md-offset-2">

			{!! Form::model($post, array('route' => array('admin.post.update', $post->id), 'method' => 'PUT', 'files' => true)) !!}
	            <h2 class="">Edit Post</h2>
		 
	            <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
                    {!! Form::label('title', 'Title') !!}
                    {!! Form::text('title', $post->title, array('class' => 'form-control', 'placeholder' => 'Title')) !!}
                </div>

	            <div class="form-group {{ ($errors->has('slug')) ? 'has-error' : '' }}">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', $post->slug, array('class' => 'form-control', 'placeholder' => 'Slug')) !!}
                </div>
				
                <div class="form-group">
	                {!! Form::label('image', 'Upload Image') !!}
	                @if (!empty($post->image_path))
	                	<a class="" href="{{ $post->image_path }}">
	            			<img src="{{ asset($post->image_path) }}" class="img-responsive" alt="" height="120" width="120"/> 
	            		</a><br/>
	            	@else
	            		<p>No image</p>
	            	@endif
	                {!! Form::file('image') !!}
	            </div>

                <div class="form-group" style="">
                    {!! Form::label('tags', 'Link tags') !!}
                    {!! Form::select('tags', $tags, $selected_tags, ['class' => 'tags form-control chosen-select', 'name' => 'tags[]', 'multiple tabindex' => 6]) !!}
                </div>

		        <div class="form-group">
		        	{!! Form::label('text', 'Text') !!}
		        	{!! Form::textarea('text', $post->content_raw, Input::old('text')) !!}
		        </div>

                <div class="form-group">
                	{!! Form::label('published', 'Published') !!}<br/>
                	@if ($post->is_published)
                		<label class="radio-inline">
	                    	{!! Form::radio('published', 1, 'checked') !!} Yes
	                    </label>
	                    <label class="radio-inline">
							{!! Form::radio('published', 0) !!} No
						</label>
					@else 	
                    	<label class="radio-inline">
                    		{!! Form::radio('published', 1) !!} Yes
                    	</label>
                    	<label class="radio-inline">
                    		{!! Form::radio('published', 0, 'checked') !!} No
                    	</label>
					@endif
                </div>

	            {!! Form::submit('Edit the Post', array('class'=>'btn btn-primary')) !!}
	            <a href="{{ route('admin.post.index') }}" class="btn btn-default">Cancel</a>
	            
			{!! Form::close() !!}

	    </div><!-- /. col-md-8 -->
    </div><!-- /. row -->
@stop

@section('scripts')
	<script>
    	var simplemde = new SimpleMDE({
    		element: document.getElementById("text"),
			renderingConfig: {
		        singleLineBreaks: false,
		        codeSyntaxHighlighting: true,
		    },
		});
	</script>

	<!-- highlight.js -->
	<script src="https://cdn.jsdelivr.net/highlight.js/latest/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML"></script>
@stop