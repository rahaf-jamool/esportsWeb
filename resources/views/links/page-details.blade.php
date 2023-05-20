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
        <img class="" src="{{  url(asset('assets/img/7.jpg')) }} " alt="header">
    </div>
</div>
<!-- End header -->

@if (isset($page) && !is_null($page))
<div class="about-union">
    <div class="col-12 col-xl-6 image">
        <img class="img1" src="{{  url(asset('assets/img/about-union1.png')) }} " alt="header">
        <!-- <img class="img2" src="{{  url(asset('assets/img/about-union.png')) }} " alt="about-union"> -->
      {{--  <img src="{{ config('app.base_address') . $item['mainImagePath'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
     --}}
        @if(!empty($page['attachments'] ) )
            <img class="img2" src="{{ config('app.base_address') .$page['attachments'][0]['path'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">
        @else
            <img class="img2" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
        @endif
    </div>
    <div class="col-12 col-xl-6 desc">
        <h1>{{$pageInfo['title']}}</h1>
        <p> {!! $page['content'] !!}</p>
    </div>
</div>
@else
    @include('layouts.no-data-available')
@endif
@endsection
