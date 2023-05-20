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
	.li-blog-banner.listOfItems{
		display: none;
	}
</style>
<!-- Start header -->
<div class="about-header1" >

    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/4.jpg')) }} " alt="">
        <div class="title-about">
        {{-- {!! trans('events.events') !!} --}}
        </div>
    </div>
</div>
<!-- End header -->
      <div class="album-gallery li-main-blog-page pt-60 pb-55">
		<div class="title pt-5 pb-5 text-center" style="color:red">
			<h1>{{ $pageInfo['title']}}</h1>
		</div>
      	<div class="container">
      		<div class="row">
      			<!-- Begin Li's Main Content Area -->
      			<div class="col-lg-12">
      				<div class="row li-main-content">
      					@if(!empty($galleries))
      						@foreach($galleries as $value)
      							<div id="album1" class="col-lg-4 col-md-6 p-3 item album1"
									data-url="{{url(App::getLocale() . '/media/gallery/' . $value['id'] . '/view')}}">
									<input type="hidden" id="config" data-config="{{ config('app.base_address') }}" >
      								<div class="li-blog-single-item pb-25">
      									<div class="li-blog-gallery-slider slick-dot-style banner1" id="banner1">
                         					 @if($value['mainImagePath'] != '' )
      										<div class="li-blog-banner">
      											<a id="mainName" data-config="{{ config('app.base_address') }}" data-id="{{$value['id']}}" data-caption="{{$value['name']}}" data-fancybox="gallery-home-{{ $value['id'] }}" href="{{ config('app.base_address') . $value['mainImagePath'] }}">
      												<img src="{{ config('app.base_address') . $value['mainImagePath'] }}" class="mainName img-full" />
      											</a>
      										</div>
      										@else
      										<div class="li-blog-banner">
      											<a  data-fancybox="gallery-home-{{$value['id']}}" href="{{asset('assets/img/logo1.png')}}">
      												<img src="{{asset('assets/img/logo1.png')}}" class="img-full" />
      											</a>
      										</div>
      										@endif

											@if(!empty($value['attachments']))
												@foreach($value['attachments'] as $val)
													<div class="li-blog-banner listOfItems">
														<a  data-caption="{{$value['name']}}"
															data-fancybox="gallery-home-{{ $value['id'] }}"
															href="{{  config('app.base_address').$val['name'] }}">
																<img src="{{  config('app.base_address').$val['name'] }}" class="img-full" />
														</a>
													</div>
												@endforeach
											@endif


      									</div>
      								</div>
      							</div>
      						@endforeach
      					@endif
      				</div>
      			</div>
      		</div>
      	</div>
    </div>
@endsection
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>


	<script>
		$(document).ready(function(){
			/* $(".album1").click(function(){ */
				$(".album1").each(function() {
					// ...
				mainBox = $(this);
				banner1 = $(this).find(".banner1");
				console.log('banner1',banner1);
				var userURL = $(this).data('url');
				$.ajax({
					type: "GET",
					dataType: 'json',
					url: userURL,
					success: function(data) {
						 console.log('main',data);
						 console.log('gallery',data.attachments);
						$result = data.attachments;
						// if(data['attachments'] ){

						//	console.log(data['attachments']);
							$.each($result, function(key, value) {
									//console.log(key);
									console.log(value.name);
									console.log(value.path);

								//	mainName = document.getElementById('mainName');
								/* 	$("#mainName").attr("data-caption"); */
									mainName = $(".mainName").attr("data-caption");
									/* $("#mainId").attr("data-caption"); */
									mainId = $(".mainName").attr("data-id");
									console.log('mainId', mainId);
									/* $("#mainId").attr("data-caption"); */
									/* mainConfig = $(".mainName").attr("data-config"); */
									mainConfig = $('#config').attr("data-config");


									console.log('mainConfig', mainConfig);
									// console.log(data.attachments.name);
									 $(banner1).append(
										'<div class="li-blog-banner listOfItems">\
										<a  data-caption="'+ data.name +'" \
											data-fancybox="gallery-home-'+data.id+'"\
											href="'+ mainConfig + value.path +'">\
												<img src="'+ mainConfig + value.path +'" class="img-full" />\
										</a>\
									</div>'
									);


							});
						// }
					}
				});
			});
			/* }); */
		});

	</script>
