@extends('layouts.master')
{{--@section('title' , config('app.name'). " - ". $pageInfo['title'])--}}
{{-- @php
    $user = session()->has('loggedUser') ? session('loggedUser') : '';
@endphp --}}
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

<section class="blogs-list">
    <div class="about-header" >
        <div class="image-home">
            <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
        </div>
    </div>
    <div class="title-about">
        <h1>{{trans('site.articles')}}</h1>
    </div>
    @if(!empty($user))
        @if($user['client']['type'] == "Club" || $user['client']['type'] == "Academy" || $user['client']['type'] == "Sport-Company")

        @else
        <div class="blog-btn">
            <button><a href="{{url(App::getLocale() . '/myaccount')}}">{{trans('articles.submit-article')}}</a></button>
        </div>
        @endif
    @endif
 @if(!empty($blogs) )
    <div class="blogs">
        @foreach ($blogs as $item)
        <figure class="snip1527">
            <a class="imageCardUrl" href="{{url(App::getLocale() . '/articles/'.$item['id'].'/view')}}">
                <div class="image">
                    @if(!empty($item['mainImagePath']))
                        <img src="{{ config('app.base_address') .$item['mainImagePath']}}" alt="alt image"  onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                    @else
                        <img src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                    @endif
                </div>
            </a>
            <figcaption>
                <div class="date">
                    <span class="day">{{ \Carbon\Carbon::parse($item['acceptDate'])->format('d-M')}}</span>
                    <span class="month">{{ \Carbon\Carbon::parse($item['acceptDate'])->format('Y')}}</span>
                </div>
                <h3 class="mb-3">{{ words($item['title'],'4','..') }}</h3>
                <p class="mb-3">
                {{ words($item['description'],'10','..') }}
                </p>
                <p class="mb-3 auther"><b> {{trans('articles.author-name')}}</b> <small>{{$item['authorName']}}</small></p>
                <div class="post-meta mb-3">
                    <span class="timestamp">
                        <a href="{{url(App::getLocale() . '/articles/'.$item['id'].'/view')}}"><button>{{trans('all.more')}}</button></a>
                    </span>
                </div>
            </figcaption>
            <a href="#"></a>
        </figure>
        @endforeach








        {{-- <figure class="snip1527">
            <a href="{{url(App::getLocale() . '/articles/view')}}">
                <div class="image">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/pr-sample25.jpg" alt="pr-sample25" />
                </div>
            </a>
            <figcaption>
                <div class="date">
                    <span class="day">01 Dec</span>
                    <span class="month">2022</span>
                </div>
                <h3 class="mb-3">Down with this sort of thing</h3>
                <p class="mb-3">
                I don't need to compromise my principles, because they don't have the slightest bearing on what happens to me anyway.
                </p>
                <p class="mb-3"><b>Author:</b> <small>Osama Jimenzi</small></p>
                <div class="post-meta mb-3">
                    <span class="timestamp">
                        <i class="fa fa-clock-o"></i> <small>6 mins ago</small>
                    </span>
                </div>
            </figcaption>
            <a href="#"></a>
        </figure>
        <figure class="snip1527">
            <a href="{{url(App::getLocale() . '/articles/view')}}">
                <div class="image">
                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/pr-sample23.jpg" alt="pr-sample23" />
                </div>
            </a>
            <figcaption>
                <div class="date">
                    <span class="day">28 Oct</span>
                    <span class="month">2022</span>
                </div>
                <h3 class="mb-3">The World Ended Yesterday</h3>
                <p class="mb-3">
                You know what we need, Hobbes? We need an attitude. Yeah, you can't be cool if you don't have an attitude.
                </p>
                <p class="mb-3"><b>Author:</b> <small>Osama Jimenzi</small></p>
                <div class="post-meta mb-3">
                    <span class="timestamp">
                        <i class="fa fa-clock-o"></i> <small>6 mins ago</small>
                    </span>
                </div>
            </figcaption>
            <a href="#"></a>
        </figure> --}}
    </div>
@endif
</section>
@endsection

@push('js')
    <script>
        $(".hover").mouseleave(
        function() {
            $(this).removeClass("hover");
        }
        );
    </script>
@endpush
