@foreach ($events as $month =>  $event)
<details>
        <summary>
            <span data-css-icon="square plus outline">
                <span>
                    <h5>{{\Carbon\Carbon::parse(mktime(0, 0, 0, $month))->translatedFormat('F')}}</h5>
                </span>
                <i></i>
            </span>
        </summary>
        <div>
            <table class="table table-borderless">
                <tbody>
                    @foreach($event as $day => $item)
                        @foreach ($item['events'] as $event)
                            <tr>
                                <td>
                                    <span class="date">{{$day}}</span>
                                </td>
                                <td class="text">
                                    <a href="{{url(App::getLocale() . '/events/'.$event['eventClassificationId'].'/'. $event['id'] .'/view')}}">
                                        <h4>{{$event['name']}}</h4>
                                    </a>
                                    <small><b>{{$event['location']}}</b> {{ \Carbon\Carbon::parse($event['startDate'])->format('H:m') }}</small>
                                </td>
                                <td>{{ $event['eventState'] }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
</details>
@endforeach