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
<div class="blog-form">
    <div class="about-header" >
        <div class="image-home">
            <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
        </div>
    </div>
    <h1>{{trans('articles.share-your-article')}}</h1>
    <form role="form" method="POST">
        <div class="form-group{{ $errors->has('fullName') ? ' has-error' : '' }}">
            <label for="fullName" class="col-md-4 control-label  pb-2 pt-2">{{trans('articles.full-name')}}</label>
            <div class="col-md-12 col-lg-9">
                <input id="fullName" type="text" class="form-control" name="fullName" value="{{ old('fullName') }}" required autofocus>
                @if ($errors->has('fullName'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fullName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label for="title" class="col-md-4 control-label  pb-2 pt-2">{{trans('articles.article-title')}}</label>
            <div class="col-md-12 col-lg-9">
                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                @if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label  pb-2 pt-2">{{trans('articles.article-text')}}</label>
            <div class="col-md-12 col-lg-9">
                <textarea style="border: 2px solid #e7e7e9;" name="description" id="" cols="150" rows="10" maxlength="200" value="{{ old('description') }}" required autofocus></textarea>
                @if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('image ') ? ' has-error' : '' }}">
            <label for="image " class="control-label  pb-2 pt-2">{{trans('articles.article-image')}}</label>
            <div class="col-md-12 col-lg-9">
                <input id="image " type="file" class="form-control" name="image">
                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image ') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('image ') ? ' has-error' : '' }}">
            <label for="image " class="control-label  pb-2 pt-2"> {{trans('articles.download-file')}}</label>
            <div class="col-md-12 col-lg-9">
                <input id="image " type="file" class="form-control" name="image">
                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image ') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4 pt-5">
                <button type="submit" class="s-button y2w swipe2right">
                    {{trans('articles.submit-article')}}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
