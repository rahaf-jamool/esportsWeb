
<div class="event-view player-event-details">
    <div class="image-home" style="z-index: unset">
        @if(!empty($event['mainImagePath']))
            <img class="img-fluid" src="{{ config('app.base_address') .$event['mainImagePath']}}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/1.jpg')}}'"/>
        @endif
    </div>

    <div class="view-event">
        <h1 class="text-center mt-5"> {{$event['name']}}</h1>
        <div class="content-event">
            <div class="tabs">
                <input type="radio" name="tab" id="tab1" checked="checked">
                <label for="tab1">{{trans('events.informations')}}</label>
{{--                <input type="radio" name="tab" id="tab2">--}}
{{--                <label for="tab2">{{trans('events.categories-fees')}}</label>--}}
                <input type="radio" name="tab" id="tab3">
                <label for="tab3">{{trans('events.eventClients')}}</label>
                <input type="radio" name="tab" id="tab4">
                <label for="tab4">{{trans('events.photo-album')}}</label>

                <div class="tab-content-wrapper">
                    <div id="tab-content-1" class="tab-content">
                        <p class="event-msg">
                            {{trans('events.event-happened-past')}}
                        </p>
                        <p class="desc-event">
                            <div>
                                <p><span><b>{{trans('site.Startdate')}}</b></span> {{ \Carbon\Carbon::parse($event['startDate'])->format('d/m/Y')}}</p>
                                <p><span><b>{{trans('site.endtdate')}}</b></span> {{ \Carbon\Carbon::parse($event['endDate'])->format('d/m/Y')}}</p>
                                <p><span><b>{{trans('site.Registrationstartdate')}}</b></span> {{ \Carbon\Carbon::parse($event['registerStartDate'])->format('d/m/Y')}}</p>
                                <p><span><b>{{trans('site.Registrationexpirydate')}}</b></span> {{ \Carbon\Carbon::parse($event['registerEndDate'])->format('d/m/Y')}}</p>
                                <p><span><b>{{trans('site.Organizername')}}</b></span> {!! $event['organizerName'] !!}</p>
                                <p><span><b>{{trans('site.Location')}}</b></span> {!! $event['location'] !!}</p>
                                <p><span><b>{{trans('site.eventClassificationName')}}</b></span> {!! $event['eventClassificationName'] !!}</p>
                                <p><span><b>{{trans('site.description')}}</b></span> {!! $event['description'] !!}</p>
                            </div>
                        </p>
                    </div>
{{--                    <div id="tab-content-2" class="tab-content" data-aos="fade-down"--}}
{{--                    data-aos-duration="3000">--}}
{{--                        <h4 class="pcice"><span>الفئات / الأحداث الفردية</span>	<span>السعر (درهم)</span></h4>--}}
{{--                        <p>--}}
{{--                            السيد / السيدة--}}
{{--                             12-99 سنة ذكر--}}
{{--                             12-99 سنة انثى--}}
{{--                        </p>--}}
{{--                    </div>--}}
                    <div id="tab-content-3" class="tab-content details" data-aos="fade-down"
                    data-aos-duration="3000">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">{{ trans('event.clientName') }}</th>
                                    <th scope="col">{{ trans('event.clientType') }}</th>
                                    <th scope="col">{{ trans('event.eventPlatformName') }}</th>
                                    <th scope="col">{{ trans('event.eventGameName') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (count($event['eventClients']) > 0)
                                @foreach($event['eventClients'] as $eventClient)
                                    <tr>
                                        <td style="vertical-align: middle">{{ !is_null($eventClient['clientName']) ? $eventClient['clientName'] : '------' }}</td>
                                        <td style="vertical-align: middle">{{ !is_null($eventClient['clientType']) ? $eventClient['clientType'] : '------' }}</td>
                                        <td style="vertical-align: middle">{{ !is_null($eventClient['eventPlatformName']) ? $eventClient['eventPlatformName'] : '------' }}</td>
                                        <td style="vertical-align: middle">{{ !is_null($eventClient['eventGameName']) ? $eventClient['eventGameName'] : '------' }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="5">{{ trans('site.no-events-subscribed') }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div id="tab-content-4" class="tab-content images" data-aos="fade-down"
                    data-aos-duration="3000">
                        @if(count($event['attachments']) > 0)
                            <div class="row">
                                @foreach($event['attachments'] as $image)
                                    <div class="col-6 col-md-4">
                                        <div class="image-card">
                                            <img class="img-fluid" src="{{ config('app.base_address') . $image['path']}}" alt="{{ $image['name'] }}" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
