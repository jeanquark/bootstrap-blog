@if ($message = Session::get('success'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{!! $message !!}
	</div>
	{{ Session::forget('success') }}
@endif

@if ($message = Session::get('error'))
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Error:</strong> {!! $message !!}
	</div>
	{{ Session::forget('error') }}
@endif

@if ($message = Session::get('warning'))
	<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{!! $message !!}
	</div>
	{{ Session::forget('warning') }}
@endif

@if ($message = Session::get('info'))
	<div class="alert alert-info alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>FYI:</strong> {!! $message !!}
		</div>
	{{ Session::forget('info') }}
@endif

<!-- Added field -->
@if ($errors->any())        
    <div class='flash alert alert-danger alert-dismissable'> 
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>         
        @foreach ( $errors->all() as $error )               
            <p>{{ $error }}</p>         
        @endforeach     
    </div>  
@endif