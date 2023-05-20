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
    </div>
</div>
<!-- End header -->
<section class="details-services">
    @if (isset($club) && !is_null($club))
        <div class="club">
                <div class="title-club-image">
                    @if(count($club['orgnizationInfo']) > 0)
                    <div class="image-details d-flex" style="width: 100px;">
                        <img class="responsive" src="{{ config('app.base_address') . $club['orgnizationInfo']['imagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';this.style='width:100%';"/>
                        </div>
                        @else
                        <div class="image-details d-flex" style="justify-content: center;">
                        <img class="responsive" src="{{ asset('assets/img/44-01.png') }}" alt="alt image"/>
                        </div>
                    @endif
                    <h1>{{$club['name']}}</h1>
                </div>

                <div class="card">
                    <h4>{!! trans('institutions.clubDetails') !!}</h4>
                    <div class="information">
                        <div class="info-player">
                            <p>{{trans('institutions.clubName')}}</p><span>{{$club['name']}}</span>
                        </div>
                        <div class="info-player">
                            <p>{{trans('auth.email')}}</p><span>{{$club['orgnizationInfo']['email']}}</span>
                        </div>
                        <div class="info-player">
                            <p>{{trans('auth.phone')}}</p><span>{{$club['orgnizationInfo']['phone']}}</span>
                        </div>
                        <div class="info-player">
                            <p>{{trans('auth.address')}}</p><span>{{$club['orgnizationInfo']['address']}}</span>
                        </div>
                        <div class="info-player">
                            <p>{{trans('institutions.licensedate')}}</p><span>{{ \Carbon\Carbon::parse($club['orgnizationInfo']['licenceEndDate'])->format('d/m/Y')}}</span>
                        </div>
                    </div>
                </div>

                @if (count($players) > 0)
                    <div class="list-clubs" style="width: 90%;margin: auto auto 15%;border: 1px solid #f8f8f8;background: #fff;box-shadow: 1px -1px 9px 1px #e8e3e3;">
                        <div class="">
                            <div class="clubs">
                                <div class="title">
                                    {{-- <img src="{{asset('assets/img/logo1.png')}}" alt=""> --}}
                                    <h1>{{trans('site.players')}}</h1>
                                </div>

                                <div class="clup-items players" id="players">
                                    @foreach ($players as $item)
                                    <a href="{{url(App::getLocale() . '/players/' . $item['id'] . '/view')}}">
                                        <div class="item">
                                            <div class="image">
                                            @if($item['personInfo']['imagePath'] != '' )
                                                <img class="responsive" width="95" height="85" style="width: 95%; height:85%" src="{{ config('app.base_address') . $item['personInfo']['imagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                            @else
                                                <img class="responsive" width="95" height="85" style="width: 95%; height:85%" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                            @endif

                                            </div>
                                            <div class="desc">
                                                <p class="first">{{$item['name']}}</p>
                                                {{-- <button class="second"><a href="{{url(App::getLocale() . '/players/' . $item['id'] . '/view')}}">{{trans('all.more')}}</a></button> --}}
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
        </div>
    @else
        @include('layouts.no-data-available')
    @endif
</section>


@endsection
