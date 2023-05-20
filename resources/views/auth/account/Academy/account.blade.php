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
				{{-- <li class="account-link active">
					<a data-id="#statistics">
						<i class="fa fa-bar-chart-o"></i>
						<span>
							{{ trans('auth.statistics') }}
						</span>
					</a>
				</li> --}}
				<li class="account-link active">
					<a data-id="#info">
						<i class="fa fa-user"></i>
						<span>
							{{ trans('auth.accountinfo') }}
						</span>
					</a>
				</li>
				<li class="account-link">
					<a data-id="#playersManagement">
						<i class="fa fa-user"></i>
						<span>
							{{ trans('site.playersManagement') }}
						</span>
					</a>
				</li>
				<li class="account-link">
					<a data-id="#CoachadminisManage">
						<i class="fa fa-user"></i>
						<span>
							{{ trans('site.CoachadminisManage') }}
						</span>
					</a>
				</li>
				<li class="account-link">
						<a data-id="#teamManagement">
							<i class="fa fa-user"></i>
							<span>
								{{ trans('site.teamManagement') }}
							</span>
						</a>
					</li>
				<li class="account-link">
					<a data-id="#electronicservices">
						<i class="fa fa-shopping-cart"></i>
						<span>
							{{ trans('site.manageelectronicservices') }}
						</span>
					</a>
				</li>
				<li class="account-link">
					<a data-id="#SubscribeToEvents">
						<i class="fa fa-file-text" aria-hidden="true"></i>
						<span>
							{{ trans('site.SubscribeToEvents') }}
						</span>
					</a>
				</li>
                <li class="account-link">
                    <a data-id="#membershipCard">
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                        <span>
                            {{ trans('site.membership-card') }}
                        </span>
                    </a>
                </li>
			</ul>
		</div>
	</div>
	<div class="col-12 col-md-10 col-lg-9 col-xl-10 mx-auto" id="account-father">
		{{-- <div class="container p-0" id="account-content"> --}}
			<div class="tab-content">
				{{-- <div id="statistics" class="tab-pane active">
					@include('auth.account.Academy.statistics', compact('user'))
				</div> --}}
				<div id="info" class="tab-pane active">
					@include('auth.account.Academy.info_static_organize', compact('user'))
				</div>
				<div id="playersManagement" class="tab-pane">
					@include('auth.account.Academy.playersManagement', compact('user'))
				</div>
				<div id="CoachadminisManage" class="tab-pane">
					@include('auth.account.Academy.CoachadminisManage', compact('user'))
				</div>
				<div id="teamManagement" class="tab-pane">
					@include('auth.account.Academy.teamManagement', compact('user'))
				</div>
				<div id="electronicservices" class="tab-pane">
    				@include('auth.account.online-services-forms.electronicservices-organization', compact('user'))
				</div>
				<div id="SubscribeToEvents" class="tab-pane">
					@include('auth.account.SubscribeToEvents', compact('user'))
				</div>
				<div id="membershipCard" class="tab-pane">
                    @include('auth.account.Academy.membership-card', compact('user'))
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
