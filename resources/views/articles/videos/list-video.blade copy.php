@extends('layouts.master')

{{-- @section('title' , config('app.name'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
    @section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))
@endif
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-". $pageInfo['title']) --}}
@section('page-style', asset('assets/css/articles-video.css'))

@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')
<!-- Start header -->
<div class="about-header" >
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
        {{-- <div class="title-about">
        {{ $pageInfo['title']}}
        </div> --}}
    </div>
</div>
<!-- End header -->
    <div class="video-list">
    <h1>{{ $pageInfo['title']}}</h1>
        <section class="videos">
            <div class="card item">
                <a data-fancybox href="#myVideo">
                    <img class="card-img-top img-fluid" src="https://www.html5rocks.com/en/tutorials/video/basics/poster.png" />
                </a>
                <video width="640" height="320" controls id="myVideo" style="display:none;">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.mp4" type="video/mp4">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.webm" type="video/webm">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.ogv" type="video/ogg">
                </video>
            </div>

            <div class="card item">
                <a data-fancybox href="#myVideo">
                    <img class="card-img-top img-fluid" src="http://img.youtube.com/vi/rahRaVtEQaM/mqdefault.jpg" />
                </a>
                <video width="640" height="320" controls id="myVideo" style="display:none;">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.mp4" type="video/mp4">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.webm" type="video/webm">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.ogv" type="video/ogg">
                </video>
            </div>

            <div class="card item">
                <a data-fancybox href="#myVideo">
                    <img class="card-img-top img-fluid" src="https://www.html5rocks.com/en/tutorials/video/basics/poster.png" />
                </a>
                <video width="640" height="320" controls id="myVideo" style="display:none;">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.mp4" type="video/mp4">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.webm" type="video/webm">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.ogv" type="video/ogg">
                </video>
            </div>

            <div class="card item">
                <a data-fancybox href="#myVideo">
                    <img class="card-img-top img-fluid" src="http://img.youtube.com/vi/rahRaVtEQaM/mqdefault.jpg" />
                </a>
                <video width="640" height="320" controls id="myVideo" style="display:none;">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.mp4" type="video/mp4">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.webm" type="video/webm">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.ogv" type="video/ogg">
                </video>
            </div>

            <div class="card item">
                <a data-fancybox href="#myVideo">
                    <img class="card-img-top img-fluid" src="https://www.html5rocks.com/en/tutorials/video/basics/poster.png" />
                </a>
                <video width="640" height="320" controls id="myVideo" style="display:none;">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.mp4" type="video/mp4">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.webm" type="video/webm">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.ogv" type="video/ogg">
                </video>
            </div>

            <div class="card item">
                <a data-fancybox href="#myVideo">
                    <img class="card-img-top img-fluid" src="http://img.youtube.com/vi/rahRaVtEQaM/mqdefault.jpg" />
                </a>
                <video width="640" height="320" controls id="myVideo" style="display:none;">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.mp4" type="video/mp4">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.webm" type="video/webm">
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/Chrome_ImF.ogv" type="video/ogg">
                </video>
            </div>
        </section>
    </div>
@endsection


@push('js')
    <script>
        //  Set caption from card text
    $('.card-deck a').fancybox({
    caption : function( instance, item ) {
        return $(this).parent().find('.card-text').html();
    }
    });
    </script>
@endpush
