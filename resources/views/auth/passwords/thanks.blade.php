@extends('layouts.master')
@section('title' , $pageInfo['title']. " | ". config('app.name'))
@section('og-title' , $pageInfo['title']. " | ". config('app.name'))
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , strip_tags($pageInfo['description']))
@section('description', strip_tags($pageInfo['description']))
@else
    @section('og-description' , strip_tags(config('app.description')))
@section('description', strip_tags(config('app.description')))
@endif
@section('og-image' , url(asset('SD08/msf/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')
<!-- Start header -->
<div class="about-header m-0">
    <div class="title-about"></div>
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/7.jpg')) }} " alt="header">
    </div>
</div>
<div class="row page-view docs news py-5 my-5 align-centent-senter">
    <div class="col-xs-12 page-title text-center">
        <h1>{{ $pageInfo['title'] }}</h1>
    </div>
    <div class="col-xs-12 description text-center">
        <div class="thanks col-sm-6 center-block mx-auto">
            <div class="alert alert-success my-3">{!! trans('auth.password_successfully') !!}</div>
            <div class="form-group">
                <button onclick="window.location.href='{{ url(App::getLocale().'/login') }}'" class="btn  btn-primary center-block">
                    {{ trans('auth.login') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
