<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ trans('all.dir')}}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="@yield('title')">
    <meta property="og:title" content="@yield('og-title')">
    <meta property="og:description" content="@yield('og-description')">
    <meta property="og:image" content="@yield('og-image')">
    <meta property="og:url" content="@yield('og-url')">
    <meta name="twitter:card" content="summary_large_image">
    <title> @yield('title')</title>

    <!-- Favicons -->
    <link rel="icon" href="{{asset('assets/img/logo1.png')}}" >
    <link rel="apple-touch-icon" href="{{asset('assets/img/apple-touch-icon.png')}}" >

  <!-- Google Fonts -->
{{--  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">--}}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/vendor/aos/aos.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}"> --}}
  {{-- <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/> --}}
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">


  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="@yield('page-style')">
	@if(trans('all.dir') == 'rtl')
<!-- CSS -->
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css" integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('assets/css/style.ar.css')}}">
  @else
  <link rel="stylesheet" href="{{asset('assets/css/style.en.css')}}">
  @endif
  <link rel="stylesheet" href="{{asset('assets/css/style-2.css')}}">

    {{-- <link rel="stylesheet" type="text/css" href="slick/slick.css"/> --}}
    {{-- <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/> --}}
  <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" crossorigin="anonymous"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" crossorigin="anonymous"/>



  </head>
<body>
    @php
        $class = '';
        if (session()->has('memberSuccessRegister')) {
            $class = 'member-success-register';
        }
    @endphp
    <div id="preloader">
      <div id="preloaders" class="preloader">
        <img id="logoLoader" class="logoLoader" src="{{asset('assets/img/wlogo.png')}}" alt="">
        {{-- <img class="Loader" src="{{asset('assets/img/spinnerLoading1.svg')}}" alt=""> --}}
        <img class="Loader" src="{{asset('assets/img/logoLoading7.svg')}}" alt="">
        {{-- <img class="Loader" src="{{asset('assets/img/spinnerLoading4.svg')}}" alt=""> --}}
      </div>

    </div>
    <div class="overlay"></div>
    {{-- Check For Session Messages --}}
    @if (session()->has('memberSuccessRegister'))
        <div class="alert alert-success register-success text-center my-0" style="z-index: 9999;" id="success-alert">{{ session('memberSuccessRegister') }}</div>
    @endif
    <?php
      session()->forget('memberSuccessRegister');
    ?>
    @include('layouts.nav')
    <div class="body-section {{$class}}">
        @yield('content')
    </div>
    @include('layouts.footer')


