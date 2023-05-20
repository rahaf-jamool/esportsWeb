@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row text-center">
			<div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto mb-3">
                @if($user['orgnizationInfo']['imagePath'] != '' )
                    <img class="responsive" src="{{ config('app.base_address') . $user['orgnizationInfo']['imagePath']}}" width="250" alt="logo"
                    onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="border-radius: 50%;height: 70%;">
                @else
                    <img class="responsive" src="{{  url(asset('SD08/default-user-image.png')) }}" width="250" alt="logo"/>
                @endif
			</div>
			<div class="col-12"></div>
			<h4 class="p-4">{!! trans('auth.personal-information') !!}</h4>
				@if(!empty($user['name']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{ trans('auth.name') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['name'])?$user['name']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['client']['type']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{ trans('site.type') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
                            {{trans('site.SportsServicesCompany')}}
						{{-- {{ !is_null($user['client']['type'])?$user['client']['type']:''}} --}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['phone']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.phone')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['phone'])?$user['orgnizationInfo']['phone']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['email']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.email')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['email'])?$user['orgnizationInfo']['email']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['princedomName']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.princedomName')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['princedomName'])?$user['orgnizationInfo']['princedomName']:''}}
						</p>
					</div>
				</div>
				@endif

                @if (!empty($user['orgnizationInfo']['fax']))
                    <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                        <div class="col-6 text-center">
                            <strong class="product-quantity">
                            {{trans('auth.fax')}} :
                            </strong>
                        </div>
                        <div class="col-6">
                            <p>
                            {{ !is_null($user['orgnizationInfo']['fax'])?$user['orgnizationInfo']['fax']:''}}
                            </p>
                        </div>
                    </div>
                @endif

				@if(!empty($user['orgnizationInfo']['address']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.address')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['address'])?$user['orgnizationInfo']['address']:''}}
						</p>
					</div>
				</div>
				@endif

                @if (!empty($user['orgnizationInfo']['website']))
                    <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                        <div class="col-6 text-center">
                            <strong class="product-quantity">
                            {{trans('site.website')}} :
                            </strong>
                        </div>
                        <div class="col-6">
                            <p>
                                @if(!is_null($user['orgnizationInfo']['website']))
                                    <a href="{{$user['orgnizationInfo']['website']}}">{{$user['orgnizationInfo']['website']}}</a>
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
                @if (!empty($user['orgnizationInfo']['membershipNumber']))
                    <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                        <div class="col-6 text-center">
                            <strong class="product-quantity">
                            {{trans('individually.membershipNumber')}} :
                            </strong>
                        </div>
                        <div class="col-6">
                            <p>{{ $user['orgnizationInfo']['membershipNumber'] }}</p>
                        </div>
                    </div>
                @endif
                @if (!empty($user['membershipEndDate']))
                    <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                        <div class="col-6 text-center">
                            <strong class="product-quantity">
                            {{trans('individually.membershipEndDate')}} :
                            </strong>
                        </div>
                        <div class="col-6">
                            <p>
                            {{ !is_null(\Carbon\Carbon::parse($user['membershipEndDate'])->format('d/m/Y'))?\Carbon\Carbon::parse($user['membershipEndDate'] )->format('d/m/Y'):''}}
                            </p>
                        </div>
                    </div>
                @endif


				@if(!empty($user['orgnizationInfo']['owner']['name']))
				<h4 class="p-4">{{ trans('site.ownername') }} :</h4>
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.name')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['owner']['name']) ? $user['orgnizationInfo']['owner']['name']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['owner']['passport']['number']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.passport')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['owner']['passport']['number']) ? $user['orgnizationInfo']['owner']['passport']['number']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['owner']['passport']['endDate']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.passportendDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
                        {{ !is_null(\Carbon\Carbon::parse($user['orgnizationInfo']['owner']['passport']['endDate'] )->format('d/m/Y'))?\Carbon\Carbon::parse($user['orgnizationInfo']['owner']['passport']['endDate'] )->format('d/m/Y'):''}}
						</p>
					</div>
				</div>
				@endif
				<h4 class="p-4">{{trans('individually.social-media')}}</h4>
				@if(!empty($user['orgnizationInfo']['facebook']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.facebook')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['facebook'])?$user['orgnizationInfo']['facebook']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['twitter']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.twitter')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['twitter'])?$user['orgnizationInfo']['twitter']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['instagram']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.instagram')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['instagram'])?$user['orgnizationInfo']['instagram']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['discord']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.discord')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['discord'])?$user['orgnizationInfo']['discord']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['youTube']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.youtube')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['youTube'])?$user['orgnizationInfo']['youTube']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['tikTok']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.tikTok')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['tikTok'])?$user['orgnizationInfo']['tikTok']:''}}
						</p>
					</div>
				</div>
				@endif
				@if(!empty($user['orgnizationInfo']['twitch']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.twitch')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['orgnizationInfo']['twitch'])?$user['orgnizationInfo']['twitch']:''}}
						</p>
					</div>
				</div>
				@endif
		</div>
	</div>

	<div class="payment-method">
		<div class="payment-accordion">
			<div class="order-button-payment">
				<a href="{{url(App::getLocale() . '/profile/password') }}" class="text-center info-edit" id="info_edit">{{ trans('all.change-password') }}</a>
			</div>

			<div class="order-button-payment">
				<a href="{{url(App::getLocale() . '/profile/edit/'. $user['id'])}}" class="text-center info-edit mt-2" id="info_edit">{{ trans('all.edit-account-info') }}</a>
			</div>
			{{--
			<div class="order-button-payment">
				<a href="{{url(App::getLocale() . '/profile/edit/' . session('loggedUser')->id)}}" class="text-center info-edit mt-2" id="info_edit">{{ trans('all.edit-account-info') }}</a>
			</div>--}}
		</div>
	</div>




</div>
