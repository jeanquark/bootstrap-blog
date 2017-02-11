<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/blog-home.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .navbar-inverse .navbar-header>.active>a {
            color: #fff;
            background-color: #080808;
        }
    </style>

    @yield('css')

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="{{ active_class(if_uri(['/', 'home'])) }}">
                    <a class="navbar-brand" href="{{ route('home') }}">Home</a>
                </span>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{ active_class(if_uri(['about'])) }}">
                        <a href="{{ route('about') }}">About</a>
                    </li>
                    <li class="{{ active_class(if_uri(['services'])) }}">
                        <a href="{{ route('services') }}">Services</a>
                    </li>
                    <li class="{{ active_class(if_uri(['contact'])) }}">
                        <a href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="{{ active_class(if_uri(['login'])) }}"><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('admin.index') }}">Admin</a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

            </div><!-- /. navbar-collapse -->
            
        </div><!-- /. container -->
        
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            
            <!-- Notifications -->
            @include('notifications.notifications')

            <!-- Content -->
            @yield('content')

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <div class="well">
                    <h4>Blog Search</h4>
                    {!! Form::open(['method'=>'GET','url'=>'search','class'=>'','role'=>'search'])  !!} 
                        <div class="input-group">
                            {!! Form::text('search', isset($query) ? $query : NULL, array('class' => 'form-control', 'placeholder' => 'Search...')) !!}
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    {!! Form::close() !!}
                </div><!-- /. well -->

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            @foreach ($tags as $tag)
                                <span style="margin:5px 10px 5px 0px; display: inline-block;"><a href="{{ url('tag', $tag->slug, false) }}" style=""><span class="badge" style="padding: 5px 10px; background: {{ $tag->color }}">{{ $tag->name }}</span></a></span>
                            @endforeach
                        </div>
                        <br/>
                    </div><!-- /. row -->
                </div><!-- /. well -->

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <img class="img-circle img-responsive pull-right" src="http://placehold.it/200x200">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div><!-- /. col-md-4 -->

         </div><!-- /. row -->

        <!-- Footer -->
        <hr>
        <footer>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Your Website <?php echo date("Y"); ?></p>
                </div><!-- /. col-lg-12 -->
            </div><!-- /. row -->
        </footer>

    </div><!-- /. container -->
    
    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    
    @yield('scripts')

</body>
</html>