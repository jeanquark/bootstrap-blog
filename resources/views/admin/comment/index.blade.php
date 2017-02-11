@extends('layouts.layoutBack')

@section('content')
	<ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-comment"></i> Comments
        </li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the current Comments
                </div><!-- /. panel-heading -->

                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="comments_post">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th>Published</td>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ substr($comment->message, 0, 50) }} [...]</td>
                                    @if ($comment->is_published)
                                    	<td class="success text-center">Yes</td>
                                    @else
                                    	<td class="danger text-center">No</td>
                                    @endif
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        <a class="btn btn-small btn-info" href="{{ URL::to('admin/comment/' . $comment->id . '/edit') }}" style="margin: 5px;">Edit this Comment</a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /. panel-body -->
            </div><!-- /. panel panel-default -->
        </div><!-- /. col-lg-12 -->
    </div><!-- /. row -->

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-comments"></i> Replies
        </li>
    </ol>

    <a name="replies"></a><!-- This is a tag to redirect links to this portion of the page -->
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the current Replies
                </div><!-- /.panel-heading -->

                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="replies_table">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th>Published</td>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($replies as $reply)
                                <tr>
                                    <td>{{ $reply->id }}</td>
                                    <td>{{ $reply->name }}</td>
                                    <td>{{ substr($reply->message, 0, 50) }} [...]</td>
                                    @if ($reply->is_published)
                                        <td class="success text-center">Yes</td>
                                    @else
                                        <td class="danger text-center">No</td>
                                    @endif
                                    <td>{{ $reply->created_at }}</td>
                                    <td>
                                        <a class="btn btn-small btn-info" href="{{ URL::to('admin/reply/' . $reply->id . '/edit') }}" style="margin: 5px;">Edit this Reply</a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /. panel-body -->
            </div><!-- /. panel panel-default -->
        </div><!-- /. col-lg-12 -->
    </div><!-- /. row -->
@stop