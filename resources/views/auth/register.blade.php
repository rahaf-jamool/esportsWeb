@extends('layouts.app')
<style>

.password-field #toggler1  {
  position: absolute;
  right: 20px;
  top: 23px;
  transform: translateY(-50%);
  cursor: pointer;
}
input[type=radio]{
    height: 20px;
}
label {
    margin-bottom: 0px !important;
}
.nav-tabs{
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}
.nav-tabs>li {
    width:50%;
    background-color: transparent !important;
    border-color: transparent !important;
}
.nav-tabs .li.active{
    background-color: transparent !important;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}
.nav-tabs .nav-link.active{
    background-color: transparent !important;

}
.nav-link{
    color: #555 !important;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
    color: #08ac9c !important;
}
</style>

@section('content')
{{-- {{dd($errors)}} --}}
<div class="container">
<div class="bs-example">
    <ul class="nav nav-tabs">
        <li class="nav-item active">
            <a href="#loginForm" class="nav-link " data-toggle="tab">Login</a>
        </li>
        <li class="nav-item">
            <a href="#registerForm" class="nav-link" data-toggle="tab">Register</a>
        </li>
    </ul>
    <div class="tab-content" style="padding-top: 50px;">
        <div class="tab-pane fade show active" id="loginForm">
        <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{!! trans('auth.login') !!}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{!! trans('auth.email') !!}</label>
                            <div class="col-md-6">
                                <input id="text" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{!! trans('auth.password') !!}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                <span><i id="toggler1"class="fa fa-eye"></i></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group d-none">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {!! trans('auth.remember-me') !!}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {!! trans('auth.login') !!}
                                </button>
                                {{-- <a class="btn btn-link d-none" href="{{ url(App::getLocale() . '/password/reset') }}"> --}}
                                <a class="btn btn-link" href="{{ url(App::getLocale() . '/password/reset') }}">
                                    {!! trans('auth.forgot') !!}
                                </a>
                            </div>
                        </div>
                        <div class="form-group px-3 px-md-5">
                            @include('layouts.message')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tab-pane fade" id="registerForm">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{!! trans('auth.register') !!}</div>
                <div class="panel-body">
                    @include('layouts.message')
                    <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="type" class="col-md-4 control-label">Type</label>
                            <div class="col-md-6" style="display: flex; align-items: center;">
                                  <input type="radio" id="member" name="type" value="member" checked>
                                  <label for="member">Personal</label><br>
                                  <input type="radio" id="company" name="type" value="company">
                                  <label for="compnay">Company</label>
                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{trans('auth.name')}}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{trans('auth.email')}}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">{{trans('auth.phone')}}</label>
                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('responsiblePersonName') ? ' has-error' : '' }} companyinfo" style="display: none;">
                            <label for="responsiblePersonName" class="col-md-4 control-label">Responsible Name</label>
                            <div class="col-md-6">
                                <input id="responsiblePersonName" type="text" class="form-control" name="responsiblePersonName">
                                @if ($errors->has('responsiblePersonName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('responsiblePersonName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('responsiblePersonMobile') ? ' has-error' : '' }} companyinfo" style="display: none;">
                            <label for="responsiblePersonMobile" class="col-md-4 control-label">Responsible Phone</label>
                            <div class="col-md-6">
                                <input id="responsiblePersonMobile" type="text" class="form-control" name="responsiblePersonMobile">
                                @if ($errors->has('responsiblePersonMobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('responsiblePersonMobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{trans('auth.password')}}</label>
                            <div class="col-md-6 password-field">
                                <input id="password" type="password" class="form-control" name="password" required>
                			    <!--  	<span><i id="toggler1"class="fa fa-eye"></i></span> -->
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-md-4 control-label">{{trans('auth.confirm-password')}}</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        {{-- <div class="form-group{{ $errors->has('account-type') ? ' has-error' : '' }}">
                            <label for="account-type" class="col-md-4 control-label">{{trans('auth.account-type')}}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="account-type" id="account-type">
                                    <option value="">{{trans('product.choose')}}</option>
                                    <option value="person">{{trans('auth.person')}}</option>
                                    <option value="corporate">{{trans('auth.corporate')}}</option>
                                </select>
                                @if ($errors->has('account-type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('account-type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('auth.register')}}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group px-3 px-md-5">
                        {{-- @include('layouts.message') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>


</div>
@endsection

<!-- <script type="text/javascript">
      		var password = document.getElementById('password');
			var toggler1 = document.getElementById('toggler1');

			showHidePassword1 = () => {
                      console.log('hi');
            /*     if (password.type == 'password') {
                password.setAttribute('type', 'text');
                toggler1.classList.add('fa-eye-slash');
                } else {
                toggler1.classList.remove('fa-eye-slash');
                password.setAttribute('type', 'password');
                }
            };*/

			document.getElementById('toggler1').addEventListener('click', showHidePassword1);
</script> -->

 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
    $('input[type=radio]').click(function(){


        if (this.value == 'member') {
           // $('.companyinfo').hide();
           $('.companyinfo').fadeOut( "slow");
      //  alert("hi member");
        }
        else if (this.value == 'company') {
            $('.companyinfo').fadeIn( "slow");
           // alert("hi company");
        }
    });
});
</script>
