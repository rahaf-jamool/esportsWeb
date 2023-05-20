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
			<div class="col-12 col-md-10 col-lg-8 card mx-auto mb-3">
				@include('layouts.message')
				<div class="card-body">
					{!! Form::model($user, ['url' => url(App::getLocale() . '/profile/edit/' . $user->id), 'method' => 'POST', 'files' => true]) !!}
						{{ Form::hidden('ajax_url', url(App::getLocale() . '/upload')) }}
						{{ Form::hidden('user_id', $user->id) }}
						<div class="mb-3">
							{{ Form::label('name', trans('auth.name')) }}
							{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('auth.name')]) }}
						</div>
						<div class="mb-3 d-none">
							{{ Form::label('userName', trans('auth.username')) }}
							{{ Form::text('userName', null, ['class' => 'form-control', 'placeholder' => trans('auth.username')]) }}
						</div>
						<div class="mb-3">
							{{ Form::label('email', trans('auth.email')) }}
							{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('auth.email')]) }}
						</div>
						<div class="mb-3">
							{{ Form::label('phone', trans('auth.phone')) }}
							{{ Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('auth.phone')]) }}
						</div>
						<div class="mb-3">
							{{ Form::label('mobile', trans('auth.mobile')) }}
							{{ Form::text('mobile', null, ['class' => 'form-control', 'placeholder' => trans('auth.mobile')]) }}
						</div>
{{--						<div class="col-sm-12 input-group mb-3">--}}
{{--							<div class="input-group">--}}
{{--								<input type="file" class="form-control" name="upload_image" id="file" aria-describedby="uploadFile" aria-label="Upload">--}}
{{--								<button class="btn btn-outline-secondary upload_image" type="button" id="uploadFile">{{trans('auth.upload')}}</button>--}}
{{--							</div>--}}
{{--							{{ Form::hidden('image_url', '') }}--}}
{{--						</div>--}}

						<div class="input-group mb-3" style="direction: ltr">
							<div class="input-group-prepend">
								<button class="btn btn-outline-secondary upload_image" type="button" id="uploadFile">{{trans('auth.upload')}}</button>
							</div>
							<div class="custom-file">
								<input type="file" class="custom-file-input form-control" name="upload_image" id="file" aria-describedby="uploadFile" aria-label="Upload">
								<label class="custom-file-label" for="inputGroupFile03" style="text-align: end;">{{trans('auth.choose-file')}}</label>
							</div>
							{{ Form::hidden('image_url', '') }}
						</div>
					@php
                    //dd(session()->all());
						if (session()->has('profileImageUrl')) {
                            $imagUrl = session()->has('profileImageUrl') ? config('app.base_address') . session('profileImageUrl') : '';
                            $hideImage = session()->has('profileImageUrl') ? '' : 'd-none';
                        } else {
                            $imagUrl = session('loggedUser')->image;
                            $hideImage = '';
                        }
					@endphp
					<div class="col-12 col-sm-6 col-md-4 col-3 mx-auto image-viewer-box my-2 {{$hideImage}}">
						<img class="responsive" src="{{$imagUrl}}" width="100" alt="">
					</div>

						<div class="alert-msg alert alert-success text-center d-none py-2 mb-3"></div>
						<div style="display: flex;justify-content: space-between;">
							{{ Form::submit(trans('auth.save'), ['class' => 'btn btn-primary', 'style' => 'background: #001c4c; width:49%']) }}
							<a href="{{ url(App::getLocale() . '/myaccount') }}" class="btn" style="height: 45px;font-size: 14px;width: 49%; display: flex; border-color: #001c4c;color: #001c4c;align-items: center;justify-content: center;">Cancel</a>
						</div>


					{!! Form::close() !!}
				</div><!--.card-body-->
			</div>
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

