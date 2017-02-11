<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Chosen -->
    <link href="https://harvesthq.github.io/chosen/chosen.min.css" rel="stylesheet">
    
    <!-- Markdown editor -->
    <link href="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.css" rel="stylesheet">

    <!-- Sweetalert -->
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css') }}" rel="stylesheet">

    <!-- toastr notifications -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        body {
            height: 100%;
            background-color: #fff;
        }
        pre {
            border: none;
            background: #fff;
            padding: 0;
        }
        pre code {
            border-radius: 20px;
            overflow: auto;
            word-wrap: normal;
            white-space: pre;
        }

        /* Panel */
        .panel-lightblue {
            border-color: #5bc0de;
        }

        .panel-lightblue > .panel-heading {
            border-color: #5bc0de;
            color: #fff;
            background-color: #5bc0de;
        }

        .panel-lightblue > a {
            color: #5bc0de;
        }

        .panel-lightblue > a:hover {
            color: #31b0d5;
        }
        .table-bordered tbody tr td {
            vertical-align: middle;
        }
    </style>

    @yield('css')

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand pull-left" href="{{ route('home') }}">Back to site</a>
            </div><!-- /.navbar-header -->

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    @if (Auth::check())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->email }} <b class="caret"></b></a>
                    @else
                        <a href="#">You are not logged in</a>
                    @endif
                    <ul class="dropdown-menu">

                        @if (Auth::check())
                            <li>
                                <a href="{{ route('logout') }}">Logout</a>
                            </li>
                        @endif

                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="{{ active_class(if_route(['admin.index'])) }}">
                        <a href="{{ route('admin.index') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="{{ active_class(if_route(['admin.post.index', 'admin.post.create', 'admin.post.edit', 'admin.post.show'])) }}">
                        <a href="{{ route('admin.post.index') }}"><i class="fa fa-fw fa-file-text-o"></i> Manage Posts</a>
                    </li>
                    <li class="{{ active_class(if_route(['admin.tag.index', 'admin.tag.create', 'admin.tag.edit', 'admin.tag.show'])) }}">
                        <a href="{{ route('admin.tag.index') }}"><i class="fa fa-fw fa-tags"></i> Manage Tags</a>
                    </li>
                    <li class="{{ active_class(if_route(['admin.comment.index', 'admin.comment.create', 'admin.comment.edit', 'admin.comment.show', 'admin.reply.edit'])) }}">
                        <a href="{{ route('admin.comment.index') }}"><i class="fa fa-fw fa-comments"></i> Manage Comments</a>
                    </li>
                    <li class="{{ active_class(if_route(['admin.contact.index', 'admin.contact.show'])) }}">
                        <a href="{{ route('admin.contact.index') }}"><i class="fa fa-fw fa-commenting-o"></i> Contact form (<?php echo App\Contact::where('is_read', '=', 0)->count(); ?>)</a>
                    </li>
                    <li class="{{ active_class(if_route(['admin.user.index', 'admin.user.create', 'admin.user.edit', 'admin.user.show'] )) }}">
                        <a href="{{ route('admin.user.index') }}"><i class="fa fa-fw fa-users"></i> Manage Users</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Notifications -->
                @include('notifications.notifications')

                <!-- /.content -->
                @yield('content')

            </div><!-- /.container-fluid -->

        </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Select Chosen -->
    <script src="https://harvesthq.github.io/chosen/chosen.jquery.min.js"></script>
    <script>
        $(function() {
            $('.chosen-select').chosen({max_selected_options: 3});
            $('.chosen-select-deselect').chosen({ allow_single_deselect: true });
        });
    </script>

    <!-- Markdown editor -->
    <script src="//cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    
    <!-- Sweetalert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <!-- toastr notifications -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    @yield('scripts')

</body>
</html>