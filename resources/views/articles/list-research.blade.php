@extends('layouts.master')

@section('title' , config('app.name'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
    @section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))
@endif
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-". $pageInfo['title'])

@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')
	<section class="top-post-area pt-10">
		<div class="container no-padding">
			<div class="row">
				<div class="col-lg-12">
					<div class="hero-nav-area">
						<h2 class="text-white">{{ $pageInfo['title'] }}</h2>
					</div>
				</div>
			</div>
		</div>
	</section>	
	<section class="latest-post-area pb-120">
		<div class="container no-padding">
			<div class="row">
				<div class="col-lg-4">
					<div class="single-sidebar-widget editors-pick-widget">
						<div class="latest-post-wrap">
							<h6 class="title">
								{{ trans('all.research-list') }}
							</h6>
							<div class="post-lists">
								@if($articlesMaster->isNotEmpty())
									@foreach($articlesMaster as $row)								
									<div class="single-post d-flex flex-row mb-10 p-10 border-bottom">
										<a href="javascript:void(0)" data-research-id="{{ $row->id }}" ><h6>{{ $row->{$symbol.'_name'} }}</h6></a>
									</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-8 post-list">
					<div class="latest-post-wrap" id="ResearchList">
						@if($articles->isNotEmpty())
							@foreach($articles as $row)
								<div class="single-latest-post row align-items-center">
									<div class="col-lg-5 post-left">
										<div class="feature-img relative">
											<div class="overlay overlay-bg"></div>
											@if($row->photo != '' && File::exists('SD08/msf/'.$row->photo))
												<img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$row->photo),278,190,array('crop')) }}" alt="">
											@else
												<img class="img-fluid" src="{{ Image::url(url('SD08/msf/logo.png'),278,190,array('crop')) }}" alt="">
											@endif
										</div>
										<ul class="tags">
											<li><a href="javascript:void(0)">{{ $row->articlemaster->{$symbol.'_name'} }}</a></li>
										</ul>
									</div>
									<div class="col-lg-7 post-right">
										<a href="{{ArticlesService::check_url($row,$row->articlemaster)}}">
											<h4>{{ $row->title }}</h4>
										</a>
										<ul class="meta">
											<li><a href="#"><span class="lnr lnr-user"></span> {{ $row->author->Title }}</a></li>
											<li><a href="#"><span class="lnr lnr-calendar-full"></span> {{ date( "d M Y" , strtotime($row->post_date)) }} </a></li>
											<li><a href="#"><span class="lnr lnr-bubble"></span>{{ trans('all.comments') }} {{ count($row->comments) }}</a></li>
										</ul>
										<p class="excert">
											{!! words($row->brief,13,'..') !!}
										</p>
									</div>
								</div>
							@endforeach
							<div class="col-lg-12 load-more">
								<a href="javascript:void(0)" id="load_more" class="primary-btn"
										   data-offset="12">{{ trans('site.load-more') }}
								</a>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
    <script type="text/javascript">
        var _config = {
            getGetResearchUrl: '{{ url($symbol.'/research/')}}',
            getGetResearchTarget: '#ResearchList',
            token: '{{ csrf_token() }}',
        }
    </script>
    <script type="text/javascript" src="{{ asset('js/nrdjs/Research.js') }}"></script>
    <script type="text/javascript">
        Research.listPage();
        Research.filter();
    </script>
@endsection