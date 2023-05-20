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

@section('og-image' , url(asset('')))
@section('og-url' , url(Request::url()))
@section('page-style', asset(''))
{{--{{dd(session('loggedUser'))}}--}}
@section('content')
	<div class="information" style="margin-top: 50px">
		<div class="container">
			<h1 class="text-center my-4">{{trans('auth.edit-profile')}}</h1>
			@include('layouts.message')
            @include('sweetalert::alert')
			<form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/profile/edit/' . $user['id']) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                <input type="hidden" name="account-type"  value="{{ is_null($user['client']['type']) ? '' : $user['client']['type'] }}">
				<input type="hidden" name="clientId" value="{{ is_null($user['clientId']) ? '' : $user['clientId'] }}">
                <input type="hidden" name="personInfoId" value="{{ is_null($user['personInfoId']) ? '' : $user['personInfoId'] }}">
                <input type="hidden" name="passportId" value="{{ is_null($user['personInfo']['passportId']) ? '' : $user['personInfo']['passportId'] }}">
                <input type="hidden" name="princedomId" value="{{ is_null($user['personInfo']['princedomId']) ? '' : $user['personInfo']['princedomId'] }}">
                <input type="hidden" name="clubId" value="{{ is_null($user['clubId']) ? '' : $user['clubId'] }}">
                <input type="hidden" name="academyId" value="{{ is_null($user['academyId']) ? '' : $user['academyId'] }}">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="name" class="col-md-4 control-label  pb-2 pt-2">{{trans('auth.name')}}</label>
                    <div class="col-12">
                        <input id="name" type="text" class="form-control" name="name"
                               value="{{ is_null($user['name']) ? '' : $user['name'] }}" required autofocus>
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
                        <input id="email" type="email" class="form-control" name="email" value="{{ is_null($user['personInfo']['email']) ? '' : $user['personInfo']['email'] }}" required>
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
                        <input id="phone" type="text" value="{{ is_null($user['personInfo']['phone']) ? '' : $user['personInfo']['phone'] }}" class="form-control" name="phone" required>
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
                                <input type="radio" name="gender" value="M"  {{ ($user['personInfo']['gender']=="M")? "checked" : "" }} style="">{{trans('individually.male')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="gender" value="F"  {{ ($user['personInfo']['gender']=="F")? "checked" : "" }}>{{trans('individually.female')}}
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
                                <input type="radio" name="socialStatus" value="Married" {{ ($user['personInfo']['socialStatus']=="Married")? "checked" : "" }} style="" checked>{{trans('individually.married')}}
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="socialStatus" value="Single" {{ ($user['personInfo']['socialStatus']=="Single")? "checked" : "" }}>{{trans('individually.single')}}
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
                            <input type="date" name="BirthDate" value="{{ is_null(Carbon\Carbon::parse($user['personInfo']['birthDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($user['personInfo']['birthDate'])->format('Y-m-d') }}" data-date-format="YYYY-MM-DD"
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
                                {{ trans('individually.yes') }}<input type="radio" name="uaeResidency" {{ ($user['personInfo']['uaeResidency']== true)? "checked" : "" }} value="true">
                            </label>
                            <label class="radio-inline">
                                {{ trans('individually.no') }}<input type="radio" name="uaeResidency" {{ ($user['personInfo']['uaeResidency']== false )? "checked" : "" }} value="false">
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
								<option {{ $nationality['id'] == $user['personInfo']['nationalityId'] ? 'selected' : '' }} value="{{$nationality['id']}}">{{ $nationality['name'] }}</option>
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
                        <input type="number" name="passportNumber" value="{{ is_null($user['personInfo']['passport']['number']) ? '' : $user['personInfo']['passport']['number'] }}" min="0" id="passportNumber" class="form-control input-player" required>
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
                            <div class="picture-container">
                                <div class="picture">
                                    <img src="{{ config('app.base_address') . $user['personInfo']['passport']['imagePath'] }}" class="picture-src" id="wizardPicturePreview" height="200px" width="100%" title="" style="margin: 20px 0;"/>
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
                <div class="form-group{{ $errors->has('StartDate') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="StartDate" class="col-11 control-label pb-2 pt-2">{{trans('institutions.startPassportDate')}}</label>
                            <div class="col-12">
                                <input id="StartDate" type="date" class="form-control {{$errors->first('startDate') ? "is-invalid" : "" }} "
                                value="{{ is_null(Carbon\Carbon::parse($user['personInfo']['passport']['startDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($user['personInfo']['passport']['startDate'])->format('Y-m-d') }}" name="StartDate">
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
                                <input id="EndDate" type="date" class="form-control" value="{{ is_null(Carbon\Carbon::parse($user['personInfo']['passport']['endDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($user['personInfo']['passport']['endDate'])->format('Y-m-d') }}" name="EndDate">
                                @if ($errors->has('EndDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('EndDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                </div>
                <div class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                        <label for="emirates-personal-passport-photo" class="col-11 control-label pb-2 pt-2">{{trans('individually.personal-passport-photo')}}</label>
                        <div class="col-sm-12 input-group mb-3">
                            <div class="picture-container">
                                    <div class="picture">
                                        <img src="{{ config('app.base_address') . $user['personInfo']['imagePath'] }}" class="picture-src" id="wizardPicturePreview1" height="200px" width="100%" title="" style="margin: 20px 0;"/>
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
                                            value="{{ old('twitter') ? old('twitter') : $user['personInfo']['twitter'] }}">
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
                                            value="{{ old('instagram') ? old('instagram') : $user['personInfo']['instagram'] }}">
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
                                            value="{{ old('facebook') ? old('facebook') : $user['personInfo']['facebook'] }}">
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
                                            value="{{ old('youTube') ? old('youTube') : $user['personInfo']['youTube'] }}">
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
                                            value="{{ old('discord') ? old('discord') : $user['personInfo']['discord'] }}">
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
                                            value="{{ old('tikTok') ? old('tikTok') : $user['personInfo']['tikTok'] }}">
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
                                            value="{{ old('twitch') ? old('twitch') : $user['personInfo']['twitch'] }}">
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
                    <div class="form-group mb-3">
                        @if (count($games) > 0)
                            @foreach($games as $game)
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="refereeGames_{{$game['id']}}"
                                           value="{{ $game['id'] . '|' . $game['name'] }}" name="refereeGames[]"
										   @foreach ( $user['refereeGames'] as  $val)
                                                    @if ($val['gameId'] == $game['id'])
                                                            checked
                                                    @endif
                                            @endforeach >
                                    <label class="custom-control-label" for="refereeGames_{{$game['id']}}">{{ $game['name'] }}</label>
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
@endsection

@push('js')
    <script>
		$(document).ready(function () {
			// $(document).on('change', '.file-upload-button', function(event) {
			//
			// });
			$('.upload_image').click(function () {
				let form = $('.information .card-body form');
				let ajaxUrl = form.find('input[name="ajax_url"]').val();
				let userId = form.find('input[name="user_id"]').val();
				let files = $('#file')[0].files;
				let token = form.find('input[name="_token"]').val();
				var reader = new FileReader();
				// console.log(ajaxUrl, userId, files, token);
				// return;
				reader.onload = function () {
					let base64String = reader.result.replace("data:", "").replace(/^.+,/, "");
					if (ajaxUrl == '' || userId == '' || files == '' || token == '') return;
					// console.log(files.length);
					if(files.length > 0) {
						var formData = new FormData();
						// Append data
						formData.append('_token', token);
						formData.append('file', files[0]);
						formData.append('userId', userId );
						formData.append('imgBase64String', base64String );
						$.ajax({
							url: ajaxUrl,
							type: 'POST',
							contentType: false,
							processData: false,
							// dataType: 'json',
							data: formData,
							beforeSend: function () {
								let uploadButtonTxt = "{{ trans('auth.uploading') }}";
								// disabled qty Button
								$('#uploadFile').addClass('disabled');
								$('#uploadFile').text(`${uploadButtonTxt}`);
							},
							error: function(data, status, error) {
								let uploadButtonTxt = "{{ trans('auth.upload') }}";
								$('#uploadFile').removeClass('disabled');
								$('#uploadFile').text(`${uploadButtonTxt}`);
								console.log(data);
								// alert(data.responseJSON.error);
							},
							success: function(data, status) {
								let uploadButtonTxt = "{{ trans('auth.upload') }}";
								// console.log(data, status);
								if (status == 'success') {
									$('#uploadFile').removeClass('disabled');
									$('#uploadFile').text(`${uploadButtonTxt}`);
									$('.image-viewer-box').removeClass('d-none').find('img').attr('src', '{{config('app.base_address')}}' + data.url);
									$('input[name="image_url"]').val(data.url);
									$('.alert-msg').removeClass('d-none').text(data.success);
									setTimeout(() => {
										$('.alert-msg').addClass('d-none').fadeOut(1000);
									}, 3000);
								}
							},
						});	 // end ajax
					}
				}
				reader.readAsDataURL(files[0]);
			}); // click button

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

