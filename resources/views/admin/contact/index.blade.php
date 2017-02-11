@extends('layouts.layoutBack')

@section('css')
	<!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">
@stop

@section('content')
	<ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-comment"></i> Contacts
        </li>
    </ol>
	<ul class="nav navbar-nav">
        <li><a href="{{ route('admin.contact.index') }}">View All Contacts</a></li>
    </ul>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the current Contacts
                </div><!-- /.panel-heading -->

                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="contacts_table" style="visibility:hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Read?</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach($contacts as $contact)
                                <tr class="@if($contact->is_read) warning @endif">
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ substr($contact->message, 0, 50) }} [...]</td>
                                    <td class="text-center"><input type="checkbox" class="read" data-id="{{$contact->id}}" @if ($contact->is_read) checked @endif></td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $contact->created_at)->diffForHumans() }}</td>
                                    <td style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {!! Form::open(array('route' => array('admin.contact.destroy', $contact->id), 'method' => 'POST', 'id' => 'contactForm' )) !!}
                                            <a class="btn btn-small btn-success" href="{{ URL::to('admin/contact/' . $contact->id) }}" style="margin: 5px;">Show this Message</a>
                                            <input name="_method" type="hidden" value="DELETE">
                                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                                            <input class="btn btn-small btn-warning" value="Delete this Message" style="margin: 5px;" type="submit">
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /. panel-body -->
                <div class="text-center">
                	{{ $contacts->links() }}
            	</div>
            </div><!-- /. panel panel-default -->
        </div><!-- /. col-lg-12 -->
    </div><!-- /. row -->
@stop

@section('scripts')
	<script>
        $(window).load(function(){
            $('#contacts_table').removeAttr('style');
        })
    </script>
	<!-- icheck checkboxes -->
    <script type="text/javascript" src="{{ asset('icheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.read').iCheck({
                checkboxClass: 'icheckbox_square-yellow',
                radioClass: 'iradio_square-yellow',
                increaseArea: '20%'
            });
            $('.read').on('ifClicked', function(event){
                id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: "{{ URL::route('readStatus') }}",
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': id
                    },
                    success: function(data) {
                        // empty
                    },
                });
            });
            $('.read').on('ifToggled', function(event) {
                $(this).closest('tr').toggleClass('warning');
            });
        });
        
    </script>

    <script>
        $('.btn-warning').click(function(e) {
            e.preventDefault(); // Prevent the href from redirecting directly
            form = $(this).closest('form');
            warnBeforeRedirect();
        });

        function warnBeforeRedirect() {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this message!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false 
            },
            function(isConfirm) {
                if (isConfirm) {                        
                    form.submit();
                } else {
                    swal("Cancelled", "Your message is safe :)", "error");
                }
            });
        }
    </script>
@stop