@extends('layouts.master')
@section('title' , config('app.name'). " - ". 'my-account')
@section('og-description' , config('app.description'))
@section('description', config('app.description'))
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-".  'my-account')
@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/account.css'))

@section('content')
<!-- Start header -->
<div class="about-header">
    <div class="title-about">
        {{$pageInfo['title']}}
    </div>
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
    </div>
</div>
<!-- End header -->
<section class="account-container">
	<div class="col-xs-12 visible-xs">
		<div class="account-toggle">
			<div class="account-navbar-toggle">
				<span></span>
			</div>
			<label>
				{{ trans('all.account-menu') }}
			</label>
		</div>
	</div>
	<div class="account-header">
		<div class="card-body">
			<ul class="account-nav nav nav-tabs">

				<li class="account-link active">
					<a data-id="#info">
						<i class="fa fa-user"></i>
						<span>
							{{ trans('auth.accountinfo') }}
						</span>
					</a>
				</li>
				@if($user['client']['type'] == 'Player' || $user['client']['type'] == 'follower'  || $user['client']['type'] == 'Coach' || $user['client']['type'] == 'Referee' )
					<li class="account-link">
						<a data-id="#clubs">
							<i class="fa fa-user"></i>
							<span>
								{{ trans('site.clubs') }}
							</span>
						</a>
					</li>
					<li class="account-link">
						<a data-id="#academies">
							<i class="fa fa-user"></i>
							<span>
								{{ trans('site.academies') }}
							</span>
						</a>
					</li>
				@endif

				@if($user['client']['type'] == 'Club'  || $user['client']['type'] == 'Academy' )
					<li class="account-link">
						<a data-id="#teams">
							<i class="fa fa-user"></i>
							<span>
								{{ trans('site.teams') }}
							</span>
						</a>
					</li>
					<li class="account-link">
						<a data-id="#players">
							<i class="fa fa-user"></i>
							<span>
								{{ trans('site.players') }}
							</span>
						</a>
					</li>
					<li class="account-link">
						<a data-id="#coaches">
							<i class="fa fa-user"></i>
							<span>
								{{ trans('site.coaches') }}
							</span>
						</a>
					</li>
					<li class="account-link">
						<a data-id="#managers">
							<i class="fa fa-user"></i>
							<span>
								{{ trans('site.managers') }}
							</span>
						</a>
					</li>
				@endif

				<li class="account-link">
					<a data-id="#electronicservices">
						<i class="fa fa-shopping-cart"></i>
						<span>
							{{ trans('site.electronicservices') }}
						</span>
					</a>
				</li>
				<li class="account-link">
					<a data-id="#orders">
						<i class="fa fa-file-text" aria-hidden="true"></i>
						<span>
							{{ trans('site.orders') }}
						</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="col-12 col-md-10 col-lg-9 col-xl-10 mx-auto" id="account-father">
		{{-- <div class="container p-0" id="account-content"> --}}
			<div class="tab-content">
				<div id="info" class="tab-pane active">
				@if($user['client']['type'] == 'Club'  || $user['client']['type'] == 'Academy' )
					@include('auth.account.info_static_organize', compact('user'))
				@else
					@include('auth.account.info_static', compact('user'))
				@endif

				</div>
				@if($user['client']['type'] == 'Player' || $user['client']['type'] == 'follower'  || $user['client']['type'] == 'Coach' || $user['client']['type'] == 'Referee' )
				<div id="clubs" class="tab-pane">
					@include('auth.account.clubs', compact('user'))
				</div>
				<div id="academies" class="tab-pane">
					@include('auth.account.academies', compact('user'))
				</div>

				@endif
				@if($user['client']['type'] == 'Club'  || $user['client']['type'] == 'Academy' )
					<div id="teams" class="tab-pane">
						@include('auth.account.teams', compact('user'))
					</div>
					<div id="players" class="tab-pane">
						@include('auth.account.players', compact('user'))
					</div>
					<div id="coaches" class="tab-pane">
						@include('auth.account.coaches', compact('user'))
					</div>
					<div id="managers" class="tab-pane">
						@include('auth.account.managers', compact('user'))
					</div>
				@endif
				<div id="electronicservices" class="tab-pane">
					@include('auth.account.electronicservices', compact('user'))
				</div>
				<div id="orders" class="tab-pane">
					@include('auth.account.orders', compact('user'))
				</div>

			</div>
		{{-- </div> --}}
	</div>
</section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.nav-tabs li').click(function () {
                $(this).addClass('active').siblings().removeClass('active');
                var Id = $(this).find('a').data('id');
                $(`${Id}`).addClass('active').siblings().removeClass('active');
            });
	    });
    </script>
@endpush
