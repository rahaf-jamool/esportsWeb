@include('layouts.message')
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
		<div class="row text-center">
            <button type="button" class="btn btn-outline-dark col-4 mx-3" id="clubRequests"  data-toggle="modal" data-target="#clubTeamDetailsReadyModel">{{ trans('site.club-requests') }}</button>
			<div class="col-12"></div>
			<h4 class="p-4">{{ trans('site.teamManagement') }}</h4>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('all.image') }}</th>
                            <th scope="col">{{ trans('auth.name') }} </th>
                            <th scope="col">{{ trans('auth.status') }} </th>
                            <th scope="col">{{ trans('all.created-date') }} </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($teams) > 0)
                            @foreach($teams as $team)
                                <tr id="team_item_{{$team['id']}}">
                                    <th class="image" style="vertical-align:middle;" scope="row"><img src="{{ config('app.base_address') . $team['logoImagePath'] }}" alt="" width="75" height="75" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}'" /></th>
                                    <th class="name" style="vertical-align:middle;" scope="row">{{ $team['name'] }}</th>
                                    <td class="status {{ $team['accepted'] ? 'text-success' : 'text-danger' }}" style="vertical-align:middle;">{{ $team['accepted'] ? trans('site.order-accepted') : trans('site.order-waiting') }}</td>
                                    <th class="create-at" style="vertical-align:middle;" scope="row">{{ \Carbon\Carbon::parse($team['createdAt'])->format('Y-m-d') }}</th>
                                    <td style="vertical-align:middle;">
                                        <button class="btn btn-dark club-team-details btn-sm" data-toggle="modal" data-target="#clubTeamDetailsReadyModel" data-id="{{ $team['id'] }}" style="cursor: pointer;">{{trans('site.details')}}</button>
                                        <button class="btn btn-success btn-sm edit-team-info" data-toggle="modal" data-target="#clubTeamDetailsReadyModel" data-id="{{ $team['id'] }}">{{trans('all.edit')}}</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                    {{-- {{dd($userId)}} --}}
    		</div>
		</div>
	</div>
    <div class="payment-method">
        <div class="payment-accordion">
            <div class="order-button-payment">
                <a href="javascript:void(0)" class="text-center info-edit mt-0" id="info_edit" data-toggle="modal" data-target="#clubTeamRequestModel">{{ trans('auth.new-team') }}</a>
            </div>
        </div>
    </div>

    <!--Team request model-->
    <div class="modal fade" id="clubTeamRequestModel" tabindex="-1" aria-labelledby="clubTeamRequestModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="clubTeamRequestModelLabel">{{ trans('site.team-create-request') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="club_team_request_form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>{{ trans('site.team-name') }}</label>
                            <input type="text" name="team-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.team-logo') }}</label>
                            <input type="file" name="file" class="form-control" id="club_team_request_file">
                        </div>
                    </form>
                    <div class="alert alert-danger text-center team-request-error-message d-none"></div>
                    <div class="alert alert-success text-center team-request-success-message d-none"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary button-close" data-dismiss="modal">{{ trans('all.button_close') }}</button>
                    <button type="button" class="btn btn-success" id="club_send_team_request">{{ trans('all.send') }}</button>
                </div>
            </div>
        </div>
    </div><!--#clubTeamRequestModel-->

    <!-- Start Add New Player model-->
    <div class="modal fade" id="clubAddNewPlayerModel" tabindex="-1" aria-labelledby="clubAddNewPlayerModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="clubAddNewPlayerModelLabel">{{ trans('site.add-player') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3">{{ trans('site.search-for-player') }}</h6>
                    <form id="club_search_form_for_player">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <input type="text" name="name" placeholder="{{ trans('site.type-player-name') }}" >
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="email" name="email" placeholder="{{ trans('site.type-player-email') }}" >
                            </div>
                            <div class="col-12 col-md-4">
                                <input type="text" name="cardid" placeholder="{{ trans('site.type-player-card-id') }}" >
                            </div>
                        </div>
                        <button class="btn btn-success mt-3 search" type="submit">{{ trans('all.search') }}</button>
                        <button class="btn btn-secondary mt-3 register-model" data-toggle="modal" data-target="#clubTeamDetailsReadyModel">{{ trans('site.register-new-player') }}</button>
                    </form>
                    <div class="alert alert-success text-center mt-3 invitation-success-message d-none"></div>
                    <div class="alert alert-danger text-center mt-3 invitation-error-message d-none"></div>
                    <div class="search-result mt-5">
                        <div class="row w-100 mx-auto"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--#clubAddNewPlayerModel-->
    <!-- End Add New Player model-->

    <!--Team Details model-->
    <div class="modal fade" id="clubTeamDetailsReadyModel" tabindex="-1" role="dialog" aria-labelledby="clubTeamDetailsReadyModelLabel" aria-hidden="true" style="overflow-x: hidden;overflow-y: auto;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="model-content-box">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clubTeamDetailsReadyModelLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0" style="background: #f5f5f5;height: 600px;background: #f5f5f5;overflow-y: auto;"></div>
                </div>
                <div class="model-message text-center py-3">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clubTeamDetailsReadyModelLabel"></h5>
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
    </div><!--#teamDetailsModel-->

    <div class="modal fade" id="custom-message" tabindex="-1" aria-labelledby="custom-message-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center py-4">
                    <h4 class="h5 message-text mb-0 mx-auto">{{ trans('site.waitForAdministratorApprovalOnCreatingTeam') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $('#custom-message').on('click', '.close', function () {
                $(this).closest('.modal').removeClass('show');
                $('.modal-backdrop').removeClass('show');
            });
            // Close team details model after click add new player button
            $('#clubTeamDetailsReadyModel').on('click', '#clubAddNewPlayerButton, #clubAddPlayerFromClubButtonPending', function () {
                $('#clubTeamDetailsReadyModel .close').click();
            });

            // Render Register Player Form
            $('.register-model').click( function (e) {
                e.preventDefault();
                $('#clubAddNewPlayerModel .close').click();
                resetSearchForm();
                callAjax('{{ url(App::getLocale() . '/profile/renderPlayerFormAjax') }}');
            });

            // Get All Club Request
            $('#clubRequests').click( () => callAjax('{{ url(App::getLocale() . '/profile/getPlayerRequestsAjax') }}') );

            // Render All Players Who are club participants
            $('#clubTeamDetailsReadyModel').on('click', '#clubAddPlayerFromClubButton', function (e) {
                e.preventDefault();
                callAjax('{{ url(App::getLocale() . '/profile/renderAllPlayerClubParticipantsAjax') }}');
            });

            // Render Register Club Form
            $(document).on('click', '.edit-team-info', function (e) {
                let teamId = e.target.dataset.id;
                let url = "{{ url(App::getLocale() . '/profile/renderClubEditFormAjax') }}" + '/' + teamId;
                e.preventDefault();
                callAjax(url);
                $('#clubTeamDetailsReadyModel .modal-body').css('height', 'unset');
            });

            // Reset Search Form And Empty Search Result Section
            $('#clubAddNewPlayerModel .close').click(() => resetSearchForm());
            $(document).on('change', 'input[name="otherPlatform"]', function (e) {
                $(this).parent().siblings('#form-platform').toggleClass('d-none');
            });
            $(document).on('change', 'input[name="otherGame"]', function () {
                $(this).parent().siblings('#form-games').toggleClass('d-none');
            });
            // Show And Hide Password
            showHidePassword('#hide_show', 'password');
            showHidePassword('#hide_show1', 'password_confirmation');

            $('#teamManagement').on('click', '.club-team-details', function (e) {
                let id = $(this).data('id');
                // return;
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/clubGetTeamDetailsAjax') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id
                    },
                    beforeSend: function () {
                        $('#clubTeamDetailsReadyModel .model-loader').removeClass('d-none');
                        $('#clubTeamDetailsReadyModel .model-message').addClass('d-none');
                        $('#clubTeamDetailsReadyModel .model-content-box').addClass('d-none');
                    },
                    error: function (error) {
                        console.log(error);
                    },
                    success: function (response) {
                        if (!response.error) {
                            $('#clubTeamDetailsReadyModel .model-loader').addClass('d-none');
                            $('#clubTeamDetailsReadyModel .model-message').addClass('d-none');
                            $('#clubTeamDetailsReadyModel .model-content-box').removeClass('d-none');
                            $('#clubTeamDetailsReadyModel').find('.modal-body').html(response.data);
                        } else {
                            $('#clubTeamDetailsReadyModel .model-loader').addClass('d-none');
                            $('#clubTeamDetailsReadyModel .model-message').removeClass('d-none').html(`<h4 class="mb-0">${response.data}</h4>`);
                            $('#clubTeamDetailsReadyModel .model-content-box').addClass('d-none');
                            $('#clubTeamDetailsReadyModel').find('.modal-body').html('');
                        }
                    }
                });
            });

            // Club send request to create a team
            $('#club_send_team_request').click(function () {
                let name = $('input[name="team-name"]').val();
                let files = $('#club_team_request_file')[0].files;
                let reader = new FileReader();
                if (files.length == 0 && name == '') return;
                reader.onload = function () {
                    let base64String = reader.result.replace("data:", "").replace(/^.+,/, "");

                    if(files.length > 0) {
                        let formData = new FormData();
                        formData.append('_token', '{{ csrf_token() }}');
                        formData.append('name', name);
                        formData.append('type', 'create');
                        // formData.append('file', files[0]);
                        formData.append('file-name', files[0].name);
                        formData.append('file-size', files[0].size);
                        formData.append('file-type', files[0].type);
                        formData.append('file-imgBase64String', base64String );
                        $.ajax({
                            url: '{{ url(App::getLocale() . '/profile/playerTeamRequest') }}',
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            data: formData,
                            beforeSend: function () {
                                $('#club_send_team_request').css({'pointer-events': 'none', 'opacity': '.7'});
                            },
                            error: function () {
                                $('#club_send_team_request').css({'pointer-events': 'auto', 'opacity': '1'});
                            },
                            success: function (response) {
                                if (response.error) {
                                    $('.team-request-error-message').removeClass('d-none').text(response.result);
                                    setTimeout(() => {
                                        $('.team-request-error-message').addClass('d-none').text('');
                                    }, 5000);
                                } else {
                                    $('.team-request-success-message').removeClass('d-none').text(response.result);
                                    $('#teamManagement .table-responsive tbody').append(`<tr>
                                        <th style="vertical-align:middle;" scope="row"><img src="{{config('app.base_address')}}${response.data['team']['logoImagePath']}" alt="" width="75" height="75" onerror="this.onerror=null;this.src='{{asset('assets/img/logo1.png')}}'"></th>
                                        <th style="vertical-align:middle;" scope="row">${response.data['team']['name']}</th>
                                        <td style="vertical-align:middle;" class="text-danger">{{trans('site.order-pending')}}</td>
                                        <th style="vertical-align:middle;" scope="row">${new Date(response.data['team']['createdAt']).getFullYear() + '-' + new Date(response.data['team']['createdAt']).getMonth() + '-' + new Date(response.data['team']['createdAt']).getDay()}</th>
                                        <td style="vertical-align:middle;">
                                            <button class="btn btn-dark club-team-details btn-sm" data-toggle="modal" data-target="#clubTeamDetailsReadyModel" data-id="${response.data['team']['id']}" style="cursor: pointer;" style="cursor: pointer;">{{trans('site.details')}}</button>
                                            <button class="btn btn-success btn-sm edit-team-info" data-toggle="modal" data-target="#clubTeamDetailsReadyModel" data-id="${response.data['team']['id']}">{{trans('all.edit')}}</button>
                                        </td>
                                    </tr>`);
                                    setTimeout(() => {
                                        $('.team-request-success-message').addClass('d-none').text('');
                                        $('#club_team_request_form')[0].reset();         // Reset the model form
                                        $('.button-close').click();                 // Close the Model
                                    }, 3000);
                                }
                                $('#club_send_team_request').css({'pointer-events': 'auto', 'opacity': '1'});
                            }
                        });
                    }
                }
                reader.readAsDataURL(files[0]);
            });

            // Search for Player
            $('#club_search_form_for_player .search').click(function (e) {
                e.preventDefault();
                let form = document.getElementById('club_search_form_for_player');
                let formData = new FormData(form);
                if ($('#clubAddNewPlayerModel').find('input[name="name"]').val() == '' &&
                    $('#clubAddNewPlayerModel').find('input[name="email"]').val() == '' &&
                    $('#clubAddNewPlayerModel').find('input[name="cardid"]').val() == '') return;
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/searchAcceptedPlayerAjax') }}',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    beforeSend: function () {
                        $('#club_search_form_for_player .search').css({'pointer-events': 'none', 'opacity': '.7'});
                    },
                    error: function () {
                        $('#club_search_form_for_player .search').css({'pointer-events': 'auto', 'opacity': '1'});
                    },
                    success: function (response) {
                        $('#club_search_form_for_player .search').css({'pointer-events': 'auto', 'opacity': '1'});
                        if (!response.error) {
                            $('#clubAddNewPlayerModel .search-result .row').html(response.data);
                            $('.search-result .card-img-top').height($('.search-result .card-img-top').width());
                        } else {
                            $('#clubAddNewPlayerModel .search-result .row').html(`<div class="alert alert-warning text-center">${response.data}</div>`);
                        }
                    }
                });
            });

            // Send Invitation By Player To Other Player
            $('#clubTeamDetailsReadyModel, #clubAddNewPlayerModel').on('click', '.player-send-invitation', function (e) {
                let playerId = e.target.dataset.playerid;
                let teamId = $('#academyAddNewPlayerButton').data('teamid');
                // let isTeamHead = $('.club-team-details').data('hasteamhead');
                console.log(playerId, teamId);
                //     return;
                    swal({
                        title: '{{trans("site.are-you-sure-want-add-this-player")}}',
                        buttons: ['{{trans("site.cancel")}}', '{{trans("site.ok")}}'],
                    }).then((accept) => {
                        if (accept) {
                            $.ajax({
                                url: '{{ url(App::getLocale() . '/profile/playerTeamRequest') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    type: 'Add',
                                    playerId,
                                    teamId
                                },
                                beforeSend: function () {
                                    $('.player-send-invitation').css({'pointer-events': 'none', 'opacity': '.7'});
                                },
                                error: function () {
                                    $('.player-send-invitation').css({'pointer-events': 'auto', 'opacity': '1'});
                                },
                                success: function (response) {
                                    if (response.error) {
                                        $('.invitation-error-message').removeClass('d-none').text(response.result);
                                        setTimeout(() => {
                                            $('.invitation-error-message').addClass('d-none').text('');
                                        }, 7000);
                                    } else {
                                        $('.invitation-success-message').removeClass('d-none').text(response.result);
                                        setTimeout(() => {
                                            $('.invitation-success-message').addClass('d-none').text('');
                                        }, 5000);
                                    }
                                    $('.player-send-invitation').css({'pointer-events': 'auto', 'opacity': '1'});
                                }
                            });
                            // return;

                        }
                    });
            });

            {{--$(document).on('click', '#club_register_form .submit', function (e) {--}}
            {{--    e.preventDefault();--}}
            {{--    let button = $('#club_register_form .submit');--}}
            {{--    let form = document.getElementById('club_register_form');--}}
            {{--    let formData = new FormData(form);--}}
            {{--    $.ajax({--}}
            {{--        url: '{{ url(App::getLocale() . '/profile/clubRegisterNewPlayerAjax') }}',--}}
            {{--        type: 'POST',--}}
            {{--        contentType: false,--}}
            {{--        processData: false,--}}
            {{--        data: formData,--}}
            {{--        beforeSend: function () {--}}
            {{--            button.css({'pointer-events': 'none', 'opacity': '.7'});--}}
            {{--        },--}}
            {{--        error: function () {--}}
            {{--            button.css({'pointer-events': 'auto', 'opacity': '1'});--}}
            {{--        },--}}
            {{--        success: function (response) {--}}
            {{--            if (response.error) {--}}
            {{--                $('.error-register-club-message').removeClass('d-none').html(response.result);--}}
            {{--                setTimeout(() => {--}}
            {{--                    $('.error-register-club-message').addClass('d-none').text('');--}}
            {{--                }, 10000);--}}
            {{--            } else {--}}
            {{--                $('.success-register-club-message').removeClass('d-none').html(response.result);--}}
            {{--                setTimeout(() => {--}}
            {{--                    $('.success-register-club-message').addClass('d-none').text('');--}}
            {{--                }, 10000);--}}
            {{--            }--}}
            {{--            button.css({'pointer-events': 'auto', 'opacity': '1'});--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}

            // The Club decide to remove other Player
            $('#clubTeamDetailsReadyModel').on('click', '.club-remove-player', function (e) {
{{--                if (!confirm('{{ trans('site.confirm-remove-player') }}')) return;--}}
                let playerId = e.target.dataset.id;
                let teamId = e.target.dataset.teamid;
                swal({
                    title: '{{trans("site.confirm-remove-player")}}',
                    buttons: ['{{trans("site.cancel")}}', '{{trans("site.ok")}}'],
                }).then((accept) => {
                    if (accept) {
                        $.ajax({
                            url: '{{ url(App::getLocale() . '/profile/playerTeamRequest') }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                type: 'remove',
                                playerId,
                                teamId
                            },
                            beforeSend: function () {
                                // btnElement.css({'pointer-events': 'none', 'opacity': '.7'});
                            },
                            error: function () {
                                // btnElement.css({'pointer-events': 'auto', 'opacity': '1'});
                            },
                            success: function (response) {
                                if (response.error) {
                                    $('.club-team-error-message').removeClass('d-none').text(response.result);
                                    setTimeout(() => {
                                        $('.club-team-error-message').addClass('d-none').text('');
                                    }, 7000);
                                } else {
                                    $('.club-team-success-message').removeClass('d-none').text(response.result);
                                    setTimeout(() => {
                                        $('.club-team-success-message').addClass('d-none').text('');
                                    }, 7000);
                                }
                                // btnElement.css({'pointer-events': 'auto', 'opacity': '1'});
                                // $('.button-close').click();                 // Close the Model
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#player_register_form .submit', function (e) {
                e.preventDefault();
                let button = $('#player_register_form .submit');
                let form = document.getElementById('player_register_form');
                let formData = new FormData(form);
                $.ajax({
                    url: "{{ url(App::getLocale() . '/profile/playerRegisterNewPlayerAjax') }}",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    beforeSend: function () {
                        button.css({'pointer-events': 'none', 'opacity': '.7'});
                    },
                    error: function () {
                        button.css({'pointer-events': 'auto', 'opacity': '1'});
                    },
                    success: function (response) {
                        if (response.error) {
                            $('.error-register-player-message').removeClass('d-none').html(response.result);
                            setTimeout(() => {
                                $('.error-register-player-message').addClass('d-none').text('');
                            }, 10000);
                        } else {
                            $('.success-register-player-message').removeClass('d-none').html(response.result);
                            setTimeout(() => {
                                $('.success-register-player-message').addClass('d-none').text('');
                            }, 7000);
                        }
                        button.css({'pointer-events': 'auto', 'opacity': '1'});
                    }
                });
            });

            $(document).on('click', '#add-game', function () {
                let nameGame = $('input[name="nameGame"]').val();
                if (nameGame == '') {
                    swal(
                        '{{trans("auth.name")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });
                } else {
                    let urlService = '{{ url(App::getLocale() . '/register/games/add') }}';
                    let newUrl = urlService + '/' + nameGame;
                    $.ajax({
                        url: newUrl,
                        type: 'GET',
                        processData: false,
                        contentType: false,
                        data: nameGame,
                        beforeSend: function () {},
                        error: function (response) {
                            swal("Oh noes!", "The AJAX request failed!", "error");
                        },
                        success: function (response) {
                            swal('{{trans("site.add-success")}}', {
                                icon: "success",
                                button: '{{trans("site.ok")}}',
                            });
                            $('#games-dev').append(
                                '<div class="custom-control custom-switch" id="platfom-add">\
                                   <input type="checkbox" class="custom-control-input" id="playerGames_{{' + response.success.result.id +'}}"\
                                                value="' + response.success.result.id + ' " name="playerGames[]">\
                                                <label class="custom-control-label" for="playerGames_{{' + response.success.result.id +'}}">' + response.success.result.name + '</label>\
                                            </div>'
                            );
                        }
                    });
                }
            });

            $(document).on('click', '#add-platform', function () {
                let namePlatform = $('input[name="namePlatform"]').val();
                //let formData = new FormData();
                if (namePlatform == '') {
                    swal(
                        '{{trans("auth.name")}}', {
                            icon: "warning",
                            button: '{{trans("site.ok")}}',
                        });

                } else {
                    let urlService = '{{ url(App::getLocale() . '/register/platform/add') }}';
                    let newUrl = urlService + '/' + namePlatform;
                    $.ajax({
                        url: newUrl,
                        type: 'GET',
                        processData: false,
                        contentType: false,
                        data: namePlatform,
                        beforeSend: function () {},
                        error: function (response) {
                            swal("Oh noes!", "The AJAX request failed!", "error");
                        },
                        success: function (response) {
                            swal('{{trans("site.add-success")}}', {
                                icon: "success",
                                button: '{{trans("site.ok")}}',
                            });
                            $('#platform-dev').append(
                                '<div class="custom-control custom-switch" id="platfom-add">\
                                    <input type="checkbox" class="custom-control-input" id="playerPlatforms_{{' + response.success.result.id +'}}"\
                                                value="' + response.success.result.id + ' " name="playerPlatforms[]">\
                                                <label class="custom-control-label" for="playerPlatforms_{{' + response.success.result.id +'}}">' + response.success.result.name + '</label>\
                                            </div>'
                            );
                        }
                    });
                }
            });

            $(document).on('click', '#update_team_info', function (e) {
                e.preventDefault();
                let button = $('#update_team_info');
                let form = document.getElementById('edit_team_info_form');
                let formData = new FormData(form);
                if ($('#clubTeamDetailsReadyModel').find('input[name="team-name"]').val() == '' &&
                    $('#clubTeamDetailsReadyModel').find('input[name="file"]').val() == '') return;
                $.ajax({
                    url: "{{ url(App::getLocale() . '/profile/updateTeamInfoAjax') }}",
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    beforeSend: function () {
                        button.text('{{ trans('auth.updating') }}').css({'pointer-events': 'none', 'opacity': '.7'});
                    },
                    error: function () {
                        button.text('{{ trans('auth.update') }}').css({'pointer-events': 'auto', 'opacity': '1'});
                    },
                    success: function (response) {
                        if (response.error) {
                            $('.edit-team-request-error-message').removeClass('d-none').html(response.result);
                            setTimeout(() => {
                                $('.edit-team-request-error-message').addClass('d-none').text('');
                            }, 10000);
                        } else {
                            if (response.data.logoImagePath) {
                                $(`#team_item_${response.data.id} .image img`).attr('src', `{{config('app.base_address')}}${response.data.logoImagePath}`);
                            }
                            $(`#team_item_${response.data.id} .name`).text(`${response.data.name}`);
                            $('.edit-team-request-success-message').removeClass('d-none').html(response.result);
                            setTimeout(() => {
                                $('.edit-team-request-success-message').addClass('d-none').text('');
                                $('#clubTeamDetailsReadyModel .close').click();
                            }, 1000);
                        }
                        button.text('{{ trans('auth.update') }}').css({'pointer-events': 'auto', 'opacity': '1'});
                    }
                });
            });


            function showHidePassword(element, attr) {
                // $(`${element}`).show();
                // $(`${element} span`).addClass('show');
                $(document).on('click', `${element} span`, function() {
                    console.log('click showHidePassword');
                    if( $(this).hasClass('show') ) {
                        //   $(this).text('Hide');
                        $(`#player_register_form input[name="${attr}"]`).attr('type', 'text');
                        $(this).removeClass('show');
                    } else {
                        //    $(this).text('Show');
                        $(`#player_register_form input[name="${attr}"]`).attr('type','password');
                        $(this).addClass('show');
                    }
                });
                $(document).on('click', '#player_register_form button[type="submit"]', function(){
                    $(`${element} span`).text('Show').addClass('show');
                    $(`${element}`).parent().find(`input[name="${attr}"]`).attr('type','password');
                });
            }

            function resetSearchForm() {
                $('#club_search_form_for_player')[0].reset();                    // Reset the search form
                $('#clubAddNewPlayerModel .search-result .row').html('');   // Empty The Search Result Box
            }

            // Ajax Called
            function callAjax(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function () {
                        $('#clubTeamDetailsReadyModel .model-loader').removeClass('d-none');
                        $('#clubTeamDetailsReadyModel .model-message').addClass('d-none');
                        $('#clubTeamDetailsReadyModel .model-content-box').addClass('d-none');
                    },
                    success: function (response) {
                        if (!response.error) {
                            $('#clubTeamDetailsReadyModel .model-loader').addClass('d-none');
                            $('#clubTeamDetailsReadyModel .model-message').addClass('d-none');
                            $('#clubTeamDetailsReadyModel .model-content-box').removeClass('d-none');
                            $('#clubTeamDetailsReadyModel').find('.modal-body').html(response.data);
                        } else {
                            $('#clubTeamDetailsReadyModel .model-loader').addClass('d-none');
                            $('#clubTeamDetailsReadyModel .model-message').removeClass('d-none').html(`<h4 class="mb-0">${response.result}</h4>`);
                            $('#clubTeamDetailsReadyModel .model-content-box').addClass('d-none');
                            $('#clubTeamDetailsReadyModel').find('.modal-body').html('');
                        }
                    }
                });
            }
        });

    </script>
@endpush
