@extends('layouts.master')

<?php

    //dd(session('loggedUser'));
    // $list = App\Facades\ProductService::getList();
    // ProductService::getList("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJJZCI6Ijg5MGQ1MjlmLWQ3MjgtNGQzZS1iMDdmLWQ2NjcxNzU2M2IxMSIsImh0dHA6Ly9zY2hlbWFzLnhtbHNvYXAub3JnL3dzLzIwMDUvMDUvaWRlbnRpdHkvY2xhaW1zL2VtYWlsYWRkcmVzcyI6IlNVQWRtaW5AYXBwLmNvbSIsIlVzZXJOYW1lIjoiU1VBZG1pbiIsIkZpcnN0VXNlIjoiVHJ1ZSIsIkxhc3RQYXNzd29yZENoYW5nZSI6IiIsIlNob3VsZENoYW5nZVBhc3N3b3JkIjoiRmFsc2UiLCJEYXRhQWNjZXNzS2V5IjoiMC4iLCJodHRwOi8vc2NoZW1hcy5taWNyb3NvZnQuY29tL3dzLzIwMDgvMDYvaWRlbnRpdHkvY2xhaW1zL3JvbGUiOiJTVUFkbWluIiwiUGVybWlzc2lvbiI6WyJpbmRleGVzLWNvbnRyb2wiLCJyZWFkLUFjYWRlbXkiLCJyZWFkLUFnZUNhdGVnb3J5IiwicmVhZC1ibG9jayIsInJlYWQtQmxvY2tDYXRlZ29yeSIsInJlYWQtQmxvY2tUeXBlIiwicmVhZC1DaGFtcGlvbnNoaXBDbGFzc2lmaWNhdGlvbiIsInJlYWQtQ2x1YiIsInJlYWQtQ2x1YlR5cGUiLCJyZWFkLUNvYWNoIiwicmVhZC1Db3VudHJ5IiwicmVhZC1MZWFndWVDbGFzc2lmaWNhdGlvbiIsInJlYWQtTGVhZ3VlR3JvdXAiLCJyZWFkLU1hbmFnZXIiLCJyZWFkLU1lbnUiLCJyZWFkLU1lbnVDYXRlZ29yeSIsInJlYWQtTWVudVR5cGUiLCJyZWFkLU5hdGlvbmFsaXR5IiwicmVhZC1QYWdlIiwicmVhZC1QbGF5ZXIiLCJyZWFkLVBsYXllckNsYXNzaWZpY2F0aW9uIiwicmVhZC1QcmluY2Vkb20iLCJyZWFkLVJlZmVyZWUiLCJyZWFkLVN0YWRpdW0iLCJ3cml0ZS1BY2FkZW15Iiwid3JpdGUtQWdlQ2F0ZWdvcnkiLCJ3cml0ZS1ibG9jayIsIndyaXRlLUJsb2NrQ2F0ZWdvcnkiLCJ3cml0ZS1CbG9ja1R5cGUiLCJ3cml0ZS1DaGFtcGlvbnNoaXBDbGFzc2lmaWNhdGlvbiIsIndyaXRlLUNsdWIiLCJ3cml0ZS1DbHViVHlwZSIsIndyaXRlLUNvYWNoIiwid3JpdGUtQ291bnRyeSIsIndyaXRlLUxlYWd1ZUNsYXNzaWZpY2F0aW9uIiwid3JpdGUtTGVhZ3VlR3JvdXAiLCJ3cml0ZS1NYW5hZ2VyIiwid3JpdGUtTWVudSIsIndyaXRlLU1lbnVDYXRlZ29yeSIsIndyaXRlLU1lbnVUeXBlIiwid3JpdGUtTmF0aW9uYWxpdHkiLCJ3cml0ZS1QYWdlIiwid3JpdGUtUGxheWVyIiwid3JpdGUtUGxheWVyQ2xhc3NpZmljYXRpb24iLCJ3cml0ZS1QcmluY2Vkb20iLCJ3cml0ZS1SZWZlcmVlIiwid3JpdGUtU3RhZGl1bSIsInJlYWQtRXZlbnQiLCJyZWFkLVRlYW0iLCJ3cml0ZS1FdmVudCIsIndyaXRlLVRlYW0iLCJyZWFkLUdhbWUiLCJyZWFkLVBsYXRmb3JtIiwid3JpdGUtR2FtZSIsIndyaXRlLVBsYXRmb3JtIl0sImV4cCI6MTY2Mzg2OTcwMX0.Oj2vJI9jq2V46da0glkie_9loaUWzyD-eZZrc_lLGBA");
?>

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
@section('page-style', asset('assets/css/home.css'))

@section('container' , 'container-fluid-custom')
@section('content')

@include('home.home-slider')
@include('home.home-news')
@include('home.home-player-month')
@include('home.home-esports')
@include('home.home-clubs')
@include('home.home-championship')
@include('home.home-players')
@include('home.home-sponsors')
@endsection

@push('js')
    {{-- <script src="{{asset('assets/js/main.js')}}"></script> --}}
    <script>
        $(function () {
            $('.home-club-image').height($('.home-club-image').width());
            $('.home-player-image').height($('.home-player-image').width());
        });
        $(document).ready(function () {

            setTimeout(() => {
                if ($('.body-section').hasClass('member-success-register')) {
                    $.ajax({
                        url: '{{url(App::getLocale() . '/flush-session')}}',
                        method: 'POST',
                        data : {
                            '_token' : '{{csrf_token()}}'
                        },
                        error: function (data) {
                            console.log('error : ' , data);
                        },
                        success: function (data, status) {
                            if (status == 'success') {
                                $('.register-success').slideUp(500);
                                $('.body-section').removeClass(`${data.class}`);
                            }
                        }
                    });
                }
            }, 4000);
        });
    </script>
@endpush
