@extends('layouts.layoutBack')

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-users"></i>  <a href="{{ route('admin.user.index') }}">Users</a>
        </li>
        <li class="active">
            <i class="fa fa-plus-square"></i> Create
        </li>
    </ol>

    <div class="row">
		<div class="col-md-6 col-md-offset-3">
			
			<h2 class="">Create a new User</h2>

			{!!Form::open(['route' => 'admin.user.index', 'method' => 'POST', 'class' => 'clearfix']) !!}
				
                <div class="form-group">
                    {!! Form::label('email', 'Email*') !!}    
                    {!! Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Email')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password*') !!}
                    {!! Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password_confirmation', 'Confirm Password*') !!}
                    {!! Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) !!}
                </div>
                
                {!! Form::submit('Create User', array('class' => 'btn btn-primary'))!!}
                <a href="{{ route('admin.user.index') }}" class="btn btn-default">Back to Users</a>

            {!!Form::close()!!}

	    </div><!-- /. col-md-6 -->
    </div><!-- /. row -->
@stop