
@if (!empty($requests))
    <div class="p-3">
        <h4 class="p-4">{{ trans('all.create-team-request') }}</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.type') }}</th>
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('auth.image') }}</th>
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('auth.status') }}</th>
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.team-name') }} </th>
    {{--                        <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.player-status') }} </th>--}}
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.administration-status') }} </th>
                </tr>
                </thead>
                <tbody>
                    @php($teamRequest = false)
                    @foreach($requests as $request)
                        {{-- Check if this is team and not player --}}
                        @if (!isset($request['player']['name']) && isset($request['team']['name']))
                            @php($teamRequest == true)
                            <tr>
                                <th style="vertical-align:middle;text-align:center;" scope="row">{{ trans('site.'.$request['type']) }}</th>
                                @if($request['team']['logoImagePath'] != '' )
                                    <th style="vertical-align:middle;text-align:center;" scope="row">
                                        <img src="{{ config('app.base_address') . $request['team']['logoImagePath']}}" width="50" alt="logo"
                                             onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="border-radius: 50%;height: 70%;"></th>
                                @else
                                    <th><img class="responsive" src="{{  url(asset('SD08/default-user-image.png')) }}" width="250" alt="logo"/></th>
                                @endif

                                <th style="vertical-align:middle;text-align:center;" class="{{$request['team']['accepted'] ? 'text-success' : 'text-danger' }}">{{ $request['team']['accepted'] ? trans('site.order-accepted') : trans('site.order-pending') }}</th>
                                <th style="vertical-align:middle;text-align:center;" scope="row">{{ $request['team']['name'] }}</th>
    {{--                                <th style="vertical-align:middle;text-align:center;" scope="row">{{ $request['playerState'] }}</th>--}}
                                <th style="vertical-align:middle;text-align:center;" scope="row" class="{{$request['administrationState'] == 'Accepted' ? 'text-success' : ($request['administrationState'] == 'Pending' ? 'text-danger' : 'text-danger')}}">{{ $request['administrationState'] == 'Accepted' ? trans('site.order-accepted') : ($request['administrationState'] == 'Pending' ? trans('site.order-pending') : trans('site.order-Refused')) }}</th>
                            </tr>
                        @endif
                    @endforeach
                    @if (!$teamRequest)
                        <tr>
                            <th style="vertical-align:middle;text-align:center;" scope="row" colspan="5">{{ trans('site.empty-team-creation-request') }}</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="player p-3">

        <h4 class="p-4">{{ trans('site.players-request') }}</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.type') }}</th>
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.playername') }}</th>
                    @if (session('loggedUser')['client']['type'] == 'Player')
                        <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.is-player-head') }}</th>
                    @endif
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.team-name') }} </th>
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.player-status') }} </th>
                    <th style="vertical-align:middle;text-align:center;" scope="col">{{ trans('site.administration-status') }} </th>
                </tr>
                </thead>
                <tbody>
                @php($playerRequest = false)
                    @foreach($requests as $request)
                        {{-- Check if this is player --}}
                        @if (isset($request['player']['name']))
                            @php($playerRequest = true)
                            <tr>
                                <th style="vertical-align:middle;text-align:center;" scope="row">{{ trans('site.'.$request['type']) }}</th>
                                <th style="vertical-align:middle;text-align:center;" scope="row">{{ $request['player']['name'] }}</th>
                                @if (session('loggedUser')['client']['type'] == 'Player')
                                    <th style="vertical-align:middle;text-align:center;" scope="row">{{ $request['isTeamHead'] ? trans('individually.yes') : trans('individually.no') }}</th>
                                @endif
                                <th style="vertical-align:middle;text-align:center;" scope="row">{{ isset($request['team']['name']) ? $request['team']['name'] : '-' }}</th>
                                <th style="vertical-align:middle;text-align:center;" class="{{$request['playerState'] == 'Accepted' ? 'text-success' : 'text-danger' }}">{{ $request['playerState'] == 'Accepted' ? trans('site.order-accepted') : trans('site.order-pending') }}</th>
                                <th style="vertical-align:middle;text-align:center;" scope="row" class="{{$request['administrationState'] == 'Accepted' ? 'text-success' : ($request['administrationState'] == 'Pending' ? 'text-danger' : 'text-danger')}}">{{ $request['administrationState'] == 'Accepted' ? trans('site.order-accepted') : ($request['administrationState'] == 'Pending' ? trans('site.order-pending') : trans('site.order-Refused')) }}</th>
                            </tr>
                        @endif
                    @endforeach
                    @if (!$playerRequest)
                        <tr>
                            <th style="vertical-align:middle;text-align:center;" scope="row" colspan="6">{{ trans('site.empty-players-request') }}</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endif
