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
@if(isset($player) && !is_null($player))
<div class="view-player">
    <div class="image-text">
        {{-- <img src="{{asset('assets/img/5-01.jpg')}}" alt=""> --}}
        <div class="image">
            @if(!empty($player['personInfo']['imagePath']))
                <img src="{{ config('app.base_address') .$player['personInfo']['imagePath']}}" alt="alt image"  onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
            @else
                <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
            @endif
        </div>
        <h3>{{$player['name']}}</h3>
    </div>
    <div class="card">
        <h4>{{trans('all.personal-details')}}</h4>
        <div class="information">
            @if (!is_null($player['clubName']))
                <div class="info-player">
                    <p>{{trans('institutions.clubName')}} :</p><span>{{$player['clubName']}}</span>
                </div>
            @endif
            @if (!is_null($player['academyName']))
                <div class="info-player">
                    <p>{{trans('all.AcademyName')}} :</p><span>{{$player['academyName']}}</span>
                </div>
            @endif
            @if (!is_null($player['personInfo']['birthDate']))
                <div class="info-player">
                    <p>{{trans('auth.birthDate')}} :</p><span>{{(\Carbon\Carbon::parse($player['personInfo']['birthDate'] )->format('d/m/Y'))}}</span>
                </div>
            @endif
            @if (!is_null($player['personInfo']['nationalityName']))
                <div class="info-player">
                    <p>{{trans('auth.nationalityName')}} :</p><span>{{$player['personInfo']['nationalityName']}}</span>
                </div>
            @endif
            @if (!is_null($player['personInfo']['email']))
                <div class="info-player">
                    <p>{{trans('all.email')}} :</p><span>{{$player['personInfo']['email']}}</span>
                </div>
            @endif
            @if (!is_null($player['personInfo']['phone']))
                <div class="info-player">
                    <p>{{trans('all.Phone')}} :</p><span>{{$player['personInfo']['phone']}}</span>
                </div>
            @endif
            @if (!is_null($player['personInfo']['address']))
                <div class="info-player">
                    <p>{{trans('auth.Address')}} :</p><span>{{$player['personInfo']['address']}}</span>
                </div>
            @endif
            @if (!is_null($player['personInfo']['gender']))
                <div class="info-player">
                    <p>{{trans('auth.gender')}} :</p>
                    @if ($player['personInfo']['gender'] == 'M')
                        <span>{{trans('individually.male')}}</span>
                     @elseif ($player['personInfo']['gender'] == 'F')
                        <span>{{trans('individually.female')}}</span>
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>
@else
    @include('layouts.no-data-available')
@endif
@endsection
