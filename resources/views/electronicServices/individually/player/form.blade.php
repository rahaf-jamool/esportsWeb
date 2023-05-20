<div class="container clubRegistration">
    <div class="row pt-5">
        <h1> {!! trans('individually.register-player-account') !!}</h1>
        <p>{!! trans('institutions.Ifyouhaveaccount') !!}<a href="">{!! trans('institutions.loginpage') !!}</a>.</p>

        <div class="col-12 col-lg-9">
            @include('layouts.message')
                    <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/register') }}">
                        {{ csrf_field() }}
                        <h4>{!! trans('individually.player-data') !!}</h4>
                        <hr>
                        <div class="form-group{{ $errors->has('firstName') ? ' has-error' : '' }}">
                            <span>* </span><label for="firstName" class="col-md-4 control-label  pb-2 pt-2">{{trans('individually.firstName')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" required autofocus>
                                @if ($errors->has('firstName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lastName') ? ' has-error' : '' }}">
                            <span>* </span><label for="lastName" class="col-md-4 control-label  pb-2 pt-2">{{trans('individually.lastName')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>
                                @if ($errors->has('lastName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <span>* </span><label for="email" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.email')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="email" type="email" class="form-control" name="email" value="" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <span>* </span><label for="phone" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.phone')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="phone" type="text" class="form-control" name="phone">
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('gender') ? ' has-error' : '' }}">
                            <span>* </span><label for="phone" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.sex')}}</label>
                            <div class="col-sm-12 col-lg-9 radio-btn">
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="1" style="">ذكر
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="gender" value="2">أنثى
                                </label>
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('marital_status') ? ' has-error' : '' }}">
                            <span>* </span><label for="marital_status" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.sex')}}</label>
                            <div class="col-sm-12 col-lg-9 radio-btn">
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" value="1" style="">متزوج
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="marital_status" value="2">أعزب
                                </label>
                                @if ($errors->has('marital_status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('marital_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('please-choose') ? ' has-error' : '' }}">
                            <span>* </span><label for="please-choose" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.educational-level')}}</label>
                            <div class="col-sm-12">
                                <select name="education_degree" id="input-education-degree" class="form-control jcf-reset-appearance input-player">
                                    <option value=""> --- {{trans('individually.please-choose')}} ---</option>
                                    <option value="1">دكتوراه</option>
                                    <option value="2">ماجيستير</option>
                                    <option value="3">بكالوريوس</option>
                                    <option value="4">دبلوم</option>
                                    <option value="5">ثانوية عامة</option>
                                    <option value="6">أخرى</option>
                                </select>
                                @if ($errors->has('please-choose'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('please-choose') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('date_of_birth') ? ' has-error' : '' }}">
                            <span>* </span><label for="date_of_birth" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.date-birth')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="date_of_birth" value="" data-date-format="YYYY-MM-DD" id="input-date-of-birth" class="form-control input-player">
                                </div>
                                @if ($errors->has('date_of_birth'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('nationality') ? ' has-error' : '' }}">
                            <span>* </span><label for="nationality" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.nationality')}}</label>
                            <div class="col-sm-12 radio-btn">
                                <label class="radio-inline jcf-label-active">
                                    نعم<input type="radio" name="nationality" value="1" checked="checked">
                                </label>
                                <label class="radio-inline">
                                    لا<input type="radio" name="nationality" value="2">
                                </label>
                                @if ($errors->has('nationality'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group residence-only {{ $errors->has('emirates-number') ? ' has-error' : '' }}">
                            <span>* </span><label for="emirates-number" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.emirates-number')}}</label>
                            <div class="col-sm-12">
                                <input type="text" name="emirates-number" value="" placeholder="784-XXXX-XXXXXXX-X" id="input-id-no" class="form-control input-player">
                            </div>
                            @if ($errors->has('emirates-number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('emirates-number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group residence-only {{ $errors->has('emirates-expiry-date') ? ' has-error' : '' }}">
                            <span>* </span><label for="emirates-expiry-date" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.emirates-expiry-date')}}</label>
                            <div class="col-sm-12">
                                <div class="input-group date">
                                    <input type="date" name="id_expire" value="" data-date-format="YYYY-MM-DD" id="input-id-expire" class="form-control input-player">
                                </div>
                                @if ($errors->has('emirates-expiry-date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('emirates-expiry-date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group residence-only {{ $errors->has('emirate') ? ' has-error' : '' }}">
                            <span>* </span><label for="emirate" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.emirate')}}</label>
                            <div class="col-sm-12">
                                    <select name="emirate" id="input-zone" class="form-control jcf-reset-appearance input-player">
                                        <option value=""> --- {{trans('individually.please-choose')}}  --- </option>
                                        <option value="3506">أبو ظبي</option>
                                        <option value="3512">أم القيوين</option>
                                        <option value="3509">الشارقة</option>
                                        <option value="3508">الفجيرة</option>
                                        <option value="3510">دبي</option>
                                        <option value="3511">رأس الخيمة</option>
                                        <option value="3507">عجمان</option>
                                    </select>
                                    @if ($errors->has('emirate'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('emirate') }}</strong>
                                        </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group residence-only {{ $errors->has('emirates-passport-number') ? ' has-error' : '' }}">
                            <span>* </span><label for="emirates-passport-number" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.passport-number')}}</label>
                            <div class="col-sm-12">
                            <input type="text" name="g_passport_no" value="" id="input-g-passport-no" class="form-control input-player">
                            </div>
                            @if ($errors->has('passport-number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('passport-number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group residence-only {{ $errors->has('emirates-personal-passport-photo') ? ' has-error' : '' }}">
                            <span>* </span><label for="emirates-personal-passport-photo" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.personal-passport-photo')}}</label>
                            <div class="col-sm-12">
                                <span class="file-input btn btn-primary btn-file">
                                     {{trans('individually.upload-file')}} <input type="file">
                            </div>
                            @if ($errors->has('personal-passport-photo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('personal-passport-photo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </fieldset>
                    <fieldset id="payment-container">
                        <legend>{{trans('individually.social-media')}}</legend>
                        <div class="form-group required  {{ $errors->has('twitter') ? ' has-error' : '' }}">
                            <span>* </span><label for="twitter" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.twitter')}}</label>
                            <div class="col-sm-12">
                                <input type="text" name="twitter" value="" id="twitter" class="form-control input-player">
                            </div>
                            @if ($errors->has('twitter'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('twitter') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group required {{ $errors->has('instagram') ? ' has-error' : '' }}">
                            <span>* </span><label for="instagram" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.instagram')}}</label>
                            <div class="col-sm-12">
                                <input type="text" name="instagram" value="" id="instagram" class="form-control input-player">
                            </div>
                            @if ($errors->has('instagram'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('instagram') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group required {{ $errors->has('facebook') ? ' has-error' : '' }}">
                            <span>* </span><label for="facebook" class="col-md-4 control-label pb-2 pt-2">{{trans('individually.facebook')}}</label>
                            <div class="col-sm-12">
                                <input type="email" name="facebook" value="" id="facebook" class="form-control input-player">
                            </div>
                            @if ($errors->has('facebook'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('facebook') }}</strong>
                                </span>
                            @endif
                        </div>
                    </fieldset>
                    <fieldset id="payment-container">
                        <legend>{{trans('individually.game-platform')}}</legend>
                        <p style="color: red;-size: 13px;">{{trans('individually.select-game-platform')}}</p>
                        <div class="form-group mb-3">
                            <div class="col-sm-12" style="display: flex;justify-content: space-between;flex-wrap: wrap;">
                                <div class="games">
                                    <div class="checkbox-games">
                                        <input type="checkbox" id="check-games">
                                        <label for="check-games">Playstation</label>
                                    </div>
                                    <div class="input-games">
                                        <input type="text" placeholder="PSN ID" class="input-player" style="width: 200px;">
                                    </div>
                                </div>
                                <div class="games">
                                    <div class="checkbox-games">
                                        <input type="checkbox" id="check-games">
                                        <label for="check-games">Playstation</label>
                                    </div>
                                    <div class="input-games">
                                        <input type="text" placeholder="PSN ID" class="input-player" style="width: 200px;">
                                    </div>
                                </div>
                                <div class="games">
                                    <div class="checkbox-games">
                                        <input type="checkbox" id="check-games">
                                        <label for="check-games">Playstation</label>
                                    </div>
                                    <div class="input-games">
                                        <input type="text" placeholder="PSN ID" class="input-player" style="width: 200px;">
                                    </div>
                                </div>
                                <div class="games">
                                    <div class="checkbox-games">
                                        <input type="checkbox" id="check-games">
                                        <label for="check-games">Playstation</label>
                                    </div>
                                    <div class="input-games">
                                        <input type="text" placeholder="PSN ID" class="input-player" style="width: 200px;">
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('games'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('games') }}</strong>
                                </span>
                            @endif
                        </div>
                    </fieldset>
                    <fieldset id="password-container">
                        <legend>{{trans('individually.your-password')}}</legend>
                        <div class="form-group required {{ $errors->has('password') ? ' has-error' : '' }}">
                            <span>* </span><label for="password_confirmation" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.password')}}</label>
                            <div class="col-sm-12">
                                <input type="password" autocomplete="off" name="password" value="" placeholder="كلمة المرور" id="input-password" class="form-control input-player">
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group required {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <span>* </span><label for="password_confirmation" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.confirm-password')}}</label>
                            <div class="col-sm-12">
                                <input type="password" autocomplete="off" name="confirm" value="" placeholder="تأكيد كلمة المرور" id="input-confirm" class="form-control input-player">
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </fieldset>
                    <fieldset id="payment-container">
                        <legend>{{trans('individually.payment-method')}}</legend>
                        <p>{{trans('individually.registration-payment')}}</p>
                        <div class="form-group mb-3">
                            <label class="col-sm-12" for="input-coupon">{{trans('individually.please-coupon')}}</label>
                            <div class="col-sm-12" id="coupon-err">
                                <div class="input-group">
                                    <input type="text" name="coupon" value=""  id="input-coupon" class="form-control input-player">
                                    <span class="input-group-btn">
                                        <input type="button" value="{{trans('individually.take-discount')}}" id="button-coupon" data-loading-text="{{trans('individually.my-neighbour')}}" class="btn btn-primary">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="buttons mb-3">
                        <div>
                            <span class="jcf-checkbox jcf-unchecked"><span></span><input type="checkbox" name="agree" value="1" style="position: absolute; height: 100%; width: 100%; opacity: 0; margin: 0px;"></span>
                           {{trans('individually.have-read')}} <a href="https://uaetriathlon.ae/index.php?route=information/information/agree&amp;information_id=8" class="agree"><b>{{trans('individually.privacy-notice')}}</b></a>
                            <input type="hidden" id="dob-val" value="">
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 pt-5">
                                <button type="submit" class="btn btn-primary s-button y2w swipe2right">
                                    {{trans('individually.tracking')}}
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group px-3 px-md-5">
                        @include('layouts.message')
                    </div>
        </div>
        <div class="col-12 col-lg-3">
            <aside id="column-right">
                <div class="swiper-viewport">
                    <div id="banner0" class="swiper-container swiper-container-horizontal swiper-container-fade">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide swiper-slide-active" style="opacity: 1; transform: translate3d(0px, 0px, 0px);">
                                <img src="https://uaetriathlon.ae/image/cache/catalog/Card-Front-sample-320x320.png" alt="Account" class="img-responsive" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
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
