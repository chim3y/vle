@extends('layouts.app')

@section('content')
<br/>
<br/>
<br/>
<br/>
<br/>

<div class="container" style="background: url("/assests/img/") no-repeat fixed center center;">
    <div class="row">
         <div class="col-md-7 col-md-offset-2">

            <div class="panel panel-default">
                 <div class="panel-heading" style="background-color: white">   <img src="/assets/img/logo.png" style="height: 150px; width: 130px"> </img>   <img src="/assets/img/logo11.png"></img></div>
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
                                <input id="password" type="password" class="form-control" id="password" name="password" required>
                                
                      

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                     

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                                    </label>
                                </div>
                                 <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                    <div class="col-md-offset-1">
                    <a href="{{ URL::route('admin.login') }}" style="color:black"> Admin Login </a> 
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>

     

@endsection
