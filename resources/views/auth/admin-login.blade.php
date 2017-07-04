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
                <div class="panel-heading" style="background-color: white"> 
             
                 <img src="/assets/img/logo.png" style="height: 150px; width: 130px"> </img>   <img src="/assets/img/logo1.png"></img>

                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      

                            <div class="col-md-7 col-md-offset-3">
                                <input id="email" type="email" class="form-control" placeholder="Email-Address" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                         

                            <div class="col-md-7 col-md-offset-3">
                                <input id="password" type="password" placeholder="Password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary form-control">
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
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<br/>

 

@endsection
