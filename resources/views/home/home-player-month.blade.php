
<section class="player-articles py-3 px-2 pt-sm-3 pt-lg-5">
    <section class="col-lg-6 col-md-12 col-sm-12 articles">
        <div class="title">
            <img src="{{asset('assets/icon/2.png')}}" alt="">
            <a href="{{ url(App::getLocale() . '/articles') }}"><h1>{{trans('site.articles')}}</h1></a>
        </div>

        <div class="blogs-list">
            @if(isset($blogs) && count($blogs) > 0)
                <div class="blogs" id="blogs">
                    @foreach ($blogs as $item)
                    <a class="imageCardUrl" href="{{url(App::getLocale() . '/articles/'.$item['id'].'/view')}}">
                        <figure class="snip1527">
                            {{-- <a class="imageCardUrl" href="{{url(App::getLocale() . '/articles/'.$item['id'].'/view')}}"> --}}
                                <div class="image">
                                    @if(!empty($item['mainImagePath']))
                                        <img src="{{ config('app.base_address') .$item['mainImagePath']}}" alt="alt image"  onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                    @else
                                        <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                    @endif
                                </div>
                            {{-- </a> --}}
                            <figcaption>
                                <div class="date">
                                    <span class="day">{{ \Carbon\Carbon::parse($item['acceptDate'])->format('d-M')}}</span>
                                    <span class="month">{{ \Carbon\Carbon::parse($item['acceptDate'])->format('Y')}}</span>
                                </div>
                                <div class="desc">
                                    <h3 class="mb-3">{{$item['title']}}</h3>
                                    <p class="mb-3">
                                        {!!  words($item['description'],'10','..')  !!}
                                    </p>
                                    <p class="mb-3"><b> {{trans('articles.author-name')}} </b> <small>{{$item['authorName']}}</small></p>
                                </div>
                                {{-- <div class="post-meta">
                                    <span class="timestamp">
                                        <button>{{trans('all.more')}}</button>
                                    </span>
                                </div> --}}
                            </figcaption>
                            {{-- <a href="#"></a> --}}
                        </figure>
                    </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="col-lg-6 col-md-12 col-sm-12 player-month">
        <div class="">
            <div class="title">
                <img src="{{asset('assets/icon/3.png')}}" alt="">
                <h1>{{trans('site.player-month')}}</h1>
            </div>

        <div class="player">
            <div class="video">
                <img src="{{ config('app.base_address') . $playerMonth['imagUrl'] }}" alt="">
                <div id="side-shape"></div>
            </div>
            <div class="desc">
                <div>
                    <h2>
                         {{ $playerMonth['name'] }}
                    </h2>
                    <div class="desc-player mt-3">
                        {!! getTranslate($playerMonth, 'description') !!}
                            {{-- <p>لاعب المنتخب الوطني  لرياضة كرة القدم الالكترونية (FIFA Nations 2022)</p>
                            <p>الحاصل على الميدالية الفضية في دورة الألعاب الخليجية الأخيرة</p> --}}
                    </div>
                </div>
            </div>
        </div>
        </div>

    </section>
</section>
