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
@section('page-style', asset('assets/css/plyers.css'))

@section('container' , 'container-fluid-custom')
@section('content')
<div class="about-header" >
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/4.jpg')) }} " alt="logo">
    </div>
</div>

<div class="list-player">
    <div class="list-clubs">
        <div class="clubs">
            <div class="title">
                <h1>{{trans('site.players')}}</h1>
            </div>
            <div class="clup-items players">

            @foreach ($players as $player)
                <a href="{{url(App::getLocale() . '/players/' . $player['id'] . '/view')}}">
                    <div class="item">
                        <div class="image">
                        @if($player['personInfo']['imagePath'] != '' )
                            <img class="responsive" src="{{ config('app.base_address') . $player['personInfo']['imagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                        @else
                            <img class="responsive" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                        @endif
                        </div>
                        <div class="desc">
                            <p class="first">{{$player['name']}}</p>
                            {{-- <button class="second"><a href="">{{trans('all.more')}}</a></button> --}}
                        </div>
                    </div>
                </a>

                {{-- <div class="col-12 col-md-6 col-lg-3 item">
                    <div class="top">
                        <p>G <span>2</span></p>
                    </div>
                    <a class="" href="{{url(App::getLocale() . '/electronic-services/electronicclubs/details')}}">
                        <div class="image-player">
                            @if(count($item['personInfo']) > 0)
                                <img class="responsive" src="{{ config('app.base_address') . $item['personInfo']['imagePath'] }}" alt="alt image"/>
                            @else
                                <img class="responsive" src="{{ asset('assets/img/44-01.png') }}" alt="alt image"/>
                            @endif
                        </div>
                    </a>
                    <div class="desc">
                        <p class="first">{{$item['name']}}</p>
                        <p class="second">Lorem, ipsum.</p>
                    </div>
                </div> --}}
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
