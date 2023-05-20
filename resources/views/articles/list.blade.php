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
@section('page-style', asset('assets/css/articles.css'))

@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')

<section class="section">
    <section class="banner-area">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">
                        {{-- {{ $pageInfo['title'] }} --}}
                        الاخبار
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <section class="blog-posts-area section-gap news" style="padding-top: 50px;">
        {{-- <div class="container">
            @if($articles->isNotEmpty())
                <div class="row news-sector">
                    @foreach($articles as $value)
                        <div class="col-md-4 col-sm-6 col-12" >
                            <div class="card home-article m-1 text-center animation fadeInUp p-0" style="width: 100%; background-color: #fff;">
                                <a href="{{ArticlesService::check_url($value,$value->articlemaster)}}">
                                    @if($value->photo!='' && File::exists('SD08/msf/'.$value->photo))
                                        <img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$value->photo),400,550,array('crop') ) }}" alt="{{ $value->{$symbol.'_name'} }}"/>
                                    @else
                                        <img class="img-fluid" src="{{asset('assets/img/3-01.jpg')}}"/>
                                    @endif
                                </a>
                                <div class="card-body p-3">
                                    <div class="article-date">
                                        <span>
                                            29 Jun 2022
                                            {{-- {{ date( "d M Y" , strtotime($value->created_at)) }} --}}
                                        </span>
                                    </div>
                                    <div class="article-logo">
                                        <img src="{{ url('SD08/msf/logo.jpg') }}">
                                    </div>
                                    <h3 class="card-title">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر
                                        {{-- {{ words($value->title,13) }} --}}
                                    </h3>
                                    <p class="card-text" style="font-size: 15px;">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر الخاص لراعي هذا البطولة  اللاعب والعاشق والمحب لهذا اللعبة  السيد ..
                                        {{-- {{ words($value->description,20,'..') }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12" >
                            <div class="card home-article m-1 text-center animation fadeInUp p-0" style="width: 100%; background-color: #fff;">
                                {{-- <a href="{{ArticlesService::check_url($value,$value->articlemaster)}}"> --}}
                                    {{-- @if($value->photo!='' && File::exists('SD08/msf/'.$value->photo)) --}}
                                        {{-- <img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$value->photo),400,550,array('crop') ) }}" alt="{{ $value->{$symbol.'_name'} }}"/> --}}
                                    {{-- @else --}}
                                        <img class="img-fluid" src="{{asset('assets/img/3-01.jpg')}}"/>
                                    {{-- @endif --}}
                                {{-- </a> --}}
                                <div class="card-body p-3">
                                    <div class="article-date">
                                        <span>
                                            29 Jun 2022
                                            {{-- {{ date( "d M Y" , strtotime($value->created_at)) }} --}}
                                        </span>
                                    </div>
                                    <div class="article-logo">
                                        <img src="{{ url('SD08/msf/logo.jpg') }}">
                                    </div>
                                    <h3 class="card-title">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر
                                        {{-- {{ words($value->title,13) }} --}}
                                    </h3>
                                    <p class="card-text" style="font-size: 15px;">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر الخاص لراعي هذا البطولة  اللاعب والعاشق والمحب لهذا اللعبة  السيد ..
                                        {{-- {{ words($value->description,20,'..') }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12" >
                            <div class="card home-article m-1 text-center animation fadeInUp p-0" style="width: 100%; background-color: #fff;">
                                {{-- <a href="{{ArticlesService::check_url($value,$value->articlemaster)}}"> --}}
                                    {{-- @if($value->photo!='' && File::exists('SD08/msf/'.$value->photo)) --}}
                                        {{-- <img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$value->photo),400,550,array('crop') ) }}" alt="{{ $value->{$symbol.'_name'} }}"/> --}}
                                    {{-- @else --}}
                                        <img class="img-fluid" src="{{asset('assets/img/3-01.jpg')}}"/>
                                    {{-- @endif --}}
                                {{-- </a> --}}
                                <div class="card-body p-3">
                                    <div class="article-date">
                                        <span>
                                            29 Jun 2022
                                            {{-- {{ date( "d M Y" , strtotime($value->created_at)) }} --}}
                                        </span>
                                    </div>
                                    <div class="article-logo">
                                        <img src="{{ url('SD08/msf/logo.jpg') }}">
                                    </div>
                                    <h3 class="card-title">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر
                                        {{-- {{ words($value->title,13) }} --}}
                                    </h3>
                                    <p class="card-text" style="font-size: 15px;">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر الخاص لراعي هذا البطولة  اللاعب والعاشق والمحب لهذا اللعبة  السيد ..
                                        {{-- {{ words($value->description,20,'..') }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12" >
                            <div class="card home-article m-1 text-center animation fadeInUp p-0" style="width: 100%; background-color: #fff;">
                                {{-- <a href="{{ArticlesService::check_url($value,$value->articlemaster)}}"> --}}
                                    {{-- @if($value->photo!='' && File::exists('SD08/msf/'.$value->photo)) --}}
                                        {{-- <img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$value->photo),400,550,array('crop') ) }}" alt="{{ $value->{$symbol.'_name'} }}"/> --}}
                                    {{-- @else --}}
                                        <img class="img-fluid" src="{{asset('assets/img/3-01.jpg')}}"/>
                                    {{-- @endif --}}
                                {{-- </a> --}}
                                <div class="card-body p-3">
                                    <div class="article-date">
                                        <span>
                                            29 Jun 2022
                                            {{-- {{ date( "d M Y" , strtotime($value->created_at)) }} --}}
                                        </span>
                                    </div>
                                    <div class="article-logo">
                                        <img src="{{ url('SD08/msf/logo.jpg') }}">
                                    </div>
                                    <h3 class="card-title">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر
                                        {{-- {{ words($value->title,13) }} --}}
                                    </h3>
                                    <p class="card-text" style="font-size: 15px;">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر الخاص لراعي هذا البطولة  اللاعب والعاشق والمحب لهذا اللعبة  السيد ..
                                        {{-- {{ words($value->description,20,'..') }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12" >
                            <div class="card home-article m-1 text-center animation fadeInUp p-0" style="width: 100%; background-color: #fff;">
                                {{-- <a href="{{ArticlesService::check_url($value,$value->articlemaster)}}"> --}}
                                    {{-- @if($value->photo!='' && File::exists('SD08/msf/'.$value->photo)) --}}
                                        {{-- <img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$value->photo),400,550,array('crop') ) }}" alt="{{ $value->{$symbol.'_name'} }}"/> --}}
                                    {{-- @else --}}
                                        <img class="img-fluid" src="{{asset('assets/img/3-01.jpg')}}"/>
                                    {{-- @endif --}}
                                {{-- </a> --}}
                                <div class="card-body p-3">
                                    <div class="article-date">
                                        <span>
                                            29 Jun 2022
                                            {{-- {{ date( "d M Y" , strtotime($value->created_at)) }} --}}
                                        </span>
                                    </div>
                                    <div class="article-logo">
                                        <img src="{{ url('SD08/msf/logo.jpg') }}">
                                    </div>
                                    <h3 class="card-title">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر
                                        {{-- {{ words($value->title,13) }} --}}
                                    </h3>
                                    <p class="card-text" style="font-size: 15px;">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر الخاص لراعي هذا البطولة  اللاعب والعاشق والمحب لهذا اللعبة  السيد ..
                                        {{-- {{ words($value->description,20,'..') }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-12" >
                            <div class="card home-article m-1 text-center animation fadeInUp p-0" style="width: 100%; background-color: #fff;">
                                {{-- <a href="{{ArticlesService::check_url($value,$value->articlemaster)}}"> --}}
                                    {{-- @if($value->photo!='' && File::exists('SD08/msf/'.$value->photo)) --}}
                                        {{-- <img class="img-fluid" src="{{ Image::url(url('SD08/msf/'.$value->photo),400,550,array('crop') ) }}" alt="{{ $value->{$symbol.'_name'} }}"/> --}}
                                    {{-- @else --}}
                                        <img class="img-fluid" src="{{asset('assets/img/3-01.jpg')}}"/>
                                    {{-- @endif --}}
                                {{-- </a> --}}
                                <div class="card-body p-3">
                                    <div class="article-date">
                                        <span>
                                            29 Jun 2022
                                            {{-- {{ date( "d M Y" , strtotime($value->created_at)) }} --}}
                                        </span>
                                    </div>
                                    <div class="article-logo">
                                        <img src="{{ url('SD08/msf/logo.jpg') }}">
                                    </div>
                                    <h3 class="card-title">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر
                                        {{-- {{ words($value->title,13) }} --}}
                                    </h3>
                                    <p class="card-text" style="font-size: 15px;">
                                        رئيس اتحاد الامارات للدارتس سعادة خليفة المطيوعي ، يتقدم بالشكر الخاص لراعي هذا البطولة  اللاعب والعاشق والمحب لهذا اللعبة  السيد ..
                                        {{-- {{ words($value->description,20,'..') }} --}}
                                    </p>
                                </div>
                            </div>
                        </div>

                    {{-- @endforeach --}}
                </div>
                <div class="col-12 text-center mt-5 mb-5">
                    <a href="javascript:void(0)" id="load_more" class="btn btn-primary"
                                data-offset="12">{{ trans('site.load-more') }}
                    </a>
                </div>
            {{-- @endif --}}
        </div> --}}
    </section>
</section>
    {{-- <script type="text/javascript">
        var _config = {
            getGetArticlesUrl: '{{ url($symbol.'/articles/get_ajax_articles/'.$article_type->id)}}',
            getGetArticlesTarget: '.news-sector',
        }
    </script>
    <script type="text/javascript" src="{{ asset('js/nrdjs/articles.js') }}"></script>
    <script type="text/javascript">
        articles.listPage();
    </script> --}}
@endsection
