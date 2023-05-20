@php
    $floatRight = App::getLocale() == 'en' ? 'float:right;' : 'float:left;';
@endphp
@extends('layouts.master')
@section('keywords' , config('app.keywords'))
@section('og-url' , url(Request::url()))
@section('container' , 'container-fluid-custom')
@section('page-style', asset('assets/css/electronic-services.css'))

@section('content')
    <div class="container clubRegistration">
        <div class="row pt-5">
            <h1> {!! trans('individually.register-Follower-account') !!}</h1>
            <p>{!! trans('institutions.Ifyouhaveaccount') !!}<a class="login" href="{{ url(App::getLocale() . '/login') }}">{!! trans('institutions.loginpage') !!}</a>.</p>

            <div class="col-12 col-lg-9">
                @include('layouts.message')
                <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="account-type" value="WebSite-Follower">
                    <h4>{!! trans('individually.follower-data') !!}</h4>
                    <hr>
                    <div class="form-group{{ $errors->has('uaeResidency') ? ' has-error' : '' }}">
                        {{-- <span class="asterisks">*</span><label for="state" class="col-11 control-label pb-2 pt-2">{{trans('individually.place-of-residence')}}</label> --}}
                        <div class="col-sm-12 col-lg-9 radio-btn">
                            <label class="radio-inline">
                                <input type="radio" name="uaeResidency" value="1" style="" checked="checked">{{trans('individually.inside-state')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="uaeResidency" value="0">{{trans('individually.out-country')}}
                            </label>
                            @if ($errors->has('uaeResidency'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('uaeResidency') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="firstName" class="col-11 control-label  pb-2 pt-2">{{trans('individually.name')}}</label>
                        <div class="col-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="email" class="col-11 control-label pb-2 pt-2">{{trans('auth.email')}}</label>
                        <div class="col-12">
                            <input id="email" type="email" class="form-control" name="email" value="" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

{{--                    <div class="form-group{{ $errors->has('userName') ? ' has-error' : '' }}">--}}
{{--                        <span class="asterisks">*</span><label for="userName" class="col-11 control-label pb-2 pt-2">{{trans('auth.username')}}</label>--}}
{{--                        <div class="col-12">--}}
{{--                            <input id="userName" type="text" class="form-control" name="userName" value="" required>--}}
{{--                            @if ($errors->has('userName'))--}}
{{--                                <span class="help-block">--}}
{{--                                    <strong>{{ $errors->first('userName') }}</strong>--}}
{{--                                </span>--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <fieldset id="password-container">
                        <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="password_confirmation" class="col-11 control-label pb-2 pt-2">{{trans('auth.password')}}</label>
                            <div class="col-12">
                                <input type="password" autocomplete="off" name="password" value=""
                                       placeholder="كلمة المرور" id="input-password" class="form-control input-player" required>
                                <div class="hide-show">
                                    <span style="{{ $floatRight }}"><i class="fa fa-eye" style="color: #000;"></i></span>
                                </div>
                            </div>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div
                            class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="password_confirmation" class="col-6 control-label pb-2 pt-2">{{trans('auth.confirm-password')}}</label>
                            <div class="col-12">
                                <input type="password" autocomplete="off" name="password_confirmation" value=""
                                       placeholder="تأكيد كلمة المرور" id="password_confirmation" class="form-control input-player" required>
                                <div class="hide-show1">
                                    <span style="{{ $floatRight }}"><i class="fa fa-eye" style="color: #000;"></i></span>
                                </div>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4 pt-5">
                            <button type="submit" class="btn btn-success ">
                                {{trans('site.createaccount')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-3">
                <aside id="column-right">
                    <div class="list-group">
                        <a href="#" class="list-group-item">{{trans('individually.entry')}}</a>
                        <a href="#" class="list-group-item">{{trans('individually.registration')}}</a>
                        <a href="#" class="list-group-item">{{trans('auth.forgot')}}</a>
                        <a href="#" class="list-group-item">{{trans('individually.my-personal-account')}}</a>
                    </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // $(document).ready(function () {
        //     $('input[type="email"]').blur(function () {
        //         let email = $(this)[0].value;
        //         email = email.split('@')[0];
        //         email = email.replace('#', '');
        //         email = email.replace('.', '');
        //         email = email.replace('-', '');
        //         email = email.replace('_', '');
        //         $('input[name="userName"]').val(email);
        //     });
        // });
        $(function(){
            $('.hide-show').show();
            $('.hide-show span').addClass('show')

            $('.hide-show span').click(function(){
                if( $(this).hasClass('show') ) {
                //   $(this).text('Hide');
                $('input[name="password"]').attr('type','text');
                $(this).removeClass('show');
                } else {
                //    $(this).text('Show');
                $('input[name="password"]').attr('type','password');
                $(this).addClass('show');
                }
            });

            $('form button[type="submit"]').on('click', function(){
                $('.hide-show span').text('Show').addClass('show');
                $('.hide-show').parent().find('input[name="password"]').attr('type','password');
            });
                //
        });
        $(function(){
            $('.hide-show1').show();
            $('.hide-show1 span').addClass('show')

            $('.hide-show1 span').click(function(){
                if( $(this).hasClass('show') ) {
                //   $(this).text('Hide');
                $('input[name="password_confirmation"]').attr('type','text');
                $(this).removeClass('show');
                } else {
                //    $(this).text('Show');
                $('input[name="password_confirmation"]').attr('type','password');
                $(this).addClass('show');
                }
            });

            $('form button[type="submit"]').on('click', function(){
                $('.hide-show1 span').text('Show').addClass('show');
                $('.hide-show1').parent().find('input[name="password_confirmation"]').attr('type','password');
            });
                //
        });
    </script>
@endpush
