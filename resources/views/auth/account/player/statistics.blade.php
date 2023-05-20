@include('layouts.message')
@include('sweetalert::alert')
{{-- @if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif --}}
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row text-center">
			<h2>{{ trans('auth.statistics') }}</h2>


					<div class="col-lg-4 col-md-6" style="margin-top: 20px">
						<div class="card border-primary">
							<div class="card-body bg-primary text-white">
								<div class="row p-4">
									<div class="col-3">
										<i class="fa fa-calendar fa-3x"></i>
									</div>
									<div class="col-9 text-right">
										<h1>{{ count($ClientEventsRequests)}}</h1>
										<h4> {{ trans('site.events') }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 col-md-6" style="margin-top: 20px">
						<div class="card border-danger">
							<div class="card-body bg-danger text-white">
								<div class="row p-4">
									<div class="col-3">
										<i class="fa fa-random fa-3x"></i>
									</div>
									<div class="col-9 text-right">
										<h1>{{$user['numberOfMatch']}}</h1>
										<h4> {{ trans('site.matches') }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6" style="margin-top: 20px">
						<div class="card border-success">
							<div class="card-body bg-success text-white">
								<div class="row p-4">
									<div class="col-3">
									<i class="fa fa-trophy fa-3x"></i>
									</div>
									<div class="col-9 text-right">
										<h1>{{ $user['numberOfWonMatch'] }}</h1>
										<h4> {{ trans('site.win') }}</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
		</div>
	</div>
</div>
