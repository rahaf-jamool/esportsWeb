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

@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('content')
    <div class="row page-view news">
        <div class="col-xs-12 page-title">
            <h1>{{ $pageInfo['title']}}</h1>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="news-sector">
                @if($news->isNotEmpty())
                @foreach($news as $value)
                    <div class="news-box col-xs-12 col-sm-6 col-md-4">

                        <a href="{{NewsService::check_url($value,$value->newsmaster)}}">

                                <div class="panel-body panel">
                                    <div class="thumbnail">
                                        @if($value->photo!='' && File::exists('SD08/msf/'.$value->photo))
                                            <img class="img-responsive"
                                                 src="{{ url("SD08/msf/".$value->photo) }}"
                                                 alt="{{ $value->title }}">
                                        @else
                                            <img src="{{ url('SD08/msf/logo.jpg') }}" alt="{{ $value->title }}" />
                                        @endif
                                    </div>
                                    <div class="date"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <span> &#x200E;{{ date( "d,M Y" , strtotime($value->post_date)) }} </span>
                                    </div>
                                    <div class="caption caption-board">
                                        <h4> {{ $value->title }} </h4>
                                        <p>{{ words($value->brief , '15' , '00') }}</p>
                                    </div>
                                    @if($value->news_type== 1)
                                        <div class="date">
                                            @if($value->start_date!='' && $value->end_date!='')
                                                <span class="from">
                                                    {{$value->start_date}}
                                                    &nbsp;{{trans('all.to')}}&nbsp;
                                                    {{$value->end_date}}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    <div class="more">

                                        <a href="{{NewsService::check_url($value,$value->newsmaster)}}" class="btn btn-default btn-more">
                                            {{ trans('site.more') }}
                                        </a>
                                    </div>
                                </div>

                        </a>
                    </div>
                @endforeach
                </div>
                    <div class="col-xs-12 col-sm-12 load-more">
                        <a href="javascript:void(0)" id="load_more" class="btn btn-default "
                                   data-offset="12">{{ trans('site.load-more') }}
                        </a>
                    </div>
                    @endif
            </div>
        </div>
    </div>


    <script type="text/javascript">
        var _config = {
            getGetArticlesUrl: '{{ url($symbol.'/get_search_ajax_news/'.$keyword)}}'
        }
    </script>
    <script type="text/javascript" src="{{ asset('js/nrdjs/articles.js') }}"></script>
    <script type="text/javascript">
        articles.listPage();
    </script>
@endsection