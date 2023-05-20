@extends('layouts.master')
@section('title' , trans('site.site-title'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
@section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
@section('description', config('app.description'))
@endif
@section('keywords' , config('app.keywords'))
@section('og-title' , config('app.name')  ."-". $pageInfo['title'])
{{-- {{dd(session('mainToken'))}} --}}
{{-- {{dd($list)}} --}}
@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/events.css'))

@section('container' , 'container-fluid-custom')
@section('content')

    @if(isset($event) && !is_null($event))
    <div class="event-view about-header">
        <div class="image-home">
            <img class="" src="{{  url(asset('assets/img/7.jpg')) }} " alt="">
            <div class="title-about"></div>
        </div>
        <div class="div-closed">
            <h2>{!! $pageInfo['title'] !!}</h2>
            <div class="card">
                <span class="date mb-3">{{ \Carbon\Carbon::parse($event['startDate'])->format('d/m/Y')}}</span>
                <div
                    class="title mb-3">{!! words((App::getLocale() == 'en')? $event['enDescription'] :  $event['description'],'10','..')  !!}</div>
            @if(  \Carbon\Carbon::now()->diffInDays($event['registerEndDate'], false) != 0)
                @if( $user == '')
                        <button class="no-subscribe btn" id="subscribenow"
                                data-id="{{$event['id']}}">{{trans('site.subscribenow')}}</button>
                @elseif(  $user['client']['type'] == "WebSite-Follower")
                    <!-- <div>WebSite-Follower </div> -->
                        <button class="no-follower-subscribe btn" id="subscribenow"
                                data-id="{{$event['id']}}">{{trans('site.subscribenow')}}</button>
                    @elseif(  $user['client']['type'] == "Coach")
                        <button class="no-Coach-subscribe btn" id="subscribenow"
                                data-id="{{$event['id']}}">{{trans('site.subscribenow')}}</button>
                    @elseif(  $user['client']['type'] == "Referee")
                        <button class="no-Referee-subscribe btn" id="subscribenow"
                                data-id="{{$event['id']}}">{{trans('site.subscribenow')}}</button>
                    @elseif(  $user['client']['type'] == "Sport-Company")
                        <button class="no-Sport-Company-subscribe btn" id="subscribenow"
                                data-id="{{$event['id']}}">{{trans('site.subscribenow')}}</button>
                    @else
                        @if(  $event['participationType'] == "Individuals")
                        <!--    <div>الاشتراك فردي </div> -->
                            @if($user['client']['type'] == "Player")
                            <!--  <div> لاعب </div>  -->
                                @if(  $user['isTeamLeader'])
                                <!--   <div> مدير فريق </div>  -->
                                    <button class="subscribenow subscribenow-team btn" data-toggle="modal"
                                            data-target="#individual-team-players" data-id="{{$event['id']}}"
                                            data-asTeam="false">{{trans('site.subscribenow')}}</button>
                                @else
                                    @if($IsCurrentUserInEvent)
                                    <!--   <div> مشترك  </div>  -->
                                        <button
                                            class="subscribed subscribenow-team btn">{{trans('site.event-subscribed')}}</button>
                                    @else
                                    <!--  <div> غير مشترك  </div>  -->
                                        <button class="subscribenow subscribenow-Individuals btn"
                                                data-id="{{$event['id']}}"
                                                data-asTeam="false">{{trans('site.subscribenow')}}</button>
                                    @endif

                                @endif
                            @elseif($user['client']['type'] == "Club" || $user['client']['type'] == "Academy" )
                            <!--        <div> اكاديمية -  نادي  </div>  -->
                                <button class="subscribenow subscribenow-team btn" data-toggle="modal"
                                        data-target="#individual-team-players" data-id="{{$event['id']}}"
                                        data-asTeam="false">{{trans('site.subscribenow')}}</button>
                            @endif



                        @elseif(  $event['participationType'] == "teams")
                        <!--   <div>الاشتراك فرق </div>  -->
                            @if($user['client']['type'] == "Player")
                            <!--   <div> لاعب </div> -->
                                @if($user['isTeamLeader'])
                                <!--  <div> مدير فريق </div>  -->
                                    <button class="subscribenow-team btn" data-toggle="modal"
                                            data-target="#subscribenow-player-team" data-id="{{$event['id']}}"
                                            data-asTeam="true">{{trans('site.subscribenow')}}</button>
                                @else
                                <!--     <div> فرد  </div>  -->
                                    <button class="no-Player-subscribe btn" data-id="{{$event['id']}}"
                                            data-asTeam="false">{{trans('site.subscribenow')}}</button>
                                @endif
                            @elseif($user['client']['type'] == "Club" || $user['client']['type'] == "Academy" )
                            <!--      <div> نادي  </div> -->
                                <button class="subscribenow subscribenow-team btn" data-toggle="modal"
                                        data-target="#teams-team" data-id="{{$event['id']}}"
                                        data-asTeam="false">{{trans('site.subscribenow')}}</button>
                            @endif
                        @endif
                    @endif
                @else
                <!--      <div>الوقت  انتهى</div>  -->
                    <button class="btn">{{trans('site.Registrationexpired')}}</button>
                @endif

            </div>
        </div>

        <div class="view-event">
            <h1 class="text-center mt-5 mb-3 mb-md-4"> {{ (App::getLocale() == 'en')? $event['enName'] :  $event['name']}}</h1>
            <h4 class="text-center" style="font-weight: 500;">
                <span class="text-secondary">{{ trans('events.organizer') }}</span> :
                {{ (App::getLocale() == 'en')? $event['enOrganizerName'] :  $event['organizerName'] }}
            </h4>
            <div class="content-event">
                <div class="tabs">
                    <input type="radio" name="tab" id="tab1" checked="checked">
                    <label for="tab1">{{trans('events.informations')}}</label>
                    <input type="radio" name="tab" id="tab2">
                    <label for="tab2">{{trans('events.categories-fees')}}</label>
                    <input type="radio" name="tab" id="tab3">
                    <label for="tab3">{{trans('events.frequently-questions')}}</label>
                    <input type="radio" name="tab" id="tab4">
                    <label for="tab4">{{trans('events.photo-album')}}</label>

                    <div class="tab-content-wrapper">
                        <div id="tab-content-1" class="tab-content">
                            @if(  \Carbon\Carbon::now()->diffInDays($event['endTime'], false) != 0)
                                <p class="event-msg">
                                    {{trans('events.event-happened-past')}}
                                </p>
                            @endif
                            <div class="desc-event">
                                <div class="row">
                                    <div class="col-6 col-md-4 mb-3">
                                        <span><b>{{trans('site.subscription-type')}}: </b></span>
                                        @if($event['participationType'] == 'Teams')
                                            {{trans('site.teams')}}
                                        @elseif($event['participationType'] == 'Individuals')
                                            {{trans('site.individually')}}
                                        @else
                                            {{$event['participationType']}}
                                        @endif
                                    </div>
                                    <div class="col-6 col-md-4 mb-3">
                                        <span><b>{{trans('site.Startdate')}}</b></span> {{ \Carbon\Carbon::parse($event['startDate'])->format('d/m/Y')}}
                                    </div>
                                    <div class="col-6 col-md-4 mb-3">
                                        <span><b>{{trans('site.endtdate')}}</b></span> {{ \Carbon\Carbon::parse($event['endDate'])->format('d/m/Y')}}
                                    </div>
                                    <div class="col-6 col-md-4 mb-3">
                                        <span><b>{{trans('site.Registrationstartdate')}}</b></span> {{ \Carbon\Carbon::parse($event['registerStartDate'])->format('d/m/Y')}}
                                    </div>
                                    <div class="col-6 col-md-4 mb-3">
                                        <span><b>{{trans('site.Registrationexpirydate')}}</b></span>
                                        {{ \Carbon\Carbon::parse($event['registerEndDate'])->format('d/m/Y')}}
                                    </div>
                                    <div class="col-6 col-md-4 mb-3">
                                        <span><b>{{trans('site.Location')}}</b></span>
                                        {!! (App::getLocale() == 'en')? $event['enLocation'] :  $event['location'] !!}
                                    </div>
                                    <div class="col-6 col-md-4 mb-3">
                                        <span><b>{{trans('site.eventClassificationName')}}</b></span>
                                        {!! (App::getLocale() == 'en')? $event['eventClassificationEnName'] :  $event['eventClassificationName'] !!}
                                    </div>
                                    <div class="col-12 mb-3">
                                        <span><b>{{trans('site.description')}}</b></span>
                                        {!! (App::getLocale() == 'en')? $event['enDescription'] :  $event['description'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-content-2" class="tab-content" data-aos="fade-down"
                             data-aos-duration="3000">
                            <div>
                                <h4 class="pcice"><span>{{trans('site.category')}}</span>
                                    <span>{{trans('site.feeValue')}} </span></h4>
                            </div>
                            @if(!empty($event['eventFees']))
                                @foreach($event['eventFees'] as $eventFee)
                                    <div>
                                        <h4 class="pcice" style="color:black">
                                            <span>  {!! (App::getLocale() == 'en') ? $eventFee['enCategory'] : $eventFee['category'] !!}</span>
                                            <span>  {!! (App::getLocale() == 'en') ? $eventFee['enFeeValue'] : $eventFee['feeValue'] !!}</span>
                                        </h4>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div id="tab-content-3" class="tab-content details" data-aos="fade-down"
                             data-aos-duration="3000">
                            @if(!empty($event['eventFAQs']))
                                @foreach($event['eventFAQs'] as $eventFAQ)
                                    <details open>
                                        <summary> {!! (App::getLocale() == 'en') ? $eventFAQ['enQuestion'] : $eventFAQ['question'] !!}</summary>
                                        <p> {!! (App::getLocale() == 'en') ? $eventFAQ['enAnswer'] : $eventFAQ['answer'] !!}</p>
                                    </details>
                                @endforeach
                            @endif
                        </div>
                        <div id="tab-content-4" class="tab-content images" data-aos="fade-down"
                             data-aos-duration="3000">
                            @if(!empty($event['mainImagePath']))
                                <div class="image-card">
                                    <img src="{{ config('app.base_address') .$event['mainImagePath']}}" alt="alt image"
                                         onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                </div>
                            @endif

                            @if(!empty($event['attachments']))

                                @foreach($event['attachments'] as $attachment)

                                    <div class="image-card">
                                        <img src="{{ config('app.base_address') . $attachment['path']}}" alt="alt image"
                                             onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="orginize d-none">
                    <!--             <div class="rating-badge">
                                    <div class="uk-button-group uk-width-1-1 uk-text-left">
                                        <a href="" class="uk-button uk-button-default uk-text-left uk-width-1-1">
                                        <h5>
                                        التقييم 8.0</h5>
                                        <span>
                                        من 62 التقييمات </span>
                                        </a>
                                    </div>
                                </div> -->
                    <div class="orginizer">
                        <h4>{{trans('events.organizer')}}</h4>
                        <h6>{{ (App::getLocale() == 'en')? $event['enOrganizerName'] :  $event['organizerName']}}</h6>
                    </div>
                </div>
            </div>
        </div>


        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
        <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

        <!-- start subscribe Individuals player team modal -->
        <div class="modal fade" id="individual-team-players" tabindex="-1" role="dialog" aria-labelledby="basicModal"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">{{ trans('site.Subscribetotheevent') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="title-service">{{ trans('site.Teammembers') }}</h3>

                        <div class="col-12 col-lg-9 form-request">
                            @include('layouts.message')
                            <form class="form-horizontal w-100" id="SubscribePlayers" role="form" method="POST"
                                  action="#">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$event['id']}}" name="eventId" id="eventId">
                                <input type="hidden" value="false" name="asTeam">
                                <select id="choices-multiple-remove-button"
                                        placeholder="{{ trans('site.selectplayers') }}" name="orgPlayerIds" multiple>
                                    @if(!empty($clientTeamPlayers))
                                        @foreach($clientTeamPlayers as $clientTeamPlayer)
                                            <option
                                                value="{{$clientTeamPlayer['id']}}">{{$clientTeamPlayer['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default"
                                data-dismiss="modal">{{trans('site.cancel')}}</button>
                        <button type="button" class="btn btn-primary subscribenow-Individuals-players"
                                id="subscribenow-Individuals-players">{{trans('site.send')}}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end subscribe Individuals player team modal -->
        @if( !$user == '')
            @if($user['client']['type'] == "Player")
                <!-- start subscribe player-team modal -->
                <div class="modal fade" id="subscribenow-player-team" tabindex="-1" role="dialog"
                     aria-labelledby="basicModal" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">{{ trans('site.Subscribetotheevent') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3 class="title-service">{{ trans('site.teams') }}</h3>

                                <div class="col-12 col-lg-9 form-request">
                                    @include('layouts.message')
                                    <form class="form-horizontal w-100" id="SubscribeTeams" role="form" method="POST"
                                          action="#">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$event['id']}}" name="eventId" id="eventId">
                                        <input type="hidden" value="true" name="asTeam">
                                        <select id="choices-multiple-remove-button2"
                                                placeholder="{{ trans('site.selectteams') }}" name="orgTeamIds"
                                                multiple>
                                            @if(!empty($clientTeams))
                                                <option value="{{$clientTeams['id']}}">{{$clientTeams['name']}}</option>
                                            @endif
                                        </select>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">{{trans('site.cancel')}}</button>
                                            <button type="button" class="btn btn-primary subscribenow-teams"
                                                    id="subscribenow-teams">{{trans('site.send')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end subscribe player-team modal -->
            @else
            <!-- start subscribe teams modal -->
                <div class="modal fade" id="teams-team" tabindex="-1" role="dialog" aria-labelledby="basicModal"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">{{ trans('site.Subscribetotheevent') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3 class="title-service">{{ trans('site.teams') }}</h3>

                                <div class="col-12 col-lg-9 form-request">
                                    @include('layouts.message')
                                    <form class="form-horizontal w-100" id="SubscribeTeams" role="form" method="POST"
                                          action="#">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$event['id']}}" name="eventId" id="eventId">
                                        <input type="hidden" value="true" name="asTeam">
                                        <select id="choices-multiple-remove-button2"
                                                placeholder="{{ trans('site.selectteams') }}" name="orgTeamIds"
                                                multiple>
                                            @if(!empty($clientTeams))
                                                @foreach($clientTeams as $clientTeam)
                                                    <option
                                                        value="{{$clientTeam['id']}}">{{$clientTeam['name']}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">{{trans('site.cancel')}}</button>
                                            <button type="button" class="btn btn-primary subscribenow-teams"
                                                    id="subscribenow-teams">{{trans('site.send')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end subscribe teams modal -->

            @endif
        @endif
    </div>
    @else
        @include('layouts.no-data-available')
    @endif




        @push('js')
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                $(document).ready(function () {

                    /*start  select players */
                    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                        removeItemButton: true,

                    });
                    /* end select players */
                    /*start  select teams */
                    var multipleCancelButton = new Choices('#choices-multiple-remove-button2', {
                        removeItemButton: true,

                    });
                    /* end select teams */
                    /* start subscribe as individual */
                    $('.subscribenow-Individuals').click(function () {
                        let eventId = $(this).data('id');
                        let asTeam = false;
                        let urlEvent = '{{ url(App::getLocale() . '/events/subscribe-event') }}';
                        let newUrl = urlEvent + '/' + eventId;
                        console.log(eventId);
                        console.log(asTeam);
                        console.log(newUrl);
                        let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('eventId', eventId);
                        formData.append('asTeam', asTeam);

                        $.ajax({
                            url: newUrl,
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: formData,
                            beforeSend: function () {
                            },
                            error: function (response) {


                                swal('{{trans("site.sorry")}}', response.responseJSON.error, "error");

                            },
                            success: function (response) {
                                console.log(response);
                                if (response.success.hasErrors) {
                                    swal('{{trans("site.sorry")}}', {
                                        text: '{{trans("site.ClientAlreadyRegisterdInThisEvent")}}',
                                        icon: "warning",
                                        button: '{{trans("site.ok")}}',
                                    });
                                } else {
                                    swal('{{trans("site.congratulation")}}', {
                                        text: '{{trans("site.Yousuccessfullysubscribedevent")}}',
                                        icon: "success",
                                        button: '{{trans("site.ok")}}',
                                    });


                                    $('.subscribenow').text('{{trans("site.event-subscribed")}}');

                                }
                            }
                        });


                    });
                    /* end subscribe as individual */
                    /* start subscribe as individual players*/
                    $('.subscribenow-Individuals-players').click(function () {
                        let eventId = $('#eventId').val();
                        let urlEvent = '{{ url(App::getLocale() . '/events/subscribe-event') }}';
                        let newUrl = urlEvent + '/' + eventId;

                        let orgPlayerIds = $('#choices-multiple-remove-button').val();
                        if (orgPlayerIds.length === 0) {
                            swal('{{trans("site.sorry")}}', {
                                text: '{{trans("site.Noplayerselected")}}',
                                icon: "error",
                                button: '{{trans("site.ok")}}',
                            });
                        } else {
                            orgPlayerIds = JSON.stringify(orgPlayerIds);
                            let formData = new FormData($('#SubscribePlayers')[0]);
                            formData.append('_token', '{{ csrf_token() }}');
                            formData.append('orgPlayerIds', orgPlayerIds);
                            $.ajax({
                                url: newUrl,
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                data: formData,
                                beforeSend: function () {
                                },
                                error: function (response) {


                                    swal('{{trans("site.sorry")}}', response.responseJSON.error, "error");

                                },
                                success: function (response) {
                                    console.log(response);
                                    if (response.success.hasErrors) {
                                        swal('{{trans("site.sorry")}}', {
                                            text: '{{trans("site.ClientAlreadyRegisterdInThisEvent")}}',
                                            icon: "warning",
                                            button: '{{trans("site.ok")}}',
                                        });
                                    } else {
                                        swal('{{trans("site.congratulation")}}', {
                                            text: '{{trans("site.Yousuccessfullysubscribedevent")}}',
                                            icon: "success",
                                            button: '{{trans("site.ok")}}',
                                        });


                                        //$('.subscribenow').text('{{trans("site.event-subscribed")}}');
                                        $('#individual-team-players').fadeOut();
                                        $('.modal-backdrop').remove();
                                    }
                                }
                            });
                        }


                    });
                    /* end subscribe as individual players*/
                    /* start subscribe as teams team*/
                    $('.subscribenow-teams').click(function () {
                        let eventId = $('#eventId').val();
                        let urlEvent = '{{ url(App::getLocale() . '/events/subscribe-event') }}';
                        let newUrl = urlEvent + '/' + eventId;

                        let orgTeamIds = $('#choices-multiple-remove-button2').val();

                        if (orgTeamIds.length === 0) {
                            swal('{{trans("site.sorry")}}', {
                                text: '{{trans("site.NoTeamselected")}}',
                                icon: "error",
                                button: '{{trans("site.ok")}}',
                            });
                        } else {

                            orgTeamIds = JSON.stringify(orgTeamIds);
                            let formData = new FormData($('#SubscribeTeams')[0]);
                            formData.append('_token', '{{ csrf_token() }}');
                            formData.append('orgTeamIds', orgTeamIds);

                            $.ajax({
                                url: newUrl,
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                data: formData,
                                beforeSend: function () {
                                },
                                error: function (response) {


                                    swal('{{trans("site.sorry")}}', response.responseJSON.error, "error");

                                },
                                success: function (response) {
                                    console.log(response);
                                    if (response.success.hasErrors) {
                                        swal('{{trans("site.sorry")}}', {
                                            text: '{{trans("site.ClientAlreadyRegisterdInThisEvent")}}',
                                            icon: "warning",
                                            button: '{{trans("site.ok")}}',
                                        });
                                    } else {
                                        swal('{{trans("site.congratulation")}}', {
                                            text: '{{trans("site.Yousuccessfullysubscribedevent")}}',
                                            icon: "success",
                                            button: '{{trans("site.ok")}}',
                                        });


                                        //   $('.subscribenow').text('{{trans("site.event-subscribed")}}');
                                        $('#teams-team').fadeOut();
                                        $('#subscribenow-player-team').fadeOut();
                                        $('.modal-backdrop').remove();

                                    }
                                }
                            });

                        }

                    });
                    /* end subscribe as teams team*/


                    $('.no-subscribe').click(function () {
                        swal({
                            title: '{{trans("site.warning")}}',
                            text: '{{trans("site.cannotparticipateevent")}}',
                            icon: "warning",
                            buttons: ['{{trans("site.cancel")}}', '{{trans("all.login")}}'],
                            dangerMode: true,
                        })
                            .then((ok) => {
                                if (ok) {
                                    window.location.href = '{{url(App::getLocale().'/login')}}';
                                } else {
                                    /* swal("Your imaginary file is safe!"); */
                                }
                            });
                    });
                    $('.no-follower-subscribe').click(function () {

                        swal('{{trans("site.cannotsubscribeeventfollower")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                    });
                    $('.no-Coach-subscribe').click(function () {

                        swal('{{trans("site.cannotsubscribeeventCoach")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                    });
                    $('.no-Referee-subscribe').click(function () {

                        swal('{{trans("site.cannotsubscribeeventReferee")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                    });
                    $('.no-Sport-Company-subscribe').click(function () {

                        swal('{{trans("site.cannotsubscribeeventSportCompany")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                    });
                    $('.no-Player-subscribe').click(function () {

                        swal('{{trans("site.playercannotparticipateteamevents")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                    });
                    $('.subscribed').click(function () {

                        swal('{{trans("site.ClientAlreadyRegisterdInThisEvent")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                    });

                });
            </script>
    @endpush

@endsection
