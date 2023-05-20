@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row ">
			<div class="col-12"></div>
			<h4 class="p-4 text-center">{{ trans('site.electronicservices') }}</h4>
			<div id="tab-content-3" class="tab-content details">
				@include('auth.account.online-services-forms.filiationcertificate', compact('user'))
				@include('auth.account.online-services-forms.experiencecertificate', compact('user'))
				@include('auth.account.online-services-forms.joiningcertificate', compact('user'))
            </div>
		</div>
	</div>
</div>


