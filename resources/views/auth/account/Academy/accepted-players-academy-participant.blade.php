<div class="tab__content">
    <div class="alert alert-danger text-center invitation-error-message py-3 d-none"></div>
    <div class="alert alert-success text-center invitation-success-message py-3 d-none"></div>
    <h4 class="p-4">{{ trans('site.all-player-in-academy') }}</h4>
    <div class="table-container table-responsive text-center" >
        <table class="table table-striped table-hover" id="players_managements_tabs">
            <thead>
            <tr>
                <th style="vertical-align: middle" scope="col">{{ trans('auth.image') }}</th>
                <th style="vertical-align: middle" scope="col">{{ trans('all.name') }}</th>
                <th style="vertical-align: middle" scope="col">{{ trans('all.email') }}</th>
                <th style="vertical-align: middle" scope="col">{{ trans('auth.birthDate') }}</th>
                <th style="vertical-align: middle" scope="col">{{ trans('site.join-date') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @if (count($players) > 0)
                @foreach($players as $player)
                    @if (!in_array($player['id'], $playersIds))
                        <tr>
                            <th style="vertical-align:middle;" scope="row"><img src="{{  config('app.base_address') . $player['personInfo']['imagePath'] }}" width="50" height="50" alt=""></th>
                            <td style="vertical-align: middle">{{ !is_null($player['name']) ? $player['name'] : '------' }}</td>
                            <td style="vertical-align: middle">{{ !is_null($player['personInfo']['email']) ? $player['personInfo']['email'] : '------' }}</td>
                            <td style="vertical-align: middle">{{ !is_null($player['joinDate']) ? \Carbon\Carbon::parse($player['joinDate'])->format('Y-m-d') : '------' }}</td>
                            <td style="vertical-align: middle">{{ !is_null($player['joinDate']) ? \Carbon\Carbon::parse($player['joinDate'])->format('Y-m-d') : '------' }}</td>
                            @if (!$player['isTeamMember'])
                                <td style="vertical-align: middle"><a type="button" href="javascript:void(0)" class="btn btn-outline-dark player-send-invitation btn-sm" data-playerid="{{ $player['id'] }}">{{ trans('site.add-player') }}</a></td>
                            @else
                                <td></td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div><!--.table-container-->
</div><!--.tab__content-->
