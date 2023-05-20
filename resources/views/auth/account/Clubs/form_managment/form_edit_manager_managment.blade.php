@php
    $rtl = App::getLocale() == 'ar' ? 'rtl' : 'ltr';
@endphp
@extends('layouts.master')

@section('title' , trans('all.site-title'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
    @section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))
@endif
@section('keywords' , config('app.keywords'))
@section('og-title' , config('app.name')  . "-" . $pageInfo['title'])
@section('page-style', asset('assets/css/account.css'))
@section('og-image' , url(asset('')))
@section('og-url' , url(Request::url()))
@section('page-style', asset(''))
@section('content')
	<div class="information" style="margin-top: 50px">
		<div class="container" style="padding-top: 100px;">
			<h1 class="text-center my-4">{{trans('site.add-player')}}</h1>
            @include('layouts.message')
            @include('sweetalert::alert')
            <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/update/managment/' . $response['id']) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <input type="hidden" name="responseId"  value="{{ is_null($response['id']) ? '' : $response['id'] }}">
                <input type="hidden" name="state"  value="{{ is_null($response['client']['state']) ? '' : $response['client']['state'] }}">

                <input type="hidden" name="account-type"  value="{{ is_null($response['client']['type']) ? '' : $response['client']['type'] }}">
				<input type="hidden" name="clientId" value="{{ is_null($response['clientId']) ? '' : $response['clientId'] }}">
                <input type="hidden" name="personInfoId" value="{{ is_null($response['personInfoId']) ? '' : $response['personInfoId'] }}">
                <input type="hidden" name="passportId" value="{{ is_null($response['personInfo']['passportId']) ? '' : $response['personInfo']['passportId'] }}">
                <input type="hidden" name="princedomId" value="{{ is_null($response['personInfo']['princedomId']) ? '' : $response['personInfo']['princedomId'] }}">
                <input type="hidden" name="clubId" value="{{ is_null($response['clubId']) ? '' : $response['clubId'] }}">
                <input type="hidden" name="academyId" value="{{ is_null($response['academyId']) ? '' : $response['academyId'] }}">
                @if ($user['client']['type'] == 'Club')
                    <input type="hidden" name="clubId" value="{{ is_null($user['id']) ? '' : $user['id'] }}">
                    <input type="hidden" name="clubName" value="{{ is_null($user['name']) ? '' : $user['name'] }}">
                @elseif ($user['client']['type'] == 'Academy')
                    <input type="hidden" name="academyId" value="{{ is_null($user['id']) ? '' : $user['id'] }}">
                    <input type="hidden" name="academyName" value="{{ is_null($user['name']) ? '' : $user['name'] }}">
                @endif
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="name" class="col-md-4 control-label  pb-2 pt-2">{{trans('auth.name')}}</label>
                    <div class="col-12">
                        <input id="name" type="text" class="form-control" name="name"
                               value="{{ is_null($response['name']) ? '' : $response['name'] }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
				{{-- <div class="form-group{{ $errors->has('userName') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="userName" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.username')}}</label>
                        <div class="col-12">
                            <input id="userName" type="text" class="form-control" name="userName" required>
                            @if ($errors->has('userName'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('userName') }}</strong>
                                    </span>
                            @endif
                        </div>
                </div> --}}
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="email" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.email')}}</label>
                    <div class="col-12">
                        <input id="email" type="email" class="form-control" name="email" value="{{ is_null($response['personInfo']['email']) ? '' : $response['personInfo']['email'] }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                {{-- <div class="form-group{{ $errors->has('userName') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="userName" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.username')}}</label>
                    <div class="col-sm-12">
                        <input id="userName" type="text" class="form-control" name="userName" value="{{ is_null($user['userName']) ? '' : $user['userName'] }}" required>
                        @if ($errors->has('userName'))
                            <span class="help-block">
                                <strong>{{ $errors->first('userName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> --}}
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="phone" class="col-11 control-label pb-2 pt-2">{{trans('auth.phone')}}</label>
                    <div class="col-12">
                        <input id="phone" type="text" value="{{ is_null($response['personInfo']['phone']) ? '' : $response['personInfo']['phone'] }}" class="form-control" name="phone" required>
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
                                <input type="radio" name="gender" value="M"  {{ ($response['personInfo']['gender']=="M")? "checked" : "" }} style="">{{trans('individually.male')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="F"  {{ ($response['personInfo']['gender']=="F")? "checked" : "" }}>{{trans('individually.female')}}
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
                                <input type="radio" name="socialStatus" value="Married" {{ ($response['personInfo']['socialStatus']=="Married")? "checked" : "" }} style="">{{trans('individually.married')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="socialStatus" value="Single" {{ ($response['personInfo']['socialStatus']=="Single")? "checked" : "" }}>{{trans('individually.single')}}
                            </label>
                            @if ($errors->has('socialStatus'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('socialStatus') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                {{-- <div class="form-group {{ $errors->has('please-choose') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="please-choose" class="col-11 control-label pb-2 pt-2">{{trans('individually.educational-level')}}</label>
                    <div class="col-sm-12">
                        <select name="educationLevelId" id="input-education-degree"
                                class="form-control jcf-reset-appearance input-player" required>
                            <option value=""> --- {{trans('individually.please-choose')}} ---</option>
                            @if (count($educationLevel) > 0)
                                @foreach($educationLevel as $level)
                                    <option value="{{ $level['id'] }}" style="direction: {{$rtl}}">{{ $level['name'] }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('educationLevelId'))
                            <span class="help-block">
                                <strong>{{ $errors->first('educationLevelId') }}</strong>
                            </span>
                        @endif
                    </div>
                </div> --}}
                <div class="form-group {{ $errors->has('BirthDate') ? ' has-error' : '' }}">
                    <label for="BirthDate" class="col-12 control-label pb-2 pt-2">{{trans('individually.date-birth')}}</label>
                    <div class="col-sm-12">
                        <div class="input-group date">
                            <input type="date" name="BirthDate" value="{{ is_null(Carbon\Carbon::parse($response['personInfo']['birthDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($response['personInfo']['birthDate'])->format('Y-m-d') }}" data-date-format="YYYY-MM-DD"
                                   id="input-date-of-birth" class="form-control input-player" required>
                        </div>
                        @if ($errors->has('BirthDate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('BirthDate') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
				<div class="form-group {{ $errors->has('uaeResidency') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="uaeResidency" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.uaeResidency')}}</label>
                        <div class="col-sm-12 radio-btn">
                            <label class="radio-inline jcf-label-active">
                                {{ trans('individually.yes') }}<input type="radio" name="uaeResidency" {{ ($response['personInfo']['uaeResidency']== true)? "checked" : "" }} value="true">
                            </label>
                            <label class="radio-inline">
                                {{ trans('individually.no') }}<input type="radio" name="uaeResidency" {{ ($response['personInfo']['uaeResidency']== false )? "checked" : "" }} value="false">
                            </label>
                            @if ($errors->has('uaeResidency'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('uaeResidency') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    {{-- <div class="form-group residence-only {{ $errors->has('uaeIdNumber') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span>
                        <label for="uaeIdNumber" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.emirates-number')}}</label>
                        <div class="col-sm-12">
                            <input type="text" name="uaeIdNumber" placeholder="784-XXXX-XXXXXXX-X"
                                   id="input-id-no"  class="form-control input-player {{$errors->first('uaeIdNumber') ? "is-invalid" : "" }} "
                                value="{{ is_null($user['personInfo']['uaeIdNumber']) ? '' : $user['personInfo']['uaeIdNumber'] }}" required>

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
                                       id="uaeIdEndDate" class="form-control input-player {{$errors->first('uaeIdEndDate') ? "is-invalid" : "" }} "
                                value="{{ is_null($user['personInfo']['uaeIdEndDate']) ? '' : $user['personInfo']['uaeIdEndDate'] }}" required>

                            </div>
                            @if ($errors->has('uaeIdEndDate'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('uaeIdEndDate') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div> --}}
                <div class="form-group residence-only {{ $errors->has('nationality') ? ' has-error' : '' }}">
                    <label for="nationality" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.nationality')}}</label>
                    <div class="col-sm-12">
                        <select name="NationalityId" id="input-zone" class="form-control jcf-reset-appearance input-player" required>
                            <option value=""> --- {{trans('individually.please-choose')}} ---</option>
                            @foreach($nationalities as $nationality)
								<option {{ $nationality['id'] == $response['personInfo']['nationalityId'] ? 'selected' : '' }} value="{{$nationality['id']}}">{{ $nationality['name'] }}</option>
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
                        <input type="text" name="passportNumber" value="{{ is_null($response['personInfo']['passport']['number']) ? '' : $response['personInfo']['passport']['number'] }}" id="passportNumber" class="form-control input-player" required>
                    </div>
                    @if ($errors->has('passportNumber'))
                        <span class="help-block">
                            <strong>{{ $errors->first('passportNumber') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('StartDate') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="StartDate" class="col-11 control-label pb-2 pt-2">{{trans('institutions.startPassportDate')}}</label>
                            <div class="col-12">
                                <input id="StartDate" type="date" class="form-control {{$errors->first('startDate') ? "is-invalid" : "" }} "
                                value="{{ is_null(Carbon\Carbon::parse($response['personInfo']['passport']['startDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($response['personInfo']['passport']['startDate'])->format('Y-m-d') }}" name="StartDate">
                                @if ($errors->has('startDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('startDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="form-group{{ $errors->has('EndDate') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="EndDate" class="col-11 control-label pb-2 pt-2">{{trans('institutions.endPassportDate')}}</label>
                            <div class="col-12">
                                <input id="EndDate" type="date" class="form-control" value="{{ is_null(Carbon\Carbon::parse($response['personInfo']['passport']['endDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($response['personInfo']['passport']['endDate'])->format('Y-m-d') }}" name="EndDate">
                                @if ($errors->has('EndDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('EndDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="form-group{{ $errors->has('passport-file ') ? ' has-error' : '' }}">
                        <span class="asterisks">* </span><label for="passport-file " class="control-label  pb-2 pt-2">{{ trans('institutions.passportcopy') }}</label>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="picture-container">
                                <div class="picture">
                                    <img src="{{ config('app.base_address') . $response['personInfo']['passport']['imagePath'] }}" class="picture-src" id="wizardPicturePreview" height="200px" width="100%" title="" style="margin: 20px 0;"/>
                                    <input type="file" id="wizard-picture" name="passport-file" class="form-control {{$errors->first('imagePath') ? "is-invalid" : "" }} ">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('imagePath') }}
                                    </div>
                                </div>
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
                            <div class="picture-container">
                                    <div class="picture">
                                        <img src="{{ config('app.base_address') . $response['personInfo']['imagePath'] }}" class="picture-src" id="wizardPicturePreview1" height="200px" width="100%" title="" style="margin: 20px 0;"/>
                                        <input type="file" id="wizard-picture1" name="file" class="form-control {{$errors->first('personal-passport-photo') ? "is-invalid" : "" }} ">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('personal-passport-photo') }}
                                        </div>
                                    </div>
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
                                        <input type="text" name="twitter" id="twitter" class="form-control input-player {{$errors->first('twitter') ? "is-invalid" : "" }} "
                                            value="{{ old('twitter') ? old('twitter') : $response['personInfo']['twitter'] }}">
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
                                        <input type="text" name="instagram" id="instagram" class="form-control input-player {{$errors->first('instagram') ? "is-invalid" : "" }} "
                                            value="{{ old('instagram') ? old('instagram') : $response['personInfo']['instagram'] }}">
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
                                        <input type="text" name="facebook" id="facebook" class="form-control input-player {{$errors->first('facebook') ? "is-invalid" : "" }} "
                                            value="{{ old('facebook') ? old('facebook') : $response['personInfo']['facebook'] }}">
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
                                        <input type="text" name="youtube" id="youtube" class="form-control input-player {{$errors->first('youTube') ? "is-invalid" : "" }} "
                                            value="{{ old('youTube') ? old('youTube') : $response['personInfo']['youTube'] }}">
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
                                        <input type="text" name="discord" id="discord" class="form-control input-player {{$errors->first('discord') ? "is-invalid" : "" }} "
                                            value="{{ old('discord') ? old('discord') : $response['personInfo']['discord'] }}">
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
                                        <input type="text" name="tikTok" id="tikTok" class="form-control input-player {{$errors->first('tikTok') ? "is-invalid" : "" }} "
                                            value="{{ old('tikTok') ? old('tikTok') : $response['personInfo']['tikTok'] }}">
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
                                        <input type="text" name="twitch" id="twitch" class="form-control input-player {{$errors->first('twitch') ? "is-invalid" : "" }} "
                                            value="{{ old('twitch') ? old('twitch') : $response['personInfo']['twitch'] }}">
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
					<fieldset id="payment-container">
                    <legend><span class="asterisks">*</span> {{trans('individually.game-platform')}}</legend>
                    {{--                        <p style="color: red;size: 13px;">{{trans('individually.select-game-platform')}}</p>--}}
                    <div class="form-group mb-3">
                        @if (count($games) > 0)
                            @foreach($games as $game)
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="managerGames_{{$game['id']}}"
                                           value="{{ $game['id'] . '|' . $game['name'] }}" name="managerGames[]"
										    @foreach ( $response['managerGames'] as  $val)
                                                    @if ($val['gameId'] == $game['id'])
                                                            checked
                                                    @endif
                                            @endforeach >
                                    <label class="custom-control-label" for="managerGames_{{$game['id']}}">{{ $game['name'] }}</label>
                                </div>
                            @endforeach
                        @endif
                        @if ($errors->has('games'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('games') }}</strong>
                                </span>
                        @endif
                    </div>
                </fieldset>
				<div class="form-group">
                    <div class="col-md-6 col-md-offset-4 pt-5">
                        <button type="submit" class="btn btn-success">
                        {{trans('all.edit')}}
                        </button>
                    </div>
                </div>
			</form>
            </div>
        </div>
    </div>
    @endsection

    @push('js')
        <script>
            $(document).ready(function () {
            // Prepare the preview for profile picture
            $("#wizard-picture").change(function(){
                    readURL(this);
                });
                //Function to show image before upload
                function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                    }
                }

                // Prepare the preview for profile picture
                    $("#wizard-picture1").change(function(){
                    readURL1(this);
                });
                //Function to show image before upload
                function readURL1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#wizardPicturePreview1').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                    }
                }
            });
        </script>
    @endpush

