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

@if(Storage::disk()->exists($result->image))
    @section('og-image' , url(asset($result->image)))
@else
    @section('og-image' , url(asset('royal_real_estate/SD08/Icons/logo.png')))
@endif
@section('og-url' , url(Request::url()))

@section('container' , 'container-fluid-custom')
@section('content')
    <section class="container-fluid main-section page-container">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="card card-custom w-100">
                        <div class="main-title">
                            <h1 class="page-title">
                                {{ $result->translation(App::getLocale())->name }}
                            </h1>
                        </div>
                        @if(Storage::disk()->exists($result->image))
                            <div class="image">
                                <img class="card-img"
                                     src="{{ asset($result->image) }}">
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    {!! $result->translation(App::getLocale())->description !!}
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="send-error-ajax" class="send-error-ajax">
                                    </div>
                                    <div id="send-ajax" class="send-ajax">
                                        <form id="contact_form" onsubmit="return false;">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <label for="name">{{ trans('site.name') }} </label>
                                                <input name="name" type="name" class="form-control" id="name"
                                                       placeholder="{{ trans('site.name') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">{{ trans('page.quantity') }} </label>
                                                <input name="quantity" type="text" class="form-control" id="quantity"
                                                       placeholder="{{ trans('page.quantity') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">{{ trans('site.email') }}</label>
                                                <input name="email" type="email" class="form-control" id="email"
                                                       placeholder="{{ trans('site.email') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">{{ trans('site.phone') }}</label>
                                                <input name="phone" type="text" class="form-control" id="phone"
                                                       placeholder="{{ trans('site.phone') }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="comments">{{ trans('page.comments') }}</label>
                                                <textarea name="comments" id="comments" class="form-control comments"
                                                          placeholder="{{ trans('page.comments') }}" rows="6"></textarea>
                                            </div>
                                            <button type="submit" id="submit_contact" name="submit"
                                                    class="btn btn-learn-more btn-primary pull-right">{{ trans('site.submit') }}</button>
                                        </form>
                                    </div>
                                </div>
                                @if($result->translation($locale)->link1 != '')
                                <div class="col-12">
                                    <br>
                                    <iframe src="{{ $result->translation($locale)->link1 }}" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                                @endif
                                @if($result->translation($locale)->link2 != '')
                                    <div class="col-12">
                                        <br>
                                        <iframe src="{{ $result->translation($locale)->link2 }}" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/localization/messages_'.App::getLocale().'.min.js') }}"></script>

    <script type="text/javascript">
        function CallFormSubmit( id ){
            var form  = $('#'+id);

            var $btn = $('#submit_contact');
            $btn.attr("disabled", "disabled");
            $btn.html("{{ trans('site.sending') }}");
            $.ajax({
                type: 'post',
                url: "{{ url('/'.App::getLocale().'/contact') }}",
                data: form.serialize()
            }).done(function (data) {
                if (data.error) {
                    $btn.removeAttr("disabled");
                    $btn.removeClass("disabled");
                    $btn.html("{{ trans('site.send') }}");
                    $('#send-error-ajax').html(data.result);
                } else {
                    $btn.removeAttr("disabled");
                    $btn.html("{{ trans('site.send') }}");
                    $('#send-ajax').html("<h5 class='text-info'>{{ trans('site.send_success') }}</h5><div class=\"home\"><a href={{url(App::getLocale())}}><div class=\"btn\">{{trans('all.home')}}</div></a></div> ");
                }
            }).fail(function (data) {

            });
        }



        (function($,W,D)
        {
            var JQUERY4U = {};

            JQUERY4U.UTIL =
                {
                    setupFormValidation: function()
                    {
                        //form validation rules
                        $("#contact_form").validate({
                            rules: {
                                name:"required",
                                message: {
                                    required: true,
                                },
                                email: {
                                    required: true,
                                    email: true
                                },
                            },

                            submitHandler: function(form) {
                                CallFormSubmit('contact_form');
                            }
                        });
                    }
                }
            //when the dom has loaded setup form validation rules
            $(D).ready(function($) {
                JQUERY4U.UTIL.setupFormValidation();
            });

        })(jQuery, window, document);
    </script>
@endsection
