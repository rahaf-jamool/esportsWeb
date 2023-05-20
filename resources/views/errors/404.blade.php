<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>404 - {{ trans('all.page-not-found') }}</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="{{ asset("css/errors-style.css") }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="error-page">
    <div class="error-box">
        <div class="error-body text-center">
            <h1>404</h1>
            <h3 class="text-uppercase">{{ trans('all.page-not-found') }}</h3>
            <p class="text-muted m-t-30 m-b-30">{{ trans('all.please-try-again-later') }}</p>
            <a href="{{ url(App::getLocale() . '/') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">{{ trans('all.back-to-home') }}</a> </div>
        <footer class="footer text-center">{{ \Carbon\Carbon::today()->year }}</footer>
    </div>
</section>
<!-- jQuery -->
{{-- <script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset("plugins/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset("js/custom.min.js") }}"></script> --}}

</body>
</html>
