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

<!-- <section class="event-header">
    <div class="register-section">
        <div class="details-register">
            <div class="title">
                {{trans('institutions.if-you-can-register')}}
            </div>
            <div class="button-register">
                <button class="btn btn-success"><a style="color: #fff" href="{{url(App::getLocale().'/electronic-services/individually/register')}}">{{trans('all.register')}}</a></button>
            </div>
        </div>
    </div>
</section> -->
<div class="tile" id="tile-1">
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="setting-tab" data-bs-toggle="tab" data-bs-target="#setting" href="#setting" role="tab" aria-controls="setting" aria-selected="false">{{trans('individually.players')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{trans('individually.coaches')}}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{trans('individually.judgments')}}</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" href="#home" role="tab" aria-controls="home" aria-selected="true">{{trans('individually.issuance-certificate')}}</a>
        </li> --}}
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="setting" role="tabpanel" aria-labelledby="setting-tab">
            @include('electronicServices.individually.player.list')
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            @include('electronicServices.individually.coach.list')
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @include('electronicServices.individually.judgment.list')
        </div>
        {{-- <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
            @include('electronicServices.individually.issuance-of-certificate.list')
        </div> --}}
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

         // Prepare the preview for profile picture
         $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
            });

        // $(document).ready( function() {
        //     $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        //         console.log("teste");
        //         var input_label = $(this).closest('.input-group').find('.file-input-label'),
        //             log = numFiles > 1 ? numFiles + ' files selected' : label;

        //         if( input_label.length ) {
        //             input_label.text(log);
        //         } else {
        //             if( log ) alert(log);
        //         }
        //     });
        // });
    </script>
@endpush
