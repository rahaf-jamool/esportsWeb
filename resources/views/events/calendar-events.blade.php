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
@section('page-style', asset('assets/css/events-calendar.css'))

@section('container' , 'container-fluid-custom')
@section('content')
<div class="event-view about-header">
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/4.jpg')) }} " alt="">
        <div class="title-about">
        {{-- {!! trans('events.events') !!} --}}
        </div>
    </div>
</div>

<div class="calender container py-3 py-md-5">
        <h1>{{trans('site.Events-Calendar')}}</h1>

        <div class="event-dropdown">
                <div class="dropdown">
                    <div class="select">
                        <span>{{trans('site.select-type')}}</span>
                        <i class="fa fa-chevron-down"></i>
                    </div>
                    <input type="hidden" name="gender">
                    <ul class="dropdown-menu">
                        <li id="all" class="type">{{trans('site.all')}}</li>
                        @if (!empty($EventClassifications) > 0)
                        @foreach ($EventClassifications as $item)
                            <li id="{{$item['id']}}" class="type">
                                {{$item['name']}}
                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
        </div>
        <div class="events">
            @foreach ($events as $month =>  $event)
                <details>
                        <summary>
                            <span data-css-icon="square plus outline">
                                <span>
                                    <h5>{{\Carbon\Carbon::parse(mktime(0, 0, 0, $month))->translatedFormat('F')}}</h5>
                                </span>
                                <i></i>
                            </span>
                        </summary>
                        <div>
                            <table class="table table-borderless">
                                <tbody>
                                    @foreach($event as $day => $item)
                                        @foreach ($item['events'] as $event)
                                                <tr>
                                                    <td>
                                                        <span class="date">{{$day}}</span>
                                                    </td>
                                                    <td class="text">
                                                    <a href="{{url(App::getLocale() . '/events/'.$event['eventClassificationId'].'/'. $event['id'] .'/view')}}">
                                                        <h4>{{$event['name']}}</h4>
                                                    </a>
                                                        <small><b>{{$event['location']}}</b> {{ \Carbon\Carbon::parse($event['startDate'])->format('H:m') }}</small>
                                                    </td>
                                                    <td>{{ $event['eventState'] }}</td>
                                                </tr>

                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </details>
            @endforeach
        </div>
    </div>

@push('js')

<script>
    $(document).ready(function() {
            $('.nav-tabs li').click(function () {
                $(this).addClass('active').siblings().removeClass('active');
                var Id = $(this).find('a').data('id');
                $(`${Id}`).addClass('active').siblings().removeClass('active');
            });

            function setDetailsHeight(selector, wrapper = document) {
            const setHeight = (detail, open = false) => {
                detail.open = open;
                const rect = detail.getBoundingClientRect();
                detail.dataset.width = rect.width;
                detail.style.setProperty(open ? `--expanded` : `--collapsed`,`${rect.height}px`);
            }
            const details = wrapper.querySelectorAll(selector);
            const RO = new ResizeObserver(entries => {
                return entries.forEach(entry => {
                    const detail = entry.target;
                    const width = parseInt(detail.dataset.width, 10);
                    if (width !== entry.contentRect.width) {
                        detail.removeAttribute('style');
                        setHeight(detail);
                        setHeight(detail, true);
                        detail.open = false;
                    }
                })
            });
            details.forEach(detail => {
                RO.observe(detail);
            });
        }

        /* Run it */
        setDetailsHeight('details');

        /*Dropdown Menu*/
        $('.dropdown').click(function () {
                $(this).attr('tabindex', 1).focus();
                $(this).toggleClass('active');
                $(this).find('.dropdown-menu').slideToggle(300);
        });
        $('.dropdown').focusout(function () {
            $(this).removeClass('active');
            $(this).find('.dropdown-menu').slideUp(300);
        });
        $('.dropdown .dropdown-menu li').click(function () {
            $(this).parents('.dropdown').find('span').text($(this).text());
            $(this).parents('.dropdown').find('input').attr('value', $(this).attr('id'));
        });
        /*End Dropdown Menu*/

        $('.type').click(function(){
            let classificationId = $(this).attr('id');
            console.log(classificationId);
            $.ajax({
                url: '{{ url(App::getLocale() . "/events/calendar") }}',
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    classificationId
                },
                error: function (response) {

                    console.log(response);
                },
                success: function (response) {
                    console.log(response);
                    $('.events').html(response.data);
                }
            });
        });
    });


</script>


@endpush

@endsection
