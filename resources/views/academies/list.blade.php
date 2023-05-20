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

@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/electronic-services.css'))

@section('container' , 'container-fluid-custom')
@section('content')
<!-- Start header -->
<div class="about-header" >

    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/4.jpg')) }} " alt="logo">
        <div class="title-about">
        {{-- {{trans('site.academies')}} --}}
        </div>
    </div>
</div>
<!-- End header -->
{{--dd($academies)--}}
@if (count($academies) > 0)
    <div class="list-clubs py-3 py-md-5">
        <div class="clubs">
            <h1 data-aos="fade-up" data-aos-duration="2000" class="text-center">{{trans('site.academies')}}</h1>
            <div class="clup-items">
                @foreach ($academies as $item)
                    <a class="" href="{{url(App::getLocale() . '/academies/' . $item['id'] . '/details')}}">
                        <div class="item club-item" data-aos="fade-up"
                        data-aos-duration="2000">
                            <div class="image">
                                {{-- <img src="{{asset('assets/img/44-01.png')}}" alt=""> --}}


                                @if(!empty($item['orgnizationInfo']['imagePath']))
                                    <img class="responsive" src="{{ config('app.base_address') . $item['orgnizationInfo']['imagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                @else
                                    <img class="responsive" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                @endif

                            </div>
                            <div class="desc-clup" style="margin: 20px 0px;">
                                <p>{{$item['name']}}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
                {{-- <a class="" href="{{url(App::getLocale() . '/academies/details')}}">
                    <div class="item" data-aos="fade-up"
                    data-aos-duration="2000">
                        <div class="image">
                            <img src="{{asset('assets/img/44-01.png')}}" alt="">
                        </div>
                        <div class="desc-clup">
                            <p>{!! trans('institutions.title') !!}</p>
                        </div>
                        <a class="link" href="{{url(App::getLocale() . '/academies/details')}}">
                            <div class="button-more">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                <button>{!! trans('institutions.more') !!}</button>
                            </div>
                        </a>
                    </div>
                </a>
                <a class="" href="{{url(App::getLocale() . '/academies/details')}}">
                    <div class="item" data-aos="fade-up"
                    data-aos-duration="2000">
                        <div class="image">
                            <img src="{{asset('assets/img/44-01.png')}}" alt="">
                        </div>
                        <div class="desc-clup">
                            <p>{!! trans('institutions.title') !!}</p>
                        </div>
                        <a class="link" href="{{url(App::getLocale() . '/academies/details')}}">
                            <div class="button-more">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                <button>{!! trans('institutions.more') !!}</button>
                            </div>
                        </a>
                    </div>
                </a> --}}
            </div>
        </div>
    </div>
@endif
@endsection
