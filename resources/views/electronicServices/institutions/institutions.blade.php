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
        {{$pageInfo['title']}}
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

<!-- <section class="event-header">
    <div class="register-section">
        <div class="details-register">
            <div class="title">
                {{trans('institutions.if-you-can-register')}}
            </div>
            <div class="button-register">
                <button class="btn btn-success"><a style="color: #fff" href="{{url(App::getLocale().'/electronic-services/institutions/register')}}">{{trans('all.register')}}</a></button>
            </div>
        </div>
    </div>
</section> -->
<div class="tile" id="tile-1">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="ElectronicClub-tab" data-bs-toggle="tab" data-bs-target="#ElectronicClub" href="#ElectronicClub" role="tab" aria-controls="ElectronicClub" aria-selected="true"> {!! trans('institutions.ElectronicClub') !!}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="PrivateAcademy-tab" data-bs-toggle="tab" data-bs-target="#PrivateAcademy" href="#PrivateAcademy" role="tab" aria-controls="PrivateAcademy" aria-selected="false"> {!! trans('institutions.PrivateAcademy') !!}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="SportsServicesCompanies-tab" data-bs-toggle="tab" data-bs-target="#SportsServicesCompanies" href="#SportsServicesCompanies" role="tab" aria-controls="SportsServicesCompanies" aria-selected="false"> {!! trans('institutions.SportsServicesCompanies') !!}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " id="sportsteams-tab" data-bs-toggle="tab" data-bs-target="#sportsteams" href="#sportsteams" role="tab" aria-controls="sportsteams" aria-selected="false">{!! trans('institutions.sportsteams') !!}</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="ElectronicClub" role="tabpanel" aria-labelledby="ElectronicClub-tab">
            @include('electronicServices.institutions.electronic-club.list')
        </div>
        <div class="tab-pane fade" id="PrivateAcademy" role="tabpanel" aria-labelledby="PrivateAcademy-tab">
            @include('electronicServices.institutions.private-academy.list')
        </div>
        <div class="tab-pane fade" id="SportsServicesCompanies" role="tabpanel" aria-labelledby="SportsServicesCompanies-tab">
            @include('electronicServices.institutions.sports-services-companies.list')
        </div>
        <div class="tab-pane fade " id="sportsteams" role="tabpanel" aria-labelledby="sportsteams-tab">
            @include('electronicServices.institutions.sports-teams.list')
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $("#tile-1 .nav-tabs a").click(function() {
        var position = $(this).parent().position();
        var width = $(this).parent().width();
            $("#tile-1 .slider").css({"left":+ position.left,"width":width});
        });
        var actWidth = $("#tile-1 .nav-tabs").find(".active").parent("li").width();
        var actPosition = $("#tile-1 .nav-tabs .active").position();
        $("#tile-1 .slider").css({"left":+ actPosition.left,"width": actWidth});

    </script>
@endpush
