@extends('layouts.master')
@section('title' , config('app.name'). " - ". $pageInfo['title'])
@section('og-description' , config('app.description'))
@section('description', config('app.description'))
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-".  $pageInfo['title'])
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

					<li class="account-link">
						<a data-id="#articles">
							<i class="fa fa-user"></i>
							<span>
								{{ trans('site.articles') }}
							</span>
						</a>
					</li>
					{{--	<li class="account-link">
						<a data-id="#SubscribeToEvents">
							<i class="fa fa-file-text" aria-hidden="true"></i>
							<span>
								{{ trans('site.SubscribeToEvents') }}
							</span>
						</a>
					</li>--}}
			</ul>
		</div>
	</div>
	<div class="col-12 col-md-10 col-lg-9 col-xl-10 mx-auto" id="account-father">
		{{-- <div class="container p-0" id="account-content"> --}}
			<div class="tab-content">

				<div id="info" class="tab-pane active">
					@include('auth.account.follower.info_static', compact('user'))
				</div>
				<div id="articles" class="tab-pane">
					@include('auth.account.articles', compact('user'))
				</div>
				{{--		<div id="SubscribeToEvents" class="tab-pane">
					@include('auth.account.SubscribeToEvents', compact('user'))--}}
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
