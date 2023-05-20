@extends('layouts.master')

@section('title' , trans('site.site-title'). " - ". $pageInfo['title'])

{{-- @if(array_key_exists('description' , $pagesInfo))
    @section('og-description' , $pagesInfo['description'])
    @section('description', $pagesInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))
@endif --}}

{{-- @section('keywords' , config('app.keywords')) --}}
{{-- @section('og-title' , config('app.name')  ."-". $pagesInfo['title']) --}}

@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/links.css'))

@section('content')
    <section class="blogs-list">
        <!-- Start header -->
        <div class="about-header m-0">
            <div class="title-about"></div>
            <div class="image-home">
                <img class="" src="{{  url(asset('assets/img/7.jpg')) }} " alt="header">
            </div>
        </div>
{{--        @if (isset($pages) && !is_null($pages))--}}
{{--        <div class="about-union">--}}
{{--            <div class="container">--}}
{{--                <div class="col-12 col-xl-6 desc">--}}
{{--                    <h1>{{getTranslate($pages, 'name')}}</h1>--}}
{{--                </div>--}}
{{--                @if(!empty($pages['attachments'] ) )--}}
{{--                    <img class="chart" src="{{ config('app.base_address') .$pages['attachments'][0]['path'] }}" alt="" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';">--}}
{{--                @else--}}
{{--                    <img class="chart" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @else--}}
{{--        @include('layouts.no-data-available')--}}
{{--    @endif--}}
        <div class="row justify-content-center">
            <div class="title col-xs-12 text-center mt-5">
                <h1 style="color: red">
                    {{ $pageInfo['title'] }}
                </h1>
            </div>
        </div>
        <div class="container my-3 my-md-5">
            @if(isset($pages) && count($pages) > 0)
                <div class="row">
                    @foreach($pages as $key => $item)
                        @if($key == 0)
                            <div class="col-12 mb-4">
                        @elseif($key == 1 || $key == 2)
                            <div class="col-12 col-md-6 mb-4">
                        @else
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                        @endif
                        <div class="product-box column h-100" data-aos="fade-up" data-aos-duration="2000">
                            {{--                                <a href="{{url(App::getLocale() . '/pages/view/' . $item['id'])}}" class="product-item w-100">--}}
                            <div class="card p-0 mb-0 h-100 mx-auto" style="max-width: 350px">
                                @if(!empty($item['mainImagePath']))
                                    <img class="responsive" src="{{ config('app.base_address') .$item['mainImagePath']}}" alt="alt image"  onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}';"/>
                                @else
                                    <img class="responsive" src="{{asset('assets/img/logo1.png')}}" alt="alt image"/>
                                @endif
                                <div class="card-body p-3 text-center">
                                    <h6 class="card-title text-black text-center border-0">{!! words(getTranslate($item, 'content'), 15, '...') !!}</h6>
                                    <p class="card-text text-success text-center mb-0">{{ getTranslate($item, 'name') }}</p>
                                    {{--                                            <button class="btn btn-success mt-3">{{trans('all.more')}}</button>--}}
                                </div>
                            </div>
                            {{--                                </a>--}}
                        </div>
                    </div>
                @endforeach
                </div>
            @else
                @include('layouts.no-data-available')
            @endif
        </div>
    </section>
@endsection

