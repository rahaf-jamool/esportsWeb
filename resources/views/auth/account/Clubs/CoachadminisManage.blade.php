@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area coaches-managements pt-30 pb-30">
	<div class="your-order">
         <a href="{{url(App::getLocale() . '/profile/addCoachClub')}}" class="text-center btn btn-primary info-edit mt-2" id="info_edit">{{ trans('site.add-coach') }}</a>
		<div class="row text-center">
			<div class="col-12"></div>
			<h4 class="p-4">{{ trans('site.CoachadminisManage') }}</h4>

			<div class="tab__content">
				<div class="table-container text-center" >
				<table class="table table-striped table-hover" id="order-table">
					<thead>
						<tr> 
							<th scope="col">{{ trans('site.name') }} </th>
							<th scope="col">{{ trans('site.type') }} </th>
							<th scope="col">{{ trans('site.join-date') }} </th>
							<th scope="col">{{ trans('site.status') }} </th>
							<th scope="col">{{ trans('site.operations') }} </th>
						</tr>
					</thead>
					<tbody>
                    @if (!empty($coachesClub))
                        @foreach($coachesClub as $coache)
                            <tr >
                                <td>{{ $coache['name'] }}</td>
                                <td>{{ trans('individually.coach') }}</td>
                                <td>{{ \Carbon\Carbon::parse($coache['joinDate'])->format('Y-m-d') }}</td>
                                <td>
                                    @if($coache['client']['state'] == "Accepted")
                                        <p style="Color:green; font-weight: bold;">
                                            {{ trans('site.order-received') }}
                                        </p>
                                    @elseif($coache['client']['state'] == "Refused")
                                        <p style="Color:red; font-weight: bold;">
                                            {{ trans('site.order-Refused') }}
                                        </p>
                                    @else
                                        <p style="Color:orange; font-weight: bold;">
                                            {{ trans('site.order-waiting') }}
                                        </p>
                                    @endif
                                </td>
                               {{-- <td><a type="button" href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i></a></td>--}}
                                <td >
									<span class="m-1 btn btn-success coach-details-ajax" data-userId="{{$coache['id']}}" data-type="Coach"  data-toggle="modal" data-target="#clubCoachDetailsModel" style="cursor: pointer;">{{ trans('site.show') }}</span>
                                    <a href="{{url(App::getLocale() . '/profile/editCoachClub/'. $coache['id'])}}">
                                        <span class="m-1 btn btn-primary coach-edit" style="cursor: pointer;">{{ trans('site.edit') }}</span>
                                    </a>
                                    <span data-id="{{$coache['id']}}" class="m-1 delete-coach btn btn-danger">{{ trans('site.delete') }}</span>
								</td>
                            </tr>
                        @endforeach
                    @endif

					@if (!empty($managersClub))
                        @foreach($managersClub as $manager)
                            <tr>
                                <td>{{ $manager['name'] }}</td>
                                <td>{{ trans('site.manager') }}</td>
                                <td>{{ \Carbon\Carbon::parse($manager['joinDate'])->format('Y-m-d') }}</td>
                                <td>
                                    @if($manager['client']['state'] == "Accepted")
										<p style="Color:green; font-weight: bold;">
											{{ trans('site.order-received') }}
										</p>
									@elseif($manager['client']['state'] == "Refused")
										<p style="Color:red; font-weight: bold;">
											{{ trans('site.order-Refused') }}
										</p>
									@else
										<p style="Color:orange; font-weight: bold;">
											{{ trans('site.order-waiting') }}
										</p>
									@endif
                                </td>
                                {{--<td><a type="button" href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i></a></td>--}}
                                <td >
									<span class="m-1 btn btn-success coach-details-ajax" data-userId="{{$manager['id']}}" data-type="manager"  data-toggle="modal" data-target="#clubCoachDetailsModel" style="cursor: pointer;">{{ trans('site.show') }}</span>
                                    <a href="{{url(App::getLocale() . '/profile/editManagerClub/'. $manager['id'])}}">
                                        <span class="m-1 btn btn-primary coach-edit" style="cursor: pointer;">{{ trans('site.edit') }}</span>
                                    </a>
                                    <span data-id="{{$manager['id']}}" class="m-1 delete-manager btn btn-danger">{{ trans('site.delete') }}</span>

								</td>
                            </tr>
                        @endforeach
                    @endif

					</tbody>
				</table>
				</div>
			</div>

		</div>
	</div>
    <div class="modal fade" id="clubCoachDetailsModel" tabindex="-1" role="dialog" aria-labelledby="clubCoachDetailsModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="model-content-box">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clubCoachDetailsModelLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0" style="background: #f5f5f5"></div>
                </div>
                <div class="model-message text-center py-3">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clubCoachDetailsModelLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <p class="model-message-content text-danger mb-0 mt-3"></p>
                </div>
                <div class="model-loader text-center d-none py-5">
                    <img src="{{asset('SD08\loader.gif')}}" alt="">
                </div>
            </div>
        </div>
    </div><!--.modal-->
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $('.coach-details-ajax').click(function () {
                let userId = $(this).attr('data-userId');
                let type = $(this).attr('data-type');
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/getClubCoachDetailsAjax') }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: userId,
                        type
                    },
                    beforeSend: function () {
                        $('#clubCoachDetailsModel .model-loader').removeClass('d-none');
                        $('#clubCoachDetailsModel .model-message').addClass('d-none');
                        $('#clubCoachDetailsModel .model-content-box').addClass('d-none');
                    },
                    success: function (response) {
                        $('#clubCoachDetailsModel .model-loader').addClass('d-none');
                        $('#clubCoachDetailsModel .model-message').addClass('d-none');
                        $('#clubCoachDetailsModel .model-content-box').removeClass('d-none');
                        $('#clubCoachDetailsModel').find('.modal-body').html(response.data);
                        // $('#clubCoachDetailsModel').find('.modal-title').text(response.title);
                    }
                });
            });
            $(document).on("click", ".delete-coach" , function() {
							let serviceTr = $(this);
							let serviceID = $(this).data('id');
							let urlService = '{{ url(App::getLocale() . '/delet-coach-request') }}';
							let newUrl = urlService + '/' + serviceID;

							swal({
								title: '{{trans("site.Areyousure")}}',
								text: '{{trans("site.Oncedeleted")}}',
								icon: "warning",
								buttons: ['{{trans("site.cancel")}}', '{{trans("site.ok")}}'],
								dangerMode: true,
								})
								.then((willDelete) => {
								if (willDelete) {
									$.ajax({
										url: newUrl,
										type: 'POST',
										dataType: 'JSON',
										data:{
											'_token': '{{ csrf_token() }}',
											'_method': 'POST',
											'id': serviceID,
										},
										beforeSend: function () {
										},
										success: function () {
											serviceTr.closest("tr").remove();
											swal('{{trans("site.Deletedsuccessfully1")}}', {
											icon: "success",
											button: '{{trans("site.ok")}}',
											});
											console.log('DELETED');
										},
										error: function (xhr) {
											console.log(xhr.responseText);
										}
									})
								} else {

								}
							});
			});
            $(document).on("click", ".delete-manager" , function() {
							let serviceTr = $(this);
							let serviceID = $(this).data('id');
							let urlService = '{{ url(App::getLocale() . '/delet-manager-request') }}';
							let newUrl = urlService + '/' + serviceID;

							swal({
								title: '{{trans("site.Areyousure")}}',
								text: '{{trans("site.Oncedeleted")}}',
								icon: "warning",
								buttons: ['{{trans("site.cancel")}}', '{{trans("site.ok")}}'],
								dangerMode: true,
								})
								.then((willDelete) => {
								if (willDelete) {
									$.ajax({
										url: newUrl,
										type: 'POST',
										dataType: 'JSON',
										data:{
											'_token': '{{ csrf_token() }}',
											'_method': 'POST',
											'id': serviceID,
										},
										beforeSend: function () {
										},
										success: function () {
											serviceTr.closest("tr").remove();
											swal('{{trans("site.Deletedsuccessfully1")}}', {
											icon: "success",
											button: '{{trans("site.ok")}}',
											});
											console.log('DELETED');
										},
										error: function (xhr) {
											console.log(xhr.responseText);
										}
									})
								} else {

								}
							});
			});
        });
    </script>
@endpush
