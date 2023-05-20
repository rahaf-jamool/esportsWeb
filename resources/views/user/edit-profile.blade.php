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
@section('og-title' , config('app.name')  . "-" . $pageInfo['title'])

@section('og-image' , url(asset('')))
@section('og-url' , url(Request::url()))
@section('page-style', asset(''))

@section('content')
	<div class="information">
		<div class="container">
			<h1 class="text-center my-4">{{trans('user.edit-profile')}}</h1>
			<div class="col-12 col-md-10 col-lg-8 card mx-auto mb-3">
				<div class="card-body">
					{!! Form::model($user, ['url' => url(App::getLocale() . '/user/edit/' . $user->id), 'method' => 'POST', 'files' => true]) !!}
						{{ Form::hidden('_method', 'PUT') }}
						{{ Form::hidden('ajax_url', url(App::getLocale() . '/upload')) }}
						{{ Form::hidden('user_id', $user->id) }}
						<div class="mb-3">
							{{ Form::label('userName', trans('user.username')) }}
							{{ Form::text('userName', null, ['class' => 'form-control', 'placeholder' => trans('user.username')]) }}
						</div>
						<div class="mb-3">
							{{ Form::label('email', trans('user.email')) }}
							{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('user.email')]) }}
						</div>
						<div class="mb-3">
							{{ Form::label('phone', trans('user.phone')) }}
							{{ Form::number('phone', null, ['class' => 'form-control', 'placeholder' => trans('user.phone')]) }}
						</div>
						<div class="col-sm-12 input-group mb-3">
							<div class="input-group">
								<input type="file" class="form-control" name="upload_image" id="file" aria-describedby="uploadFile" aria-label="Upload">
								<button class="btn btn-outline-secondary upload_image" type="button" id="uploadFile">{{trans('user.upload')}}</button>
							</div>
							{{ Form::hidden('image_url', '') }}
						</div>
						<div class="alert-msg alert alert-success text-center d-none py-2"></div>
						{{ Form::submit(trans('user.update'), ['class' => 'btn btn-primary']) }}
					{!! Form::close() !!}
				</div><!--.card-body-->
			</div>
		</div>
	</div>
@endsection

@push('js')
	<script>
		$(document).ready(function () {
			$('.upload_image').click(function () {
				let ajaxUrl = $('input[name="ajax_url"]').val();
				let userId = $('input[name="user_id"]').val();
				let files = $('#file')[0].files;
				let token = $('input[name="_token"]').val();
				var reader = new FileReader();
				reader.onload = function () {
					let base64String = reader.result.replace("data:", "").replace(/^.+,/, "");
					if (ajaxUrl == '' || userId == '' || files == '' || token == '') return;
					console.log(files.length);
					if(files.length > 0) {
						var formData = new FormData();
						// Append data
						formData.append('file', files[0]);
						formData.append('_token', token);
						formData.append('userId', userId );
						formData.append('imgBase64String', base64String );
						$.ajax({
							url: ajaxUrl,
							method: 'POST',
							contentType: false,
							processData: false,
							dataType: 'json',
							data: formData,
							beforeSend: function () {
								let uploadButtonTxt = "{{ trans('user.uploading') }}";
								// disabled qty Button
								$('#uploadFile').addClass('disabled');
								$('#uploadFile').text(`${uploadButtonTxt}`);
							},
							error: function(data, status, error) {
								let uploadButtonTxt = "{{ trans('user.upload') }}";
								$('#uploadFile').removeClass('disabled');
								$('#uploadFile').text(`${uploadButtonTxt}`);
								console.log(data, status, error);
							},
							success: function(data, status) {
								let uploadButtonTxt = "{{ trans('user.upload') }}";
								console.log(data, status);
								if (status == 'success') {
									$('#uploadFile').removeClass('disabled');
									$('#uploadFile').text(`${uploadButtonTxt}`);
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
