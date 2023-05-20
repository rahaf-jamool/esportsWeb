@foreach($players as $player)
    <div class="col-12 col-sm-6 col-lg-4 mx-auto mb-4">
        <div class="border w-100">
            @if($player['personInfo']['imagePath'] != '' )
                <img class="card-img-top" src="{{ config('app.base_address') . $player['personInfo']['imagePath']}}" alt="Player Image"
                     onerror="this.onerror=null;this.src='{{asset('SD08/default-user-image.png')}}';">
            @else
                <img class="card-img-top" src="{{  url(asset('SD08/default-user-image.png')) }}" alt="player Image"/>
            @endif
            <div class="card-body p-3">
                <h6 class="card-title my-2" style="font-size: 15px;">{{ $player['name'] }}</h6>
                <p class="card-text mb-0" style="font-size: 13px;">{{ trans('auth.email') . ' : ' . $player['personInfo']['email'] }}</p>
                <p class="card-text" style="font-size: 13px;">{{ trans('auth.birthDate') . ' : ' .  \Carbon\Carbon::parse($player['personInfo']['birthDate'])->format('Y-m-d') }}</p>
                <button class="btn btn-outline-dark btn-sm btn-block player-send-invitation" data-playerid="{{ $player['id'] }}">{{ trans('site.send-invitation') }}</button>
            </div>
        </div>
    </div>
@endforeach
