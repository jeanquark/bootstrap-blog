@extends('layouts.layoutBack')

@section('content')
	<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12" style="">
            <h1 class="page-header">
                Dashboard <small>Statistics Overview</small>
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard
                </li>
            </ol>
        </div>
    </div><!-- /.row -->
	
    <div class="row">
        <div class="col-md-2 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($posts) }}</div>
                            <div>Unpublished posts!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.post.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comment fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($comments) }}</div>
                            <div>Unpublished comments!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.comment.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-lightblue">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($replies) }}</div>
                            <div>Unpublished replies!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('admin/comment#replies') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-commenting-o fa-4x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ count($contacts) }}</div>
                            <div>Unread messages!</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.contact.index') }}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div><!-- /. row -->

@stop