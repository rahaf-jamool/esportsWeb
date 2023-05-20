<div class="person-info-area">
	<div class="your-order">
		<div class="row text-center">
			<div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto mb-3">
				@if($player['personInfo']['imagePath'] != '' )
                    <img class="responsive" src="{{ config('app.base_address') . $player['personInfo']['imagePath']}}" width="250" alt="logo"
                    onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="border-radius: 50%;height: 70%;">
                @else
                    <img class="responsive" src="{{  url(asset('SD08/default-user-image.png')) }}" width="250" alt="logo"/>
                @endif
			</div> 
			    <div class="col-12"></div>
			    <h4 class="p-4">{!! trans('auth.personal-information') !!}</h4>
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
    						{{ trans('individually.clubName') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
    						{{ !is_null($player['clubName']) ? $player['clubName'] : '-------'}}
						</p>
					</div>
				</div>
				@if (!empty($player['nationalTeamName']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('individually.nationalTeamName') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($player['nationalTeamName']) ? $player['nationalTeamName'] : '-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($player['name']))

                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('auth.name') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($player['name']) ? $player['name'] : '-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($player['client']['type']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{ trans('site.type') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['client']['type'])?$player['client']['type']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['phone']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.phone')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['phone'])?$player['personInfo']['phone']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['email']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.email')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['email'])?$player['personInfo']['email']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['gender']))

				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.gender')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
							@if (!is_null($player['personInfo']['gender']) && $player['personInfo']['gender'] == 'M')
                                {{trans('individually.male')}}
                            @elseif (!is_null($player['personInfo']['gender']) && $player['personInfo']['gender'] == 'F')
                                {{trans('individually.female')}}
                            @endif
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['socialStatus']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.socialStatus')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
							@if ($player['personInfo']['socialStatus'] == 'Married')
                                @if (App::getLocale() == 'en')
                                    {{ !is_null($player['personInfo']['socialStatus'])?$player['personInfo']['socialStatus']:''}}
                                @else
                                    {{trans('individually.married')}}
                                @endif
                            @elseif ($player['personInfo']['socialStatus'] == 'Single')
                                @if (App::getLocale() == 'en')
                                    {{ !is_null($player['personInfo']['socialStatus'])?$player['personInfo']['socialStatus']:''}}
                                @else
                                    {{trans('individually.single')}}
                                @endif
                            @endif
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['birthDate']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.birthDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['birthDate']) ? \Carbon\Carbon::parse($player['personInfo']['birthDate'])->format('Y-m-d') : '-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['nationalityName']))
                
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.nationalityName')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['nationalityName'])?$player['personInfo']['nationalityName']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['princedomName']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.princedomName')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['princedomName'])?$player['personInfo']['princedomName']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['educationLevelName']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('Individually.educational-level')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
    						{{ !is_null($player['personInfo']['educationLevelName'])?$player['personInfo']['educationLevelName']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['membershipNumber']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-8 text-left">
                        <strong class="product-quantity">
                            {{trans('Individually.membershipNumber')}} :
                        </strong>
                    </div>
                    <div class="col">
                        <p>
                            {{ !is_null($player['personInfo']['membershipNumber'])?$player['personInfo']['membershipNumber']:'-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($player['personInfo']['membershipEndDate']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-8 text-left">
                        <strong class="product-quantity">
                            {{trans('Individually.membershipEndDate')}} :
                        </strong>
                    </div>
                    <div class="col">
                        <p>
                            {{ !is_null($player['personInfo']['membershipEndDate']) ? \Carbon\Carbon::parse($player['personInfo']['membershipEndDate'])->format('Y-m-d') : '-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($player['personInfo']['idCardNumber']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.idCardNumber')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['idCardNumber'])?$player['personInfo']['idCardNumber']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['passport']['number']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('Individually.passport-number')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
	    					{{ !is_null($player['personInfo']['passport']['number'])?$player['personInfo']['passport']['number']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['passport']['endDate']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.passportendDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['passport']['endDate']) ? \Carbon\Carbon::parse($player['personInfo']['passport']['endDate'])->format('Y-m-d') : '-------'}}
						</p>
					</div>
				</div>
				<h4 class="p-4">{{trans('individually.social-media')}}</h4>
				@endif
				@if (!empty($player['personInfo']['facebook']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('individually.facebook')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['facebook'])?$player['personInfo']['facebook']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['twitter']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('individually.twitter')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['twitter'])?$player['personInfo']['twitter']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['instagram']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('individually.instagram')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($player['personInfo']['instagram'])?$player['personInfo']['instagram']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($player['personInfo']['discord']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('individually.discord')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($player['personInfo']['discord'])?$player['personInfo']['discord']:'----'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($player['personInfo']['youTube']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('individually.youtube')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($player['personInfo']['youTube'])?$player['personInfo']['youTube']:'----'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($player['personInfo']['tikTok']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('individually.tikTok')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($player['personInfo']['tikTok'])?$player['personInfo']['tikTok']:'----'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($player['personInfo']['twitch']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('individually.twitch')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($player['personInfo']['twitch'])?$player['personInfo']['twitch']:'----'}}
                        </p>
                    </div>
                </div>
				@endif
				<h4 class="p-4">{{trans('individually.game-platform')}}</h4>
				@if (!empty($player['personInfo']['playerPlatforms']))
				<div class="col-12  mb-2 border-bottom mx-auto pb-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('individually.game-platform')}} :
						</strong>
					</div>
					<div class="col-6">
                        @if(count($player['playerPlatforms']) > 0)
							@foreach($player['playerPlatforms'] as $val)
								<p>{{$val['platformName']}}</p>
							@endforeach
						@endif
					</div>
				</div>
				@endif
				<h4 class="p-4">{{trans('auth.games')}}</h4>
				@if (!empty($player['personInfo']['playerGames']))
				<div class="col-12  mb-2 border-bottom mx-auto pb-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.games')}} :
						</strong>
					</div>
					<div class="col-6">
						  @if(count($player['playerGames']) > 0)
							@foreach($player['playerGames'] as $val)
								<p>{{$val['gameName']}}</p>
							@endforeach
						@endif
					</div>
				</div>
				@endif
		</div><!--.row-->
        <div class="col-12">
            <h4 class="p-4 text-center">{{trans('individually.subscribed-events')}}</h4>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">{{ trans('all.image') }}</th>
                        <th scope="col">{{ trans('all.name') }}</th>
                        <th scope="col">{{ trans('site.location') }}</th>
                        <th scope="col">{{ trans('site.Startdate') }}</th>
                        <th scope="col">{{ trans('site.endtdate') }}</th>
                        <th scope="col">{{ trans('site.details') }} </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($events) > 0)
                        @foreach($events as $event)
                            <tr id="player_subscribed_events_details" data-id="{{ $event['id'] }}" style="cursor: pointer;">
                                <th scope="row" style="vertical-align: middle">
                                    @if(!is_null($event['mainImagePath']))
                                        <img src="{{ config('app.base_address') . $event['mainImagePath']}}" width="50" height="50" alt="event image"
                                             onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}'">
                                    @else
                                        <img class="responsive" src="{{  url(asset('SD08/default-user-image.png')) }}" width="50" height="50" alt="event image"/>
                                    @endif
                                </th>
                                <td style="vertical-align: middle">{{ !is_null($event['name']) ? $event['name'] : '------' }}</td>
                                <td style="vertical-align: middle">{{ !is_null($event['location']) ? $event['location'] : '------' }}</td>
                                <td style="vertical-align: middle">{{ !is_null($event['startDate']) ? \Carbon\Carbon::parse($event['startDate'])->format('Y-m-d') : '------' }}</td>
                                <td style="vertical-align: middle">{{ !is_null($event['endDate']) ? \Carbon\Carbon::parse($event['endDate'])->format('Y-m-d') : '------' }}</td>
                                <td style="text-align:center;vertical-align: middle"><a type="button" href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>
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
