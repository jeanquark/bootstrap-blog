@extends('layouts.layoutBack')

@section('css')
    <style>
        .table th, td {
          overflow: hidden;
          text-overflow: ellipsis;
          white-space: nowrap;
        }
    </style>
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-tags"></i> Tags
        </li>
    </ol>
	<ul class="nav navbar-nav">
        <li><a href="{{ route('admin.tag.index') }}">View All Tags</a></li>
        <li><a href="{{ route('admin.tag.create') }}">Create a Tag</a>
    </ul>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the current Tags
                </div><!-- /.panel-heading -->

                <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover" id="tags_table">
                            <thead>
                                <tr>
                                    <th valign="middle">ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Color</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($tags as $tag)
	                                <tr>
	                                    <td>{{ $tag->id }}</td>
	                                    <td>{{ $tag->name }}</td>
	                                    <td>{{ $tag->slug }}</td>
                                        <td style="background-color: <?php echo $tag->color; ?>"></td>
	                                    <td>{{ $tag->created_at }}</td>
	                                    <td style="">
	                                    	<form method="POST" action="{{ URL::to('admin/tag/' . $tag->id) }}" id="tagForm" accept-charset="UTF-8">
                                                <a class="btn btn-small btn-info" href="{{ URL::to('admin/tag/' . $tag->id . '/edit') }}" style="margin: 5px;">Edit this Tag</a>
                                                <input name="_method" type="hidden" value="DELETE">
                                                <input name="_token" value="{{ csrf_token() }}" type="hidden">
                                                <input class="btn btn-small btn-warning" value="Delete this tag" style="margin: 5px;" type="submit">
                                            </form>
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

@section('scripts')
    <script>
        $('.btn-warning').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this tag!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              cancelButtonText: "No, cancel plx!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                console.log('confirmed!');
                form.submit();
              } else {
                swal("Cancelled", "Your tag is safe :)", "error");
              }
            });
        });
    </script>
@stop