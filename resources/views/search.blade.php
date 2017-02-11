@extends('layouts.layoutFront')

@section('title', 'Search')

@section('css')
	<style>
		.highlight { background-color: yellow }
	</style>
@stop

@section('content')
	<!-- Blog Entries Column -->
    <div class="col-md-8">
		
       	<div class="well">
       		<h4 class="text-center">There {{ $count == 0 || $count == 1 ? 'is' : 'are' }} {{ $count }} {{ $count == 0 || $count == 1 ? 'post' : 'posts'}}  corresponding to query <span style="background: yellow;">{{ $query }}</span></h4>
       	</div>
		
		@if (empty($posts->first()))
			<h4 class="text-center">Sorry, no result found. Try again!</h4>
		@else
	        <!-- Blog posts retrieved from DB -->
	        @foreach ($posts as $post)
	            <h2>
	                <a href="{{ url('post', $post->slug, false) }}">{{ $post->title }}</a>
	            </h2>
	            <p class="lead">
	                by <a href="#">{{ $post->user->name }}</a>
	                @foreach ($post->tags as $tag)
	                    <a href="{{ url('tag', $tag->slug, false) }}" ><span class="badge" style="background-color: {{ $tag->color }}; vertical-align: 25%;">{{ $tag->name }}</span></a>
	                @endforeach
	            </p>

	            <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->format('F d, Y \a\t g:i A') }}</p>
				<hr>

				<?php 
					$sentences = preg_split('/[.]/', $post->content_html);
					$extract = [];
					
					foreach($sentences as $sentence) {
				        if (stripos($sentence, $query) !== false) {
				        	$extract[] = $sentence;
				    	}
				    }

				    for ($j = 0; $j < count($extract); $j++) {
				    	if (!preg_match("<pre>", $extract[$j])) {
				    		?><p><?php echo strip_tags($extract[$j] . '. [...]'); ?></p><?php
				    	} else {
				    		?><p><?php echo '[Search element wrapped inside code block]'; ?></p><?php
				    	}
				    }
				    $extract = [];
				?>
				
			    <hr>
	            <a class="btn btn-primary" href="{{ url('post', $post->slug, false) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

	            <hr>
	        @endforeach

	        <!-- Pager -->
	        <ul class="pager">
	            @if ($posts->appends(['search' => $query])->currentPage() > 1)
	                <li class="next">
	                    <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
	                        <i class="fa fa-long-arrow-left fa-lg"></i>    
	                        Newer →
	                     </a>
	                </li>
	            @else       
	                <li class="next disabled">
	                    <a>
	                        <i class="fa fa-long-arrow-left fa-lg"></i>    
	                        Newer →
	                    </a>
	                </li>
	            @endif
	            @if ($posts->appends(['search' => $query])->hasMorePages())
	                <li class="previous">
	                    <a href="{!! $posts->nextPageUrl() !!}">
	                        ← Older
	                        <i class="fa fa-long-arrow-right"></i>
	                    </a>
	                </li>
	            @else   
	                <li class="previous disabled">
	                    <a>
	                        ← Older
	                        <i class="fa fa-long-arrow-right"></i>
	                    </a>
	                </li>
	            @endif
	        </ul>
		@endif
    </div><!-- ./ col-md-8 -->
@stop

@section('scripts')
	<!-- Highlight -->
	<script src="{{ asset('highlight/highlight.js') }}"></script>
	<script>
		$('h2').highlight('<?php echo $query; ?>');
		$('p').highlight('<?php echo $query; ?>');
	</script>
@stop