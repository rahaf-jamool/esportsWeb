@extends('layouts.master')

@section('title' , trans('site.site-title'). " - ". $pageInfo['title'])

{{-- @if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
    @section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))
@endif --}}

{{-- @section('keywords' , config('app.keywords')) --}}
{{-- @section('og-title' , config('app.name')  ."-". $pageInfo['title']) --}}

@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/links.css'))
@section('content')
<!-- Start header -->
<div class="about-header m-0">
    <div class="title-about">

    </div>
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/2.jpg')) }} " alt="logo">
    </div>
</div>
<!-- End header -->
@if (isset($members) && !is_null($members))
<div class="current-board">
<h1 class="mb-5"> {{$pageInfo['title']}}</h1>
    <img class="back" src="{{  url(asset('assets/img/current-board.png')) }} " alt="logo">


    <!-- <div class="person">
        <div class="image">
        <img class="" src="{{  url(asset('assets/img/5-01.jpg')) }} " alt="logo">

        </div>
        <h5 class="name-person">Lorem, ipsum.</h5>
        <p class="desc-person">Lorem ipsum dolor sit.</p>
    </div> -->
    <div class="group">
                @if(!empty($members))
                    @foreach($members as $member)
                        @if($member['order'] == 1 )
                        <div class="col-12 person">
                            <div class="image">
                            @if($member['mainImagePath'] != '' )
                                <img src="{{ config('app.base_address') . $member['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                            @else
                                <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                            @endif
                            </div>
                            <h5 class="name-person">{!! $member['name'] !!}</h5>
                            <p class="desc-person">{!! $member['content'] !!}</p>
                        </div>
                        @endif

                        @if($member['order'] != 1 )
                            <div class="col-12 col-md-6 col-lg-4 person">
                                <div class="image">
                                @if($member['mainImagePath'] != '' )
                                    <img src="{{ config('app.base_address') . $member['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
                                @else
                                    <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                @endif
                                </div>
                                <h5 class="name-person">{!! $member['name'] !!}</h5>
                                <p class="desc-person">{!! $member['content'] !!}</p>
                            </div>
                        @endif
                    @endforeach
                @endif
    </div>
</div>
    @else
        @include('layouts.no-data-available')
    @endif
@endsection
