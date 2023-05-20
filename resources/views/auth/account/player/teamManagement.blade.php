
@include('layouts.message')
{{-- {{ dd($user['numberOfMatch'], $user['numberOfWonMatch'])}} --}}
{{--{{ dd($clientTeamRequests) }}--}}
<div class="card checkout-area pt-30 pb-30">
	<div class="your-order">
        <div class="alert alert-success team-request-success-message text-center d-none"></div>
        <div class="alert alert-danger team-request-error-message text-center d-none"></div>
		<div class="row text-center">
			<div class="col-12 pt-3">
                @if (count($clientTeamRequests) == 0)
                    <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#teamRequestModel">{{ trans('site.send-team-request') }}</button>
                @else
                    @if ($clientTeamRequests['teamHeadId'] == session('loggedUser')['id'])
                        <button type="button" class="btn btn-outline-dark add-player-ajax"  data-toggle="modal" data-target="#addNewPlayerModel">{{ trans('site.add-player') }}</button>
                    @endif
                @endif
                <button type="button" class="btn btn-outline-dark" id="playerRequests"  data-toggle="modal" data-target="#playerTeamDetailsModel">{{ trans('site.player-requests') }}</button>
                <button type="button" class="btn btn-outline-dark teams-invitations-ajax"  data-toggle="modal" data-target="#playerTeamDetailsModel">{{ trans('site.teams-invitations') }}</button>
            </div>
			<h4 class="p-4">{{ trans('site.teamManagement') }}</h4>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th scope="col">{{ trans('auth.image') }}</th>
                        <th scope="col">{{ trans('auth.name') }} </th>
                        <th scope="col">{{ trans('individually.teamHeadName') }} </th>
                        <th scope="col">{{ trans('auth.status') }} </th>
                        <th scope="col"></th>
					</tr>
				</thead>
				<tbody>
                    @if (count($clientTeamRequests) > 0)
                        <tr id="player_team_item">
                            <th class="image" style="vertical-align:middle;" scope="row"><img src="{{ config('app.base_address') . $clientTeamRequests['logoImagePath'] }}" width="50" height="50" alt=""></th>
                            <th class="name" style="vertical-align:middle;" scope="row">{{ $clientTeamRequests['name'] }}</th>
                            <th style="vertical-align:middle;" scope="row">{{ $clientTeamRequests['teamHeadName'] }}</th>
                            <td style="vertical-align:middle;" class="text-success">{{ $clientTeamRequests['accepted'] ? trans('site.order-accepted') : trans('site.order-waiting') }}</td>
                            <td style="vertical-align:middle;">
                                <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#playerTeamDetailsReadyModel" style="cursor: pointer;">{{trans('site.details')}}</button>
                                 @if ($clientTeamRequests['teamHeadId'] == session('loggedUser')['id'])
                                    <button class="btn btn-success btn-sm edit-team-info" data-toggle="modal" data-target="#playerTeamDetailsModel">{{trans('all.edit')}}</button>
                                 @endif
                            </td>
                        </tr>
                    @endif
				</tbody>
			</table>
		</div>
	</div><!--.your-order-->

    <!--Team Details model-->
    <div class="modal fade" id="playerTeamDetailsReadyModel" tabindex="-1" aria-labelledby="playerTeamDetailsReadyModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="playerTeamDetailsReadyModelLabel">{{ trans('site.team-create-request') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($clientTeamRequests) > 0)
                        @include('auth.account.player.ajax_team_details', compact('clientTeamRequests'))
                    @endif
                </div>
            </div>
        </div>
    </div><!--#teamDetailsModel-->

    <!--Team request model-->
    <div class="modal fade" id="teamRequestModel" tabindex="-1" aria-labelledby="teamRequestModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="teamRequestModelLabel">{{ trans('site.team-create-request') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="team_request_form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>{{ trans('site.team-name') }}</label>
                            <input type="text" name="team-name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{ trans('site.team-logo') }}</label>
                            <input type="file" name="file" class="form-control" id="team_request_file">
                        </div>
                    </form>
                    <div class="alert alert-danger text-center team-request-error-message d-none"></div>
                    <div class="alert alert-success text-center team-request-success-message d-none"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary button-close" data-dismiss="modal">{{ trans('all.button_close') }}</button>
                    <button type="button" class="btn btn-success" id="send_team_request">{{ trans('all.send') }}</button>
                </div>
            </div>
        </div>
    </div><!--#teamRequestModel-->

    <!-- Start Add New Player model-->
    <div class="modal fade" id="addNewPlayerModel" tabindex="-1" aria-labelledby="addNewPlayerModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="addNewPlayerModelLabel">{{ trans('site.add-player') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3">{{ trans('site.search-for-player') }}</h6>
                    <form id="player_search_form">
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
                        <button class="btn btn-secondary mt-3 register-model" data-toggle="modal" data-target="#playerTeamDetailsModel">{{ trans('site.register-new-player') }}</button>
                    </form>
                    <div class="alert alert-success text-center mt-3 invitation-success-message d-none"></div>
                    <div class="alert alert-danger text-center mt-3 invitation-error-message d-none"></div>
                    <div class="search-result mt-5" data-teamid="{{ count($clientTeamRequests) > 0 ? $clientTeamRequests['id'] : 0 }}">
                        <div class="row w-100 mx-auto"></div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--#addNewPlayerModel-->
    <!-- End Add New Player model-->

    <div class="modal fade" id="playerTeamDetailsModel" tabindex="-1" role="dialog" aria-labelledby="playerTeamDetailsModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="model-content-box">
                    <div class="modal-header">
                        <h5 class="modal-title" id="playerTeamDetailsModelLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0" style="background: #f5f5f5;height: 600px;background: #f5f5f5;overflow-y: auto;"></div>
                </div>
                <div class="model-message text-center py-3">
                    <div class="modal-header">
                        <h5 class="modal-title" id="playerTeamDetailsModelLabel"></h5>
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
            $('.invitation_row').tooltip();
            $(document).on('change', 'input[name="otherPlatform"]', function (e) {
                $(this).parent().siblings('#form-platform').toggleClass('d-none');
            });
            $(document).on('change', 'input[name="otherGame"]', function () {
                $(this).parent().siblings('#form-games').toggleClass('d-none');
            });
            // Get All Player Request
            $('#playerRequests').click( () => callAjax('{{ url(App::getLocale() . '/profile/getPlayerRequestsAjax') }}') );
            // Get Team Invitations for this Player
            $('.teams-invitations-ajax').click( () => callAjax('{{ url(App::getLocale() . '/profile/getPlayerInvitationsAjax') }}'));
            // Render Register Player Form
            $('.register-model').click( function (e) {
                e.preventDefault();
                $('#addNewPlayerModel .close').click();
                resetSearchForm();
                callAjax('{{ url(App::getLocale() . '/profile/renderPlayerFormAjax') }}');
            });
            // Render Register Player Form
            $('.edit-team-info').on('click', function (e) {
                e.preventDefault();
                callAjax('{{ url(App::getLocale() . '/profile/renderPlayerEditFormAjax') }}');
                $('#playerTeamDetailsModel .modal-body').css('height', 'unset');
            });
            // Reset Search Form And Empty Search Result Section
            $('#addNewPlayerModel .close').click(() => resetSearchForm());
            // Show And Hide Password
            showHidePassword('#hide_show', 'password');
            showHidePassword('#hide_show1', 'password_confirmation');


            // Search for Player
            $('#player_search_form .search').click(function (e) {
                e.preventDefault();
                let form = document.getElementById('player_search_form');
                let formData = new FormData(form);
                if ($('#player_search_form').find('input[name="name"]').val() == '' &&
                    $('#player_search_form').find('input[name="email"]').val() == '' &&
                    $('#player_search_form').find('input[name="cardid"]').val() == '') return;
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/searchAcceptedPlayerAjax') }}',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    beforeSend: function () {
                        $('#player_search_form .search').text('{{ trans('all.searching') }}').css({'pointer-events': 'none', 'opacity': '.7'});
                    },
                    error: function () {
                        $('#player_search_form .search').text('{{ trans('all.search') }}').css({'pointer-events': 'auto', 'opacity': '1'});
                    },
                    success: function (response) {
                        $('#player_search_form .search').text('{{ trans('all.search') }}').css({'pointer-events': 'auto', 'opacity': '1'});
                        if (!response.error) {
                            $('#addNewPlayerModel .search-result .row').html(response.data);
                            $('.search-result .card-img-top').height($('.search-result .card-img-top').width());
                        } else {
                            $('#addNewPlayerModel .search-result .row').html(`<div class="alert alert-warning text-center">${response.data}</div>`);
                        }
                    }
                });
            });

            // Send Invitation By Player To Other Player
            $('#addNewPlayerModel').on('click', '.player-send-invitation', function (e) {
                let playerId = e.target.dataset.playerid;
                let teamId = $('#addNewPlayerModel .search-result').data('teamid');
                {{--let isTeamHead = {{ (isset($clientTeamRequests) && count($clientTeamRequests) > 0) ? ($clientTeamRequests['teamHeadId'] == session('loggedUser')['id']) : 0 }};--}}
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/playerTeamRequest') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: 'Join',
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
            });

            $('#playerTeamDetailsModel').on('click', '.accept-invitation', function (e) {
                let acceptButton = $('.accept-invitation');
                let isJoinedTeam = e.target.dataset.isjoin;
                let id = e.target.dataset.id;
                if (isJoinedTeam == 'true' && id == undefined) {
                    swal('{{ trans('site.prevent-accept-invitation-msg') }}');
                } else {
                    $.ajax({
                        url: '{{ url(App::getLocale() . '/profile/playerAcceptInvitationAjax') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id
                        },
                        beforeSend: function () {
                            acceptButton.css({'pointer-events': 'none', 'opacity': '.7'});
                        },
                        error: function () {
                            acceptButton.css({'pointer-events': 'auto', 'opacity': '1'});
                        },
                        success: function (response) {
                            if (response.error) {
                                acceptButton.css({'pointer-events': 'auto', 'opacity': '1'});
                                $('.accept-invitation-error-message').removeClass('d-none').html(response.result);
                                setTimeout(() => {
                                    $('.accept-invitation-error-message').addClass('d-none').text('');
                                }, 10000);
                            } else {
                                acceptButton.css({'display': 'none', 'pointer-events': 'none', 'opacity': '0'});
                                $('.accept-invitation-success-message').removeClass('d-none').html(response.result);
                                setTimeout(() => {
                                    $('.accept-invitation-success-message').addClass('d-none').text('');
                                }, 7000);
                            }
                        }
                    });
                }
            });

            $(document).on('click', '#player_register_form .submit', function (e) {
                e.preventDefault();
                let button = $('#player_register_form .submit');
                let form = document.getElementById('player_register_form');
                let formData = new FormData(form);
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/playerRegisterNewPlayerAjax') }}',
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    data: formData,
                    beforeSend: function () {
                        button.text('{{ trans('site.joining') }}').css({'pointer-events': 'none', 'opacity': '.7'});
                    },
                    error: function () {
                        button.text('{{ trans('site.createaccount') }}').css({'pointer-events': 'auto', 'opacity': '1'});
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
                        button.text('{{ trans('site.createaccount') }}').css({'pointer-events': 'auto', 'opacity': '1'});
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
                if ($('#playerTeamDetailsModel').find('input[name="team-name"]').val() == '' &&
                    $('#playerTeamDetailsModel').find('input[name="file"]').val() == '') return;
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
                                $(`#player_team_item .image img, #playerTeamDetailsReadyModel .modal-body .image`).attr('src', `{{config('app.base_address')}}${response.data.logoImagePath}`);
                            }
                            $(`#player_team_item .name, #playerTeamDetailsReadyModel .modal-body .name`).text(`${response.data.name}`);
                            $('.edit-team-request-success-message').removeClass('d-none').html(response.result);
                            setTimeout(() => {
                                $('.edit-team-request-success-message').addClass('d-none').text('');
                                $('#playerTeamDetailsModel .close').click();
                            }, 1000);
                        }
                        button.text('{{ trans('auth.update') }}').css({'pointer-events': 'auto', 'opacity': '1'});
                    }
                });
            });

            function showHidePassword(element, attr) {
                console.log('showHidePassword');
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
                $('#player_search_form')[0].reset();                    // Reset the search form
                $('#addNewPlayerModel .search-result .row').html('');   // Empty The Search Result Box
            }

            // Ajax Called
            function callAjax(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function () {
                        $('#playerTeamDetailsModel .model-loader').removeClass('d-none');
                        $('#playerTeamDetailsModel .model-message').addClass('d-none');
                        $('#playerTeamDetailsModel .model-content-box').addClass('d-none');
                    },
                    success: function (response) {
                        console.log('response', response)
                        if (!response.error) {
                            $('#playerTeamDetailsModel .model-loader').addClass('d-none');
                            $('#playerTeamDetailsModel .model-message').addClass('d-none');
                            $('#playerTeamDetailsModel .model-content-box').removeClass('d-none');
                            $('#playerTeamDetailsModel').find('.modal-body').html(response.data);
                        } else {
                            $('#playerTeamDetailsModel .model-loader').addClass('d-none');
                            $('#playerTeamDetailsModel .model-message').removeClass('d-none').html(`<h4 class="mb-0">${response.result}</h4>`);
                            $('#playerTeamDetailsModel .model-content-box').addClass('d-none');
                            $('#playerTeamDetailsModel').find('.modal-body').html('');
                        }
                    }
                });
            }
        });
    </script>
@endpush
