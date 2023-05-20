<div class="person-info-area">
	<div class="your-order">
        <button class="btn btn-outline-secondary" id="player_leave_team">{{ trans('individually.leave-team') }}</button>
		<div class="row text-center">
			<div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto mb-3">
				@if($clientTeamRequests['logoImagePath'] != '' )
                    <img class="responsive image" src="{{ config('app.base_address') . $clientTeamRequests['logoImagePath']}}" width="250" alt="logo"
                    onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="border-radius: 50%;height: 70%;">
                @else
                    <img class="responsive" src="{{  url(asset('SD08/default-user-image.png')) }}" width="250" alt="logo"/>
                @endif
			</div>
			    <div class="col-12"></div>
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
    						{{ trans('individually.name') }} :
						</strong>
					</div>
					<div class="col-6">
						<p class="name">
    						{{ !is_null($clientTeamRequests['name']) ? $clientTeamRequests['name'] : '-------'}}
						</p>
					</div>
				</div>
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('individually.teamHeadName') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($clientTeamRequests['teamHeadName']) ? $clientTeamRequests['teamHeadName'] : '-------'}}
                        </p>
                    </div>
                </div>

            <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                <div class="col-6 text-left">
                    <strong class="product-quantity">
                        {{ trans('all.created-date') }} :
                    </strong>
                </div>
                <div class="col-6">
                    <p>
                        {{ \Carbon\Carbon::parse($clientTeamRequests['createdAt'])->format('Y-m-d') }}
                    </p>
                </div>
            </div>
            <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                <div class="col-6 text-left">
                    <strong class="product-quantity">
                        {{ trans('auth.status') }} :
                    </strong>
                </div>
                <div class="col-6">
                    <p>
                        {{ $clientTeamRequests['accepted'] ? trans('site.order-accepted') : trans('site.order-pending') }}
                    </p>
                </div>
            </div>
            @if ( $clientTeamRequests['coachName'] != '')
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('individually.coachName') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ $clientTeamRequests['coachName'] }}
                        </p>
                    </div>
                </div>
            @endif
            @if ($clientTeamRequests['clubName'] != '')
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('individually.clubName') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ $clientTeamRequests['clubName'] }}
                        </p>
                    </div>
                </div>
            @endif
            @if ($clientTeamRequests['academyName'] != '')
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('individually.academyName') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ $clientTeamRequests['academyName'] }}
                        </p>
                    </div>
                </div>
            @endif
		</div><!--.row-->
        <div class="col-12">
            <h4 class="p-4 text-center">{{trans('individually.team-members')}}</h4>
            <div class="alert alert-danger text-center player-team-error-message mb-3 d-none"></div>
            <div class="alert alert-success text-center player-team-success-message mb-3 d-none"></div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="vertical-align: middle" scope="col">{{ trans('auth.image') }}</th>
                        <th style="vertical-align: middle" scope="col">{{ trans('all.name') }}</th>
                        <th style="vertical-align: middle" scope="col">{{ trans('auth.email') }}</th>
                        <th style="vertical-align: middle" scope="col">{{ trans('site.join-date') }}</th>
                        @if ($clientTeamRequests['teamHeadId'] == session('loggedUser')['id'])
                            <th style="text-align:center;vertical-align: middle" scope="col">{{ trans('site.details') }} </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (count($clientTeamRequests['players']) > 0)
                        @foreach($clientTeamRequests['players'] as $member)
{{--                            @if ($member['id'] != $clientTeamRequests['teamHeadId'])--}}
                                <tr>
                                    <th style="vertical-align:middle;" scope="row"><img src="{{  config('app.base_address') . $member['personInfo']['imagePath'] }}" width="50" height="50" alt=""></th>
                                    <td style="vertical-align: middle">{{ !is_null($member['name']) ? $member['name'] : '------' }}</td>
                                    <td style="vertical-align: middle">{{ !is_null($member['personInfo']['email']) ? $member['personInfo']['email'] : '------' }}</td>
                                    <td style="vertical-align: middle">{{ !is_null($member['joinDate']) ? \Carbon\Carbon::parse($member['joinDate'])->format('Y-m-d') : '------' }}</td>
                                    @if ($clientTeamRequests['teamHeadId'] == session('loggedUser')['id'] && $member['id'] != $clientTeamRequests['teamHeadId'])
                                        <td style="text-align:center;vertical-align: middle"><a class="text-danger player-remove-player" type="button" data-teamid="{{ $clientTeamRequests['id'] }}" data-id="{{ $member['id'] }}" href="javascript:void(0)">{{ trans('individually.remove') }}</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
{{--                            @endif--}}
                        @endforeach
                    @else
                        <tr>
                            <td class="text-center" colspan="5">{{ trans('site.no-events-subscribed') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
	</div><!--.your-order-->
</div>
