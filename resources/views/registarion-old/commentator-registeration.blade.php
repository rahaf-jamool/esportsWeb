@php
    $rtl = App::getLocale() == 'ar' ? 'rtl' : 'ltr';
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
            <h1> {!! trans('individually.register-commentator-account') !!}</h1>
            <p>{!! trans('institutions.Ifyouhaveaccount') !!}<a class="login"  href="{{ url(App::getLocale() . '/login') }}">{!! trans('institutions.loginpage') !!}</a>.</p>

            <div class="col-12 col-lg-8">
                @include('layouts.message')
                <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="account-type" value="Commentator">

                    <h4>{!! trans('individually.commentator-data') !!}</h4>
                    <hr>
                    <div class="form-group{{ $errors->has('uaeResidency') ? ' has-error' : '' }}">
                        {{-- <span class="asterisks">*</span><label for="state" class="col-11 control-label pb-2 pt-2">{{trans('individually.place-of-residence')}}</label> --}}
                        <div class="col-sm-12 col-lg-9 radio-btn">
                            <label class="radio-inline">
                                <input type="radio" name="uaeResidency" value="true" style="" checked="checked">{{trans('individually.inside-state')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="uaeResidency" value="false">{{trans('individually.out-country')}}
                            </label>
                            @if ($errors->has('uaeResidency'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('uaeResidency') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="firstName" class="col-md-4 control-label  pb-2 pt-2">{{trans('individually.firstName')}}</label>
                        <div class="col-12">
                            <input id="firstName" type="text" class="form-control" name="firstName"
                                   value="{{ old('firstName') }}" required autofocus>
                            @if ($errors->has('firstName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="lastName" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.lastName')}}</label>
                        <div class="col-12">
                            <input id="lastName" type="text" class="form-control" name="lastName"
                                   value="{{ old('lastName') }}" required autofocus>
                            @if ($errors->has('lastName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="email" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.email')}}</label>
                        <div class="col-12">
                            <input id="email" type="email" class="form-control" name="email" value="" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group{{ $errors->has('userName') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="userName" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.username')}}</label>
                        <div class="col-12">
                            <input id="userName" type="text" class="form-control" name="userName" value="" required>
                            @if ($errors->has('userName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('userName') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div> --}}
                    <fieldset id="password-container">
                        <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="password_confirmation" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.password')}}</label>
                            <div class="col-sm-12">
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
                            <span class="asterisks">*</span><label for="password_confirmation" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.confirm-password')}}</label>
                            <div class="col-sm-12">
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
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="phone" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.phone')}}</label>
                        <div class="col-12">
                            <input id="phone" type="text" class="form-control" name="phone" required>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="gender" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.sex')}}</label>
                        <div class="col-sm-12 radio-btn">
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="M" style="">{{trans('individually.male')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="F">{{trans('individually.female')}}
                            </label>
                            @if ($errors->has('gender'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('socialStatus') ? ' has-error' : '' }}">
                        <label for="socialStatus" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.marital_status')}}</label>
                        <div class="col-sm-12 radio-btn">
                            <label class="radio-inline">
                                <input type="radio" name="socialStatus" value="Married" style="">{{trans('individually.married')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="socialStatus" value="Single">{{trans('individually.single')}}
                            </label>
                            @if ($errors->has('socialStatus'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('socialStatus') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('please-choose') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="please-choose" class="col-11 control-label pb-2 pt-2">{{trans('individually.educational-level')}}</label>
                        <div class="col-sm-12">
                            <select name="educationLevelId" id="input-education-degree"
                                    class="form-control jcf-reset-appearance input-player" required>
                                <option value=""> --- {{trans('individually.please-choose')}} ---</option>
                                @if (count($educationLevel) > 0)
                                    @foreach($educationLevel as $level)
                                        <option value="{{ $level['id'] }}" style="direction: {{$rtl}}">{{ getTranslate($level, 'name') }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('educationLevelId'))
                                <span class="help-block">
                                <strong>{{ $errors->first('educationLevelId') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('BirthDate') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="BirthDate" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.date-birth')}}</label>
                        <div class="col-sm-12">
                            <div class="input-group date">
                                <input type="date" name="BirthDate" value="" data-date-format="YYYY-MM-DD"
                                       id="input-date-of-birth" class="form-control input-player" required>
                            </div>
                            @if ($errors->has('BirthDate'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('BirthDate') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                 {{--  <div class="form-group residence-only {{ $errors->has('uaeIdNumber') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span>
                        <label for="uaeIdNumber" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.emirates-number')}}</label>
                        <div class="col-sm-12">
                            <input type="text" name="uaeIdNumber" value="" placeholder="784-XXXX-XXXXXXX-X"
                                   id="input-id-no" class="form-control input-player" required>
                        </div>
                        @if ($errors->has('uaeIdNumber'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('uaeIdNumber') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group residence-only {{ $errors->has('uaeIdEndDate') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="uaeIdEndDate" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.emirates-expiry-date')}}</label>
                        <div class="col-sm-12">
                            <div class="input-group date">
                                <input type="date" name="uaeIdEndDate" value="" data-date-format="YYYY-MM-DD"
                                       id="uaeIdEndDate" class="form-control input-player" required>
                            </div>
                            @if ($errors->has('uaeIdEndDate'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('uaeIdEndDate') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
--}}
                    <div class="form-group residence-only {{ $errors->has('nationality') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="nationality" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.nationality')}}</label>
                        <div class="col-sm-12">
                            <select name="NationalityId" id="input-zone" class="form-control jcf-reset-appearance input-player" required>
                                    <option value=""> --- {{trans('individually.please-choose')}} ---</option>
                                @foreach($nationalities as $nationality)
                                    <option value="{{$nationality['id']}}" style="direction: {{$rtl}}">{{ getTranslate($nationality, 'name') }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('NationalityId'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('NationalityId') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group residence-only {{ $errors->has('passportNumber') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="passportNumber" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.passport-number')}}</label>
                        <div class="col-sm-12">
                            <input type="number" name="passportNumber" min="0" value="" id="passportNumber" class="form-control input-player" required>
                        </div>
                        @if ($errors->has('passportNumber'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('passportNumber') }}</strong>
                                </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('passport-file ') ? ' has-error' : '' }}">
                        <span class="asterisks">* </span><label for="passport-file " class="control-label  pb-2 pt-2">{{ trans('institutions.passportcopy') }}</label>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group">
                                <input type="file" class="form-control" name="passport-file" id="passport_file" aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                            </div>
                        </div>
                        @if ($errors->has('passport-file'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('passport-file') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                        <label for="emirates-personal-passport-photo" class="col-11 control-label pb-2 pt-2">{{trans('individually.personal-passport-photo')}}</label>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="input-group">
                                <input type="file" class="form-control" name="file" id="file" aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                            </div>
                            {{ Form::hidden('image_url', '') }}
                        </div>
                        @if ($errors->has('personal-passport-photo'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('personal-passport-photo') }}</strong>
                                </span>
                        @endif
                    </div>
                    <fieldset id="payment-container">
                        <legend>{{trans('individually.social-media')}}</legend>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group required  {{ $errors->has('twitter') ? ' has-error' : '' }}">
                                    <label for="twitter" class="col-12 control-label pb-2 pt-2">{{trans('individually.twitter')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="twitter" value="" id="twitter" class="form-control input-player">
                                    </div>
                                    @if ($errors->has('twitter'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('twitter') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group required {{ $errors->has('instagram') ? ' has-error' : '' }}">
                                    <label for="instagram" class="col-12 control-label pb-2 pt-2">{{trans('individually.instagram')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="instagram" value="" id="instagram" class="form-control input-player">
                                    </div>
                                    @if ($errors->has('instagram'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('instagram') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group required {{ $errors->has('facebook') ? ' has-error' : '' }}">
                                    <label for="facebook" class="col-12 control-label pb-2 pt-2">{{trans('individually.facebook')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="facebook" value="" id="facebook" class="form-control input-player">
                                    </div>
                                    @if ($errors->has('facebook'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('facebook') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group required {{ $errors->has('youtube') ? ' has-error' : '' }}">
                                    <label for="youtube" class="col-12 control-label pb-2 pt-2">{{trans('individually.youtube')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="youtube" value="" id="youtube" class="form-control input-player">
                                    </div>
                                    @if ($errors->has('youtube'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('youtube') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group required {{ $errors->has('discord') ? ' has-error' : '' }}">
                                    <label for="discord" class="col-12 control-label pb-2 pt-2">{{trans('individually.discord')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="discord" value="" id="discord" class="form-control input-player">
                                    </div>
                                    @if ($errors->has('discord'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('discord') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group required {{ $errors->has('tikTok') ? ' has-error' : '' }}">
                                    <label for="tikTok" class="col-12 control-label pb-2 pt-2">{{trans('individually.tikTok')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="tikTok" value="" id="tikTok" class="form-control input-player">
                                    </div>
                                    @if ($errors->has('tikTok'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tikTok') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group required {{ $errors->has('twitch') ? ' has-error' : '' }}">
                                    <label for="twitch" class="col-12 control-label pb-2 pt-2">{{trans('individually.twitch')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="twitch" value="" id="twitch" class="form-control input-player">
                                    </div>
                                    @if ($errors->has('twitch'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('twitch') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    {{-- <fieldset id="platform-container">
                        <div class="platform-flex">
                            <div class="form-group mb-3 input-platform" id="platform-dev">
                                <legend>{{trans('individually.platform')}}</legend>
                                @if (count($platforms) > 0)
                                    @foreach($platforms as $platform)
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="playerPlatforms_{{$platform['id']}}"
                                                value="{{ $platform['id'] . '|' . $platform['name'] }}" name="playerPlatforms[]">
                                            <label class="custom-control-label" for="playerPlatforms_{{$platform['id']}}">{{ $platform['name'] }}</label>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('platform'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('platform') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="custom-control custom-switch mb-4">
                                <input type="checkbox" class="custom-control-input" id="other" name="otherPlatform">
                                <label class="custom-control-label" for="other">{{trans('individually.other')}}</label>
                            </div>
                            <div id="form-platform" class="mb-3">
                                <div>
                                    <label for="namePlatform" class="col-md-12 control-label pb-2 pt-2">{{trans('individually.add-platform')}}</label>
                                    <div style="display: flex;gap: 20px;">
                                        <input type="text" name="namePlatform" value="" data-date-format="YYYY-MM-DD"
                                            id="namePlatform" class="form-control input-player col-4" required >
                                        <span class="btn btn-success" id="add-platform">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('namePlatform'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('namePlatform') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id="payment-container">
                        <div class="platform-flex">
                            <div class="form-group mb-3 input-platform"  id="games-dev">
                                <legend>{{trans('individually.game-platform')}}</legend>
                                @if (count($games) > 0)
                                    @foreach($games as $game)
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="playerGames_{{$game['id']}}"
                                                value="{{ $game['id'] . '|' . $game['name'] }}" name="playerGames[]">
                                            <label class="custom-control-label" for="playerGames_{{$game['id']}}">{{ $game['name'] }}</label>
                                        </div>
                                    @endforeach
                                @endif
                                @if ($errors->has('games'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('games') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-switch mb-4">
                                <input type="checkbox" class="custom-control-input" id="othe1" name="otherGame">
                                <label class="custom-control-label" for="othe1">{{trans('individually.other')}}</label>
                            </div>
                            <div id="form-games" class="mb-3">
                                <div>
                                    <label for="nameGame" class="col-md-12 control-label pb-2 pt-2">{{trans('individually.add-game')}}</label>
                                    <div style="display: flex;gap: 20px;">
                                        <input type="text" name="nameGame" value="" data-date-format="YYYY-MM-DD"
                                            id="nameGame" class="form-control input-player col-4" required >
                                        <span class="btn btn-success" id="add-game">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </div>
                                    @if ($errors->has('nameGame'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nameGame') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset> --}}

                    {{--                    <fieldset id="payment-container">--}}
                    {{--                        <legend>{{trans('individually.payment-method')}}</legend>--}}
                    {{--                        <p>{{trans('individually.registration-payment')}}</p>--}}
                    {{--                        <div class="form-group mb-3">--}}
                    {{--                            <label class="col-sm-12" for="input-coupon">{{trans('individually.please-coupon')}}</label>--}}
                    {{--                            <div class="col-sm-12" id="coupon-err">--}}
                    {{--                                <div class="input-group">--}}
                    {{--                                    <input type="text" name="coupon" value=""  id="input-coupon" class="form-control input-player">--}}
                    {{--                                    <span class="input-group-btn">--}}
                    {{--                                        <input type="button" value="{{trans('individually.take-discount')}}" id="button-coupon" data-loading-text="{{trans('individually.my-neighbour')}}" class="btn btn-primary">--}}
                    {{--                                    </span>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </fieldset>--}}
                    {{--                    <div class="buttons mb-3">--}}
                    {{--                        <div>--}}
                    {{--                            <span class="jcf-checkbox jcf-unchecked"><span></span><input type="checkbox" name="agree" value="1" style="position: absolute; height: 100%; width: 100%; opacity: 0; margin: 0px;"></span>--}}
                    {{--                           {{trans('individually.have-read')}} <a href="https://uaetriathlon.ae/index.php?route=information/information/agree&amp;information_id=8" class="agree"><b>{{trans('individually.privacy-notice')}}</b></a>--}}
                    {{--                            <input type="hidden" id="dob-val" value="">--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
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
                    <div class="added d-none" style="margin-top: 2150px;">
                        <div class="add-platform">
                            <form id="form-platform">
                                    <div>
                                        <label for="namePlatform" class="col-md-12 control-label pb-2 pt-2">Add Platform</label>
                                        <div class="input-group date">
                                            <input type="text" name="namePlatform" value="" data-date-format="YYYY-MM-DD"
                                                id="namePlatform" class="form-control input-player col-10" required style="margin: auto;display: flex; justify-content: center;">
                                        </div>
                                        @if ($errors->has('namePlatform'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('namePlatform') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4 pt-4" style="margin: auto;" >
                                            <div class="btn btn-success" id="add-platform">
                                                {{-- {{trans('site.createaccount')}} --}}
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                        <div class="add-platform">
                                <form  id="form-games">
                                    <div>
                                        <label for="nameGame" class="col-md-12 control-label pb-2 pt-2">Add Games</label>
                                        <div class="input-group date">
                                            <input type="text" name="nameGame" value="" data-date-format="YYYY-MM-DD"
                                                id="nameGame" class="form-control input-player col-10" required style="margin: auto;display: flex; justify-content: center;">
                                        </div>
                                        @if ($errors->has('nameGame'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('nameGame') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4 pt-4" style="margin: auto;">
                                            <div id="add-game" class="btn btn-success ">
                                                <i class="fa fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                </div>
                </aside>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#form-platform").hide();
            $("#form-games").hide();
            $('input[name="otherPlatform"]').change(function() {
                $("#form-platform").toggle();
            });
            $('input[name="otherGame"]').change(function() {
                $("#form-games").toggle();
            });
            // $('input[type="email"]').blur(function () {
            //     let email = $(this)[0].value;
            //     email = email.split('@')[0];
            //     email = email.replace('#', '');
            //     email = email.replace('.', '');
            //     email = email.replace('-', '');
            //     email = email.replace('_', '');
            //     $('input[name="userName"]').val(email);
            // });
            $('#card_account-type').text($('input[name="account-type"]').val());
            $('select[name="NationalityId"]').change(function (e) {
                $('#card_NationalityId').text(e.target.selectedOptions[0].text);
            });
            $('input[type="file"]').change(function (e) {
                $('#card_image').attr('src', URL.createObjectURL(e.target.files[0]));
            });
            $('input[name="firstName"]').blur((e) => inputBlur(e, "firstName"));
            $('input[name="BirthDate"]').blur((e) => inputBlur(e, "BirthDate"));
            $('input[name="uaeIdNumber"]').blur((e) => inputBlur(e, "uaeIdNumber"));
            $('input[name="uaeIdEndDate"]').blur((e) => inputBlur(e, "uaeIdEndDate"));
            function inputBlur(element, name) {
                let value = element.target.value;
                $('#card_' + name).text(value);
            }
            //
            $('#add-platform').click(function () {
				let namePlatform = $('input[name="namePlatform"]').val();
				//let formData = new FormData();
                if(namePlatform == ''){
					swal(
						'{{trans("auth.name")}}', {
							icon: "warning",
							button: '{{trans("site.ok")}}',
					});

				}else{
                        let urlService = '{{ url(App::getLocale() . '/register/platform/add') }}';
                        let newUrl = urlService + '/' + namePlatform;
                    $.ajax({
                                url: newUrl,
                                type: 'GET',
                                processData: false,
                                contentType: false,
                                data: namePlatform,
                                beforeSend: function () {

                                },

                                error: function (response) {
                                    swal("Oh noes!", "The AJAX request failed!", "error");
                                },
                                success: function (response) {
                                    console.log('response');
                                    console.log(response);
                                    swal('{{trans("site.add-success")}}',{
										icon: "success",
										button: '{{trans("site.ok")}}',
                                    });

                                    $('#platform-dev').append(
                                        '<div class="custom-control custom-switch" id="platfom-add">\
                                            <input type="checkbox" class="custom-control-input" id="playerPlatforms_{{' + response.success.result.id +'}}"\
                                                value="' + response.success.result.id +' " name="playerPlatforms[]">\
                                                <label class="custom-control-label" for="playerPlatforms_{{' + response.success.result.id +'}}">'+ response.success.result.name +'</label>\
                                            </div>'
                                    );
                                }
                    });
                }
            });


            $('#add-game').click(function () {
				let nameGame = $('input[name="nameGame"]').val();
				if(nameGame == ''){
					swal(
						'{{trans("auth.name")}}', {
							icon: "warning",
							button: '{{trans("site.ok")}}',
					});

				}else{
                        let urlService = '{{ url(App::getLocale() . '/register/games/add') }}';
                        let newUrl = urlService + '/' + nameGame;
                    $.ajax({
                                url: newUrl,
                                type: 'GET',
                                processData: false,
                                contentType: false,
                                data: nameGame,
                                beforeSend: function () {

                                },

                                error: function (response) {
                                    swal("Oh noes!", "The AJAX request failed!", "error");
                                },
                                success: function (response) {
                                    console.log('response');
                                    console.log(response);
                                    swal('{{trans("site.add-success")}}',{
										icon: "success",
										button: '{{trans("site.ok")}}',
                                    });

                                    $('#games-dev').append(
                                        '<div class="custom-control custom-switch">\
                                            <input type="checkbox" class="custom-control-input" id="playerGames_{{' + response.success.result.id +'}}"\
                                                value="' + response.success.result.id +'" name="playerGames[]">\
                                                <label class="custom-control-label" for="playerGames_{{' + response.success.result.id +'}}">'+ response.success.result.name +'</label>\
                                            </div>'
                                    );
                                }
                    });
                }
			});
        });
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
