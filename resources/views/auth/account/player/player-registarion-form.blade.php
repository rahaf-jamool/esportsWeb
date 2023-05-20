@php
    $rtl = App::getLocale() == 'ar' ? 'rtl' : 'ltr';
    $floatRight = App::getLocale() == 'en' ? 'float:right;' : 'float:left;';
@endphp
<div class="container player-register-new-player w-100">
    <div class="row pt-3">
        <h1> {!! trans('individually.register-player-account') !!}</h1>

        <div class="col-12">
            <form id="player_register_form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <hr class="m-0">
                <input type="hidden" name="account-type" value="Player">
                <input type="hidden" name="team-id" value="{{ $teamId }}">
                <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="firstName" class="col-11 control-label  pb-2 pt-2">{{trans('individually.firstName')}}</label>
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
                    <span class="asterisks">*</span><label for="lastName" class="col-11 control-label pb-2 pt-2">{{trans('individually.lastName')}}</label>
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
                <fieldset id="password-container">
                    <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="password_confirmation" class="col-10 control-label pb-2 pt-2">{{trans('auth.password')}}</label>
                        <div class="col-sm-12">
                            <input type="password" autocomplete="off" name="password" value=""
                                   placeholder="كلمة المرور" id="input-password" class="form-control input-player" required>
                            <div class="hide-show" id="hide_show" style="display: block">
                                <span class="show" style="{{$floatRight}}"><i class="fa fa-eye" style="color: #000;"></i></span>
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
                        <span class="asterisks">*</span><label for="password_confirmation" class="col-10 control-label pb-2 pt-2">{{trans('auth.confirm-password')}}</label>
                        <div class="col-sm-12">
                            <input type="password" autocomplete="off" name="password_confirmation" value=""
                                   placeholder="تأكيد كلمة المرور" id="password_confirmation" class="form-control input-player" required>
                            <div class="hide-show1" id="hide_show1" style="display: block">
                                <span class="show" style="{{$floatRight}}"><i class="fa fa-eye" style="color: #000;"></i></span>
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
                    <span class="asterisks">*</span><label for="phone" class="col-11 control-label pb-2 pt-2">{{trans('auth.phone')}}</label>
                    <div class="col-12">
                        <input id="phone" type="text" class="form-control" name="phone" required>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                            <span class="asterisks">*</span><label for="gender" class="col-11 control-label pb-2 pt-2">{{trans('individually.sex')}}</label>
                            <div class="col-sm-12 radio-btn">
                                <label class="radio-inline">
                                    <input class="mx-2" type="radio" name="gender" value="M" style="">{{trans('individually.male')}}
                                </label>
                                <label class="radio-inline">
                                    <input class="mx-2" type="radio" name="gender" value="F">{{trans('individually.female')}}
                                </label>
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group {{ $errors->has('socialStatus') ? ' has-error' : '' }}">
                            <label for="socialStatus" class="col-11 control-label pb-2 pt-2">{{trans('individually.marital_status')}}</label>
                            <div class="col-sm-12 radio-btn">
                                <label class="radio-inline">
                                    <input class="mx-2" type="radio" name="socialStatus" value="Married" style="">{{trans('individually.married')}}
                                </label>
                                <label class="radio-inline">
                                    <input class="mx-2" type="radio" name="socialStatus" value="Single">{{trans('individually.single')}}
                                </label>
                                @if ($errors->has('socialStatus'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('socialStatus') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
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
                    <label for="BirthDate" class="col-11 control-label pb-2 pt-2">{{trans('individually.date-birth')}}</label>
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
                <div class="form-group {{ $errors->has('uaeResidency') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span><label for="uaeResidency" class="col-11 control-label pb-2 pt-2">{{trans('individually.uaeResidency')}}</label>
                    <div class="col-sm-12 radio-btn">
                        <label class="radio-inline jcf-label-active">
                            {{ trans('individually.yes') }}<input class="mx-2" type="radio" name="uaeResidency" value="1" checked="checked">
                        </label>
                        <label class="radio-inline">
                            {{ trans('individually.no') }}<input class="mx-2" type="radio" name="uaeResidency" value="0">
                        </label>
                        @if ($errors->has('uaeResidency'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('uaeResidency') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
             {{--  <div class="form-group residence-only {{ $errors->has('uaeIdNumber') ? ' has-error' : '' }}">
                    <span class="asterisks">*</span>
                    <label for="uaeIdNumber" class="col-11 control-label pb-2 pt-2">{{trans('individually.emirates-number')}}</label>
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
                    <span class="asterisks">*</span><label for="uaeIdEndDate" class="col-11 control-label pb-2 pt-2">{{trans('individually.emirates-expiry-date')}}</label>
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
                    <label for="nationality" class="col-11 control-label pb-2 pt-2">{{trans('individually.nationality')}}</label>
                    <div class="col-sm-12">
                        <select name="NationalityId" id="input-zone" class="form-control jcf-reset-appearance input-player" required>
                                <option value="">--- {{trans('individually.please-choose')}} ---</option>
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
                    <span class="asterisks">*</span><label for="passportNumber" class="col-11 control-label pb-2 pt-2">{{trans('individually.passport-number')}}</label>
                    <div class="col-sm-12">
                        <input type="text" name="passportNumber" value="" id="passportNumber" class="form-control input-player" required>
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
                <div class="row">
                    <div class="col-12 col-md-6">
                        <fieldset id="platform-container">
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
                                <div id="form-platform" class="mb-3 d-none">
                                    <div>
                                        <label for="namePlatform"
                                               class="col-md-12 control-label pb-2 pt-2">{{trans('individually.add-platform')}}</label>
                                        <div style="display: flex;gap: 20px;">
                                            <input type="text" name="namePlatform" value=""
                                                   id="namePlatform" class="form-control input-player col-4">
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
                    </div>
                    <div class="col-12 col-md-6">
                        <fieldset id="payment-container">
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
                                <div id="form-games" class="mb-3 d-none">
                                    <div>
                                        <label for="nameGame"
                                               class="col-md-12 control-label pb-2 pt-2">{{trans('individually.add-game')}}</label>
                                        <div style="display: flex;gap: 20px;">
                                            <input type="text" name="nameGame" value=""
                                                   id="nameGame" class="form-control input-player col-4">
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
                <div class="alert alert-success text-center success-register-player-message d-none"></div>
                <div class="alert alert-danger text-center error-register-player-message d-none"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4 pt-5">
                        <a href="javascript:void(0)" type="submit" class="btn btn-success submit">
                            {{trans('site.createaccount')}}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
