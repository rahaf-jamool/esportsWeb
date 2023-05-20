@extends('layouts.master')
<!-- Main Content -->
@section('content')
<style>
    .panel {
    margin-bottom: 22px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius: 4px;
    box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
}
.panel-default {
    border-color: #d3e0e9;
}
.panel-heading {
    padding: 10px 15px;
    border-bottom: 1px solid transparent;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}
.panel-body {
    padding: 15px;
}
.panel-default>.panel-heading {
    color: #333;
    background-color: #fff;
    border-color: #d3e0e9;
}

</style>
<!-- Start header -->
<div class="about-header m-0">
    <div class="title-about">

    </div>
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/7.jpg')) }} " alt="header">
    </div>
</div>
<!-- End header -->
<div class="container">
    <div class="row" style="justify-content: center;align-items: center; min-height: 322px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('auth.reset-password') }}</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/password/email') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-12 control-label">{!! trans('auth.email') !!}</label>

                            <div class="col-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-12 error-messages">
                                @include('layouts.message')
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    {!! trans('auth.send-reset-link') !!}
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- <div class="form-group px-3 px-md-5">
                        @include('layouts.message')
                    </div>--}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            setTimeout(() => $('.error-messages').html(''), 8000);
        });
    </script>
@endpush
