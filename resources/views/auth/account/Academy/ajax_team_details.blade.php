
<div class="card checkout-area pt-30 pb-30">
    <div class="your-order">
        <div class="row text-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto mb-3">
                @if($team['logoImagePath'] != '' )
                    <img class="responsive" src="{{ config('app.base_address') . $team['logoImagePath']}}" width="250" alt="logo"
                         onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="border-radius: 50%;">
                @else
                    <img class="responsive" src="{{  url(asset('SD08/default-user-image.png')) }}" width="250" alt="logo"/>
                @endif
            </div>
            <h4 class="p-4">{!! trans('all.team-info') !!}</h4>
            @if (!empty($team['name']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('auth.name') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($team['name'])?$team['name']:''}}
                        </p>
                    </div>
                </div>
            @endif
            <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                <div class="col-6 text-left">
                    <strong class="product-quantity">
                        {{ trans('auth.status') }} :
                    </strong>
                </div>
                <div class="col-6">
                    <p>
                        {{ $team['accepted'] ? trans('site.order-accepted') : trans('site.order-pending') }}
                    </p>
                </div>
            </div>
            @if (!empty($team['academyName']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('all.AcademyName') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($team['academyName'])?$team['academyName']:''}}
                        </p>
                    </div>
                </div>
            @endif

            @if (!empty($team['createdAt']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('all.created-date') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($team['createdAt']) ? \Carbon\Carbon::parse($team['createdAt'])->format('Y-m-d') :''}}
                        </p>
                    </div>
                </div>
            @endif

            <div class="col-12">
                <h4 class="pt-4 pb-2 text-center">{{trans('individually.team-members')}}</h4>
                <div class="alert alert-danger text-center academy-team-error-message mb-3 d-none"></div>
                <div class="alert alert-success text-center academy-team-success-message mb-3 d-none"></div>
                @if (!$team['accepted'])
                    <div class="text-left">
                        <button type="button" id="academyAddNewPlayerButton" class="btn btn-outline-dark btn-sm mb-3" data-toggle="modal" data-target="#custom-message">{{ trans('site.add-player-not-in-academy') }}</button>
                        <button type="button" id="academyAddPlayerFromAcademyButtonPending" class="btn btn-outline-dark btn-sm mb-3" data-toggle="modal" data-target="#custom-message">{{ trans('site.add-player-in-academy') }}</button>
                    </div>
                @else
                    <div class="text-left">
                        <button type="button" id="academyAddNewPlayerButton" class="btn btn-outline-dark btn-sm mb-3" data-toggle="modal" data-target="#academyAddNewPlayerModel" data-teamid="{{ $team['id'] }}">{{ trans('site.add-player-not-in-academy') }}</button>
                        <button type="button" id="academyAddPlayerFromAcademyButton" class="btn btn-outline-dark btn-sm mb-3" data-teamid="{{ $team['id'] }}">{{ trans('site.add-player-in-academy') }}</button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th style="vertical-align: middle" scope="col">{{ trans('auth.image') }}</th>
                            <th style="vertical-align: middle" scope="col">{{ trans('all.name') }}</th>
                            <th style="vertical-align: middle" scope="col">{{ trans('all.email') }}</th>
                            <th style="vertical-align: middle" scope="col">{{ trans('site.join-date') }}</th>
                            <th style="vertical-align: middle" scope="col">{{ trans('auth.status') }}</th>
                            <th style="text-align:center;vertical-align: middle" scope="col">{{ trans('site.details') }} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($team['players']) > 0)
                            @foreach($team['players'] as $member)
                                <tr>
                                    <th style="vertical-align:middle;" scope="row"><img src="{{  config('app.base_address') . $member['personInfo']['imagePath'] }}" width="50" height="50" alt=""></th>
                                    <td style="vertical-align: middle">{{ !is_null($member['name']) ? $member['name'] : '------' }}</td>
                                    <td style="vertical-align: middle">{{ !is_null($member['personInfo']['email']) ? $member['personInfo']['email'] : '------' }}</td>
                                    <td style="vertical-align: middle">{{ !is_null($member['joinDate']) ? \Carbon\Carbon::parse($member['joinDate'])->format('Y-m-d') : '------' }}</td>
                                    <td style="vertical-align: middle">{{ !is_null($member['client']['state']) ? trans('site.order-accepted') : '------' }}</td>
                                    <td style="text-align:center;vertical-align: middle"><a class="text-danger academy-remove-player" type="button" data-teamid="{{ $team['id'] }}" data-id="{{ $member['id'] }}" href="javascript:void(0)">{{ trans('individually.remove') }}</a></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">{{ trans('all.no-players-for-this-team-yet') }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

