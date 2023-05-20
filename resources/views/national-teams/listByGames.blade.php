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
        {{-- {!! trans('institutions.ElectronicClubs') !!} --}}
        </div>
    </div>
</div>
<!-- End header -->

@if (isset($NationalGames) && !empty($NationalGames) )
<div class="list-clubs py-3 py-md-5">
    <div class="">
        <div class="clubs">
            <div class="title">
                <h1>{{trans('site.games')}}</h1>
            </div>
            <div class="clup-items">
                @foreach ($NationalGames as $item)
                <div class="item club-item" data-aos="fade-up"
                        data-aos-duration="2000">
                        <a class="" href="{{url(App::getLocale() . '/national-teams/games/' . $item['id'] )}}">
                        <div class="image">
                            @if(!empty($item['logoPath']))
                                <img class="responsive" src="{{ config('app.base_address') . $item['logoPath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                             @else
                                <img class="responsive" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                            @endif
                        </div>
                        </a>
                    <div class="desc-clup"  style="margin: 20px 0px;">
                        <p>{{ (App::getLocale() == 'en')? $item['enName'] :  $item['name']}}</p>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@else
    @include('layouts.no-data-available')
@endif


@endsection
