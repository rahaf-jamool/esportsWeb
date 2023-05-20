<div class="container clubRegistration">
    <div class="row pt-5">
        <h1> {!! trans('institutions.sportscompaniesRegistration') !!}</h1>
        <p>{!! trans('institutions.Ifyouhaveaccount') !!}<a href="">{!! trans('institutions.loginpage') !!}</a>.</p>

        <div class="col-12 col-lg-9">
            @include('layouts.message')
                    <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/register') }}">
                        {{ csrf_field() }}
                        <h4>{!! trans('institutions.sportscompaniesDetails') !!}</h4>
                        <hr>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <span>* </span><label for="name" class="col-md-4 control-label  pb-2 pt-2">{{trans('institutions.sportscompaniesName')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
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
                        <div class="form-group{{ $errors->has('Placeofissue') ? ' has-error' : '' }}">
                            <span>* </span><label for="Placeofissue" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.Placeofissue')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <select name="select_box" class="form-select" id="Placeofissue" style="direction: ltr;">
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
                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <span>* </span><label for="date" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.licensedate')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="date" type="date" class="form-control" name="date">
                                @if ($errors->has('date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('license ') ? ' has-error' : '' }}">
                            <span>* </span><label for="license " class="control-label  pb-2 pt-2">{{ trans('institutions.licensecopy') }}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="license " type="file" class="form-control" name="license">
                                @if ($errors->has('license'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('license ') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h4 class="pt-4">{!! trans('institutions.OwnerDetails') !!}</h4>
                        <hr>
                        <div class="form-group{{ $errors->has('fName') ? ' has-error' : '' }}">
                            <span>* </span><label for="fName" class="col-md-4 control-label  pb-2 pt-2">{{trans('institutions.fName')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="fName" type="text" class="form-control" name="fName" value="{{ old('fName') }}" required autofocus>
                                @if ($errors->has('fName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lName') ? ' has-error' : '' }}">
                            <span>* </span><label for="lName" class="col-md-4 control-label  pb-2 pt-2">{{trans('institutions.lName')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="lName" type="text" class="form-control" name="lName" value="{{ old('lName') }}" required autofocus>
                                @if ($errors->has('lName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <span>* </span><label for="country" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.country')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <select name="select_box" class="form-select" id="country" style="direction: ltr;">
                                    <option value="">{{trans('institutions.choosecountry')}}</option>
                                    <option value="0">uae</option>
                                    <option value="0">sy</option>
                                </select>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('passportcopy ') ? ' has-error' : '' }}">
                            <span>* </span><label for="passportcopy " class="control-label  pb-2 pt-2">{{ trans('institutions.passportcopy') }}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="passportcopy " type="file" class="form-control" name="passportcopy">
                                @if ($errors->has('passportcopy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('passportcopy ') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <span>* </span><label for="mobile" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.mobile')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="mobile" type="text" class="form-control" name="mobile">
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <h4 class="pt-4">{!! trans('institutions.socialmedia') !!}</h4>
                        <hr>
                        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                            <span>* </span><label for="website" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.website')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="website" type="text" class="form-control" name="website">
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                            <span>* </span><label for="facebook" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.facebook')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="facebook" type="text" class="form-control" name="facebook">
                                @if ($errors->has('facebook'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('linkedin') ? ' has-error' : '' }}">
                            <span>* </span><label for="linkedin" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.linkedin')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="linkedin" type="text" class="form-control" name="linkedin">
                                @if ($errors->has('linkedin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('linkedin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('instagram') ? ' has-error' : '' }}">
                            <span>* </span><label for="instagram" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.instagram')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="instagram" type="text" class="form-control" name="instagram">
                                @if ($errors->has('instagram'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('instagram') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <h4 class="pt-4">{!! trans('institutions.yourpass') !!}</h4>
                        <hr>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <span>* </span><label for="password" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.password')}}</label>
                            <div class="col-md-12 col-lg-9 password-field">
                                <input id="password" type="password" class="form-control" name="password" required>
                			    <!--  	<span><i id="toggler1"class="fa fa-eye"></i></span> -->
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <span>* </span><label for="password_confirmation" class="col-md-4 control-label pb-2 pt-2">{{trans('auth.confirm-password')}}</label>
                            <div class="col-md-12 col-lg-9">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('coupon') ? ' has-error' : '' }}">
                            <span>* </span><label for="coupon" class="col-md-4 control-label pb-2 pt-2">{{trans('institutions.coupon')}}</label>
                            <div class="d-flex col-md-12 col-lg-9">
                                <div class="col-9">
                                    <input id="coupon" type="text" class="form-control" name="coupon">
                                    @if ($errors->has('coupon'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('coupon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-3 btn btn-primary " style="font-size: 15px;">
                                    {!! trans('institutions.applycoupon') !!}
                                </div>
                            </div>
                        </div>


                        <h4 class="pt-4">{!! trans('institutions.paymentmethod') !!}</h4>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-12 col-lg-9">
                                <p>{!! trans('institutions.choosepaymentmethod') !!}</p>
                            </div>
                        </div>
                        <div class="form-check">
                            <div class="col-md-12 col-lg-9">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                <label class="form-check-label" for="flexCheckChecked">
                                {!! trans('institutions.Ihavereadandagree') !!} <a href="#">{!! trans('institutions.privacyNotice') !!}</a>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 pt-5">
                                <button type="submit" class="btn btn-primary s-button y2w swipe2right">
                                    {{trans('auth.register')}}
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

