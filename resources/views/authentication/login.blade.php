@extends('layouts.master')

@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/register.css'))

@section('content')
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-11 col-md-10 col-lg-8 col-xl-7 mx-auto">
                <div class="form-wrap">
                    <div class="tabs">
                        <h3 class="login-tab"><a class="active" href="#login-tab-content">{{trans('auth.login')}}</a></h3>
                    </div>
                    <div class="tabs-content">
                        @if (session('error'))
                            <div class="alert alert-danger text-center">{{session('error')}}</div>
                        @endif
                        <div id="login-tab-content" class="active">
                            <form class="login-form" method="post" action="{{ url(App::getLocale() . '/login') }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('userType') ? ' has-error' : '' }}">
                                    <select class="input" id="userType" name="userType">
                                        <option value="Follower">{{ trans('site.site-follower') }}</option>
                                        <option value="Player">{{ trans('site.player') }}</option>
                                        <option value="Coach">{{ trans('site.coach') }}</option>
                                        <option value="Manager">{{ trans('site.manager') }}</option>
                                        <option value="Club">{{ trans('site.Club') }}</option>
                                        <option value="Commentator">{{ trans('individually.commentator') }}</option>
                                        <option value="Content-Creator">{{ trans('individually.content-writer') }}</option>
                                        <option value="Academy">{{ trans('site.Academy') }}</option>
                                        <option value="Sport-Company">{{ trans('site.SportsServicesCompany') }}</option>
                                    </select>
                                    @if ($errors->has('userType'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('userType') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input id="email" type="text" class="input" name="email" value="{{ old('email') }}" placeholder="{{trans('auth.email')}}" required autofocus>
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <input id="password" type="password" class="input" name="password" value="{{ old('user_name') }}" placeholder="{{trans('auth.password')}}" required autofocus>
                                    <div class="hide-show">
                                        <span style="{{ App::getLocale() == 'en' ? 'float:right;' : ''}}"><i class="fa fa-eye"></i></span>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="alert alert-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>
                                <input type="submit" class="button" value="{{trans('all.login')}}">
                            </form>
                            <div class="help-text p-3 p-md-4 text-center">
                                <p class="mb-0"><a href="{{ url(App::getLocale() . '/password/reset') }}">{{trans('auth.forgot')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
    <script>
        jQuery(document).ready(function($) {
            tab = $('.tabs h3 a');

            tab.on('click', function(event) {
                event.preventDefault();
                tab.removeClass('active');
                $(this).addClass('active');

                tab_content = $(this).attr('href');
                $('div[id$="tab-content"]').removeClass('active');
                $(tab_content).addClass('active');
            });
        });
        //
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
        });
    </script>
@endpush
