<?php

namespace App\Http\Controllers;

use App\Facades\EventsService;
use App\Helpers\General\EndPoints;
use Illuminate\Http\Request;
use App\Services\ApiService;
use Symfony\Component\HttpFoundation\Response;
class EventsController extends Controller
{
    public function subscribeEvent($local ,$id, Request $request)
    {
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $data = $request->all();


                if (isset($data['orgPlayerIds'])) {
                    $data['playerIds'] = json_decode($data['orgPlayerIds'], true);
                }
                if (isset($data['orgTeamIds'])) {
                    $data['orgTeamIds'] = json_decode($data['orgTeamIds'], true);
                }



             //dd($data );
               $response = ApiService::PostDataByEndPoint(EndPoints::SendClientJoinEventApi, $data, $token);


              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }


    public function index($local,$id,$slug){
        $pageInfo['title'] = trans('site.events');
        // $events = EventsService::getByclassification($id);

        $events = EventsService::getApiResponse(EndPoints::GetEventsByclassificationIdApi . '?classificationId=' . $id  );
       // dd($events);


       switch($id) {
            case('3'):
                $pageInfo['title'] = trans('site.official');
                break;
            case('4'):
                $pageInfo['title'] = trans('site.accredited');
                break;
            case('5'):
                $pageInfo['title'] = trans('site.refresher');
                break;
            case('6'):
                $pageInfo['title'] = trans('site.trainingcourses');
                break;
            case('7'):
                $pageInfo['title'] = trans('site.community-activities');
                break;
        }

//        dd($events);
        return view('events.list',compact('pageInfo','events'));
    }

    public function view1($local,$slug,$id){
        $pageInfo['title'] = trans('site.events');

        $event = EventsService::getApiResponse(EndPoints::GetEventsApi . '/' . $id );
        //        dd($event);
        $event = $event['result'];
       switch($slug) {
            case('official'):
                return view('events.official.view',compact('pageInfo','event'));
                break;
            case('accredited'):
                return view('events.accredited.view',compact('pageInfo','event'));
                break;
            case('refresher'):
                return view('events.refresher.view',compact('pageInfo','event'));
                break;
            case('trainingcourses'):
                return view('events.Training-courses.view',compact('pageInfo','event'));
                break;
            case('community-activities'):
                return view('events.community-activities.view',compact('pageInfo','event'));
                break;
            }
    }


        public function view($local,$catId,$id){
            $pageInfo['title'] = trans('site.events');
            $user = session()->has('loggedUser') ? session('loggedUser') : '';
            $token = session('token');
            $clientTeamPlayers=[];
            $clientTeams=[];
            if($user !=""){
                $IsCurrentUserInEvent = ApiService::GetDataByEndPoint(EndPoints::IsCurrentUserInEventApi. '/' . $id , $token);
                //dd($IsCurrentUserInEvent);
                switch ($user['client']['type']) {
                    case 'Player' :
                        $clientTeams = ApiService::GetDataByEndPoint(EndPoints::GetPlayerTeamDetailsApi , $token);
                        $clientTeamPlayers = !$clientTeams['hasErrors'] ? $clientTeams['result']['players'] : [];
                       // $clientTeamPlayers = $clientTeams['players'];
                      // dd($clientTeams);


                        $clientTeams = !$clientTeams['hasErrors'] ? $clientTeams['result'] : [];
                     //   $clientTeams = $clientTeams['result'];
                       // dd($clientTeams);

                        $user = ApiService::GetDataByEndPoint(EndPoints::GetPlayerInfoApi,$token);
                        $user = $user['result'];
                        break;
                    case 'Club':
                        $clientTeamPlayers = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayersApi , $token);
                        $clientTeams = ApiService::GetDataByEndPoint(EndPoints::GetOrgClientAcceptedTeamsApi , $token);
                        $clientTeams = $clientTeams['result'];
                        $user = ApiService::GetDataByEndPoint(EndPoints::GetClubsInfoApi,$token);
                        $user = $user['result'];
                        break;
                    case 'Academy':
                        $clientTeamPlayers = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayersApi , $token);
                        $clientTeams = ApiService::GetDataByEndPoint(EndPoints::GetOrgClientAcceptedTeamsApi , $token);
                        $clientTeams = $clientTeams['result'];
                        $user = ApiService::GetDataByEndPoint(EndPoints::GetAcademiesInfoApi,$token);
                        $user = $user['result'];
                        break;
                    default:
                        break;
                }
               // $user['isTeamLeader']= false;

            } else {
                $IsCurrentUserInEvent =false;
            }
             //dd($clientTeamPlayers);
            //  dd($user);
                $event = EventsService::getApiResponse(EndPoints::GetEventsApi . '/' . $id );
                $event = $event['result'];

    // dd($IsCurrentUserInEvent);

            switch($catId) {
                    case('3'):
                        $pageInfo['title'] = trans('site.official');
                        break;
                    case('4'):
                        $pageInfo['title'] = trans('site.accredited');
                        break;
                    case('5'):
                        $pageInfo['title'] = trans('site.refresher');
                        break;
                    case('6'):
                        $pageInfo['title'] = trans('site.trainingcourses');
                        break;
                    case('7'):
                        $pageInfo['title'] = trans('site.community-activities');
                        break;
                    }
            return view('events.view',compact('pageInfo','event','user','clientTeamPlayers','clientTeams','IsCurrentUserInEvent'));
        }


        public function eventCalendar(Request $request)
        {
            $pageInfo['title'] = trans('site.events');
            $EventClassifications =  EventsService::getApiResponse(EndPoints::GetEventClassificationsApi);

            if ($request->ajax()) {
                $EventsGroupedByDate =  EventsService::getApiResponse(EndPoints::GetEventsGroupedByDateApi, $request->classificationId);
                $events = [];
                if (count($EventsGroupedByDate) > 0) {
                    foreach($EventsGroupedByDate as $event) {
                        $events[$event['date']['month']][$event['date']['day']]['events'] = $event['events'];
                    }
                }
                //            dd($events);
                $html = view('events.ajax-calendar-events', compact('pageInfo','EventsGroupedByDate','events'))->render();
                return response()->json(['data' => $html]);

            }
            $EventsGroupedByDate =  EventsService::getApiResponse(EndPoints::GetEventsGroupedByDateApi);
                $events = [];
                if (count($EventsGroupedByDate) > 0) {
                    foreach($EventsGroupedByDate as $event) {
                        $events[$event['date']['month']][$event['date']['day']]['events'] = $event['events'];
                    }
                }
            return view('events.calendar-events',compact('pageInfo','EventClassifications','EventsGroupedByDate','events'));
        }

}
