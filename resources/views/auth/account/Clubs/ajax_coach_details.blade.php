<div class="person-info-area">
	<div class="your-order">
		<div class="row text-center">
			<div class="col-12 col-md-8 col-lg-6 col-xl-4 mx-auto mb-3">
				@if($data['personInfo']['imagePath'] != '' )
                    <img class="responsive" src="{{ config('app.base_address') . $data['personInfo']['imagePath']}}" width="250" alt="logo"
                    onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';" style="border-radius: 50%;height: 70%;">
                @else
                    <img class="responsive" src="{{  url(asset('SD08/default-user-image.png')) }}" width="250" alt="logo"/>
                @endif
			</div>
			    <div class="col-12"></div>
			    <h4 class="p-4">{!! trans('auth.personal-information') !!}</h4>
				@if (!empty($data['clubName']))

				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
    						{{ trans('individually.clubName') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
    						{{ !is_null($data['clubName']) ? $data['clubName'] : '-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['joinDate']))

                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('site.join-date') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($data['joinDate']) ? \Carbon\Carbon::parse($data['joinDate'])->format('Y-m-d') : '-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($data['name']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{ trans('auth.name') }} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($data['name']) ? $data['name'] : '-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($data['client']['type']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{ trans('site.type') }} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['client']['type'])?$data['client']['type']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['phone']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.phone')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['phone'])?$data['personInfo']['phone']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['email']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.email')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['email'])?$data['personInfo']['email']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['gender']))

				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.gender')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
							@if (!is_null($data['personInfo']['gender']) && $data['personInfo']['gender'] == 'M')
                                {{trans('individually.male')}}
                            @elseif (!is_null($data['personInfo']['gender']) && $data['personInfo']['gender'] == 'F')
                                {{trans('individually.female')}}
                            @endif
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['socialStatus']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.socialStatus')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
							@if ($data['personInfo']['socialStatus'] == 'Married')
                                @if (App::getLocale() == 'en')
                                    {{ !is_null($data['personInfo']['socialStatus'])?$data['personInfo']['socialStatus']:''}}
                                @else
                                    {{trans('individually.married')}}
                                @endif
                            @elseif ($data['personInfo']['socialStatus'] == 'Single')
                                @if (App::getLocale() == 'en')
                                    {{ !is_null($data['personInfo']['socialStatus'])?$data['personInfo']['socialStatus']:''}}
                                @else
                                    {{trans('individually.single')}}
                                @endif
                            @endif
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['birthDate']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.birthDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['birthDate']) ? \Carbon\Carbon::parse($data['personInfo']['birthDate'])->format('Y-m-d') : '-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['uaeResidency']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('Individually.uaeResidency')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($data['personInfo']['uaeResidency']) ? ($data['personInfo']['uaeResidency'] == 1 ? trans('Individually.yes') : trans('Individually.no')) : '-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($data['personInfo']['nationalityName']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.nationalityName')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['nationalityName'])?$data['personInfo']['nationalityName']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['princedomName']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.princedomName')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['princedomName'])?$data['personInfo']['princedomName']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['educationLevelName']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('Individually.educational-level')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
    						{{ !is_null($data['personInfo']['educationLevelName'])?$data['personInfo']['educationLevelName']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['membershipNumber']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-8 text-left">
                        <strong class="product-quantity">
                            {{trans('Individually.membershipNumber')}} :
                        </strong>
                    </div>
                    <div class="col">
                        <p>
                            {{ !is_null($data['personInfo']['membershipNumber'])?$data['personInfo']['membershipNumber']:'-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($data['personInfo']['membershipEndDate']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-8 text-left">
                        <strong class="product-quantity">
                            {{trans('Individually.membershipEndDate')}} :
                        </strong>
                    </div>
                    <div class="col">
                        <p>
                            {{ !is_null($data['personInfo']['membershipEndDate']) ? \Carbon\Carbon::parse($data['personInfo']['membershipEndDate'])->format('Y-m-d') : '-------'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($data['personInfo']['idCardNumber']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.idCardNumber')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['idCardNumber'])?$data['personInfo']['idCardNumber']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['passport']['number']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('Individually.passport-number')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
	    					{{ !is_null($data['personInfo']['passport']['number'])?$data['personInfo']['passport']['number']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['passport']['endDate']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.passportendDate')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['passport']['endDate']) ? \Carbon\Carbon::parse($data['personInfo']['passport']['endDate'])->format('Y-m-d') : '-------'}}
						</p>
					</div>
				</div>
				@endif
				<h4 class="p-4">{{trans('individually.social-media')}}</h4>
				@if (!empty($data['personInfo']['facebook']))

				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('individually.facebook')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['facebook'])?$data['personInfo']['facebook']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['twitter']))

				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('individually.twitter')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['twitter'])?$data['personInfo']['twitter']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['instagram']))
				<div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('individually.instagram')}} :
						</strong>
					</div>
					<div class="col-6">
						<p>
						{{ !is_null($data['personInfo']['instagram'])?$data['personInfo']['instagram']:'-------'}}
						</p>
					</div>
				</div>
				@endif
				@if (!empty($data['personInfo']['discord']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('individually.discord')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($data['personInfo']['discord'])?$data['personInfo']['discord']:'----'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($data['personInfo']['youTube']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('individually.youtube')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($data['personInfo']['youTube'])?$data['personInfo']['youTube']:'----'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($data['personInfo']['tikTok']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('individually.tikTok')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($data['personInfo']['tikTok'])?$data['personInfo']['tikTok']:'----'}}
                        </p>
                    </div>
                </div>
				@endif
				@if (!empty($data['personInfo']['twitch']))
                <div class="col-12 col-lg-6 m-2 border-bottom mx-auto p-2 d-flex justify-content-between">
                    <div class="col-6 text-left">
                        <strong class="product-quantity">
                            {{trans('individually.twitch')}} :
                        </strong>
                    </div>
                    <div class="col-6">
                        <p>
                            {{ !is_null($data['personInfo']['twitch']) ? $data['personInfo']['twitch'] : '----'}}
                        </p>
                    </div>
                </div>
				@endif
				<h4 class="p-4">{{trans('auth.games')}}</h4>
				@if (!empty($data['coachGames']))
				<div class="col-12  mb-2 border-bottom mx-auto pb-2 d-flex justify-content-between">
					<div class="col-6 text-left">
						<strong class="product-quantity">
						{{trans('auth.games')}} :
						</strong>
					</div>
					<div class="col-6">
						  @if(count($data['coachGames']) > 0)
							@foreach($data['coachGames'] as $val)
								<p>{{$val['gameName']}}</p>
							@endforeach
						@endif
					</div>
				</div>
				@endif
		</div><!--.row-->
	</div><!--.your-order-->
</div>
