{{-- @include('layouts.message')--}}
{{--{{dd($user)}}--}}


<div class="card checkout-area players-managements pt-30 pb-30">
	<div class="your-order">
        <a href="{{url(App::getLocale() . '/profile/addPlayerClub')}}" class="text-center btn btn-success info-edit mt-2" id="info_edit">{{trans('site.add-player')}}</a>
		<div class="row text-center">
			<div class="col-12"></div>
			<h4 class="p-4">{{ trans('site.playersManagement') }}</h4>
			<div class="tab__content">
				<div class="table-container table-responsive text-center" >
					<table class="table table-striped table-hover" id="players_managements_tabs">
						<thead>
							<tr>
								<th scope="col">{{ trans('site.playername') }} </th>
								<th scope="col">{{ trans('site.Platformtype') }} </th>
								<th scope="col">{{ trans('site.gametype') }} </th>
								<th scope="col">{{ trans('site.status') }} </th>
								<th scope="col">{{ trans('site.operations') }} </th>
							</tr>
						</thead>
						<tbody>
						@if (count($playerClub) > 0)
							@foreach($playerClub as $player)
							<tr >
								<td>{{ $player['name'] }}</td>
								<td>
                                    <ul class="list-unstyled">
                                        @if (count($player['playerPlatforms']) > 0 && count($platforms) > 0)
                                            @foreach($player['playerPlatforms'] as $playerPlatform)
                                                @foreach($platforms as $platform)
                                                    @if ($platform['id'] == $playerPlatform['platformId'])
                                                        <li>{{ $platform['name'] }}</li>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @else
                                            -----
                                        @endif
                                    </ul>
                                </td>
								<td>
                                    @if (count($player['playerGames']) > 0 && count($games) > 0)
                                        @foreach($player['playerGames'] as $playerGame)
                                            @foreach($games as $game)
                                                @if ($game['id'] == $playerGame['gameId'])
                                                    <li>{{ $game['name'] }}</li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        -----
                                    @endif
                                </td>
								<td>
									@if($player['client']['state'] == "Accepted")
										<p style="Color:green; font-weight: bold;">
											{{ trans('site.order-received') }}
										</p>
									@elseif($player['client']['state'] == "Refused")
										<p style="Color:red; font-weight: bold;">
											{{ trans('site.order-Refused') }}
										</p>
									@else
										<p style="Color:orange; font-weight: bold;">
											{{ trans('site.order-waiting') }}
										</p>
									@endif
								</td>
                                <td>
									<span class="m-1 btn btn-dark player-details-ajax" data-userId="{{$player['id']}}" data-toggle="modal" data-target="#clubPlayerDetailsModel" style="cursor: pointer;">{{ trans('site.show') }}</span>
									{{--<span class="m-1 btn btn-primary player-edit" data-userId="{{$player['id']}}"  style="cursor: pointer;"><a href="{{url(App::getLocale() . '/profile/editPlayerByClient/'. $player['id'])}}">{{ trans('site.edit') }}</a></span>--}}
									<a href="{{url(App::getLocale() . '/profile/editPlayerClub/'. $player['id'])}}">
                                        <span class="m-1 btn btn-success player-edit" style="cursor: pointer;">{{ trans('site.edit') }}</span>
                                    </a>
                                    <span data-id="{{$player['id']}}" class="m-1 delete-player btn btn-danger">{{ trans('site.delete') }}</span>
								</td>
							</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div><!--.table-container-->
			</div><!--.tab__content-->
		</div><!--.row-->
	</div><!--.your-order-->
    <div class="modal fade" id="clubPlayerDetailsModel" tabindex="-1" role="dialog" aria-labelledby="clubPlayerDetailsModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="model-content-box">
                    <div class="modal-header">

                        <h5 class="modal-title" id="clubPlayerDetailsModelLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0" style="background: #f5f5f5"></div>
                </div>
                <div class="model-message text-center py-3">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clubPlayerDetailsModelLabel"></h5>
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
            $('.player-details-ajax').click(function () {
                let userId = $(this).attr('data-userId');
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/getClubPlayerDetailsAjax') }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: userId
                    },
                    beforeSend: function () {
                        $('#clubPlayerDetailsModel .model-loader').removeClass('d-none');
                        $('#clubPlayerDetailsModel .model-message').addClass('d-none');
                        $('#clubPlayerDetailsModel .model-content-box').addClass('d-none');
                    },
                    success: function (response) {
                        $('#clubPlayerDetailsModel .model-loader').addClass('d-none');
                        $('#clubPlayerDetailsModel .model-message').addClass('d-none');
                        $('#clubPlayerDetailsModel .model-content-box').removeClass('d-none');
                        $('#clubPlayerDetailsModel').find('.modal-body').html(response.data);
                        // $('#clubPlayerDetailsModel').find('.modal-title').text(response.title);
                    }
                });
            });

            $('#playersManagement').on('click', '#player_subscribed_events_details', function (e) {
                let eventId = e.target.closest('tr').dataset.id;
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/getClubPlayerEventsDetailsAjax') }}',
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: eventId
                    },
                    beforeSend: function () {
                        $('#clubPlayerDetailsModel .model-loader').removeClass('d-none');
                        $('#clubPlayerDetailsModel .model-message').addClass('d-none');
                        $('#clubPlayerDetailsModel .model-content-box').addClass('d-none');
                        $('#clubPlayerDetailsModel').find('.modal-body').html('');
                    },
                    success: function (response) {
                        $('#clubPlayerDetailsModel .model-loader').addClass('d-none');
                        $('#clubPlayerDetailsModel .model-message').addClass('d-none');
                        $('#clubPlayerDetailsModel .model-content-box').removeClass('d-none');
                        $('#clubPlayerDetailsModel').find('.modal-body').html(response.data);
                    }
                });

            });
            $(document).on("click", ".delete-player" , function() {
							let serviceTr = $(this);
							let serviceID = $(this).data('id');
							let urlService = '{{ url(App::getLocale() . '/delet-player-request') }}';
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
