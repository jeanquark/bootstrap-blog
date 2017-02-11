@extends('layouts.layoutBack')

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i>  <a href="{{ route('admin.user.index') }}">Users</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Show
        </li>
    </ol>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the current Users
                </div><!-- /. panel-heading -->

                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="users_table">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>
                                </tr>
                        </tbody>
                    </table>
                </div><!-- /. panel-body -->
            </div><!-- /. panel panel-default -->
        </div><!-- /. col-lg-12 -->
    </div><!-- /. row -->
@stop