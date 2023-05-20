@extends('layouts.master')
@section('title' , config('app.name'). " - ". $pageInfo['title'])
@section('og-description' , config('app.description'))
@section('description', config('app.description'))
@section('keywords' , config('app.keyword'))
@section('og-title' , config('app.name')  ."-".  $pageInfo['title'])
@section('og-image' , url(asset('SD08/logo.jpg')))
@section('og-url' , url(Request::url()))
@section('page-style', asset('assets/css/account.css'))

@section('content')
<!-- Start header -->
<div class="about-header">
    <div class="title-about">
        {{$pageInfo['title']}}
    </div>
    <div class="image-home">
        <img class="" src="{{  url(asset('assets/img/1.jpg')) }} " alt="logo">
    </div>
</div>
<!-- End header -->
<section class="account-container">
	<div class="col-xs-12 visible-xs">
		<div class="account-toggle">
			<div class="account-navbar-toggle">
				<span></span>
			</div>
			<label>
				{{ trans('all.account-menu') }}
			</label>
		</div>
	</div>
	<div class="account-header">
		<div class="card-body">
			<ul class="account-nav nav nav-tabs">
				<li class="account-link active">
					<a data-id="#info">
						<i class="fa fa-user"></i>
						<span>
							{{ trans('auth.accountinfo') }}
						</span>
					</a>
				</li>
                <li class="account-link">
                    <a data-id="#articles">
                        <i class="fa fa-user"></i>
                        <span>
                            {{ trans('site.articles') }}
                        </span>
                    </a>
                </li>
                <li class="account-link">
                    <a data-id="#membershipCard">
                        <i class="fa fa-id-card" aria-hidden="true"></i>
                        <span>
                            {{ trans('site.membership-card') }}
                        </span>
                    </a>
                </li>

			</ul>
		</div>
	</div>
	<div class="col-12 col-md-10 col-lg-9 col-xl-10 mx-auto" id="account-father">
		{{-- <div class="container p-0" id="account-content"> --}}
			<div class="tab-content">
				<div id="info" class="tab-pane active">
					@include('auth.account.Content-Creator.info_static', compact('user'))
				</div>
				<div id="articles" class="tab-pane">
					@include('auth.account.articles', compact('user'))
				</div>
				<div id="membershipCard" class="tab-pane">
                    @include('auth.account.Content-Creator.membership-card', compact('user'))
				</div>
			</div>
		{{-- </div> --}}
	</div>
</section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.nav-tabs li').click(function () {
                $(this).addClass('active').siblings().removeClass('active');
                var Id = $(this).find('a').data('id');
                $(`${Id}`).addClass('active').siblings().removeClass('active');
            });
            // Player send request to create his team | Team Management Send (team make request)
            $('#send_team_request').click(function () {
                let name = $('input[name="team-name"]').val();
                let files = $('#team_request_file')[0].files;
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
                                $('#send_team_request').css({'pointer-events': 'none', 'opacity': '.7'});
                            },
                            error: function () {
                                $('#send_team_request').css({'pointer-events': 'auto', 'opacity': '1'});
                            },
                            success: function (response) {
                                if (response.error) {
                                    $('.team-request-error-message').removeClass('d-none').text(response.result);
                                    setTimeout(() => {
                                        $('.team-request-error-message').addClass('d-none').text('');
                                    }, 5000);
                                } else {
                                    $('.team-request-success-message').removeClass('d-none').text(response.result);
                                    setTimeout(() => {
                                        $('.team-request-success-message').addClass('d-none').text('');
                                    }, 5000);
                                }
                                $('#send_team_request').css({'pointer-events': 'auto', 'opacity': '1'});
                                $('#team_request_form')[0].reset();         // Reset the model form
                                $('.button-close').click();                 // Close the Model
                            }
                        });
                    }
                }
                reader.readAsDataURL(files[0]);
            });

            // Player send request to leave the team
            $('#teamManagement').on('click', '#player_leave_team', function () {
                if (!confirm('{{ trans('site.confirm-player-leave-team') }}')) return;
                let btnElement = $('#player_leave_team');
                $.ajax({
                    url: '{{ url(App::getLocale() . '/profile/playerTeamRequest') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: 'leave'
                    },
                    beforeSend: function () {
                        btnElement.css({'pointer-events': 'none', 'opacity': '.7'});
                    },
                    error: function () {
                        btnElement.css({'pointer-events': 'auto', 'opacity': '1'});
                    },
                    success: function (response) {
                        if (response.error) {
                            $('.player-team-error-message').removeClass('d-none').text(response.result);
                            setTimeout(() => {
                                $('.player-team-error-message').addClass('d-none').text('');
                            }, 5000);
                        } else {
                            $('.player-team-success-message').removeClass('d-none').text(response.result);
                            setTimeout(() => {
                                $('.player-team-success-message').addClass('d-none').text('');
                            }, 5000);
                        }
                        btnElement.css({'pointer-events': 'auto', 'opacity': '1'});
                        // $('.button-close').click();                 // Close the Model
                    }
                });
            });

            // The Player Manager decide to remove other Player
            $('#teamManagement').on('click', '.player-remove-player', function (e) {
                if (!confirm('{{ trans('site.confirm-remove-player') }}')) return;
                let playerId = e.target.dataset.id;
                let teamId = e.target.dataset.teamid;
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
                            $('.player-team-error-message').removeClass('d-none').text(response.result);
                            setTimeout(() => {
                                $('.player-team-error-message').addClass('d-none').text('');
                            }, 7000);
                        } else {
                            $('.player-team-success-message').removeClass('d-none').text(response.result);
                            setTimeout(() => {
                                $('.player-team-success-message').addClass('d-none').text('');
                            }, 7000);
                        }
                        // btnElement.css({'pointer-events': 'auto', 'opacity': '1'});
                        // $('.button-close').click();                 // Close the Model
                    }
                });
            });
	    });
    </script>
@endpush
