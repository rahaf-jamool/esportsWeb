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
{{-- <div class="about-header" >
    <div class="title">
        <h1>{{ $pageInfo['title']}}</h1>
    </div>
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
    </div>
</div> --}}
<!-- End header -->
<div class="news-list">
		<div class="title pt-3 pb-5 text-center" style="color:red">
			<h1>{{ $pageInfo['title']}}</h1>
		</div>

    @if (isset($news) && count($news) > 0)
    <div class="news-items">
            @foreach ($news as $key => $item)
                    @if ($key == 0)
                            <div class="item2">
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
                    @else
                    <div class="item1">
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
                    @endif

            @endforeach
    </div>
    {{-- <div class="column">
    @foreach ($news as $key => $item)
        <div class="col2">
            <a href="{{url(App::getLocale() . '/news/' . $item['id'] . '/view')}}">
            <div class="post-module firstchild">
                <div class="thumbnail">
                    <div class="date">
                        <div class="day">{{trans('all.Aug')}} 24</div>
                        <div class="month">2022</div>
                    </div>
                    @if($item['mainImagePath'] != '' )
                        <img src="{{ config('app.base_address') . $item['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                    @else
                        <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                    @endif
                </div>
                <div class="post-content">
                <div class="category">{{trans('all.new')}}</div>
                <h1 class="title">{{$item['name']}}</h1>
                <p class="description">{{ words( $item['content'] , '15' , '...') }}</p>
                <div class="post-meta"><span class="timestamp"><i class="fa fa-clock-">o</i> 6 mins ago</span></div>
                </div>
            </div>
        </a>
        </div>

        @if ($key == 0)
            <div class="col1">
                <a href="{{url(App::getLocale() . '/news/' . $item['id'] . '/view')}}">
                    <div class="post-module">
                        <div class="thumbnail">
                            <div class="date">
                                <div class="day">{{trans('all.Aug')}} 24</div>
                                <div class="month">2022</div>
                            </div>
                            @if($item['mainImagePath'] != '' )
                                <img src="{{ config('app.base_address') . $item['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                            @else
                                <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                            @endif
                        </div>
                        <div class="post-content">
                        <div class="category">{{trans('all.new')}}</div>
                        <h1 class="title">{{$item['name']}}</h1>
                        <p class="description">{{ words( $item['content'] , '15' , '...') }}</p>
                        <div class="post-meta"><span class="timestamp"><i class="fa fa-clock-">o</i> 6 mins ago</span></div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    @endforeach
    </div> --}}
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
