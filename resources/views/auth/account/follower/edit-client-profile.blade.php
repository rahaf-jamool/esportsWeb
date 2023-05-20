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
@section('page-style', asset(''))
{{--{{dd(session('loggedUser'))}}--}}
@section('content')
	<div class="information" style="margin-top: 50px">
		<div class="container">
			<h1 class="text-center my-4">{{trans('auth.edit-profile')}}</h1>
			@include('layouts.message')
            @include('sweetalert::alert')
			<form class="form-horizontal" role="form" method="POST" action="{{ url(App::getLocale() . '/profile/edit/' . $user['id']) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="hidden" name="account-type"  value="{{ is_null($user['client']['type']) ? '' : $user['client']['type'] }}">
                    <input type="hidden" name="clientId" value="{{ is_null($user['clientId']) ? '' : $user['clientId'] }}">
                    <h4>{!! trans('individually.follower-data') !!}</h4>
                    <hr>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="firstName" class="col-11 control-label  pb-2 pt-2">{{trans('individually.name')}}</label>
                        <div class="col-12">
                            <input id="name" type="text" class="form-control" name="name" value="{{ is_null($user['name']) ? '' : $user['name'] }}"required autofocus>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="email" class="col-11 control-label pb-2 pt-2">{{trans('auth.email')}}</label>
                        <div class="col-12">
                            <input id="email" type="email" class="form-control" name="email" value="{{ is_null($user['email']) ? '' : $user['email'] }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="form-group{{ $errors->has('userName') ? ' has-error' : '' }}">
                        <span class="asterisks">*</span><label for="userName" class="col-11 control-label pb-2 pt-2">{{trans('auth.username')}}</label>
                        <div class="col-12">
                            <input id="userName" type="text" class="form-control" name="userName" value="{{ is_null($user['client']['userName']) ? '' : $user['client']['userName'] }}" required>
                            @if ($errors->has('userName'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('userName') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4 pt-5">
                            <button type="submit" class="btn btn-success ">
                                {{trans('all.edit')}}
                            </button>
                        </div>
                    </div>
            </form>
		</div>
	</div>
@endsection

@push('js')
    <script>
		$(document).ready(function () {
			// $(document).on('change', '.file-upload-button', function(event) {
			//
			// });
			$('.upload_image').click(function () {
				let form = $('.information .card-body form');
				let ajaxUrl = form.find('input[name="ajax_url"]').val();
				let userId = form.find('input[name="user_id"]').val();
				let files = $('#file')[0].files;
				let token = form.find('input[name="_token"]').val();
				var reader = new FileReader();
				// console.log(ajaxUrl, userId, files, token);
				// return;
				reader.onload = function () {
					let base64String = reader.result.replace("data:", "").replace(/^.+,/, "");
					if (ajaxUrl == '' || userId == '' || files == '' || token == '') return;
					// console.log(files.length);
					if(files.length > 0) {
						var formData = new FormData();
						// Append data
						formData.append('_token', token);
						formData.append('file', files[0]);
						formData.append('userId', userId );
						formData.append('imgBase64String', base64String );
						$.ajax({
							url: ajaxUrl,
							type: 'POST',
							contentType: false,
							processData: false,
							// dataType: 'json',
							data: formData,
							beforeSend: function () {
								let uploadButtonTxt = "{{ trans('auth.uploading') }}";
								// disabled qty Button
								$('#uploadFile').addClass('disabled');
								$('#uploadFile').text(`${uploadButtonTxt}`);
							},
							error: function(data, status, error) {
								let uploadButtonTxt = "{{ trans('auth.upload') }}";
								$('#uploadFile').removeClass('disabled');
								$('#uploadFile').text(`${uploadButtonTxt}`);
								console.log(data);
								// alert(data.responseJSON.error);
							},
							success: function(data, status) {
								let uploadButtonTxt = "{{ trans('auth.upload') }}";
								// console.log(data, status);
								if (status == 'success') {
									$('#uploadFile').removeClass('disabled');
									$('#uploadFile').text(`${uploadButtonTxt}`);
									$('.image-viewer-box').removeClass('d-none').find('img').attr('src', '{{config('app.base_address')}}' + data.url);
									$('input[name="image_url"]').val(data.url);
									$('.alert-msg').removeClass('d-none').text(data.success);
									setTimeout(() => {
										$('.alert-msg').addClass('d-none').fadeOut(1000);
									}, 3000);
								}
							},
						});	 // end ajax
					}
				}
				reader.readAsDataURL(files[0]);
			}); // click button
		});
	</script>
@endpush

