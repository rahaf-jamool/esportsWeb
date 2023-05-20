<div class="container pt-3 pb-5 w-100">
    <h3>{{ trans('site.edit-team-information') }}</h3>
    <div class="modal-body pt-3">
        <form id="edit_team_info_form" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="teamId" value="{{$teamDetails['id']}}" />
            <input type="hidden" name="teamHeadId" value="{{$teamDetails['teamHeadId']}}" />
            <div class="form-group">
                <label>{{ trans('site.team-name') }}</label>
                <input type="text" name="team-name" class="form-control" value="{{$teamDetails['name']}}">
            </div>
            <div class="form-group">
                <label>{{ trans('site.team-logo') }}</label>
                <input type="file" name="file" class="form-control" id="team_request_file">
            </div>
            <div class="mb-3">
                <img src="{{ config('app.base_address') . $teamDetails['logoImagePath']}}" alt="" width="200" height="200">
            </div>
        </form>
        <div class="alert alert-danger text-center edit-team-request-error-message py-3 d-none"></div>
        <div class="alert alert-success text-center edit-team-request-success-message py-3 d-none"></div>
        <button class="btn btn-success my-3" id="update_team_info">{{ trans('auth.update') }}</button>
    </div>
</div>
