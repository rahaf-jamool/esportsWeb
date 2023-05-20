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
@section('page-style', asset('assets/css/clubs.css'))

@section('container' , 'container-fluid-custom')
@section('content')
<!-- Start header -->
<div class="about-header" >
    
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/2-01.jpg')) }} " alt="logo">
        <div class="title-about">
        Requests And Permission
        </div>
    </div>
    <div class="login-box">
        <div class="">
            {{trans('institutions.if-you-can-register')}}
        </div>
        <div class="login-link">
            <button class="btn"><a style="color: #fff" href="{{url(App::getLocale().'/electronic-services/institutions/register')}}">{{trans('all.register')}}</a></button>
        </div>
    </div>
</div>

<!-- End header -->
@endsection
