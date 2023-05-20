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
        <h1> {!! trans('institutions.ElectronicClubRegistration') !!}</h1>
        <p>{!! trans('institutions.Ifyouhaveaccount') !!}<a class="login" href="{{ url(App::getLocale() . '/login') }}">{!! trans('institutions.loginpage') !!}</a>.</p>

        <div class="col-12 col-lg-9">
            @include('layouts.message')
            <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/register') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="account-type" value="Club">
                <h4>{!! trans('institutions.clubDetails') !!}</h4>
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
                <div class="form-group{{ $errors->has('Name') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="Name" class="col-11 control-label  pb-2 pt-2">{{trans('institutions.clubName')}}</label>
                    <div class="col-12">
                        <input id="Name" type="text" class="form-control" name="Name" value="{{ old('Name') }}" required autofocus>
                        @if ($errors->has('Name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('Name') }}</strong>
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
{{--                <div class="form-group{{ $errors->has('userName') ? ' has-error' : '' }}">--}}
{{--                    <span class="asterisks">*</span><label for="userName" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.username')}}</label>--}}
{{--                    <div class="col-12">--}}
{{--                        <input id="userName" type="text" class="form-control" name="userName" value="" required>--}}
{{--                        @if ($errors->has('userName'))--}}
{{--                            <span class="help-block">--}}
{{--                                <strong>{{ $errors->first('userName') }}</strong>--}}
{{--                            </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="password_confirmation" class="col-11 control-label pb-2 pt-2">{{trans('auth.password')}}</label>
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
                <div class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="password_confirmation" class="col-11 control-label pb-2 pt-2">{{trans('auth.confirm-password')}}</label>
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
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="phone" class="col-11 control-label pb-2 pt-2">{{trans('auth.phone')}}</label>
                    <div class="col-12">
                        <input id="phone" type="text" class="form-control" name="phone">
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('isEventCreator') ? ' has-error' : '' }}">
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
                <div class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                    <label for="emirates-personal-passport-photo" class="col-11 control-label pb-2 pt-2">{{trans('individually.Club-logo ')}}</label>
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
                {{-- <div class="form-group{{ $errors->has('ClubTypeId') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="ClubTypeId" class="col-11 control-label pb-2 pt-2">{{trans('institutions.sportType')}}</label>
                    <div class="col-12">
                        <select name="ClubTypeId" class="form-select" id="ClubTypeId" style="direction: {{$rtl}}">
                            <option value="">{{trans('individually.please-choose')}}</option>
                            @if (count($clubTypes) > 0)
                                @foreach($clubTypes as $type)
                                    <option value="{{$type['id']}}" style="direction: {{$rtl}}">{{ $type['name'] }}</option>
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
                <div class="form-group{{ $errors->has('licenceIssuar') ? ' has-error' : '' }} d-none">
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
                </div>
                <div class="form-group{{ $errors->has('licenceEndDate') ? ' has-error' : '' }}">
                    <label for="licenceEndDate" class="col-11 control-label pb-2 pt-2">{{trans('institutions.licensedate')}}</label>
                    <div class="col-12">
                        <input type="date" id="licenceEndDate" class="form-control" name="licenceEndDate">
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
                <h4 class="pt-4">{!! trans('institutions.OwnerDetails') !!}</h4>
                <hr>
                <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="firstName" class="col-11 control-label  pb-2 pt-2">{{trans('institutions.fName')}}</label>
                    <div class="col-12">
                        <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" required autofocus>
                        @if ($errors->has('firstName'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="lastName" class="col-11 control-label  pb-2 pt-2">{{trans('institutions.lName')}}</label>
                    <div class="col-12">
                        <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>
                        @if ($errors->has('lastName'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lastName') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('princedomId') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="princedomId" class="col-11 control-label pb-2 pt-2">{{trans('institutions.princedoms')}}</label>
                    <div class="col-12">
                        <select name="princedomId" class="form-control" id="princedomId">
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
                <div class="form-group{{ $errors->has('StartDate') ? ' has-error' : '' }}">
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
                <div class="form-group{{ $errors->has('EndDate') ? ' has-error' : '' }}">
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
                <div class="form-group{{ $errors->has('passport-file ') ? ' has-error' : '' }}">
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
                        <div class="col-6">
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
                        <div class="col-6">
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
                        <div class="col-6">
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
                        <div class="col-6">
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
                    </div><!--.row-->
                </fieldset>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4 pt-5">
                        <button type="submit" class="btn btn-success">
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
