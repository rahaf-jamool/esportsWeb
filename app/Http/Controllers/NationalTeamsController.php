<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\ClubsService;
use App\Facades\NationalTeamsService;
use App\Facades\PlayersService;
use App\Helpers\General\EndPoints;
use App\Services\ApiService;
use Symfony\Component\HttpFoundation\Response;
class NationalTeamsController extends Controller
{
    public function listGames(){
        $pageInfo['title'] = trans('site.nationalteams');
        $clubs = ClubsService::getApiResponse(EndPoints::GetClubsApi);
        $NationalGames = NationalTeamsService::getApiResponse(EndPoints::GetNationalTeamsGamesApi);
    //    dd($NationalGames);
        return view('national-teams.listByGames',compact('pageInfo','NationalGames'));
    }

    public function listTeamsByGames($locale,$id){
        $pageInfo['title'] = trans('site.home');

       $NationalTeams = ApiService::GetDataByEndPoint(EndPoints::GetNationalByGameApi. '/' . $id ,session('mainToken'));
//   dd($NationalTeams);
        return view('national-teams.listbygame',compact('pageInfo','NationalTeams'));
    }
    public function listTeamsByCategories($locale,$id){
        $pageInfo['title'] = trans('site.home');

       $NationalTeams = ApiService::GetDataByEndPoint(EndPoints::GetByNationalTeamApi. '/' . $id ,session('mainToken'));
    //    dd($NationalTeams);
        return view('national-teams.list',compact('pageInfo','NationalTeams'));
    }
    public function detailsTeams($locale,$id){
        $pageInfo['title'] = trans('site.home');

       $NationalTeam = ApiService::GetDataByEndPoint(EndPoints::GetByNationalTeamDetailsApi. '/' . $id ,session('mainToken'));
       $NationalTeam = $NationalTeam['result'];
   //dd($NationalTeam);
        return view('national-teams.view',compact('pageInfo','NationalTeam'));
    }



    public function index(){
        $pageInfo['title'] = trans('site.nationalteams');
        $clubs = ClubsService::getApiResponse(EndPoints::GetClubsApi);
        $NationalTeams = NationalTeamsService::getApiResponse(EndPoints::GetNationalTeamsApi);
        // dd($NationalTeams);
        return view('national-teams.list',compact('pageInfo','NationalTeams'));
    }

    public function view($locale,$id){
        $pageInfo['title'] = trans('site.home');
        // $club = ClubsService::getOne($id);
        // $club = $club['result'];
       // dd($players);
       $NationalTeam = NationalTeamsService::getOne($id);
       $NationalTeam = $NationalTeam['result'];
       $players = PlayersService::getApiResponse(EndPoints::PlayersApi . '?pageNumber=1&FilterParams%5B0%5D.ColumnName=NationalTeamId&FilterParams%5B0%5D.FilterValue=' . $NationalTeam['id'] .'&FilterParams%5B0%5D.FilterOption=IsEqualTo&Gather=AND&OrderColumn=Id&OrderType=DESC&QuickFilter=');
        return view('national-teams.view',compact('pageInfo','NationalTeam','players'));
    }
}
