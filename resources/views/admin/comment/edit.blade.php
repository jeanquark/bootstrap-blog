@extends('layouts.layoutBack')

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-comment"></i>  <a href="{{ route('admin.comment.index') }}">Comments</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Edit
        </li>
    </ol>
    <br/>
	
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			
			@if ($comment->is_published)
				<h4><span class="label label-success" style="border-radius: 10rem;">Status: published</span></h4>
			@else
				<h4><span class="label label-default" style="border-radius: 10rem;">Status: unpublished</span></h4>
			@endif

			<div class="media">
			    <a class="pull-left" href="#">
			        <img class="media-object" src="http://placehold.it/64x64" alt="">
			    </a>
			    <div class="media-body">
			        <h4 class="media-heading">{{ $comment->name }}
			            <small>{{ $comment->created_at->format('F d, Y \a\t g:i A') }}</small><br/>
			        </h4>
			        {{ $comment->message }}
			    </div><!-- /. media-body -->
			</div><!-- /. media -->
			<br/>
			<div>
				{!! Form::model($comment, array('route' => array('admin.comment.update', $comment->id), 'method' => 'PUT', 'style' => 'display:inline;')) !!}
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
		            @if ($comment->is_published) 
				    	<input class="btn btn-info" value="Unpublish" type="submit">
				    @else 
						<input class="btn btn-success" value="Publish" type="submit">
					@endif
				{!! Form::close() !!}
					
				{!! Form::model($comment, array('route' => array('admin.comment.destroy', $comment->id), 'method' => 'DELETE', 'id' => 'commentForm', 'style' => 'display:inline;')) !!}
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
					<input class="btn btn-small btn-warning" value="Delete this comment" style="margin: 5px;" type="submit">
				{!! Form::close() !!}

				<a href="{{ route('admin.comment.index') }}" class="btn btn-default">Cancel</a>
			</div>

			<hr>

		    <h3>Post related to this comment:</h3>
			<h1>{{ $post->title }}</h1>
			<!-- Author -->
			<p class="lead">
			    by {{ $post->user->first_name }} {{ $post->user->last_name }}
			</p>
			<hr>
			<!-- Date/Time -->
			<p><span class="glyphicon glyphicon-time"></span> {{ $post->created_at->format('F d, Y \a\t g:i A') }}</p>
			<hr>
			@if(!empty($post->image_path))
				<!-- Preview Image -->
				<img class="img-responsive" src="{{ asset($post->image_path) }}" alt="post image">
			@endif
			<hr>
			<p><?php echo $post->content_html; ?></p>
			
		</div><!-- /. col-md-6 -->
	</div><!-- /. row -->
@stop

@section('scripts')
	<script>
		$('.btn-warning').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRedirect();
        });

        function warnBeforeRedirect() {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this comment!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false 
            },
            function(isConfirm) {
                if (isConfirm) {                        
                    form.submit();
                } else {
                    swal("Cancelled", "Your comment is safe :)", "error");
                }
            });
        }
    </script>
@stop