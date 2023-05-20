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
{{-- {{dd(session('esportsFederationToken'))}} --}}
{{-- {{dd($list)}} --}}
@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/national-teams.css'))

@section('container' , 'container-fluid-custom')
@section('content')

<div class="event-list">
    <!-- Start header -->
<div class="about-header" >

    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/3.jpg')) }} " alt="">
        <div class="title-about">
        {{-- {!! trans('site.nationalteams') !!} --}}
        </div>
    </div>
    <h1 class="text-center mt-5">{!! trans('site.nationalteams') !!}</h1>
    <div class="grid-container py-3 py-md-5">
        <div class="grid-x grid-margin-x small-up-1 medium-up-2 large-up-4 grid-x-wrapper" data-aos="fade-up"
            data-aos-duration="2000">

            @if (isset($NationalTeams) && !empty($NationalTeams))
                @foreach ($NationalTeams as $item)
                <div class="product-box column" data-aos="fade-up"
                data-aos-duration="2000">
                    <a href="{{url(App::getLocale() . '/national-teams/Categories/' . $item['id'])}}" class="product-item p-0">

                            @if(!empty($item['logoPath']))
                            <div class="product-item-image">
                                <img src="{{ config('app.base_address') . $item['logoPath']}}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                            </div>

                            @else
                            <div class="product-item-image">
                                <img class="responsive" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                            </div>

                            @endif

                        <div class="product-item-content">
                            <div class="product-item-title">
                            {{ (App::getLocale() == 'en')? $item['enName'] :  $item['name']}}
                            </div>
                            <div class="button-pill">
                                <button class="btn btn-success">{!! trans('institutions.more') !!}</button>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            @else
                @include('layouts.no-data-available')
            @endif
        </div>
    </div>
@endsection

