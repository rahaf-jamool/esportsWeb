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
@section('page-style', asset('assets/css/contact.css'))

@section('container' , 'container-fluid-custom')
@section('content')


    <div class="map" id="map" style="width:100%;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3608.347232449753!2d55.297396414934866!3d25.25890218386755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43c3fd9200c1%3A0xdbf8ba09875b71ab!2sKhalifa%20building!5e0!3m2!1sen!2s!4v1664372776505!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        {{--   {!! $result -> URL !!}     --}}
    </div>
    <section class="container-fluid main-section page-container">
                <div class="row">
                    <div class="card-custom">
                        <div class="card-body">
                            <div class="row" style="justify-content: space-between;">
                                <div class="col-lg-4 col-sm-12 col-md-6 mb-4" style="padding: 0px;">
                                {{--    {!! $result -> Content !!} --}}
                                <p>
                                    <b>{{trans('auth.phone')}}: </b> 009711111
                                </p>
                                <p>
                                    <b>{{trans('auth.email')}}: </b> info@gmail.emiratesesports.com
                                </p>
                                <p>
                                    <b>{{trans('auth.Address')}}: </b> الامارات العربية المتحدة
                                </p>
                                </div>
                                <div class="col-lg-7 col-sm-12 col-md-6" style="padding: 0px;">
                                    <div id="send-error-ajax" class="send-error-ajax">
                                    </div>
                                    <div id="send-ajax" class="send-ajax">
                                        <form id="contact_form" onsubmit="return false;">
                                            {{ csrf_field() }}
                                            <div style="display: flex; justify-content: space-between;">
                                                <div class="form-group" style="width: 49%;">
                                                <input style="font-size: 14px!important;" name="name" type="text"
                                                    class="form-control" id="name"
                                                    placeholder="{{ trans('site.yourname') }}">
                                                </div>
                                                <div class="form-group" style="width: 49%;">
                                                    <input style="font-size: 14px!important;" name="email" type="email"
                                                        class="form-control" id="email"
                                                        placeholder="{{ trans('site.youremail') }}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <input style="font-size: 14px!important;" name="title" type="text"
                                                       class="form-control" id="title"
                                                       placeholder="{{ trans('site.yourtitle') }}">
                                            </div>
                                            <div class="form-group">
                                                <textarea style="font-size: 14px!important;" name="message" id="message"
                                                          class="form-control message"
                                                          placeholder="{{ trans('site.message') }}" rows="6"></textarea>
                                            </div>
                                            <div class="form-group d-none">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <span class="captcha-image"> {!! captcha_img()  !!} </span> <a
                                                            href="javascript:void(0);"
                                                            class="btn btn-primary captcha-refresh"> {{ trans('all.refresh') }}</a>
                                                    <br/>
                                                    <br/>
                                                    <input id="captcha"
                                                           type="text"
                                                           class="form-control captcha"
                                                           name="captcha"
                                                           value="">
                                                    @if ($errors->has('captcha'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('captcha') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                            </div>
                                            <button type="submit" id="submit_contact" name="submit"
                                                    class="btn btn-learn-more btn-success mt-3">{{ trans('site.sendmessage') }}</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        </div>
    </section>

@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        // Google Maps setup
        var googlemap = new google.maps.Map(
            document.getElementById('googlemap'),
            {
                center: new google.maps.LatLng(44.5403, -78.5463),
                zoom: 8,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        );
    });
</script>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/localization/messages_'. App::getLocale() . '.min.js') }}"></script>

        <script type="text/javascript">

            function CallFormSubmit(id) {

                var form = $('#' + id);

                var $btn = $('#submit_contact');
                $btn.attr("disabled", "disabled");
                $btn.html("{{ trans('site.sending') }}");
                console.log('form : ', form.serialize());
                $.ajax({
                    type: 'post',
                    url: "{{ url('/'.App::getLocale().'/contact/send-mail') }}",
                    data: form.serialize()
                }).done(function (data) {
                    console.log('its done');
                    if (data.error) {
                        $btn.removeAttr("disabled");
                        $btn.removeClass("disabled");
                        $btn.html("{{ trans('site.send') }}");
                        $('#send-error-ajax').html(data.result);
                        // Refresh_Captcha();
                    } else {
                        $btn.removeAttr("disabled");
                        $btn.html("{{ trans('site.send') }}");
                        $('#send-ajax').html("<h5 class='text-info'>{{ trans('site.send_success') }}</h5><div class=\"home\"><a href={{url(App::getLocale())}}><div class=\"btn\">{{trans('all.home')}}</div></a></div> ");
                    }
                }).fail(function (data) {
                    console.log('its fail');
                    $btn.removeAttr("disabled");
                    $btn.removeClass("disabled");
                    $btn.html("{{ trans('site.send') }}");
                    $('#send-error-ajax').html(data.result);
                    // Refresh_Captcha();
                });
            }


            (function ($, W, D) {
                var JQUERY4U = {};

                JQUERY4U.UTIL = {
                        setupFormValidation: function () {
                            //form validation rules
                            $("#contact_form").validate({
                                rules: {
                                    name: "required",
                                    message: {
                                        required: true,
                                    },
                                    email: {
                                        required: true,
                                        email: true
                                    },
                                    captcha: "required",
                                },

                                submitHandler: function (form) {
                                    CallFormSubmit('contact_form');
                                }
                            });
                        }
                    }
                //when the dom has loaded setup form validation rules
                $(D).ready(function ($) {
                    JQUERY4U.UTIL.setupFormValidation();
                });

            })(jQuery, window, document);
        </script>

        {{-- <script type="text/javascript">
            $('.captcha-refresh').on('click', function () {
                $.ajax({
                    type: 'get',
                    url: "{{ url('captcha-refresh') }}",
                }).done(function (data) {
                    $('.captcha-image').html(data);
                }).fail(function (data) {

                })
            })
        </script> --}}
@endpush
