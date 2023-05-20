@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row text-center">
			{{-- <div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto mb-3">
				<img class="responsive" src="" width="250" alt="User Image" onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}'">
			</div> --}}
			<div class="col-12"></div>
			<h4 class="p-4">{!! trans('auth.personal-information') !!}</h4>
                @if (!empty($user['name']))
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
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{ trans('site.type') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
                            {{trans('site.follower')}}
						{{-- {{ !is_null($user['client']['type'])?$user['client']['type']:''}} --}}
						</p>
					</div>
				</div>
                @if (!empty($user['email']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-center">
						<strong class="product-quantity">
						{{trans('auth.email')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($user['email'])?$user['email']:''}}
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
