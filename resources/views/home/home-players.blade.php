@if (isset($players) && count($players) > 0)
<div class="list-clubs py-3 px-2 px-sm-5 pt-sm-5 pb-sm-0 p-lg-5" style="background: #fcfcfc;">
    <div class="">
        <div class="clubs">
            <div class="title">
                <img src="{{asset('assets/icon/7.png')}}" alt="">
                <a href="{{url(App::getLocale() . '/players')}}"><h1>{{trans('site.players')}}</h1></a>
            </div>

            <div class="clup-items players pb-0 pb-md-5" id="players">
                @foreach ($players as $item)
                    <div class="item">
                        <div class="image home-player-image">
                        @if($item['personInfo']['imagePath'] != '' )
                            <img class="responsive" width="95" height="85" style="width: 95%; height:85%" src="{{ config('app.base_address') . $item['personInfo']['imagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                        @else
                            <img class="responsive" width="95" height="85" style="width: 95%; height:85%" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                        @endif

                        </div>
                        <div class="desc">
                            <p class="first">{{$item['name']}}</p>
                            <button class="second"><a href="{{url(App::getLocale() . '/players/' . $item['id'] . '/view')}}">{{trans('all.more')}}</a></button>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
@else
    <div class="list-clubs" style="background: #fcfcfc;">
        <div class="">
            <div class="clubs">
                <div class="title">
                    <img src="{{asset('assets/icon/7.png')}}" alt="">
                    <a href="{{url(App::getLocale() . '/players')}}"><h1>{{trans('site.players')}}</h1></a>
                </div>
                <div class="clup-items players" id="players"></div>
            </div>
        </div>
    </div>
@endif
