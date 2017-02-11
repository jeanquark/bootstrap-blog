@extends('layouts.layoutBack')

@section('css')
	<!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">
@stop

@section('content')
	<ol class="breadcrumb">
        <li>
            <i class="fa fa-commenting-o"></i>  <a href="{{ route('admin.contact.index') }}">Contacts</a>
        </li>
        <li class="active">
            <i class="fa fa-eye"></i> Show
        </li>
    </ol>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <p class="lead">
            	{{ $contact->name }} <br />
                {{ $contact->email }} <br />
                Sent on {{ $contact->created_at->format('F d, Y \a \t g:i A') }} <br />
                @if ($contact->is_read)
                    <small>This message is marked as read <span class="fa fa-check-square-o"></span></small>
                @else
                    <small>This message is marked as unread <span class="fa fa-square-o"></span></small>
                @endif
            </p>
            <hr>
            <p class="well">{{ $contact->message }}</p>
        </div><!-- /. col-md-6 -->
    </div><!-- /. row -->
@stop