<?php

namespace App\Http\Controllers;

use App\Facades\PlayersService;
use App\Helpers\General\EndPoints;
use Illuminate\Http\Request;

class PlayersController extends Controller
{
    public function index(){
        $pageInfo['title'] = trans('site.players');
        $players = PlayersService::getApiResponse(EndPoints::PlayersApi);
        return view('Players.list',compact('pageInfo','players'));
    }

    public function view($locale,$id){
        $pageInfo['title'] = trans('site.players');
        $player = PlayersService::getOne($id);
        $player = $player['result'];
        // dd($player);
        return view('Players.view',compact('pageInfo','player'));
    }
}
