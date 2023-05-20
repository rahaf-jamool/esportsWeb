
@if (isset($sponsors) && count($sponsors) > 0)

    <div class="sponsors py-3 px-2 px-sm-5 pt-sm-5 pb-sm-0 p-lg-5">
        <div class="">
            <div class="title">
                <img src="{{asset('assets/icon/8.png')}}" alt="">
                <h1>{{trans('site.sponsors')}}</h1>
            </div>
            <div class="sponsors-items" id="sponsors">

                @foreach ($sponsors as $item)

                    <div class="sponsor">
                        <a class="" href="{{ $item['url'] }}" target="_blank">
                            @if($item['mainImagePath'] != '' )
                                <img src="{{ config('app.base_address') . $item['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                            @else
                                <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                            @endif
                        </a>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@else
    <div class="sponsors">
        <div class="">
            <div class="title">
                <img src="{{asset('assets/icon/8.png')}}" alt="">
                <h1>{{trans('site.sponsors')}}</h1>
            </div>
            <div class="sponsors-items" id="sponsors"></div>
        </div>
    </div>
@endif
