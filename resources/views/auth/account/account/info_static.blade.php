@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row text-center">
			<div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto mb-3">
				<img class="responsive" src="{{$user['personInfo']['imagePath']}}" width="250" alt="User Image" onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}'">
			</div>
			<div class="col-12"></div>
			<h4 class="p-4">{!! trans('auth.personal-information') !!}</h4>
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
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{ trans('site.type') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['client']['type'])?$user['client']['type']:''}}
						</p>
					</div>
				</div>
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


				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.gender')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['gender'])?$user['personInfo']['gender']:''}}
						</p>
					</div>
				</div>
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.socialStatus')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['socialStatus'])?$user['personInfo']['socialStatus']:''}}
						</p>
					</div>
				</div>
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.birthDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['birthDate'])?$user['personInfo']['birthDate']:''}}
						</p>
					</div>
				</div>
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
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.idCardNumber')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['idCardNumber'])?$user['personInfo']['idCardNumber']:''}}
						</p>
					</div>
				</div>
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
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.passportendDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['personInfo']['passport']['endDate'])?$user['personInfo']['passport']['endDate']:''}}
						</p>
					</div>
				</div>
				<h4 class="p-4">{{trans('individually.social-media')}}</h4>
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
				<h4 class="p-4">{{trans('individually.game-platform')}}</h4>
				<div class="col-12  mb-2 border-bottom mx-auto pb-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('individually.game-platform')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						
						</p>
					</div>
				</div>
				
				<h4 class="p-4">{{trans('auth.games')}}</h4>
				<div class="col-12  mb-2 border-bottom mx-auto pb-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.games')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						
						</p>
					</div>
				</div>
				
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
