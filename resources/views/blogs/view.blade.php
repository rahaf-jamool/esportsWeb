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
@section('page-style', asset('assets/css/blogs.css'))

@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')
<!-- Start header -->
{{-- <div class="about-header" >
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
        <div class="title-about">

        </div>
    </div>
</div> --}}
<!-- End header -->
<section>
    @if (isset($blog) && !is_null($blog))
        <div class="blog-details">
            <div class="details-title mb-5">
                <h1>{{$blog['title']}}</h1>
            </div>
            <div class="details-image mb-3">
                <!-- <figure class="zoom" onmousemove="zoom(event)" style="background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/pr-sample24.jpg)">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/pr-sample24.jpg" />
                </figure> -->
                {{-- <img class="mb-3" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/pr-sample24.jpg" alt=""> --}}
                @if(!empty($blog['mainImagePath']))
                    <div class="image-details d-flex" style="justify-content: center;">
                        <img class="responsive" src="{{ config('app.base_address') . $blog['mainImagePath'] }}" alt="alt image" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';this.style='width:250px';"/>
                    </div>
                @else
                    <div class="image-details d-flex" style="justify-content: center;">
                        <img class="responsive" src="{{ asset('assets/img/44-01.png') }}" alt="alt image"/>
                    </div>
                @endif
                <div class="mt-5 mb-5 body-desc flex-wrap">
                    <div class="author mb-3">
                        <p class=""><b style="color: red"> {{trans('articles.author-name')}}: </b>{{$blog['authorName']}}</p>
                    </div>
                    <div class="author">
                        <p class=""><b style="color: red"> {{trans('site.date')}}: </b>
                            <small>{{ \Carbon\Carbon::parse($blog['acceptDate'])->format('d/m/Y')}}</small>
                    </div>
                </div>
            </div>
            <div class="details-desc mt-5">
                {!! $blog['description'] !!}
            </div>
            @if(!empty($blog['attachments']))
                <div class="load">
                    <div class="btn">
                        <a href="{{ config('app.base_address') . $blog['attachments'][0]['path'] }}" target="_blank"><button> {{trans('articles.download-article')}} </button></a>
                    </div>
                </div>
            @endif
        </div>
    @else
        @include('layouts.no-data-available')
    @endif
</section>
@endsection

@push('js')
    <script>
        function zoom(e){
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = offsetX/zoomer.offsetWidth*100
            y = offsetY/zoomer.offsetHeight*100
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        }
    </script>
@endpush
