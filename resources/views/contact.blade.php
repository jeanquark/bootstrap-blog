@extends('layouts.layoutFront')

@section('title', 'Contact')

@section('content')
	<div class="col-md-8">
		<div class="col-lg-12 text-center">
            <h3>Contact form</h3>
            <br/>
        </div>
        
        {!! Form:: open(array('route' => 'store_contact', 'method' => 'POST', 'class' => 'form')) !!}
        
            <div class="form-group">
                {!! Form::label ('name', 'Name*' )!!}
                {!! Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Your Name')) !!}
            </div>

            <div class="form-group">
                {!! Form::label ('email', 'E-mail Address*') !!}
                {!! Form::email('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Your E-mail')) !!}
            </div>

            <div class="form-group">
                {!! Form::label ('message', 'Message*' )!!}
                {!! Form::textarea('message', Input::old('message'), array('class'=>'form-control', 'placeholder'=>'Your message')) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Send Message', array('class' => 'btn btn-primary')) !!}
                {!! Form::reset('Clear', array('class' => 'btn btn-default')) !!}
            </div>

        {!! Form:: close() !!}


	</div><!-- /. col-md-8 -->

@stop