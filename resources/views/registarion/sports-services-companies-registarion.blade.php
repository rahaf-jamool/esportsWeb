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
                <h1> {!! trans('institutions.sportscompaniesRegistration') !!}</h1>
                <p>{!! trans('institutions.Ifyouhaveaccount') !!}<a class="login" href="{{ url(App::getLocale() . '/login') }}">{!! trans('institutions.loginpage') !!}</a>.</p>

                <div class="col-12">
                @include('layouts.message')
                <form class="form-horizontal" role="form" method="POST"
                      action="{{ url(App::getLocale() . '/register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="account-type" value="Sport-Company">

                    <h4>{!! trans('institutions.sportscompaniesDetails') !!}</h4>
                    <hr>
                    <div class="tabs" id="tabbedForm">
                        <nav class="tab-nav"></nav>
                        <div class="tab" data-name="{{trans('individually.General')}}">
                            <div class="d-flex flex-wrap">
                                <div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="Name" class="col-11 control-label  pb-2 pt-2">{{trans('institutions.sportscompaniesName')}}</label>
                                    <div class="col-12">
                                        <input id="Name" type="text" class="form-control" name="Name" value="{{ old('Name') }}" required autofocus>
                                        @if ($errors->has('Name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }} col-12 col-md-6">
                                    <label for="emirates-personal-passport-photo" class="col-11 control-label pb-2 pt-2">{{trans('individually.Company-logo')}}</label>
                                    <div class="col-sm-12 input-group mb-3">
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="file" id="file" aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                        </div>
                                    </div>
                                    @if ($errors->has('personal-passport-photo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('personal-passport-photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('licenceEndDate') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="licenceEndDate" class="col-11 control-label pb-2 pt-2">{{trans('institutions.licensedate')}}</label>
                                    <div class="col-12">
                                        <input type="date" id="licenceEndDate" class="form-control" name="licenceEndDate">
                                        @if ($errors->has('licenceEndDate'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('licenceEndDate') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('licenceImage') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="licenceImage" class="control-label  pb-2 pt-2">{{ trans('institutions.licensecopy') }}</label>
                                    <div class="col-sm-12 input-group mb-3">
                                        <div class="input-group">
                                            <input type="file" class="form-control" name="licenceImage" id="licenceImage" aria-describedby="uploadFile" aria-label="{{trans('individually.upload')}}">
                                        </div>
                                    </div>
                                    @if ($errors->has('licenceImage'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('licenceImage') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                        <label for="website" class="col-11 control-label pb-2 pt-2">{{trans('institutions.website')}}</label>
                                        <div class="col-12">
                                            <input id="website" type="text" class="form-control" name="website">
                                            @if ($errors->has('website'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('website') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="address" class="col-11 control-label pb-2 pt-2">{{trans('institutions.address')}}</label>
                                        <div class="col-12">
                                            <input id="address" type="text" class="form-control" name="address">
                                            @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                                        <label for="fax" class="col-11 control-label pb-2 pt-2">{{trans('institutions.fax')}}</label>
                                        <div class="col-12">
                                            <input id="fax" type="text" class="form-control" name="fax">
                                            @if ($errors->has('fax'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('fax') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('isEventCreator') ? ' has-error' : '' }} col-12 col-md-6">
                                    <span class="asterisks">*</span><label for="state" class="col-11 control-label pb-2 pt-2">{{trans('all.Do-organize-events')}}</label>
                                    <div class="col-sm-12 col-lg-9 radio-btn">
                                        <label class="radio-inline">
                                            <input type="radio" name="isEventCreator" value="true" style="" checked="checked">{{trans('individually.yes')}}
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="isEventCreator" value="false">{{trans('individually.no')}}
                                        </label>
                                        @if ($errors->has('isEventCreator'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('isEventCreator') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab" data-name="{{trans('individually.Person-Info')}}">
                            <div class="d-flex flex-wrap">
                                <fieldset id="payment-container col-12 col-md-6">
                                    <legend>{!! trans('institutions.OwnerDetails') !!}</legend>
                                    <div class="row">
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
                                                <select name="princedomId" class="form-control jcf-reset-appearance input-player" id="princedomId">
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
                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} col-12 col-md-6">
                                            <span class="asterisks">*</span><label for="phone"
                                                                                class="col-10 control-label pb-2 pt-2">{{trans('auth.phone')}}</label>
                                            <div class="col-12">
                                                <input id="phone" type="text" class="form-control" name="phone" placeholder="{{trans('auth.phoneNumberPlaceholderPattern')}}">
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
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

                                <fieldset id="payment-container" class="col-12">
                                    <legend>{!! trans('institutions.passportDetails') !!}</legend>
                                    <div class="row">
                                    <div class="form-group residence-only {{ $errors->has('passportNumber') ? ' has-error' : '' }} col-12 col-md-6">
                                        <span class="asterisks">*</span><label for="passportNumber" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.passport-number')}}</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="passportNumber" value="" id="passportNumber" class="form-control input-player" required>
                                        </div>
                                        @if ($errors->has('passportNumber'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('passportNumber') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('StartDate') ? ' has-error' : '' }} col-12 col-md-6">
                                        <span class="asterisks">*</span><label for="StartDate" class="col-11 control-label pb-2 pt-2">{{trans('institutions.startPassportDate')}}</label>
                                        <div class="col-12">
                                            <input id="StartDate" type="date" class="form-control" name="StartDate">
                                            @if ($errors->has('StartDate'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('StartDate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('EndDate') ? ' has-error' : '' }} col-12 col-md-6">
                                        <span class="asterisks">*</span><label for="EndDate" class="col-11 control-label pb-2 pt-2">{{trans('institutions.endPassportDate')}}</label>
                                        <div class="col-12">
                                            <input id="EndDate" type="date" class="form-control" name="EndDate">
                                            @if ($errors->has('EndDate'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('EndDate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('passport-file ') ? ' has-error' : '' }} col-12 col-md-6">
                                        <span class="asterisks">*</span><label for="passport-file " class="control-label  pb-2 pt-2">{{ trans('institutions.passportcopy') }}</label>
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
                                    </div>
                                </fieldset>
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
                                                                            <li>{{trans('auth.name')}} : <span id="card_Name"></span>
                                                                            </li>

                                                                            <li>{{trans('auth.account-type')}} : <span
                                                                                    id="card_account-type">{{trans('site.SportsServicesCompany')}} </span></li>

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

         /*    $('#card_account-type').text($('input[name="account-type"]').val()); */
            $('select[name="NationalityId"]').change(function (e) {
                $('#card_NationalityId').text(e.target.selectedOptions[0].text);
            });
            $('#file').change(function (e) {
                $('#card_image').attr('src', URL.createObjectURL(e.target.files[0]));
            });
            $('input[name="Name"]').blur((e) => inputBlur(e, "Name"));
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
