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
@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/events.css'))

@section('container' , 'container-fluid-custom')
@section('content')

<div class="event-list">
    <!-- Start header -->
    <div class="about-header" >

        <div class="image-home">
            <img class="" src="{{  url(asset('assets/img/4.jpg')) }} " alt="">
            <div class="title-about">
            {{-- {!! trans('events.events') !!} --}}
            </div>
        </div>

        <h1 class="text-center mt-5" style="color: red">{{ $pageInfo['title'] }}</h1>
        <div class="container-fluid">
            @if(isset($events) && count($events) > 0)
                <div class="row">
                    @foreach ($events as $item)
                        <div class="col-12 col-sm-6 col-lg-4 mx-auto mb-3">
                            <div class="product-box column" data-aos="fade-up" data-aos-duration="2000">
                                <a href="{{url(App::getLocale() . '/events/'.$item['eventClassificationId'].'/'. $item['id'] .'/view')}}" class="product-item w-100">
                                    <div class="product-item-content px-0">
                                        <div class="product-item-title">
                                            {{ (App::getLocale() == 'en') ? $item['enName'] :  $item['name'] }}
                                        </div>
                                        <div class="product-date">
                                            <div class="date-start mb-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <b class="green">{{trans('events.start-date-from')}} </b> <br />
                                                        <span class="mx-2">{{ \Carbon\Carbon::parse($item['startDate'])->format('d/m/Y')}}</span>
                                                    </div>
                                                    <div class="col-6">
                                                        <b class="red">{{trans('events.to-me')}}</b> <br />
                                                        <span class="mx-2">{{ \Carbon\Carbon::parse($item['endDate'])->format('d/m/Y')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="date-regester mb-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <b class="green"> {{trans('events.registration-date-from')}} </b> <br />
                                                        <span class="mx-2"> {{ \Carbon\Carbon::parse($item['registerStartDate'])->format('d/m/Y')}} </span>
                                                    </div>
                                                    <div class="col-6">
                                                        <b class="red">{{trans('events.registration-date-to')}}</b> <br />
                                                        <span class="mx-2">{{ \Carbon\Carbon::parse($item['registerEndDate'])->format('d/m/Y')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                <div class="product-desc">--}}
                                        {{--                                    {!!  words((App::getLocale() == 'en')? $item['enDescription'] :  $item['description'],'10','..')  !!}--}}
                                        {{--                                </div>--}}
                                        <div class="btn-event">
                                            <button class="btn btn-success">{{trans('all.more')}}</button>
                                        </div>
                                    </div>
                                    <div class="product-item-image">
                                        @if(!empty($item['mainImagePath']))
                                            <img src="{{ config('app.base_address') .$item['mainImagePath']}}" alt="alt image"  onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                        @else
                                            <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                        @endif
                                        @if( !is_null($item['participationType']) )
                                            <h5 class="type-event">
                                                @if($item['participationType'] == 'Teams')
                                                    {{trans('site.teams')}}
                                                @elseif($item['participationType'] == 'individually' || $item['participationType'] == 'Individuals')
                                                    {{trans('site.individually')}}
                                                @endif
                                            </h5>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                @include('layouts.no-data-available')
            @endif
        </div>
{{--        <div class="grid-container">--}}
{{--            <div class="grid-x-wrapper">--}}
{{--               @if(isset($events) && count($events) > 0)--}}
{{--                    @foreach ($events as $item)--}}
{{--                        <div class="product-box column" data-aos="fade-up" data-aos-duration="2000">--}}
{{--                            <a href="{{url(App::getLocale() . '/events/'.$item['eventClassificationId'].'/'. $item['id'] .'/view')}}" class="product-item">--}}
{{--                                <div class="product-item-content">--}}
{{--                                    <div class="product-item-title">--}}
{{--                                        {{ (App::getLocale() == 'en')? $item['enName'] :  $item['name']}}--}}
{{--                                    </div>--}}
{{--                                    <div class="product-date">--}}
{{--                                        <div class="date-start">--}}
{{--                                            <b class="green">{{trans('events.start-date-from')}} </b>--}}
{{--                                            <p>{{ \Carbon\Carbon::parse($item['startDate'])->format('d/m/Y')}}</p>--}}
{{--                                            <b class="red">{{trans('events.to-me')}}</b>--}}
{{--                                            <p>{{ \Carbon\Carbon::parse($item['endDate'])->format('d/m/Y')}}</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="date-regester">--}}
{{--                                            <b class="green"> {{trans('events.registration-date-from')}} </b>--}}
{{--                                            <p> {{ \Carbon\Carbon::parse($item['registerStartDate'])->format('d/m/Y')}} </p>--}}
{{--                                            <b class="red">{{trans('events.registration-date-to')}}</b>--}}
{{--                                            <p> {{ \Carbon\Carbon::parse($item['registerEndDate'])->format('d/m/Y')}}</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="btn-event">--}}
{{--                                        <button class="btn btn-success">{{trans('all.more')}}</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="product-item-image">--}}
{{--                                    @if(!empty($item['mainImagePath']))--}}
{{--                                        <img src="{{ config('app.base_address') .$item['mainImagePath']}}" alt="alt image"  onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>--}}
{{--                                    @else--}}
{{--                                        <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>--}}
{{--                                    @endif--}}
{{--                                    @if( !is_null($item['participationType']) )--}}
{{--                                        <h5 class="type-event">--}}
{{--                                            @if($item['participationType'] == 'Teams')--}}
{{--                                              {{trans('site.teams')}}--}}
{{--                                            @elseif($item['participationType'] == 'individually')--}}
{{--                                                {{trans('site.individually')}}--}}
{{--                                            @endif--}}
{{--                                        </h5>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                     @endforeach--}}
{{--                @else--}}
{{--                   @include('layouts.no-data-available')--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection
