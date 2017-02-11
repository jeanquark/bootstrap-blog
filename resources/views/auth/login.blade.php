@extends('layouts/layoutFront')

@section('content')
    <div class="col-md-8">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Added user info for quick login. To be deleted when going live -->
                    <br />
                    <br />
                    @if (App::environment() == 'local')
                        <p>To sign in, please enter :
                            @if (!empty($user = App\User::first()))
                                <ul>
                                    <li>Email: <b><pre>{{ $user->email }}</pre></b></li>
                                    <li>Password: <b><pre>secret</pre></b></li>
                                </ul>
                            @else 
                                <p class="alert alert-danger text-center">No registered user.</p>
                            @endif  
                        </p>
                    @endif
                </div><!-- /. panel-body -->
            </div><!-- /. panel panel-default -->
        </div><!-- /.col-md-10 -->
    </div><!-- /. col-md-8 -->
@endsection