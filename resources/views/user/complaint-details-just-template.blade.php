@php
	$textRight = App::getLocale() == 'ar' ? 'text-right' : 'text-left';
	$marginRight = App::getLocale() == 'ar' ? 'mr-auto' : 'ml-auto';
	$pl_1 = App::getLocale() == 'ar' ? 'ml-1' : 'mr-1';
@endphp

<!-- comments container -->
<div class="comment_block mb-5">
	<button class="btn btn-dark mb-2" data-toggle="modal" data-target="#newComplaintModal">{{trans('auth.add-complaint')}}</button>
	<div class="alert alert-success text-center d-none response-success-msg"></div>
	<!-- new comment -->
	<div class="new_comment">
		<!-- build comment -->
		<ul class="user_comment text-center">
			@if (count($complaints) > 0)
				@foreach($complaints as $complaint)
					@if ($complaint['type'] == 'Complaint')
						<li>
							<!-- current #{user} avatar -->
							<div class="user_avatar d-none">
								<img src="https://s3.amazonaws.com/uifaces/faces/twitter/dancounsell/73.jpg">
							</div><!-- the comment body -->
							<div class="comment_body px-3">
								<div class="comment_toolbar">
									<h6 class="text-right mb-0" style="color: #6c757d82">
										{{$complaint['subject']}}
									</h6>
								</div>
								<p class="mb-0" style="line-height: 4">{{$complaint['content']}}</p>
							</div>

							<!-- comments toolbar -->
							<div class="comment_toolbar mt-1">
								<p class="text-secondary text-right"><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($complaint['date'])->format('Y-m-d h:i:s A')}}</p>
								<!-- inc. date and time -->
				{{--				<div class="comment_details d-none">--}}
				{{--					<ul>--}}
				{{--						<li class="text-secondary"><i class="fa fa-calendar"></i> 04/01/2015</li>--}}
				{{--					</ul>--}}
				{{--				</div>--}}
								<!-- inc. share/reply and love -->
				{{--				<div class="comment_tools d-none">--}}
				{{--					<ul>--}}
				{{--						<li><i class="fa fa-share-alt"></i></li>--}}
				{{--						<li><i class="fa fa-reply"></i></li>--}}
				{{--						<li><i class="fa fa-heart love"></i></li>--}}
				{{--					</ul>--}}
				{{--				</div>--}}

							</div>
							@if (count($complaint['complaintReplies']) > 0)
								@foreach($complaint['complaintReplies'] as $reply)
									<div class="col-10 col-sm-11 comment-reply {{$marginRight}}">
										<div class="comment_body">
											<div class="comment_toolbar">
												<p class="text-right mb-0" style="color: #6c757d82">
													<i class="fa fa-reply" aria-hidden="true"></i>
													{{trans('auth.management-reply')}}
												</p>
											</div>
											<p>{{$reply['content']}}</p>
										</div>
										<div class="comment_toolbar mt-1">
											<p class="text-secondary text-right"><i class="fa fa-calendar"></i> {{\Carbon\Carbon::parse($reply['date'])->format('Y-m-d h:i:s A')}}</p>
										</div>
									</div>
								@endforeach
							@endif

							<!-- start user replies -->
						</li>
					@endif
				@endforeach
			@else
				<li>
					<div class="comment_body">
						<p class="mb-0" style="line-height: 4">{{trans('auth.empty-complaints')}}</p>
					</div>
				</li>
			@endif
		</ul>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="newComplaintModal" tabindex="-1" role="dialog" aria-labelledby="newComplaintModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
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
						<input type="text" class="form-control" name="content" placeholder="{{trans('auth.content')}}">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary {{$pl_1}}" data-dismiss="modal">{{trans('all.button_close')}}</button>
				<button type="button" class="btn btn-danger" id="submit_complaint">{{trans('all.submit')}}</button>
			</div>
		</div>
	</div>
</div><!--.modal-->

