@extends('layouts.master')

@php
    $players = \App\Facades\PlayersService::getApiResponse(\App\Helpers\General\EndPoints::PlayersApi);
@endphp

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
{{-- <div class="about-header m-0">
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/7.jpg')) }} " alt="header">
    </div>
</div> --}}
<!-- End header -->
@if (isset($NationalTeam) && !is_null($NationalTeam))
<div class="about-header1" >
    <div class="image-home">
        @if($NationalTeam['groupImagePath'] != '')
            <img class="responsive" src="{{ config('app.base_address') . $NationalTeam['groupImagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
        @else
            <img class="responsive" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
        @endif
    </div>
    @if (!empty($NationalTeam['name']))
        <div class="title-header">
            {{$NationalTeam['name']}}
        </div>
    @endif
</div>
<!-- End header -->
<section class="details-services national-teams">
    <div class="container">
    {{-- <h1>{{$club['name']}}</h1> --}}

        {{-- @if(count($club['orgnizationInfo']) > 0)
        <div class="image-details d-flex" style="justify-content: center;">
            <img class="responsive" src="{{ config('app.base_address') . $club['orgnizationInfo']['imagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';this.style='width:250px';"/>
        </div>
            @else
        <div class="image-details d-flex" style="justify-content: center;">
            <img class="responsive" src="{{ asset('assets/img/44-01.png') }}" alt="alt image"/>
        </div>
        @endif --}}
    </div>
    <div class="list-clubs">
        <div class="clubs">
            <div class="title mb-4" style="position: relative;">
                <h1>{{trans('site.players')}}</h1>
            </div>
            <div class="clup-items players" id="players">
            @if(!empty($NationalTeam['players']))
                 @foreach ($NationalTeam['players'] as $player)
                    <a href="{{url(App::getLocale() . '/players/' . $player['id'] . '/view')}}">
                        <div class="item">
                            <div class="image">
                            {{-- @if(!empty($player['parentId'])) --}}
                            @if (!empty($player['personInfo']))
                                @if($player['personInfo']['imagePath'] != '')
                                    <img class="responsive" src="{{ config('app.base_address') . $player['personInfo']['imagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                @else
                                    <img class="responsive" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                @endif
                            @endif

                            {{-- @endif --}}
                            </div>
                            <div class="desc">
                                <p class="first">{{$player['name']}}</p>
                                {{-- <button class="second"><a href="">{{trans('all.more')}}</a></button> --}}
                            </div>
                        </div>
                    </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@else
    @include('layouts.no-data-available')
@endif
@endsection
