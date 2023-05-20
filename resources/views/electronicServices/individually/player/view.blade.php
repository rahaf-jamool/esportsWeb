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
        <img class="" src="{{  url(asset('assets/img/2-01.jpg')) }} " alt="logo">
        <div class="title-about">
        {{trans('auth.name')}}
        </div>
    </div>
</div>
<!-- End header -->
<section class="details-services">
    <div class="container">
        <h1>{{trans('auth.name')}}</h1>
        <div class="image-details">
            <img class="" src="{{  url(asset('assets/img/2-01.jpg')) }} " alt="logo">
        </div>
        <div class="row">
            <div class="col-12 mb-2">
                <h4 class="">{!! trans('institutions.sportscompaniesDetails') !!}</h4>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <div class="row detail">
                    <div class="title col-6">
                        {{trans('institutions.clubName')}}
                    </div>
                    <div class="value col-6">
                        name name
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <div class="row detail">
                    <div class="title col-6">
                        {{trans('auth.email')}}
                    </div>
                    <div class="value col-6">
                        mail@mail.com
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <div class="row detail">
                    <div class="title col-6">
                        {{trans('auth.phone')}}
                    </div>
                    <div class="value col-6">
                        +971963852741
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <div class="row detail">
                    <div class="title col-6">
                        {{trans('institutions.Placeofissue')}}
                    </div>
                    <div class="value col-6">
                        UAE
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-2">
                <div class="row detail">
                    <div class="title col-6">
                        {{trans('institutions.licensedate')}}
                    </div>
                    <div class="value col-6">
                        10-10-2022
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <h4 class="">{!! trans('institutions.socialmedia') !!}</h4>
            </div>
            <div class="col-12 mb-2 social">
                <a href="http://emiratesesports.net/public/en"> <i class="fa fa-globe" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/emiratesesport"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/emiratesesport/"> <i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/emiratesesport/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</section>


@endsection
