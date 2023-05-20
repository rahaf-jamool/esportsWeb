@extends('layouts.master')

@section('title' , trans('all.site-title'). " - ". $pageInfo['title'])
@if(array_key_exists('description' , $pageInfo))
    @section('og-description' , $pageInfo['description'])
    @section('description', $pageInfo['description'])
@else
    @section('og-description' , config('app.description'))
    @section('description', config('app.description'))

@endif
@section('keywords' , config('app.keywords'))
@section('og-title' , config('app.name')  . "-" . $pageInfo['title'])

@section('og-image' , url(asset('')))
@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/account.css'))
@section('page-style', asset(''))
{{--{{dd(session('loggedUser'))}}--}}
@section('content')
<!-- Start header -->
<div class="about-header">
    {{-- <div class="title-about">
        {{$pageInfo['title']}}
    </div> --}}
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
    </div>
</div>
<!-- End header -->
	<div class="information" style="margin-top: 50px">
		<div class="container">
			<h1 class="text-center my-4">{{trans('all.change-password')}}</h1>
			<div class="col-12 col-md-10 col-lg-8 card mx-auto mb-3">
				@include('layouts.message')
				<div class="card-body">
					{!! Form::model($user, ['url' => url(App::getLocale() . '/profile/password/store'), 'method' => 'POST']) !!}
						{{ Form::hidden('ajax_url', url(App::getLocale() . '/upload')) }}
						{{ Form::hidden('user_id', $user['id']) }}
                            <input type="hidden" name="account-type" value="{{ is_null($user['client']['type']) ? '' : $user['client']['type'] }}">
							<div class="mb-3">
                                <div class="form-group required {{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                    <span class="asterisks">*</span><label for="oldPassword" class="col-11 control-label pb-2 pt-2">{{trans('auth.current-password')}}</label>
                                    <div class="col-sm-12">
                                        <input type="password" autocomplete="off" name="oldPassword" value=""
                                             id="oldPassword" class="form-control input-player" required>
                                        <div class="hide-show">
                                            <span><i class="fa fa-eye" style="color: #000;"></i></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('oldPassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oldPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
								{{-- {{ Form::label('oldPassword', trans('auth.current-password')) }} --}}
								{{-- {{ Form::password('oldPassword', null, ['class' => 'form-control', 'placeholder' => trans('auth.current-password')]) }} --}}
                                {{-- <div class="hide-show">
                                    <span><i class="fa fa-eye" style="color: #000;"></i></span>
                                </div> --}}
                            </div>
						<div class="mb-3">
                            <div class="form-group required {{ $errors->has('newPassword') ? ' has-error' : '' }}">
                                    <span class="asterisks">*</span><label for="password" class="col-8 control-label pb-2 pt-2">{{trans('auth.new-password')}}</label>
                                    <div class="col-sm-12">
                                        <input type="password" autocomplete="off" name="newPassword" value=""
                                             id="password" class="form-control input-player" required>
                                        <div class="hide-show1">
                                            <span><i class="fa fa-eye" style="color: #000;"></i></span>
                                        </div>
                                    </div>
                                    @if ($errors->has('newPassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('newPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
							{{-- {{ Form::label('newPassword', trans('auth.password')) }} --}}
							{{-- {{ Form::password('newPassword', null, ['class' => 'form-control', 'placeholder' => trans('auth.password')]) }} --}}
						</div>
						<div class="alert-msg alert alert-success text-center d-none py-2 mb-3"></div>
                        <button type="submit" class="btn btn-primary" style='background: #001c4c' >
                            {{trans('auth.update')}}
                        </button>
						{{-- {{ Form::submit(trans('auth.update'), ['class' => 'btn btn-primary', 'type' => 'submit' , 'style' => 'background: #001c4c' ]) }} --}}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endsection

@push('js')
    <script>
        $(function(){
            $('.hide-show').show();
            $('.hide-show span').addClass('show')

            $('.hide-show span').click(function(){
                if( $(this).hasClass('show') ) {
                //   $(this).text('Hide');
                $('input[name="oldPassword"]').attr('type','text');
                $(this).removeClass('show');
                } else {
                //    $(this).text('Show');
                $('input[name="oldPassword"]').attr('type','password');
                $(this).addClass('show');
                }
            });

            $('form button[type="submit"]').on('click', function(){
                $('.hide-show span').text('Show').addClass('show');
                $('.hide-show').parent().find('input[name="oldPassword"]').attr('type','password');
            });
                //
        });
        $(function(){

            $('.hide-show1').show();
            $('.hide-show1 span').addClass('show')

            $('.hide-show1 span').click(function(){
                if( $(this).hasClass('show') ) {
                //   $(this).text('Hide');
                $('input[name="newPassword"]').attr('type','text');
                $(this).removeClass('show');
                } else {
                //    $(this).text('Show');
                $('input[name="newPassword"]').attr('type','password');
                $(this).addClass('show');
                }
            });

            $('form button[type="submit"]').on('click', function(){
                $('.hide-show1 span').text('Show').addClass('show');
                $('.hide-show1').parent().find('input[name="newPassword"]').attr('type','password');
            });
                //
        });
    </script>
@endpush
