<?php
namespace App\Http\Controllers\Auth;

use App\Helpers\General\EndPoints;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApiUser;
use App\Models\LoggedUser;
use App\Providers\RouteServiceProvider;
use App\Services\ApiService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use  AuthenticatesUsers {
        logout as performLogout;
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkLogin', ['except' => 'logout']);
    }

    public function index()
    {
        return view('authentication.login');
    }

    public function login(Request $request)
    {
        /*
         * Account Player 1 :
                email: TalalPlayer1@app.com
                password : TalalPlayer1@123
         * Account Player 2 :
                email: TalalPlayer2@app.com
                password : TalalPlayer2@123
         * Account Player 3 :
                email: TalalPlayer4@app.com
                password : TalalPlayer4@123
         * Account Player 4 :
                email: TalalPlayer7@app.com
                password : TalalPlayer7@123
         * Account Club :
                "email": "Club2026@gmail.com",
                "password": "123123123"
        * Account Academy :
                "email": "nasr@gmail.com",
                "password": "123456"
         * */
        $dataIn = $request->all();
        return $this->memberLogin($dataIn);
    }

    public function memberLogin($dataIn)
    {
        $validator = Validator::make(
            [
                'userType' => $dataIn['userType'],
                'email' => $dataIn['email'],
                'password' => $dataIn['password'],
            ],
            [
                'userType' => 'required|in:Player,Coach,Manager,Club,Academy,Referee,Team,Follower,Sport-Company,Commentator,Content-Creator',
                'email' => 'required|email',
                'password' => 'required'
            ], [
                'userType.in' => trans('auth.allow-account-type-msg'),
        ]);
        if ($validator->fails()) {
            return redirect(App::getLocale() . '/login')->withErrors($validator->errors());
        }
        $data = $this->generateArray($dataIn);

        // Connect Api
        try {
            $response = ApiService::PostDataByEndPoint(EndPoints::loginApi, $data);
        } catch(\Exception $e) {
        //    dd($e->getMessage());
            // return back()->with('error', trans('auth.invalid-data'));
        }
    // dd($response);
        if($response['isBlocked'] == false){
             // Get Responses
            if ((isset($response['errors']) && !empty($response['errors'])) || !isset($response['token'])) {
                if (isset($response['errors'][0])) {
                    return back()->with('error', $response['errors'][0]);
                }
                return back()->with('error', trans('auth.invalid-data'));
            }
            // Get Token
            $token = $response['token'];
            if (!empty($token)) {
                session(['token' => $token]);
                // Get User Information
                return $this->getUserInfo($token, $dataIn['userType']);
            } else {
                return back()->with('error', trans('auth.invalid-data'));
            }
        }else{
            return back()->with('error', trans('auth.blocked'));
        }

    }

    private function generateArray($dataIn) {
        return [
            'email' => $dataIn['email'],
            'password' => $dataIn["password"]
        ];
    }

    private function getUserInfo($token, $type)
    {
        if(!empty($token))
        {
            try {
                switch ($type) {
                    case 'Follower' :
                        $endPoint = EndPoints::GetFollowerInfoApi;
                        break;
                    case 'Player' :
                        $endPoint = EndPoints::GetPlayerInfoApi;
                        break;
                    case 'Coach' :
                        $endPoint = EndPoints::GetCoachInfoApi;
                        break;
                    case 'Manager' :
                        $endPoint = EndPoints::GetManagersInfoApi;
                        break;
                    case 'Referee' :
                        $endPoint = EndPoints::GetRefereesInfoApi;
                        break;
                    case 'Club' :
                        $endPoint = EndPoints::GetClubsInfoApi;
                        break;
                    case 'Academy' :
                        $endPoint = EndPoints::GetAcademiesInfoApi;
                        break;
                    case 'Sport-Company' :
                        $endPoint = EndPoints::GetSportCompaniesInfoApi;
                        break;
                    case 'Commentator':
                        $endPoint = EndPoints::GetCommentatorsInfoApi;
                        break;
                    case 'Content-Creator':
                        $endPoint = EndPoints::GetContentCreatorsInfoApi;
                        break;
                    default:
                        $endPoint = EndPoints::GetPlayerInfoApi;
                }
                $arrayResponse = ApiService::GetDataByEndPoint($endPoint, $token);
//                dd($arrayResponse);
                if (is_null($arrayResponse)) {
                    if (session()->has('token')) {
                        session()->forget('token');
                    }
                    return back()->with('error', trans('all.server-error-msg'));
                }
                if (!$arrayResponse['hasErrors']) {
                    session()->put('loggedUser', $arrayResponse['result']);
                    return redirect(RouteServiceProvider::HOME);
                }
                return $this->invalidResponse();
            } catch(\Exception $e) {
                return $this->invalidResponse();
            }
        }
    }

    private function invalidResponse()
    {
        if (session()->has('token')) {
            session()->forget('token');
        }
        return back()->with('error', trans('auth.invalid-data'));
    }


    public function logout()
    {
        if (session()->has('loggedUser')) {
            session()->forget('token');
            session()->forget('loggedUser');
//            session()->forget('profileImageUrl');
            session()->forget('cart');
            return redirect(url(App::getLocale() . '/'));
        }
        return redirect(url(App::getLocale() . '/'));
    }

}
