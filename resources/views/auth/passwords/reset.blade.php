@extends('layouts.master')
<!-- Main Content -->
@section('content')
<style>
    .panel {
    margin-bottom: 22px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
}
.panel-default {
    border-color: #d3e0e9;
}
.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}
.panel-body {
    padding: 15px;
}
.panel-default>.panel-heading {
    color: #333;
    background-color: #fff;
    border-color: #d3e0e9;
}

</style>

<!-- Start header -->
<div class="about-header m-0">
    <div class="title-about"></div>
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/7.jpg')) }} " alt="header">
    </div>
</div>

<div class="container">
    <div class="row" style="justify-content: center;align-items: center; min-height: 600px;">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.reset-password') }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{-- Check For Session Error Messages--}}
                    @if (session('error'))
                        <div class="alert alert-danger my-2">{{ session('error') }}</div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/password/reset') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{!! trans('auth.email') !!}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <div class="alert alert-danger mt-3">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{!! trans('auth.password') !!}</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="alert alert-danger mt-3">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">{!! trans('auth.confirm-password') !!}</label>
                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <div class="alert alert-danger mt-3">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">{!! trans('auth.reset-password') !!}</button>
                            </div>
                        </div>
                    </form>
                </div><!--panel-body-->
            </div><!--.panel-->
        </div>
    </div><!--row-->
</div><!--.container-->
@endsection
