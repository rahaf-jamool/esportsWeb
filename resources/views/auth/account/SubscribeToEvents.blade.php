@include('layouts.message')
{{--{{dd($user)}}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row text-center">
			<div class="col-12"></div>
			<h4 class="p-4">{{ trans('site.SubscribeToEvents') }}</h4>
				
			<table class="table table-striped table-hover" id="order-table">
						<thead>
							<tr>
								<th scope="col">{{ trans('site.eventname') }} </th>
								<th scope="col">{{ trans('site.eventtype') }} </th>
								<th scope="col">{{ trans('site.eventdate') }} </th>
								<th scope="col">{{ trans('site.status') }} </th>
								{{--<th scope="col">{{ trans('site.details') }} </th>--}}
							</tr>
						</thead>
						<tbody>
							
						@if (!empty($ClientEventsRequests))
							@foreach($ClientEventsRequests as $ClientEventsRequest)
								<tr>
									<td >{{ (App::getLocale() == 'en')?$ClientEventsRequest['eventEnName']: $ClientEventsRequest['eventName']}}</td> 
									<td>{{ (App::getLocale() == 'en')?$ClientEventsRequest['eventClassificationEnName']: $ClientEventsRequest['eventClassificationName']}}</td>
									
									<td>{{ \Carbon\Carbon::parse($ClientEventsRequest['date'] )->format('d/m/Y')}}</td>
									<td>
									@if($ClientEventsRequest['state'] =='Pending')
										<p style="Color:orange; font-weight: bold;">
											{{ trans('site.order-waiting') }} 
										</p>
									@elseif($ClientEventsRequest['state'] == "Refused")
										<p style="Color:red; font-weight: bold;">
											{{ trans('site.order-Refused') }}
										</p>
									@else($ClientEventsRequest['state'] == 'Accepted')
										<p style="Color:green; font-weight: bold;">
											{{ trans('site.order-received') }}
										</p>
									@endif
									</td>
									{{--	<td >
										<a href="" target="_blank">
											<i class="fa fa-eye" aria-hidden="true"></i>
										</a>
									</td>--}}
								</tr>
						
							
							@endforeach
						@endif

						</tbody>
					</table>


				
		</div>
	</div>
</div>
