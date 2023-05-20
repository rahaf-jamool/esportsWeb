@if (isset($news) && !empty($news))
<div class="news py-3 px-2 px-sm-5 pt-sm-5 pb-sm-0 p-lg-5">
    <div class="">
        <div class="title-new">
            <div class="title">
                <img src="{{asset('assets/icon/1.png')}}" alt="">
                <a href="{{url(App::getLocale() . '/news')}}"><h1>{{trans('site.news')}}</h1></a>
            </div>
             <div class="show-all">
                <button><a href="{{url(App::getLocale() . '/news')}}">{{trans('site.more-news')}}</a></button>
            </div>
        </div>
        <div class="news-items" id="news-items">
            @foreach ($news as $item)
                <a href="{{url(App::getLocale() . '/news/' . $item['id'] . '/view')}}" class="item col-12 col-md-6 col-lg-4 offset-box-shadow">
                    <div>
                        <div class="image">
                            @if($item['mainImagePath'] != '' )
                            <img src="{{ config('app.base_address') . $item['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                        @else
                            <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                        @endif
                        </div>
                        <div class="title-news">
                            <span class="fa fa-share-alt" aria-hidden="true"></span>
                            <h4>{{$item['name']}}</h4>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@else
<div class="news p-5">
    <div class="">
        <div class="title-new">
            <div class="title">
                <img src="{{asset('assets/icon/1.png')}}" alt="">
                <a href="{{url(App::getLocale() . '/news')}}"><h1>{{trans('site.news')}}</h1></a>
            </div>
             <div class="show-all">
                <button><a href="{{url(App::getLocale() . '/news')}}">{{trans('site.more-news')}}</a></button>
            </div>
        </div>
        <div class="news-items" id="news-items"></div>
    </div>
</div>
@endif

