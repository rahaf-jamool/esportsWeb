@if (isset($clubs) && count($clubs) > 0)
    <div class="list-clubs pt-4 pb-3 px-2 px-sm-5 pt-sm-5 pb-sm-0 p-lg-5">
        <div class="">
            <div class="clubs">
                <div class="title">
                    <img src="{{asset('assets/icon/4.png')}}" alt="">
                    <a href="{{url(App::getLocale() . '/clubs')}}"><h1>{{trans('site.clubs')}}</h1></a>
                </div>

                <div class="clup-items" id="{{ count($clubs) >= 3 ? 'home-clubs' : '' }}">
                    @foreach ($clubs as $item)
                        <div class="item">
                            <a class="" href="{{url(App::getLocale() . '/clubs/' . $item['id'] . '/details')}}">
                                <div class="image home-club-image">
                                    @if(!empty($item['orgnizationInfo']['imagePath']))
                                        <img class="responsive" src="{{ config('app.base_address') .$item['orgnizationInfo']['imagePath'] }}" alt="alt image"  onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                        @else
                                        <img class="responsive" src="{{asset('assets/img/logo2.png')}}" alt="alt image"/>
                                    @endif
                                </div>
                            </a>
                            <div class="desc-clup">
                                <p>{{$item['name']}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@else
    <div class="list-clubs">
        <div class="">
            <div class="clubs">
                <div class="title">
                    <img src="{{asset('assets/icon/4.png')}}" alt="">
                    <a href="{{url(App::getLocale() . '/clubs')}}"><h1>{{trans('site.clubs')}}</h1></a>
                </div>

                <div class="clup-items" id="home-clubs"></div>
            </div>
        </div>
    </div>
@endif
