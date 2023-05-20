@php
	$pullLeft = App::getLocale() == 'ar' ? 'pull-left' : 'pull-right';
	$marginRight = App::getLocale() == 'ar' ? 'mr-auto' : 'ml-auto';
	$pl_1 = App::getLocale() == 'ar' ? 'ml-1' : 'mr-1';
	$ml_mr_auto = App::getLocale() == 'ar' ? 'mr-auto ml-0' : 'mr-0 ml-auto';
@endphp

<!-- comments container -->
<div class="comment_block mb-5">
	<button class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#newComplaintModal">{{trans('product.add-complaint')}}</button>
	<div class="alert alert-success text-center d-none response-success-msg"></div>
	<!-- new comment -->
	<div class="new_comment">
		<!-- build comment -->
		<ul class="user_comment">
			@if (count($complaints) > 0)
				@foreach($complaints as $complaint)
					@if ($complaint['type'] == 'Complaint')
						<li class="mb-2">
							<a href="javascript:void(0)" class="complaint-details"
							   data-id="{{$complaint['id']}}" data-url="{{url(App::getLocale() . '/complaint/' . $complaint['id'])}}"
                               data-bs-toggle="modal" data-bs-target="#complaintDetailsModal">
								<div class="comment_body px-3">
										<h5 class="mb-0 d-inline-block">
											@if($complaint['isReplied'])
												<i class="fa fa-check-circle-o text-success fa-fw" aria-hidden="true"></i>
											@endif
											{{$complaint['subject']}}
										</h5>
									<span class="text-secondary {{$pullLeft}}"><i class="fa fa-calendar fa-fw"></i> {{\Carbon\Carbon::parse($complaint['date'])->format('Y-m-d')}}</span>
								</div>
							</a>
						</li>
					@endif
				@endforeach
			@else
				<li>
					<div class="comment_body">
						<p class="mb-0" style="line-height: 4">{{trans('product.empty-complaints')}}</p>
					</div>
				</li>
			@endif
		</ul>
	</div>
</div>

<!-- Add New Complaint Modal -->
<div class="modal fade" id="newComplaintModal" tabindex="-1" aria-labelledby="newComplaintModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="newComplaintModalLabel">{{trans('auth.add-complaint')}}</h5>
			</div>
			<div class="modal-body">
				<form id="Complaint_form">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="type" value="Complaint">
					<div class="form-group">
						<input type="text" class="form-control" name="subject" placeholder="{{trans('auth.subject')}}">
					</div>
					<div class="form-group">
						<textarea class="form-control" name="content" placeholder="{{trans('auth.content')}}"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary {{$pl_1}}" data-bs-dismiss="modal">{{trans('all.button_close')}}</button>
				<button type="button" class="btn" id="submit_complaint" style="background-color:#08ac9c;border-color:#08ac9c;color:#FFF">{{trans('all.send')}}</button>
			</div>
		</div>
	</div>
</div><!--.modal-->

<!-- Add New Complaint Modal -->
<div class="modal fade" id="complaintDetailsModal" tabindex="-1" aria-labelledby="complaintDetailsModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="model-content-box">
				<div class="modal-header">
					<h5 class="modal-title" id="complaintDetailsModalLabel"></h5>
					<button type="button" class="btn-close close {{$ml_mr_auto}}" data-bs-dismiss="modal" aria-label="Close">
{{--                        <span aria-hidden="true">&times;</span>--}}
					</button>
				</div>
				<div class="modal-body" style="background: #f5f5f5"></div>
			</div>
			<div class="model-message text-center py-3">
				<div class="modal-header">
					<h5 class="modal-title" id="complaintDetailsModalLabel"></h5>
					<button type="button" class="close {{$ml_mr_auto}}" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<p class="model-message-content text-danger mb-0 mt-3"></p>
			</div>
			<div class="model-loader text-center d-none py-5">
				<img src="{{asset('SD08/loader.gif')}}" alt="">
			</div>
		</div>
	</div>
</div><!--.modal-->
@push('js')
    <script>
        $('#submit_complaint').click(function () {
            let form = $('#Complaint_form'),
                formData = new FormData(),
                _token = form.find('input[name="_token"]').val(),
                type = form.find('input[name="type"]').val(),
                subject = form.find('input[name="subject"]').val(),
                content = form.find('input[name="content"]').val();
            if (subject == '' || content == '' || _token == '' || type == '') {
                return;
            }
            formData.append('_token', _token);
            formData.append('type', type);
            formData.append('subject', subject);
            formData.append('content', content);
            console.log('start complaint');
            $.ajax({
                url: '{{url(App::getLocale() . "/complaint")}}',
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function () {
                    $('#submit_complaint').css({'pointer-events' : 'none', 'filter': 'opacity(0.5)'});
                },
                error: function (data, status) {
                    $('#submit_complaint').css({'pointer-events' : 'auto', 'filter': 'none'});
                    console.log(data, status);
                    alert(data.responseJSON.error);
                },
                success: function (response, status) {
                    if (status == 'success') {
                        $('#submit_complaint').css({'pointer-events' : 'auto', 'filter': 'none'});

                        // Reset the form
                        form.find('input[name="subject"]').val('');
                        form.find('input[name="content"]').val('');

                        // insert html
                        $('.user_comment').append(JSON.parse(response.data));

                        // hide model
                        $('.modal').removeClass('show').css('display', 'none');
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open').css({'padding-right': 'unset'});
                        // add success message
                        $('.response-success-msg').removeClass('d-none').text(response.success);
                        setTimeout(() => {
                            $('.response-success-msg').addClass('d-none').fadeOut(1000);
                        }, 3000);
                    }
                }
            });
        });

        // Get Complaint Details
        $('.comment_block').on('click', '.complaint-details', function () {
            let formData = new FormData(),
                ajaxUrl = $(this).data('url'),
                id = $(this).data('id');
            formData.append('_token', '{{csrf_token()}}');
            formData.append('id', id);
            $.ajax({
                url: ajaxUrl,
                method: 'POST',
                processData: false,
                contentType: false,
                data: formData,
                beforeSend: function () {
                    $('#complaintDetailsModal .model-loader').removeClass('d-none');
                    $('#complaintDetailsModal .model-message').addClass('d-none');
                    $('#complaintDetailsModal .model-content-box').addClass('d-none');
                },
                error: function (data, status) {
                    console.log(data.responseJSON.error);
                    $('#complaintDetailsModal .model-message').removeClass('d-none');
                    $('#complaintDetailsModal .model-loader').addClass('d-none');
                    $('#complaintDetailsModal').find('.model-message-content').text(data.responseJSON.error);
                },
                success: function (response, status) {
                    if (status == 'success') {
                        $('#complaintDetailsModal .model-loader').addClass('d-none');
                        $('#complaintDetailsModal .model-content-box').removeClass('d-none');
                        $('#complaintDetailsModal').find('.modal-body').html(JSON.parse(response.data));
                        $('#complaintDetailsModal').find('.modal-title').text(response.title);

                    }
                }
            });
        });

    </script>
@endpush
