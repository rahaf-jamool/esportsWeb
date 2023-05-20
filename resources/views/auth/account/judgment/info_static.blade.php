@include('layouts.message')
@include('sweetalert::alert')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row text-center">
            @if (!empty($user['personInfo']['imagePath']))
            <div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto mb-3">
                @if($user['personInfo']['imagePath'] != '' )
                    <img class="responsive" src="{{ config('app.base_address') . $user['personInfo']['imagePath']}}" width="250" alt="logo"
                    onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="border-radius: 50%;height: 70%;">
                @else
                    <img class="responsive" src="{{  url(asset('SD08/default-user-image.png')) }}" width="250" alt="logo"/>
                @endif
			</div>
            @endif

			<div class="col-12"></div>
			<h4 class="p-4">{!! trans('auth.personal-information') !!}</h4>
                @if (!empty($user['name']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{ trans('auth.username') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>

						{{ !is_null($user['name'])?$user['name']:''}}
						</p>
					</div>
				</div>
                @endif
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{ trans('site.type') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
                            {{trans('site.judgment')}}
						{{-- {{ !is_null($user['client']['type'])?$user['client']['type']:''}} --}}
						</p>
					</div>
				</div>
                @if (!empty($user['personInfo']['phone']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.phone')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['phone'])?$user['personInfo']['phone']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['email']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.email')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['email'])?$user['personInfo']['email']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['gender']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.gender')}} :
						</strong>
					</div>
                    <div class="col-6">
						<p>
                            @if (!is_null($user['personInfo']['gender']) && $user['personInfo']['gender'] == 'M')
                                {{trans('individually.male')}}
                            @elseif (!is_null($user['personInfo']['gender']) && $user['personInfo']['gender'] == 'F')
                                {{trans('individually.female')}}
                            @endif
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['socialStatus']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.socialStatus')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
                            @if ($user['personInfo']['socialStatus'] == 'Married')
                                @if (App::getLocale() == 'en')
                                    {{ !is_null($user['personInfo']['socialStatus'])?$user['personInfo']['socialStatus']:''}}
                                @else
                                    {{trans('individually.married')}}
                                @endif
                            @elseif ($user['personInfo']['socialStatus'] == 'Single')
                                @if (App::getLocale() == 'en')
                                    {{ !is_null($user['personInfo']['socialStatus'])?$user['personInfo']['socialStatus']:''}}
                                @else
                                    {{trans('individually.single')}}
                                @endif
                            @endif
						{{-- {{ !is_null($user['personInfo']['socialStatus'])?$user['personInfo']['socialStatus']:''}} --}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['birthDate']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.birthDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
                        {{ !is_null(\Carbon\Carbon::parse($user['personInfo']['birthDate'] )->format('d/m/Y'))?\Carbon\Carbon::parse($user['personInfo']['birthDate'] )->format('d/m/Y'):''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['nationalityName']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.nationalityName')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['nationalityName'])?$user['personInfo']['nationalityName']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['princedomName']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.princedomName')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['princedomName'])?$user['personInfo']['princedomName']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['address']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.address')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['address'])?$user['personInfo']['address']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['uaeIdNumber']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.idCardNumber')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['uaeIdNumber'])?$user['personInfo']['uaeIdNumber']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['passport']['number']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.passport')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['passport']['number'])?$user['personInfo']['passport']['number']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['passport']['endDate']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.passportendDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
                         {{ !is_null(\Carbon\Carbon::parse($user['personInfo']['passport']['endDate'] )->format('d/m/Y'))?\Carbon\Carbon::parse($user['personInfo']['passport']['endDate'] )->format('d/m/Y'):''}}
						</p>
					</div>
				</div>
                @endif

				<h4 class="p-4">{{trans('individually.social-media')}}</h4>
                @if (!empty($user['personInfo']['facebook']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.facebook')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['facebook'])?$user['personInfo']['facebook']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['twitter']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.twitter')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['twitter'])?$user['personInfo']['twitter']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['instagram']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.instagram')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['instagram'])?$user['personInfo']['instagram']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['discord']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.discord')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['discord'])?$user['personInfo']['discord']:''}}
						</p>
					</div>
				</div>
                @endif
                @if (!empty($user['personInfo']['youTube']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.youtube')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['youTube'])?$user['personInfo']['youTube']:''}}
						</p>
					</div>
				</div>
                @endif

                @if (!empty($user['personInfo']['tikTok']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.tikTok')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['tikTok'])?$user['personInfo']['tikTok']:''}}
						</p>
					</div>
				</div>
                @endif

                @if (!empty($user['personInfo']['twitch']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.twitch')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['twitch'])?$user['personInfo']['twitch']:''}}
						</p>
					</div>
				</div>
                @endif
                
                @if (!empty($response['refereeGames']))
                <h4 class="p-4">{{trans('auth.games')}}</h4>
				<div class="col-12  mb-2 border-bottom mx-auto pb-2 d-flex justify-content-around">
					@if(!empty($response['refereeGames']))
						@foreach($response['refereeGames'] as $val)
							<p>{{$val['gameName']}}</p>
						@endforeach
					@endif
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
