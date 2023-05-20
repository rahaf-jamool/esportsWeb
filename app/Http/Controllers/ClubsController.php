<?php

namespace App\Http\Controllers;

use App\Facades\ClubsService;
use App\Facades\CountriesService;
use App\Facades\NationalityService;
use App\Facades\PlatformService;
use App\Facades\PlayersService;
use App\Helpers\General\EndPoints;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class ClubsController extends Controller
{
    public function index(){

        $pageInfo['title'] = trans('site.home');
        $clubs = ClubsService::getApiResponse(EndPoints::GetClubsApi);
        // dd($clubs);
        return view('clubs.list',compact('pageInfo','clubs'));
    }

    public function view($locale,$id){
        $pageInfo['title'] = trans('site.home');
        $club = ClubsService::getOne($id);
        $club = $club['result'];
            // $clubId = $club['id'];
        // $players = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayersApi . '/' . $clubId , session('mainToken'));
        $players = PlayersService::getApiResponse(EndPoints::PlayersApi);
         //dd($club['id]);
        // dd($players);
        return view('clubs.view',compact('pageInfo','club','players'));
    }

    public function clubGetTeamDetailsAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $response = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamRequestsApi, session('token'));
                $response = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamDetailsApi . $request->id, session('token'));
                $team = $response['result'];
//                dd($team);
                if (count($team) > 0) {
                    if (!session()->has('teamId')) {
                        session()->put('teamId', $team['id']);
                    } else {
                        session()->forget('teamId');
                        session()->put('teamId', $team['id']);
                    }
                    $html = view('auth.account.Clubs.ajax_team_details', compact('team'))->render();
                    return response()->json(['error' => false, 'data' => $html]);
                }
            } catch(\Exception $e) {
//                dd($e->getMessage());
                return $this->serverErrorResponse();
            }
        }
        return 'Server Error, Method Not Allowed';
    }


    public function renderClubEditFormAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $teamDetails = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamDetailsApi . $request->teamId, session('token'));
                $teamDetails = $teamDetails['result'];
                $html = view('auth.account.Clubs.edit-team-details', compact('teamDetails'))->render();
                return response()->json(['error' => false, 'data' => $html]);
            } catch(\Exception $e) {
//                return response()->json(['error' => true, 'data' => $e->getMessage()]);
                return $this->serverErrorResponse();
            }
        }
        return 'Server Error, Method Not Allowed';
    }

//    public function renderClubFormAjax(Request $request)
//    {
//        if ($request->ajax()) {
//            try {
//                $teamId = session('teamId');
//                $team = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamDetailsApi . $teamId, session('token'));
//                $princedoms = ApiService::GetDataByEndPoint(EndPoints::PrincedomsGetAllApi, session('mainToken'));
//                $html = view('auth.account.Clubs.club-registration-form', compact('princedoms', 'team'))->render();
//                return response()->json(['error' => false, 'data' => $html]);
//            } catch(\Exception $e) {
////                return response()->json(['error' => true, 'data' => $e->getMessage()]);
//                return $this->serverErrorResponse();
//            }
//        }
//        return 'Server Error, Method Not Allowed';
//    }

    public function renderAllPlayerClubParticipantsAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $playersIds = [];
                $teamId = session('teamId');
                $team = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamDetailsApi . $teamId, session('token'));
                foreach ($team['result']['players'] as $player):
                    $playersIds[] = $player['id'];
                endforeach;
                $players = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayersApi, session('token'));
                $html = view('auth.account.Clubs.accepted-players-club-participant', compact('players', 'playersIds'))->render();
                return response()->json(['error' => false, 'data' => $html]);
            } catch(\Exception $e) {
//                return response()->json(['error' => true, 'data' => $e->getMessage()]);
                return $this->serverErrorResponse();
            }
        }
        return 'Server Error, Method Not Allowed';
    }

    private function serverErrorResponse()
    {
        return response()->json([
            'error' => true,
            'result' => trans('all.server-error-msg')
        ]);
    }

    private function invalidResponse($message = null)
    {
        return response()->json([
            'error' => true,
            'result' => is_null($message) ? trans('auth.invalid-data') : trans('validation-messages.' . $message)
        ]);
    }

}
