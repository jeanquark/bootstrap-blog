@extends('layouts/layoutFront')

@section('title', 'Homepage')

@section('content')

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>
        
        <!-- Blog post retrieved from DB -->
        @foreach ($posts as $post)
            <h2>
                <a href="{{ url('post', $post->slug, false) }}">{{ $post->title }}</a>
            </h2>

            <p class="lead">
                by <a href="{{ url('user', $hashids->encode($post->user_id), false) }}">{{ $post->user->name }}</a>
                @foreach ($post->tags as $tag)
                    <a href="{{ url('tag', $tag->slug, false) }}" ><span class="badge" style="background-color: {{ $tag->color }}; vertical-align: 25%;">{{ $tag->name }}</span></a>
                @endforeach
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->published_at->format('F d, Y \a\t g:i A') }}</p>
            <hr>
            @if (!empty($post->image_path))
                <img class="img-responsive" src="{{ $post->image_path }}" alt="">
                <hr>
            @endif

            <?php
                $pos1 = substr($post->content_html, 0, 300);
                $pre = strpos($pos1, '<pre>');

                if($pre !== false) {
                    $pos2 = substr($pos1, 0, $pre);
                } else {
                    $pos2 = $pos1;
                }
                $pos3 = substr($post->content_html, 0, strpos($post->content_html, '</p>'));
            ?>
            <p><?php echo $pos3; ?>&nbsp;[...]</p>
            <a class="btn btn-primary" href="{{ url('post', $post->slug, false) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            <hr>

        @endforeach

        <!-- Pager -->
        <ul class="pager">
            @if ($posts->currentPage() > 1)
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
            @if ($posts->hasMorePages())
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

    </div><!-- /. col-md-8 -->

@stop<!-- /. section content -->