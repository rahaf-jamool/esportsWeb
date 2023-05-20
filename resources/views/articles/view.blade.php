@extends('layouts.master')
@section('title' , config('app.name'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
@section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
@section('description', config('app.description'))
@endif
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-". $pageInfo['title'])

@if(File::exists(asset('SD08/msf/'.$article->photo)))
    @section('og-image' , url(asset('SD08/msf/'.$article->photo)))
@else
    @section('og-image' , url(asset('SD08/msf/logo.jpg')))
@endif
@section('og-url' ,  url(Request::url()))
@section('content')

@if (isset($article) && !is_null($article))
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        {{ $article->title }}
                    </h1>
                    <p class="text-white link-nav">
                        <a href="{{ url($symbol) }}">{{ trans('all.home') }} </a>
                        <span class="lnr lnr-arrow-left"></span>
                        <a href="{{ url($symbol.'/articles/'.$article->article_type.'/'.make_slug($article->articlemaster->{$symbol.'_name'}) ) }}">
                            {{ $article->articlemaster->{$symbol.'_name'} }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-posts-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 post-list blog-post-list">
                    <div class="single-post">
                        @if($article->photo != '' && File::exists('SD08/msf/'.$article->photo))
                            <img class="img-fluid" src="{{url('SD08/msf/'.$article->photo)}}" alt="{{ $article->title }}">
                        @endif
                        @if($article->photos->isNotEmpty())
                            <div class="active-item-imgs-carusel mt-10">
                                @foreach($article->photos as $image)
                                    <a href="{{ url('SD08/msf/'.$image->photo) }}" class="single-gallery">
                                        <img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$image->photo),200,100,array('crop')) }}" alt="{{ $image->title }}">
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        @if($article->article_type == 1)
                            <div class="category mt-10">
                                {{ date( "d M Y" , strtotime($article->post_date)) }}
                            </div>
                        @endif
                        <h1>
                            {{ $article->title }}
                        </h1>
                        <div class="content-wrap text-justify">
                             {!! $article->description !!}
                        </div>
                        <hr>
                        <section class="nav-area pt-50 pb-100">
                            <div class="container">
                                <div class="row justify-content-between">
                                    <div class="col-sm-6 nav-right justify-content-start d-flex">
                                        @if($prev->isNotEmpty())
                                            <div class="thumb">
                                                <a href="{{ArticlesService::check_url($prev->first(),$prev->first()->articlemaster)}}">
                                                    @if($prev->first()->photo != '' && File::exists('SD08/msf/'.$prev->first()->photo))
                                                        <img class="img-fluid" src="{{Image::url(url('SD08/msf/'.$prev->first()->photo),75,75,array('crop'))}}" alt="{{ $prev->first()->title }}">
                                                    @else
                                                        <img class="img-fluid" src="{{Image::url(url('SD08/msf/logo.png'),75,75,array('crop'))}}" alt="{{ $prev->first()->title }}">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="post-details">
                                                <p>{{ trans('all.prev') }}</p>
                                                <h4 class="text-uppercase {{ ($article->article_type == 1)?'':'d-none' }}">
                                                    <a href="{{ArticlesService::check_url($prev->first(),$prev->first()->articlemaster)}}">
                                                        {{ $prev->first()->title }}
                                                    </a>
                                                </h4>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-6 nav-left justify-content-end d-flex">
                                        @if($next->isNotEmpty())
                                            <div class="post-details">
                                                <p>{{ trans('all.next') }}</p>
                                                <h4 class="text-uppercase {{ ($article->article_type == 1)?'':'d-none' }}">
                                                    <a href="{{ArticlesService::check_url($next->first(),$next->first()->articlemaster)}}">
                                                        {{ $next->first()->title }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div class="thumb">
                                                <a href="{{ArticlesService::check_url($next->first(),$next->first()->articlemaster)}}">
                                                    @if($next->first()->photo != '' && File::exists('SD08/msf/'.$next->first()->photo))
                                                        <img class="img-fluid" src="{{Image::url(url('SD08/msf/'.$next->first()->photo),75,75,array('crop'))}}" alt="{{ $next->first()->title }}">
                                                    @else
                                                        <img class="img-fluid" src="{{Image::url(url('SD08/msf/logo.png'),75,75,array('crop'))}}" alt="{{ $next->first()->title }}">
                                                    @endif
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-lg-4 sidebar">
                    <div class="single-widget search-widget">
                        <div class="text-center">
                            @if(is_array($pageInfo['share']))
                                @foreach($pageInfo['share'] as $key => $value)
                                    @php
                                        $class = 'pupub';
                                        $fa = 'fab';
                                        if($key == 'email'){
                                            $fontIcon  = 'envelope';
                                            $class = '';
                                            $fa = 'fa';
                                        }elseif($key == 'gplus')
                                         $fontIcon = 'google-plus';
                                        else
                                         $fontIcon = $key;
                                    @endphp
                                    <a href="{{ $value }}" class="btn  btn-social-icon {{ $class }} btn-{{ $key }}"><i
                                                class="{{$fa}} fa-{{ $fontIcon }}" aria-hidden="true"></i></a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="single-widget recent-posts-widget">
                        <h4 class="title">{{ trans('all.most-visited') }}</h4>
                        <div class="blog-list ">
                            @if($visited->isNotEmpty())
                                @foreach($visited as $value)
                                    <div class="single-recent-post d-flex flex-row">
                                        <div class="recent-thumb">
                                            @if($value->photo != '' && File::exists('SD08/msf/'.$value->photo))
                                                <img class="img-fluid" src="{{Image::url(url('SD08/msf/'.$value->photo),75,75,array('crop'))}}" alt="{{ $value->title }}">
                                            @else
                                                <img class="img-fluid" src="{{Image::url(url('SD08/msf/logo.png'),75,75,array('crop'))}}" alt="{{ $value->title }}">
                                            @endif
                                        </div>
                                        <div class="recent-details">
                                            <a href="{{ArticlesService::check_url($value,$value->articlemaster)}}">
                                                <h4>
                                                    {{ $value->title }}
                                                </h4>
                                            </a>
                                            <p>
                                                {{ date( "d M Y" , strtotime($value->post_date)) }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/nrdjs/share.js')}}"></script>
    @include('layouts.left-side' , ['deathsArticles'=> collect()])
@else
    @include('layouts.no-data-available')
@endif

@endsection
