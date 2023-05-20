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
@section('page-style', asset('assets/css/articles-news.css'))

@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')

<!-- Start header -->
<div class="news-list">
		<div class="title pt-3 pb-5 text-center" style="color:red">
			<h1>{{ $pageInfo['title']}}</h1>
		</div>

    @if (isset($news) && count($news) > 0)
    <div class="row news-items">
            @foreach ($news as $key => $item)
                @if ($key == 0)
                    <div class="col-12 col-lg-6">
                        <a href="{{url(App::getLocale() . '/news/' . $item['id'] . '/view')}}" class="item offset-box-shadow first-child">
                            <div>
                                <div class="image" style="height: 500px;">
                                    @if($item['mainImagePath'] != '' )
                                    <img src="{{ config('app.base_address') . $item['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                                @else
                                    <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                @endif
                                </div>
                                <div class="title-news">
                                    <h4>{{$item['name']}}</h4>
                                    <span class="fa fa-share-alt" aria-hidden="true"></span>
                                </div>

                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-lg-6"><div class="row">
                @elseif($key > 0 && $key < 5)
                    <div class="col-sm-6 item1">
                        <a href="{{url(App::getLocale() . '/news/' . $item['id'] . '/view')}}" class="item offset-box-shadow news">
                            <div>
                                <div class="image">
                                    @if($item['mainImagePath'] != '' )
                                    <img src="{{ config('app.base_address') . $item['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                                    @else
                                        <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                    @endif
                                </div>
                                <div class="title-news">
                                    <h4>{{$item['name']}}</h4>
                                    <span class="fa fa-share-alt" aria-hidden="true"></span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @if ($key == 4)
                        </div>
                    </div>
                    @endif
                @else
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <a href="{{url(App::getLocale() . '/news/' . $item['id'] . '/view')}}" class="item offset-box-shadow first-child">
                            <div>
                                <div class="image" style="height: 500px;">
                                    @if($item['mainImagePath'] != '' )
                                    <img src="{{ config('app.base_address') . $item['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                                @else
                                    <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                @endif
                                </div>
                                <div class="title-news">
                                    <h4>{{$item['name']}}</h4>
                                    <span class="fa fa-share-alt" aria-hidden="true"></span>
                                </div>

                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
    </div>
    @else
        <div class="alert alert-warning text-center col-12 col-sm-10 col-md-8 col-lg-6 mx-auto mb-5">{{ trans('site.no-data-to-display') }}</div>
    @endif
  </div>
</section>
@endsection

@push('js')
<script>
    // $(window).load(function() {
  $('.post-module').hover(function() {
    $(this).find('.description').stop().animate({
      height: "toggle",
      opacity: "toggle"
    }, 300);
  });
// });
</script>
@endpush
