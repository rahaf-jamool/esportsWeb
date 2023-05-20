<?php

namespace App\Http\Controllers;

use App\Facades\BlocksService;
use App\Facades\BlogService;
use App\Facades\ClubsService;
use App\Facades\EventsService;
use App\Facades\PlayersService;
use App\Helpers\General\EndPoints;
use App\Services\ApiService;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    // private $token;

    // function __construct() {
    //     $this->token = session()->has('mainToken') ? session('mainToken') : null;
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {


        // $list = ApiService::GetDataByEndPoint(EndPoints::GetEventsApi, session('mainToken'));
        // $list = ProductService::getList();
        // dd($list);
        $pageInfo['title'] = trans('site.home');
//        dd(ApiService::GetDataByEndPoint(EndPoints::GetClubsApi, session('mainToken')));
        $endpoints = [
            EndPoints::GetClubsApi,
            EndPoints::PlayersApi,
            EndPoints::GetBlockGetPagedByCategoryApi . 7 . '?PageNumber=0&PageSize=10',
            EndPoints::GetBlockGetPagedByCategoryApi . 11 . '?PageNumber=0&PageSize=10',
            EndPoints::GetEventsApi,
            EndPoints::GetBlockGetPagedByCategoryApi . 5 . '?PageNumber=0&PageSize=10',
            EndPoints::GetArticlesApi,
            EndPoints::GetPlayerOfMonthsApi
        ];
        $response = ApiService::GetDataByMultiEndPoint($endpoints, session('mainToken'));
        $clubs = $response[0];
        $players = $response[1];
        $news = $response[2];
        $sponsors = $response[3];
        $events = $response[4];
        $galleries = $response[5];
        $blogs = $response[6];
        $playerMonth = $response[7][0];
        return view('home.home', compact('pageInfo','clubs','players','events','news','sponsors','galleries','blogs', 'playerMonth'));
        } catch (\Exception $e) {
            abort(500);
        }
    }

    public function flushSession(Request $request)
    {
        if ($request->ajax()) {
            $class  = '';
            if (session()->has('memberSuccessRegister')) {
                session()->forget('memberSuccessRegister');
                $class = 'member-success-register';
            }
            return response()->json(['success' => 'Successful delete register session message', 'class' => $class], Response::HTTP_OK);
        }
    }

    public function downloadPdf()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<img src="http://laravel-app.local/laravel%20UAE%20Esports/public/assets/img/Mumbership-ID1.png" width="200px" height="200px"/>');
        return $pdf->stream();
    }

}
