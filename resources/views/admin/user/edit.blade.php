@extends('layouts.layoutBack')

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i>  <a href="{{ route('admin.user.index') }}">Users</a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Edit
        </li>
    </ol>

    <div class="row">
		<div class="col-md-6 col-md-offset-3">
			
			<h2 class="">Edit {{ $user->name }}</h2>

			{!! Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'PATCH']) !!}
				
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, array('class' => 'form-control')) !!}
                </div>

	            {!! Form::submit('Edit User', array('class' => 'btn btn-primary')) !!}
	            <a href="{{ route('admin.user.index') }}" class="btn btn-default">Cancel</a>

	        {!!Form::close()!!}
		        
		</div><!-- /. col-md-6 -->
	</div><!-- /. row -->
@stop