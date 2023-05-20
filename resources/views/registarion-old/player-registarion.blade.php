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
<style>
    /* body {
  margin: 0;
  font-family: sans-serif;
}
 */
.clubRegistration .tabs {
  width: 100%;
}

.clubRegistration .tab-nav {
  display: flex;
  background: #f0f0f0;
}

.clubRegistration .nav-item {
  display: block;
  padding: 16px;
  cursor: pointer;
}
.clubRegistration .nav-item.selected {
    background: red;
    color: #fff;
}

.clubRegistration .tab {
  display: none;
  padding: 16px;
}
.clubRegistration .tab.selected {
  display: block;
}

.clubRegistration .tab-pag {
  padding: 0 16px;
  display: flex;
  justify-content: flex-end;
}

.clubRegistration .pag-item {
  display: block;
  padding: 12px;
  cursor: pointer;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-right: 8px;
}
.clubRegistration .pag-item:last-child {
  margin-right: 0;
}
.clubRegistration .pag-item.hidden {
  display: none;
}

.clubRegistration .pag-item-submit {
  flex: 0 1 180px;
  font-size: 1rem;
  color: #fff;
  background: #2fb44b;
}
.clubRegistration form span{
    color:#000;
}
.clubRegistration legend{
    font-size:1rem;
}
</style>

    <div class="container clubRegistration">
        <div class="row pb-5">
            <h1> {!! trans('individually.register-player-account') !!}</h1>
            <p>
                {!! trans('institutions.Ifyouhaveaccount') !!}
                <a class="login" href="{{ url(App::getLocale() . '/login') }}">{!! trans('institutions.loginpage') !!}</a>.
            </p>

                <div class="col-12">
                @include('layouts.message')
                <form class="form-horizontal" role="form" method="POST"
                      action="{{ url(App::getLocale() . '/register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="account-type" value="Player">

                    <h4>{!! trans('individually.player-data') !!}</h4>
                    <hr>
                    <div class="tabs" id="tabbedForm">
                        <nav class="tab-nav"></nav>
                        <div class="tab" data-name="{{trans('individually.General')}}">
                            <div class="d-flex flex-wrap">
                                <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="firstName"
                                                                        class="col-10 control-label  pb-2 pt-2">{{trans('individually.firstName')}}</label>
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
                                <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="lastName"
                                                                        class="col-10 control-label pb-2 pt-2">{{trans('individually.lastName')}}</label>
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
                                <fieldset id="platform-container" class="col-12 col-lg-6">
                                    <div class="platform-flex">
                                        <div class="form-group mb-3 input-platform" id="platform-dev">
                                            <legend><span class="asterisks">*</span> {{trans('individually.platform')}}</legend>
                                            @if (count($platforms) > 0)
                                                @foreach($platforms as $platform)
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="playerPlatforms_{{$platform['id']}}"
                                                            value="{{ $platform['id'] . '|' . $platform['name'] }}"
                                                            name="playerPlatforms[]">
                                                        <label class="custom-control-label"
                                                            for="playerPlatforms_{{$platform['id']}}">{{ $platform['name'] }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                            {{--  --}}
                                            @if ($errors->has('platform'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('platform') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        {{-- others --}}
                                        <div class="custom-control custom-switch mb-4">
                                            <input type="checkbox" class="custom-control-input" id="other" name="otherPlatform">
                                            <label class="custom-control-label" for="other">{{trans('individually.other')}}</label>
                                        </div>
                                        <div id="form-platform" class="mb-3">
                                            <div>
                                                <label for="namePlatform"
                                                    class="col-md-12 control-label pb-2 pt-2">{{trans('individually.add-platform')}}</label>
                                                <div style="display: flex;gap: 20px;">
                                                    <input type="text" name="namePlatform" value=""
                                                        id="namePlatform" class="form-control input-player col-5">
                                                    <span class="btn btn-success" id="add-platform">
                                                        <i style="vertical-align: bottom" class="fa fa-plus"></i>
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
                                <fieldset id="payment-container"  class="col-12 col-lg-6">
                                    <div class="platform-flex">
                                        <div class="form-group mb-3 input-platform" id="games-dev">
                                            <legend><span class="asterisks">*</span> {{trans('individually.game-platform')}}
                                            </legend>
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
                                        {{-- others --}}
                                        <div class="custom-control custom-switch mb-4">
                                            <input type="checkbox" class="custom-control-input" id="othe1" name="otherGame">
                                            <label class="custom-control-label" for="othe1">{{trans('individually.other')}}</label>
                                        </div>
                                        <div id="form-games" class="mb-3">
                                            <div>
                                                <label for="nameGame"
                                                    class="col-md-12 control-label pb-2 pt-2">{{trans('individually.add-game')}}</label>
                                                <div style="display: flex;gap: 20px;">
                                                    <input type="text" name="nameGame" value=""
                                                        id="nameGame" class="form-control input-player col-5">
                                                    <span class="btn btn-success" id="add-game">
                                                        <i style="vertical-align: bottom" class="fa fa-plus"></i>
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
                                </fieldset>

                            </div>
                        </div>

                        <div class="tab" data-name="{{trans('individually.Person-Info')}}">
                            <div class="d-flex flex-wrap">
                                <div class="form-group{{ $errors->has('uaeResidency') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="state" class="col-11 control-label pb-2 pt-2">{{trans('individually.residence')}}</label>
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
                                <div class="form-group residence-only {{ $errors->has('princedomId') ? ' has-error' : '' }} col-12 col-md-6" id="princedom">
                                    <span class="asterisks">*</span><label for="princedomId" class="col-11 control-label pb-2 pt-2">{{trans('institutions.princedoms')}}</label>
                                    <div class="col-12">
                                        <select name="princedomId" class="form-control jcf-reset-appearance input-player" id="princedomId" required>
                                            <option value="">--- {{trans('individually.please-choose')}} ---</option>
                                            @if (count($princedoms) > 0)
                                                @foreach($princedoms as $princedom)
                                                    <option value="{{$princedom['id']}}" style="direction: {{$rtl}}">{{ getTranslate($princedom, 'name') }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('princedomId'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('princedomId') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="gender"
                                                                        class="col-10 control-label pb-2 pt-2">{{trans('individually.sex')}}</label>
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

                                <div class="form-group {{ $errors->has('socialStatus') ? ' has-error' : '' }} col-12 col-md-6">
                                    <label for="socialStatus"
                                        class="col-10 control-label pb-2 pt-2">{{trans('individually.marital_status')}}</label>
                                    <div class="col-sm-12 radio-btn">
                                        <label class="radio-inline">
                                            <input type="radio" name="socialStatus" value="Married"
                                                style="">{{trans('individually.married')}}
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

                                <div class="form-group {{ $errors->has('please-choose') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="please-choose"
                                                                        class="col-11 control-label pb-2 pt-2">{{trans('individually.educational-level')}}</label>
                                    <div class="col-sm-12">
                                        <select name="educationLevelId" id="input-education-degree"
                                                class="form-control jcf-reset-appearance input-player" required>
                                            <option value=""> --- {{trans('individually.please-choose')}} ---</option>
                                            @if (!empty($educationLevel))
                                                @foreach($educationLevel as $level)
                                                    <option value="{{ $level['id'] }}"
                                                            style="direction: {{$rtl}}">{{ getTranslate($level, 'name') }}</option>
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

                                <div class="form-group {{ $errors->has('BirthDate') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="BirthDate"
                                                                        class="col-10 control-label pb-2 pt-2">{{trans('individually.date-birth')}}</label>
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
                                <div class="form-group residence-only {{ $errors->has('nationality') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="nationality"
                                                                        class="col-10 control-label pb-2 pt-2">{{trans('individually.nationality')}}</label>
                                    <div class="col-sm-12">
                                        <select name="NationalityId" id="input-zone"
                                                class="form-control jcf-reset-appearance input-player" required>
                                            <option value="">--- {{trans('individually.please-choose')}} ---</option>
                                            @if (!empty($nationalities))
                                                @foreach($nationalities as $nationality)
                                                    <option value="{{$nationality['id']}}" style="direction: {{$rtl}}">{{ getTranslate($nationality, 'name') }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if ($errors->has('NationalityId'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('NationalityId') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="phone"
                                                                        class="col-10 control-label pb-2 pt-2">{{trans('auth.phone')}}</label>
                                    <div class="col-12">
                                        <input id="phone" type="text" class="form-control" name="phone" required>
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <fieldset id="payment-container col-12 col-md-6">
                                    <legend>{{trans('individually.social-media')}}</legend>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group required  {{ $errors->has('twitter') ? ' has-error' : '' }}">
                                                <label for="twitter"
                                                    class="col-12 control-label pb-2 pt-2">{{trans('individually.twitter')}}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="twitter" value="" id="twitter"
                                                        class="form-control input-player">
                                                </div>
                                                @if ($errors->has('twitter'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('twitter') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group required {{ $errors->has('instagram') ? ' has-error' : '' }}">
                                                <label for="instagram"
                                                    class="col-12 control-label pb-2 pt-2">{{trans('individually.instagram')}}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="instagram" value="" id="instagram"
                                                        class="form-control input-player">
                                                </div>
                                                @if ($errors->has('instagram'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('instagram') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group required {{ $errors->has('facebook') ? ' has-error' : '' }}">
                                                <label for="facebook"
                                                    class="col-12 control-label pb-2 pt-2">{{trans('individually.facebook')}}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="facebook" value="" id="facebook"
                                                        class="form-control input-player">
                                                </div>
                                                @if ($errors->has('facebook'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('facebook') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group required {{ $errors->has('youtube') ? ' has-error' : '' }}">
                                                <label for="youtube"
                                                    class="col-12 control-label pb-2 pt-2">{{trans('individually.youtube')}}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="youtube" value="" id="youtube"
                                                        class="form-control input-player">
                                                </div>
                                                @if ($errors->has('youtube'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('youtube') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group required {{ $errors->has('discord') ? ' has-error' : '' }}">
                                                <label for="discord"
                                                    class="col-12 control-label pb-2 pt-2">{{trans('individually.discord')}}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="discord" value="" id="discord"
                                                        class="form-control input-player">
                                                </div>
                                                @if ($errors->has('discord'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('discord') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group required {{ $errors->has('tikTok') ? ' has-error' : '' }}">
                                                <label for="tikTok"
                                                    class="col-12 control-label pb-2 pt-2">{{trans('individually.tikTok')}}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="tikTok" value="" id="tikTok"
                                                        class="form-control input-player">
                                                </div>
                                                @if ($errors->has('tikTok'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('tikTok') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group required {{ $errors->has('twitch') ? ' has-error' : '' }}">
                                                <label for="twitch"
                                                    class="col-12 control-label pb-2 pt-2">{{trans('individually.twitch')}}</label>
                                                <div class="col-sm-12">
                                                    <input type="text" name="twitch" value="" id="twitch"
                                                        class="form-control input-player">
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
                                <div class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }} col-12 col-md-6">
                                    <label for="emirates-personal-passport-photo"
                                        class="col-11 control-label pb-2 pt-2">{{trans('individually.personal-passport-photo')}}</label>
                                    <div class="col-sm-12 input-group mb-3">
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="file" id="file"
                                                aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                        </div>
                                        {{ Form::hidden('image_url', '') }}
                                    </div>
                                    @if ($errors->has('personal-passport-photo'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('personal-passport-photo') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="form-group residence-only {{ $errors->has('passportNumber') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="passportNumber"
                                                                        class="col-10 control-label pb-2 pt-2">{{trans('individually.passport-number')}}</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="passportNumber" min="0" value="" id="passportNumber"
                                            class="form-control input-player" required>
                                    </div>
                                    @if ($errors->has('passportNumber'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('passportNumber') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('passport-file ') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">* </span><label for="passport-file "
                                                                            class="control-label  pb-2 pt-2">{{ trans('institutions.passportcopy') }}</label>
                                    <div class="col-sm-12 input-group mb-3">
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="passport-file" id="passport_file"
                                                aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                        </div>
                                    </div>
                                    @if ($errors->has('passport-file'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('passport-file') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab" data-name="{{trans('individually.User-account')}}">
                            <div class="d-flex flex-wrap">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="email"
                                                                        class="col-md-6 control-label pb-2 pt-2">{{trans('auth.email')}}</label>
                                    <div class="col-12">
                                        <input id="email" type="email" class="form-control" name="email" value="" required>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <fieldset id="password-container" class="d-flex flex-wrap col-12 p-0">
                                    <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }} col-12 col-md-6">
                                        <span class="asterisks">*</span><label for="password_confirmation"
                                                                            class="col-10 control-label pb-2 pt-2">{{trans('auth.password')}}</label>
                                        <div class="col-sm-12">
                                            <input type="password" autocomplete="off" name="password" value=""
                                                placeholder="{{trans('auth.password')}}" id="input-password" class="form-control input-player" required>
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
                                    <div class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }} col-12 col-md-6">
                                        <span class="asterisks">*</span><label for="password_confirmation"
                                                                            class="col-10 control-label pb-2 pt-2">{{trans('auth.confirm-password')}}</label>
                                        <div class="col-sm-12">
                                            <input type="password" autocomplete="off" name="password_confirmation" value=""
                                                placeholder="{{trans('auth.confirm-password')}}" id="password_confirmation"
                                                class="form-control input-player" required>
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
                                <div class="col-12 col-md-4">
                                    <aside id="column-right">
                                        <div class="swiper-viewport mb-3">
                                            <div id="banner0" class="swiper-container swiper-container-horizontal swiper-container-fade">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide swiper-slide-active position-relative"
                                                        style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                                                        <img src="{{ asset('assets/img/Mumbership-ID1.png') }}" alt="Account"
                                                            class="img-responsive" style="width: 100%;">
                                                        <div class="cart-content print-cart-js">
                                                            <div class="row w-100 h-100 align-items-center mx-auto">
                                                                <div class="col-4">
                                                                    <img class="img-fluid" id="card_image"
                                                                        src="{{ asset('SD08/default-user-image.png') }}" alt="">
                                                                </div>
                                                                <div class="col-8 pl-0">
                                                                    <div class="cart-content-info">
                                                                        <ul class="list-unstyled">
                                                                            <li>{{trans('auth.name')}} : <span id="card_firstName"></span>
                                                                            </li>
                                                                            <li>{{trans('individually.date-birth')}} : <span
                                                                                    id="card_BirthDate"></span></li>
                                                                            <li>{{trans('auth.account-type')}} : <span
                                                                                    id="card_account-type"></span></li>
                                                                            <li>{{trans('individually.nationality')}} : <span
                                                                                    id="card_NationalityId"></span></li>
                                                                            <li>{{trans('individually.emirates-number')}} : <span
                                                                                    id="card_uaeIdNumber"></span></li>
                                                                            <li>{{trans('individually.emirates-expiry-date')}} : <br><span
                                                                                    id="card_uaeIdEndDate"></span></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </aside>
                                </div>
                            </div>
                        </div>
                        <nav class="tab-pag"></nav>
                    </div>
                </form>
{{--                <form method="POST" action="{{ url(App::getLocale() . '/register/player') }}">--}}
{{--                    {{ csrf_field() }}--}}
{{--                    <input type="submit" value="download" />--}}
{{--                </form>--}}
                </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $("#form-platform").hide();
            $("#form-games").hide();
            $('input[name="otherPlatform"]').change(function () {
                $("#form-platform").toggle();
            });
            $('input[name="otherGame"]').change(function () {
                $("#form-games").toggle();
            });
            $('input[name="uaeResidency"]').change(function () {

                if ( $('#princedom').css('visibility') == 'hidden' )
                    $('#princedom').css('visibility','visible');
                else
                    $('#princedom').css('visibility','hidden');
            });

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
                if (namePlatform == '') {
                    swal(
                        '{{trans("auth.name")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                } else {
                    let urlService = '{{ url(App::getLocale() . '/register/platform/add') }}';
                    let newUrl = urlService + '/' + namePlatform;
                    $.ajax({
                        url: newUrl,
                        type: 'GET',
                        processData: false,
                        contentType: false,
                        data: namePlatform,
                        beforeSend: function () {},
                        error: function (response) {
                            swal("Oh noes!", "The AJAX request failed!", "error");
                        },
                        success: function (response) {
                            swal('{{trans("site.add-success")}}', {
                                icon: "success",
                                button: '{{trans("site.ok")}}',
                            });
                            $('#platform-dev').append(
                                '<div class="custom-control custom-switch" id="platfom-add">\
                                    <input type="checkbox" class="custom-control-input" id="playerPlatforms_{{' + response.success.result.id +'}}"\
                                                value="' + response.success.result.id + ' " name="playerPlatforms[]">\
                                                <label class="custom-control-label" for="playerPlatforms_{{' + response.success.result.id +'}}">' + response.success.result.name + '</label>\
                                            </div>'
                            );
                        }
                    });
                }
            });

            $('#add-game').click(function () {
                let nameGame = $('input[name="nameGame"]').val();
                if (nameGame == '') {
                    swal(
                        '{{trans("auth.name")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });
                } else {
                    let urlService = '{{ url(App::getLocale() . '/register/games/add') }}';
                    let newUrl = urlService + '/' + nameGame;
                    $.ajax({
                        url: newUrl,
                        type: 'GET',
                        processData: false,
                        contentType: false,
                        data: nameGame,
                        beforeSend: function () {},
                        error: function (response) {
                            swal("Oh noes!", "The AJAX request failed!", "error");
                        },
                        success: function (response) {
                            swal('{{trans("site.add-success")}}', {
                                icon: "success",
                                button: '{{trans("site.ok")}}',
                            });

                            $('#games-dev').append(
                                '<div class="custom-control custom-switch" id="platfom-add">\
                                   <input type="checkbox" class="custom-control-input" id="playerGames_{{' + response.success.result.id +'}}"\
                                                value="' + response.success.result.id + ' " name="playerGames[]">\
                                                <label class="custom-control-label" for="playerGames_{{' + response.success.result.id +'}}">' + response.success.result.name + '</label>\
                                            </div>'
                            );
                        }
                    });
                }
            });
        });
        $(function () {
            showHidePassword('.hide-show', 'password');
            showHidePassword('.hide-show1', 'password_confirmation');

            function showHidePassword(element, attr) {
                $(`${element}`).show();
                $(`${element} span`).addClass('show')
                $(`${element} span`).click(function () {
                    if ($(this).hasClass('show')) {
                        //   $(this).text('Hide');
                        $(`input[name="${attr}"]`).attr('type', 'text');
                        $(this).removeClass('show');
                    } else {
                        //    $(this).text('Show');
                        $(`input[name="${attr}"]`).attr('type', 'password');
                        $(this).addClass('show');
                    }
                });
                $('form button[type="submit"]').on('click', function () {
                    $(`${element} span`).text('Show').addClass('show');
                    $(`${element}`).parent().find(`input[name="${attr}"]`).attr('type', 'password');
                });
            }
        });
        // $(function(){
        //     $('.hide-show').show();
        //     $('.hide-show span').addClass('show')
        //
        //     $('.hide-show span').click(function(){
        //         if( $(this).hasClass('show') ) {
        //         //   $(this).text('Hide');
        //         $('input[name="password"]').attr('type','text');
        //         $(this).removeClass('show');
        //         } else {
        //         //    $(this).text('Show');
        //         $('input[name="password"]').attr('type','password');
        //         $(this).addClass('show');
        //         }
        //     });
        //
        //     $('form button[type="submit"]').on('click', function(){
        //         $('.hide-show span').text('Show').addClass('show');
        //         $('.hide-show').parent().find('input[name="password"]').attr('type','password');
        //     });
        // });
        // $(function(){
        //     $('.hide-show1').show();
        //     $('.hide-show1 span').addClass('show')
        //
        //     $('.hide-show1 span').click(function(){
        //         if( $(this).hasClass('show') ) {
        //         //   $(this).text('Hide');
        //         $('input[name="password_confirmation"]').attr('type','text');
        //         $(this).removeClass('show');
        //         } else {
        //         //    $(this).text('Show');
        //         $('input[name="password_confirmation"]').attr('type','password');
        //         $(this).addClass('show');
        //         }
        //     });
        //
        //     $('form button[type="submit"]').on('click', function(){
        //         $('.hide-show1 span').text('Show').addClass('show');
        //         $('.hide-show1').parent().find('input[name="password_confirmation"]').attr('type','password');
        //     });
        //
        // });
    </script>
<script>
    var tabs = function(id) {
  this.el = document.getElementById(id);

  this.tab = {
    el: '.tab',
    list: null
  }

  this.nav = {
    el: '.tab-nav',
    list: null
  }

  this.pag = {
    el: '.tab-pag',
    list: null
  }

  this.count = null;
  this.selected = 0;

  this.init = function() {
    // Create tabs
    this.tab.list = this.createTabList();
    this.count = this.tab.list.length;

    // Create nav
    this.nav.list = this.createNavList();
    this.renderNavList();

    // Create pag
    this.pag.list = this.createPagList();
    this.renderPagList();

    // Set selected
    this.setSelected(this.selected);
  }

  this.createTabList = function() {
    var list = [];

    this.el.querySelectorAll(this.tab.el).forEach(function(el, i) {
      list[i] = el;
    });

    return list;
  }

  this.createNavList = function() {
    var list = [];

    this.tab.list.forEach(function(el, i) {
      var listitem = document.createElement('a');
          listitem.className = 'nav-item',
          listitem.innerHTML = el.getAttribute('data-name'),
          listitem.onclick = function() {
            this.setSelected(i);
            return false;
          }.bind(this);

      list[i] = listitem;
    }.bind(this));

    return list;
  }

  this.createPagList = function() {
    var list = [];

    list.prev = document.createElement('a');
    list.prev.className = 'pag-item pag-item-prev',
      list.prev.innerHTML = "{{trans('individually.Prev')}}",
      list.prev.onclick = function() {
      this.setSelected(this.selected - 1);
      return false;
    }.bind(this);

    list.next = document.createElement('a');
    list.next.className = 'pag-item pag-item-next',
      list.next.innerHTML = "{{trans('individually.Next')}}",
      list.next.onclick = function() {
      this.setSelected(this.selected + 1);
      return false;
    }.bind(this);

    list.submit = document.createElement('button');
    list.submit.className = 'pag-item pag-item-submit',
    list.submit.innerHTML = " {{trans('site.createaccount')}}";
    list.submit.setAttribute('type', 'submit');

    return list;
  }

  this.renderNavList = function() {
    var nav = document.querySelector(this.nav.el);

    this.nav.list.forEach(function(el) {
      nav.appendChild(el);
    });
  }

  this.renderPagList = function() {
    var pag = document.querySelector(this.pag.el);

    pag.appendChild(this.pag.list.prev);
    pag.appendChild(this.pag.list.next);
    pag.appendChild(this.pag.list.submit);
  }

  this.setSelected = function(target) {
    var min = 0,
        max = this.count - 1;

    if(target > max || target < min) {
      return;
    }

    if(target == min) {
      this.pag.list.prev.classList.add('hidden');
    } else {
      this.pag.list.prev.classList.remove('hidden');
    }

    if(target == max) {
      this.pag.list.next.classList.add('hidden');
      this.pag.list.submit.classList.remove('hidden');
    } else {
      this.pag.list.next.classList.remove('hidden');
      this.pag.list.submit.classList.add('hidden');
    }

    this.tab.list[this.selected].classList.remove('selected');
    this.nav.list[this.selected].classList.remove('selected');

    this.selected = target;
    this.tab.list[this.selected].classList.add('selected');
    this.nav.list[this.selected].classList.add('selected');
  }
};

var tabbedForm = new tabs('tabbedForm');
tabbedForm.init();

</script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
