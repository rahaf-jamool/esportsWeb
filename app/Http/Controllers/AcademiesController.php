<?php

namespace App\Http\Controllers;

use App\Facades\AcademiesService;
use App\Facades\PlayersService;
use App\Helpers\General\EndPoints;
use App\Services\ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AcademiesController extends Controller
{
    public function index(){

        $pageInfo['title'] = trans('site.home');
        $academies = AcademiesService::getList();
        // dd($academies);
        return view('academies.list',compact('pageInfo','academies'));
    }

    public function view($locale,$id){
        $pageInfo['title'] = trans('site.home');
        $academy = AcademiesService::getOne($id);
        $academy = $academy['result'];
        $players = PlayersService::getApiResponse(EndPoints::PlayersApi);
        // dd($academy['result']);
        return view('academies.view',compact('pageInfo','academy','players'));
    }


    public function academyGetTeamDetailsAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
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
                    $html = view('auth.account.Academy.ajax_team_details', compact('team'))->render();
                    return response()->json(['error' => false, 'data' => $html]);
                }
            } catch(\Exception $e) {
                return $this->serverErrorResponse();
            }
        }
        return 'Server Error, Method Not Allowed';
    }

//    public function renderAcademyFormAjax(Request $request)
//    {
//        if ($request->ajax()) {
//            try {
////                $countries = ApiService::GetDataByEndPoint(EndPoints::CountriesGetAllApi, session('mainToken'));
////                $clubTypes = ApiService::GetDataByEndPoint(EndPoints::GetClubTypesGetAllApi, session('mainToken'));
//                $teamId = session('teamId');
//                $team = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamDetailsApi . $teamId, session('token'));
//                $princedoms = ApiService::GetDataByEndPoint(EndPoints::PrincedomsGetAllApi, session('mainToken'));
//                $html = view('auth.account.Academy.academy-registration-form', compact('princedoms', 'team'))->render();
//                return response()->json(['error' => false, 'data' => $html]);
//            } catch(\Exception $e) {
////                return response()->json(['error' => true, 'data' => $e->getMessage()]);
//                return $this->serverErrorResponse();
//            }
//        }
//        return 'Server Error, Method Not Allowed';
//    }

    public function renderAllPlayerAcademyParticipantsAjax(Request $request)
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
                $html = view('auth.account.Academy.accepted-players-academy-participant', compact('players', 'playersIds'))->render();
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
