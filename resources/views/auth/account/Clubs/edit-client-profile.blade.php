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
		<div class="container" style="padding-top: 100px;">
			<h1 class="text-center my-4">{{trans('auth.edit-profile')}}</h1>
            @include('layouts.message')
            @include('sweetalert::alert')
            <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/profile/edit/' . $user['id']) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                        <input type="hidden" name="account-type"  value="{{ is_null($user['client']['type']) ? '' : $user['client']['type'] }}">
                        <input type="hidden" name="clientId" value="{{ is_null($user['clientId']) ? '' : $user['clientId'] }}">
                        <input type="hidden" name="orgnizationInfoId" value="{{ is_null($user['orgnizationInfoId']) ? '' : $user['orgnizationInfoId'] }}">
                        <input type="hidden" name="ownerId" value="{{ is_null($user['orgnizationInfo']['ownerId']) ? '' : $user['orgnizationInfo']['ownerId'] }}">
                        <input type="hidden" name="princedomId" value="{{ is_null($user['orgnizationInfo']['princedomId']) ? '' : $user['orgnizationInfo']['princedomId'] }}">
                        <input type="hidden" name="passportId" value="{{ is_null($user['orgnizationInfo']['owner']['passportId']) ? '' : $user['orgnizationInfo']['owner']['passportId'] }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="name" class="col-11 control-label  pb-2 pt-2">{{trans('institutions.clubName')}}</label>
                            <div class="col-12">
                                <input id="name" type="text" name="name"  class="form-control {{$errors->first('name') ? "is-invalid" : "" }} "
                                value="{{ old('name') ? old('name') : $user['name'] }}" required autofocus>
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
                            <label for="email" class="col-11 control-label pb-2 pt-2">{{trans('auth.email')}}</label>
                            <div class="col-12">
                                <input id="email" type="email" class="form-control {{$errors->first('email') ? "is-invalid" : "" }} "
                                value="{{ old('email') ? old('email') : $user['orgnizationInfo']['email'] }}" name="email" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="phone" class="col-11 control-label pb-2 pt-2">{{trans('auth.phone')}}</label>
                            <div class="col-12">
                                <input id="phone" type="text" class="form-control {{$errors->first('phone') ? "is-invalid" : "" }} "
                                value="{{ old('phone') ? old('phone') : $user['orgnizationInfo']['phone'] }}" name="phone">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- <div class="form-group{{ $errors->has('ClubTypeId') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="ClubTypeId" class="col-11 control-label pb-2 pt-2">{{trans('institutions.sportType')}}</label>
                            <div class="col-12">
                                <select name="ClubTypeId" class="form-select" id="ClubTypeId" style="direction: ltr;">
                                    <option value="">{{trans('individually.please-choose')}}</option>
                                    @if (count($clubTypes) > 0)
                                        @foreach($clubTypes as $type)
                                            <option  {{ $type['id'] == $user['clubTypeId'] ? 'selected' : '' }} value="{{$type['id']}}">{{ $type['name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($errors->has('ClubTypeId'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ClubTypeId') }}</strong>
                                </span>
                            @endif
                        </div> --}}

                        {{-- <div class="form-group{{ $errors->has('licenceIssuar') ? ' has-error' : '' }} d-none">
                            <span class="asterisks">*</span><label for="licenceIssuar" class="col-11 control-label pb-2 pt-2">{{trans('institutions.Placeofissue')}}</label>
                            <div class="col-12">

                                <select name="licenceIssuar" class="form-select" id="licenceIssuar" style="direction: ltr;">
                                    <option value="">{{trans('institutions.choosePlaceofissue')}}</option>
                                    <option value="0">uae</option>
                                    <option value="0">sy</option>
                                </select>
                                @if ($errors->has('Placeofissue'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Placeofissue') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> --}}
                         <div class="form-group{{ $errors->has('licenceEndDate') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="licenceEndDate" class="col-11 control-label pb-2 pt-2">{{trans('institutions.licensedate')}}</label>
                            <div class="col-12">
                                <input id="licenceEndDate" type="date" class="form-control {{$errors->first('licenceEndDate') ? "is-invalid" : "" }} "
                                value="{{ is_null(Carbon\Carbon::parse($user['orgnizationInfo']['licenceEndDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($user['orgnizationInfo']['licenceEndDate'])->format('Y-m-d') }}" name="licenceEndDate">

                                @if ($errors->has('licenceEndDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('licenceEndDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('licenceImage') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="licenceImage" class="control-label  pb-2 pt-2">{{ trans('institutions.licensecopy') }}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="{{ config('app.base_address') . $user['orgnizationInfo']['licenceImagePath'] }}" class="picture-src" id="wizardPicturePreview" height="200px" width="100%" title="" style="margin: 20px 0;"/>
                                        <input type="file" id="wizard-picture" name="licenceImage" class="form-control {{$errors->first('licenceImage') ? "is-invalid" : "" }} ">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('licenceImage') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('licenceImage'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('licenceImage') }}</strong>
                                </span>
                            @endif
                        </div>

                        <h4 class="pt-4">{!! trans('institutions.OwnerDetails') !!}</h4>
                        <hr>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="name" class="col-11 control-label  pb-2 pt-2">{{trans('all.name')}}</label>
                            <div class="col-12">
                                <input id="name" type="text" class="form-control {{$errors->first('name') ? "is-invalid" : "" }} "
                                value="{{ old('name') ? old('name') : $user['orgnizationInfo']['owner']['name'] }}" name="OName" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <label for="emirates-personal-passport-photo" class="col-11 control-label pb-2 pt-2">{{trans('individually.personal-passport-photo')}}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="{{ config('app.base_address') . $user['orgnizationInfo']['imagePath'] }}" class="picture-src" id="wizardPicturePreview3" height="200px" width="100%" title="" style="margin: 20px 0;"/>
                                        <input type="file" id="wizard-picture3" name="file" class="form-control {{$errors->first('file') ? "is-invalid" : "" }} ">
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
                        <div class="form-group{{ $errors->has('princedomId') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="princedomId" class="col-11 control-label pb-2 pt-2">{{trans('institutions.princedoms')}}</label>
                            <div class="col-12">
                                <select name="princedomId" class="form-select" id="princedomdateId" style="direction: ltr;">
                                    <option value="">{{trans('individually.please-choose')}}</option>
                                    @if (count($princedoms) > 0)
                                        @foreach($princedoms as $princedom)
                                             <option {{ $princedom['id'] == $user['orgnizationInfo']['princedomId'] ? 'selected' : '' }} value="{{$princedom['id']}}">{{ $princedom['name'] }}</option>
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

                        <div class="form-group residence-only {{ $errors->has('passportNumber') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="passportNumber" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.passport-number')}}</label>
                            <div class="col-sm-12">
                                <input name="passportNumber" value="{{ is_null($user['orgnizationInfo']['owner']['passport']['number']) ? '' : $user['orgnizationInfo']['owner']['passport']['number'] }}" id="passportNumber" class="form-control input-player">
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
                                value="{{ is_null(Carbon\Carbon::parse($user['orgnizationInfo']['owner']['passport']['startDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($user['orgnizationInfo']['owner']['passport']['startDate'])->format('Y-m-d') }}" name="StartDate">
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
                                <input id="EndDate" type="date" class="form-control" value="{{ is_null(Carbon\Carbon::parse($user['orgnizationInfo']['owner']['passport']['endDate'])->format('Y-m-d')) ? '' : Carbon\Carbon::parse($user['orgnizationInfo']['owner']['passport']['endDate'])->format('Y-m-d') }}" name="EndDate">
                                @if ($errors->has('EndDate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('EndDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('passport-file ') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="passport-file " class="control-label  pb-2 pt-2">{{ trans('institutions.passportcopy') }}</label>
                            <div class="col-sm-12 input-group mb-3">
                                <div class="picture-container">
                                    <div class="picture">
                                        <img src="{{ config('app.base_address') . $user['orgnizationInfo']['imagePath'] }}" class="picture-src" id="wizardPicturePreview1" height="200px" width="100%" title="" style="margin: 20px 0;"/>
                                        <input type="file" id="wizard-picture1" name="passport-file" class="form-control {{$errors->first('passport_file') ? "is-invalid" : "" }} ">
                                        <div class="invalid-feedback">
                                            {{ $errors->first('passport_file') }}
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
                        <fieldset id="payment-container">
                            <legend>{{trans('individually.social-media')}}</legend>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group required  {{ $errors->has('twitter') ? ' has-error' : '' }}">
                                        <label for="twitter" class="col-12 control-label pb-2 pt-2">{{trans('individually.twitter')}}</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="twitter" id="twitter" class="form-control input-player {{$errors->first('twitter') ? "is-invalid" : "" }} "
                                                value="{{ old('twitter') ? old('twitter') : $user['orgnizationInfo']['twitter'] }}">
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
                                                value="{{ old('instagram') ? old('instagram') : $user['orgnizationInfo']['instagram'] }}">
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
                                                value="{{ old('facebook') ? old('facebook') : $user['orgnizationInfo']['facebook'] }}">
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
                                                value="{{ old('youTube') ? old('youTube') : $user['orgnizationInfo']['youTube'] }}">
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
                                                value="{{ old('discord') ? old('discord') : $user['orgnizationInfo']['discord'] }}">
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
                                                value="{{ old('tikTok') ? old('tikTok') : $user['orgnizationInfo']['tikTok'] }}">
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
                                                value="{{ old('twitch') ? old('twitch') : $user['orgnizationInfo']['twitch'] }}">
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
                        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                            <label for="website" class="col-11 control-label pb-2 pt-2">{{trans('institutions.website')}}</label>
                            <div class="col-12">
                                <input id="website" type="text" class="form-control {{$errors->first('website') ? "is-invalid" : "" }} "
                                value="{{ old('website') ? old('website') : $user['orgnizationInfo']['website'] }}" name="website">
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-11 control-label pb-2 pt-2">{{trans('institutions.address')}}</label>
                            <div class="col-12">
                                <input id="address" type="text" class="form-control {{$errors->first('address') ? "is-invalid" : "" }} "
                                value="{{ old('address') ? old('address') : $user['orgnizationInfo']['address'] }}" name="address">
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('fax') ? ' has-error' : '' }}">
                            <label for="fax" class="col-11 control-label pb-2 pt-2">{{trans('institutions.fax')}}</label>
                            <div class="col-12">
                                <input id="fax" type="text" class="form-control {{$errors->first('fax') ? "is-invalid" : "" }} "
                                value="{{ old('fax') ? old('fax') : $user['orgnizationInfo']['fax'] }}" name="fax">
                                @if ($errors->has('fax'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
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
            $('input[type="email"]').blur(function () {
                let email = $(this)[0].value;
                email = email.split('@')[0];
                email = email.replace('#', '');
                email = email.replace('.', '');
                email = email.replace('-', '');
                email = email.replace('_', '');
                $('input[name="userName"]').val(email);
            });
            $('#card_account-type').text($('input[name="account-type"]').val());
            $('select[name="NationalityId"]').change(function (e) {
                $('#card_NationalityId').text(e.target.selectedOptions[0].text);
            });
            $('input[type="file"]').change(function (e) {
                $('#card_image').attr('src', URL.createObjectURL(e.target.files[0]));
            });
            function inputBlur(element, name) {
                let value = element.target.value;
                $('#card_' + name).text(value);
            }
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
             // Prepare the preview for profile picture
                $("#wizard-picture3").change(function(){
                readURL3(this);
            });
            //Function to show image before upload
            function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#wizardPicturePreview3').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endpush
