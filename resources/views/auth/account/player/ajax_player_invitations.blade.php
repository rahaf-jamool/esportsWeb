<div class="p-3">
    <div class="alert alert-success text-center my-3 accept-invitation-success-message d-none"></div>
    <div class="alert alert-danger text-center my-3 accept-invitation-error-message d-none"></div>
    <h4 class="p-4">{{ trans('all.team-invitations') }}</h4>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th class="text-center" scope="col">{{ trans('auth.image') }}</th>
            <th class="text-center" scope="col">{{ trans('auth.name') }} </th>
            <th class="text-center" scope="col">{{ trans('auth.status') }} </th>
            <th class="text-center" scope="col">{{ trans('site.administration-status') }} </th>
            <th class="text-center" scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($invitations as $invitation)
            <tr class="invitation_row" data-toggle="tooltip" data-placement="top" title="{{ $invitation['playerState'] == 'Accepted' && $invitation['administrationState'] == 'Pending' ? trans('all.accept-invitation-message') : '' }}">
                <td class="text-center" style="vertical-align:middle;" scope="row"><img src="{{ config('app.base_address') . $invitation['team']['logoImagePath'] }}" width="50" height="50" alt=""></td>
                <td class="text-center" style="vertical-align:middle;" scope="row">{{ $invitation['team']['name'] }}</td>
                <td class="text-center" style="vertical-align:middle;">{{ $invitation['playerState'] == 'Accepted' ? trans('site.order-accepted') : trans('site.order-pending') }}</td>
                <td class="text-center" style="vertical-align:middle;">{{ $invitation['administrationState'] == 'Accepted' ? trans('site.order-accepted') : ($invitation['administrationState'] == 'Pending' ? trans('site.order-pending') : trans('site.order-Refused')) }}</td>
                <td class="text-center" style="vertical-align:middle;">
                    @if ($invitation['playerState'] != 'Accepted')
                        @if ($isJoinedTeam)
                            <button class="btn btn-outline-dark btn-sm accept-invitation" data-isjoin="true">{{ trans('site.accept-invitation') }}</button>
                        @else
                            <button class="btn btn-outline-dark btn-sm accept-invitation" data-isjoin="false" data-id="{{ $invitation['id'] }}">{{ trans('site.accept-invitation') }}</button>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

