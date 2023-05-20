@extends('layouts.master')

{{-- @section('title' , config('app.name'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
    @section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))
@endif
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-". $pageInfo['title']) --}}


@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')
<style>
    .video i{
        position: absolute;
        top: 50%;
        left: 50%;
        font-size: 50px;
        color: red;
        transform: translate(-50%, -50%);
    }
 /*    .li-blog-single-item{
    width: 500px;
} */
</style>
<!-- Start header -->
<div class="about-header" >

    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/4.jpg')) }} " alt="">
        <div class="title-about">
        {{-- {!! trans('events.events') !!} --}}
        </div>
    </div>
</div>
<!-- End header -->
<div class="video li-main-blog-page pt-60 pb-55">
	<div class="container">
        <div class="title pt-3 pb-3 text-center" style="color:red">
			<h1>{{ $pageInfo['title']}}</h1>
		</div>
		<div class="row">
			<!-- Begin Li's Main Content Area -->
			<div class="col-lg-12  pt-5 pb-5">
				<div class="row li-main-content">
					@if(!empty($videos))
						@foreach($videos as $value)
							<div class=" col-12 col-md-6 col-lg-4">
								<div class="li-blog-single-item pb-25">
                                    <a data-fancybox href="{{ 'https://www.youtube.com/embed/'.$value['url']}}">
                                        @if(!empty($value['mainImagePath']))
                                            <div class="product-item-image">
                                                <img class="w-100" src="{{ config('app.base_address') .$value['mainImagePath']}}" alt="alt image"  onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                            </div>
                                        @else
                                            <div class="product-item-image">
                                                <img class="w-100" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                                <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                            </div>
                                        @endif


                                    </a>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
            {{--
			<div class="col-lg-12 pt-5 pb-5">
				<div class="row li-main-content">
					@if(!empty($videos))
						@foreach($videos as $value)
							<div class=" col-12 col-md-6 col-lg-4">
								<div class="li-blog-single-item pb-25">
                                    <a data-fancybox href="{{ 'https://www.youtube.com/embed/'.$value['url']}}">
                                        @if(!empty($videos))
                                            @foreach($videos as $value)

                                                    <div class="li-blog-single-item pb-25">
                                                        <a data-fancybox href="{{ 'https://www.youtube.com/embed/'.$value['url']}}">
                                                            <iframe width="560" height="315" src="{{ 'https://www.youtube.com/embed/'.$value['url']}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        </a>
                                                    </div>

                                            @endforeach
                                        @endif
                                    </a>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
            --}}
		</div>
	</div>
</div>
<Script>
	$("[data-fancybox]").fancybox({
		image: {
			protect: true
		},
		thumbs: {
			showOnStart: true, // Display thumbnails on opening
			hideOnClosing: true   // Hide thumbnail grid when closing animation starts
		}
	});
</Script>
@endsection
