<section class="Championship py-3 px-2 px-sm-5 pt-sm-5 pb-sm-0 p-lg-5">
    @if (isset($events) && count($events) > 0)
        <div class="title">
            <img src="{{asset('assets/icon/5.png')}}" alt="">
            <a href="{{ url(App::getLocale() . '/events/calendar') }}"><h1>{{trans('site.events-tournaments')}}</h1></a>
        </div>
        <div class="items">
           <div class="row w-100 mx-auto">
               @foreach ($events as $item)
                   <div class="item col-12 col-md-6 col-lg-4">
                       <div class="item-div">
                           <a href="{{url(App::getLocale() . '/events/'.$item['eventClassificationId'].'/'. $item['id'] .'/view')}}">
                               <h2 class="text-center m-3">{{ words($item['name'],'5','..') }}</h2>
                               <p>
                                   {!! words($item['description'],'15','..') !!}
                               </p>
                               <div class="d-flex">
                                   <span>{{trans('site.Startdate')}}</span>
                                   <p class="mb-0">{{ \Carbon\Carbon::parse($item['startDate'])->format('Y-m-d') }}</p>
                               </div>
                               <div class="d-flex">
                                   <span>{{trans('site.endtdate')}}</span>
                                   <p class="mb-0">{{ \Carbon\Carbon::parse($item['endDate'])->format('Y-m-d') }}</p>
                               </div>
                               <div class="item-image">
                                   @if( !empty($item['mainImagePath']) )
                                       <img src="{{ config('app.base_address') .$item['mainImagePath']}}" alt="alt image"
                                            onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                   @else
                                       <img src="{{asset('assets/img/logo1.png')}}" alt="alt image" style="width: auto;
        height: 100%;
        margin: auto;"/>
                                   @endif
                               </div>
                           </a>
                       </div>
                   </div>
               @endforeach
           </div>
        </div>
    @else
        <div class="title">
            <img src="{{asset('assets/icon/5.png')}}" alt="">
            <a href="{{ url(App::getLocale() . '/events/calendar') }}"><h1>{{trans('site.events-tournaments')}}</h1></a>
        </div>
        <div id="championship" class="items"></div>
    @endif

    @if (isset($galleries) && count($galleries) > 0)
        <div class="title">
            <img src="{{asset('assets/icon/6.png')}}" alt="">
            <a href="{{url(App::getLocale() . '/media/gallery')}}"><h1>{{trans('site.pictures')}}</h1></a>
        </div>

        <div class="images" id="album">
            @foreach ($galleries as $value)
                <div class="image m-2 album1" id="album1"
                     data-url="{{url(App::getLocale() . '/media/gallery/' . $value['id'] . '/view')}}">
                    <input type="hidden" id="config" data-config="{{ config('app.base_address') }}">
                    <div class="li-blog-single-item pb-25">
                        <div class="li-blog-gallery-slider slick-dot-style banner1" id="banner1">
                            @if($value['mainImagePath'] != '' )
                                <div class="li-blog-banner">
                                    <a id="mainName" data-config="{{ config('app.base_address') }}"
                                       data-id="{{$value['id']}}" data-caption="{{$value['name']}}"
                                       data-fancybox="gallery-home-{{ $value['id'] }}"
                                       href="{{ config('app.base_address') . $value['mainImagePath'] }}">
                                        <img src="{{ config('app.base_address') . $value['mainImagePath'] }}"
                                             class="mainName img-full"/>
                                    </a>
                                </div>
                            @else
                                <div class="li-blog-banner">
                                    <a data-fancybox="gallery-home-{{$value['id']}}"
                                       href="{{asset('assets/img/logo1.png')}}">
                                        <img src="{{asset('assets/img/logo1.png')}}" class="img-full"/>
                                    </a>
                                </div>
                            @endif
                            @if(!empty($value['attachments']))
                                @foreach($value['attachments'] as $val)
                                    <div class="li-blog-banner listOfItems">
                                        <a data-caption="{{$value['name']}}"
                                           data-fancybox="gallery-home-{{ $value['id'] }}"
                                           href="{{  config('app.base_address').$val['name'] }}">
                                            <img src="{{  config('app.base_address').$val['name'] }}" class="img-full"/>
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="title">
            <img src="{{asset('assets/icon/6.png')}}" alt="">
            <a href="{{url(App::getLocale() . '/media/gallery')}}"><h1>{{trans('site.pictures')}}</h1></a>
        </div>

        <div class="images" id="album"></div>
    @endif
</section>


<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>


<script>
    $(document).ready(function () {
        /* $(".album1").click(function(){ */
        $(".album1").each(function () {
            // ...
            mainBox = $(this);
            banner1 = $(this).find(".banner1");
            var userURL = $(this).data('url');
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: userURL,
                success: function (data) {
                    $result = data.attachments;
                    // if(data['attachments'] ){

                    $.each($result, function (key, value) {
                        //	mainName = document.getElementById('mainName');
                        /* 	$("#mainName").attr("data-caption"); */
                        mainName = $(".mainName").attr("data-caption");
                        /* $("#mainId").attr("data-caption"); */
                        mainId = $(".mainName").attr("data-id");
                        /* $("#mainId").attr("data-caption"); */
                        /* mainConfig = $(".mainName").attr("data-config"); */
                        mainConfig = $('#config').attr("data-config");

                        $(banner1).append(
                            '<div class="li-blog-banner listOfItems">\
                            <a  data-caption="' + data.name + '" \
											data-fancybox="gallery-home-' + data.id + '"\
											href="' + mainConfig + value.path + '">\
												<img src="' + mainConfig + value.path + '" class="img-full" />\
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
