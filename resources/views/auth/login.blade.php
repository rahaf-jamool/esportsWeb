@extends('layouts.app')

@section('content')

@section('title' , config('app.name'). " - ". trans('auth.login'))
    @section('og-description' , config('app.description'))
@section('description', config('app.description'))
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-".  trans('auth.login'))
@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))

@section('content')
    <section class="login_part">
        login
        {{-- <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-lg-offset-3">
                    @if(Session::has('csrf_error'))
                        <div class="alert alert-danger text-center">
                            {{ Session::get('csrf_error') }}
                        </div>
                    @endif
                    @if(Session::has('locked'))
                        <div class="alert alert-danger text-center">
                            {{ config('app.close_letter') }}
                        </div>
                    @endif
                    @if( isset($details))
                        <div class="details">
                            {{ $details }}
                        </div>
                    @endif
                    @if ($errors->any())
                        {!! implode('', $errors->all('<h6 class="alert alert-danger">:message</h6>'))  !!}
                    @endif
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <form class="row contact_form" method="POST" action="{{ url(App::getLocale() . '/login') }}"  novalidate="novalidate">
                                {{ csrf_field()}}
                                <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="email" value=""
                                        placeholder="{{ trans('all.username') }}">
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input type="password" class="form-control" id="password" name="password" value=""
                                        placeholder="{!! trans('auth.password') !!}">
                                </div>
                                <div class="col-md-12 form-group">
                                    <div class="creat_account d-flex align-items-center">
                                        <input type="checkbox" id="f-option" name="remember">
                                        <label for="f-option">{!! trans('auth.remember-me') !!}</label>
                                    </div>
                                    <button type="submit" value="submit" class="btn btn-primary">
                                        {!! trans('auth.login') !!}
                                    </button>
                                    <a class="lost_pass" href="{{ url('/password/reset') }}">{{ trans('auth.forgot') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
@endsection


{{-- <div class="container">
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
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {{trans('auth.register')}}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group px-3 px-md-5">
                        {{-- @include('layouts.message')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
        </div>

    </div>
</div>


</div> --}}

 {{-- <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
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
</script> --}}
