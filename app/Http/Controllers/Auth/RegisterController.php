<?php

namespace App\Http\Controllers\Auth;

use App\Facades\ClubsService;
use App\Facades\PlayersService;
use App\Facades\UserService;
use App\Mail\RegisterNotification;
use App\Mail\ContactUs;

use App\Services\ApiService;
use App\Http\Controllers\Controller;
use App\Models\ApiUser;
use App\Helpers\General\EndPoints;
use App\Models\LoggedUser;
use App\Models\RegisterUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $dataIn = $request->all();
        $validationArray = $this->validationArray($dataIn['account-type']);
        $validator = Validator::make($dataIn, $validationArray, [
            "name.required" => trans('validation.required', ['field' => trans('individually.name')]),
            "Name.required" => trans('validation.required', ['field' => trans('institutions.clubName')]),
            "firstName.required" => trans('validation.required', ['field' => trans('institutions.firstName')]),
            "lastName.required" => trans('validation.required', ['field' => trans('institutions.lastName')]),
            "email.required" => trans('validation.required', ['field' => trans('auth.email')]),
            "account-type.required" => trans('validation.required', ['field' => trans('auth.account-type')]),
            "phone.required" => trans('validation.required', ['field' => trans('auth.phone')]),
            "gender.required" => trans('validation.required', ['field' => trans('auth.gender')]),
//            "socialStatus.required" => trans('validation.required', ['field' => trans('auth.socialStatus')]),
            "StartDate.required" => trans('validation.required', ['field' => trans('institutions.startPassportDate')]),
            "EndDate.required" => trans('validation.required', ['field' => trans('institutions.endPassportDate')]),
            "BirthDate.required" => trans('validation.required', ['field' => trans('auth.birthDate')]),
           "uaeResidency.required" => trans('validation.required', ['field' => 'uaeResidency']),
            "educationLevelId.required" => trans('validation.required', ['field' => trans('individually.educational-level')]),
            "NationalityId.required" => trans('validation.required', ['field' => trans('individually.nationality')]),
            "passportNumber.required" => trans('validation.required', ['field' => trans('individually.passport-number')]),
            // "princedomId.required" => trans('validation.required', ['field' => trans('institutions.princedoms')]),
            "password.required" => trans('validation.required', ['field' => trans('auth.password')]),
            "password_confirmation.required" => trans('validation.required', ['field' => trans('auth.confirm-password')]),
            'password.max' => trans('auth.max-password'),
            'password.min' => trans('auth.min-password'),
            'password.confirmed' => trans('auth.confirmed-password-msg'),
            'account-type.in' => trans('auth.allow-account-type-msg'),
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        switch ($dataIn['account-type']) {
            case 'WebSite-Follower':
                $data = $this->generateRequestFollowerData($dataIn);
                break;
            case 'Player':
            case 'Commentator':
            case 'Content-Creator':
            case 'Referee':
            case 'Coach':
            case 'Manager':
                $data = $this->generateRequestData($dataIn);
                // dd($data);
                $image = $this->uploadFiles($request, 'file');
                $passportImage = $this->uploadFiles($request, 'passport-file');
                $data['personInfo']['image'] = $image;
                $data['personInfo']['passport']['image'] = $passportImage;
                break;
            case 'Club':
            case 'Academy':
            case 'Sport-Company':
                $data = $this->generateClubRequestData($dataIn);
                // dd($data);
                $image = $this->uploadFiles($request, 'file');
                $clubPassportImage = $this->uploadFiles($request, 'passport-file');
                $clubLicenceImage = $this->uploadFiles($request, 'licenceImage');
                $data['orgnizationInfo']['image'] = $image;
                $data['orgnizationInfo']['owner']['passport']['image'] = $clubPassportImage;
                $data['orgnizationInfo']['licenceImage'] = $clubLicenceImage;
                break;
        }
//    dd($data);
        try {
            switch ($dataIn['account-type']) {
                case 'WebSite-Follower':
                    $endpoint = EndPoints::registerFollowerApi;
                    break;
                case 'Player':
                    $endpoint = EndPoints::registerPlayersApi;
                    break;
                case 'Commentator':
                    $endpoint = EndPoints::registerCommentatorsApi;
                    break;
                case 'Content-Creator':
                    $endpoint = EndPoints::registerContentCreatorsApi;
                    break;
                case 'Coach':
                    $endpoint = EndPoints::registerCoachesApi;
                    break;
                case 'Manager':
                    $endpoint = EndPoints::registerManagerApi;
                    break;
                case 'Referee':
                    $endpoint = EndPoints::registerRefereesApi;
                    break;
                case 'Club':
                    $endpoint = EndPoints::registerClubsApi;
                    break;
                case 'Academy':
                    $endpoint = EndPoints::registerAcademiesApi;
                    break;
                case 'Sport-Company':
                    $endpoint = EndPoints::registerSportCompaniesApi;
                    break;
                default :
                    $endpoint = EndPoints::registerPlayersApi;
            }
            $response = ApiService::PostDataByEndPoint($endpoint, $data);

            //   dd($response);
            if (isset($response['hasErrors']) && !$response['hasErrors']) {
                if ($dataIn['account-type'] == 'WebSite-Follower') {
                    if (!$response['hasErrors']) {
                        Mail::to(config('mail.webmaster')['address'])->send(new RegisterNotification($data));

                        Mail::to($dataIn['email'])->send(new RegisterNotification($data));
                        return $this->login($dataIn);
                    }
                }
                session()->put('memberSuccessRegister', trans('auth.success-member-register'));
                Mail::to($dataIn['email'])->send(new RegisterNotification($data));
                return redirect()->to(RouteServiceProvider::HOME);
            } else {
                if (isset($response['validationErrors'][0]['field']) && $response['validationErrors'][0]['field'] == 'User') {
                    return back()->with('error', trans('auth.register-user-exists'));
                }
                if (isset($response['validationErrors'][0]['field']) && $response['validationErrors'][0]['field'] == 'Validation') {
                    return back()->with('error', $response['validationErrors'][0]['errors'][0]);
                }
                return back()->with('error', trans('auth.invalid-data'));
            }
    //    dd($response);
        } catch (\Exception $e) {
        //   dd($e->getMessage());
        //  return $e->getMessage();
            return back()->with('error', trans('auth.invalid-data'));
        }
    }

    private function validationArray($type)
    {
        switch ($type) {
            case 'WebSite-Follower':
                $validationArray = [
                    "name" => "required",
                    'email' => 'required|email',
//                    'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    'password' => ['required', 'confirmed', 'max:20', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
            case 'Player':
            case 'Commentator':
            case 'Content-Creator':
                $validationArray = [
                    "firstName" => "required",
                    "lastName" => 'required',
                    'email' => 'required|email',
//                    'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
//                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
//                    "educationLevelId" => 'required',
                   "uaeResidency" => 'required|in:true,false',
                //    "uaeIdNumber" => 'required',
                //    "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
                    "twitter" => 'sometimes|nullable',
                    "instagram" => 'sometimes|nullable',
                    "facebook" => 'sometimes|nullable',
                    "youtube" => 'sometimes|nullable',
                    "discord" => 'sometimes|nullable',
                    "tikTok" => 'sometimes|nullable',
                    "twitch" => 'sometimes|nullable',
                    // 'playerPlatforms' => 'required',
                    // 'playerGames' => 'required',
                    'password' => ['required', 'confirmed', 'max:20', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
            case 'Coach':
            case 'Manager':
                $validationArray = [
                    "firstName" => "required",
                    "lastName" => 'required',
                    'email' => 'required|email',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
//                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
                    "uaeResidency" => 'required|in:true,false',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
                    'password' => ['required', 'confirmed', 'max:20', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
            case 'Referee':
                $validationArray = [
                    "firstName" => "required",
                    "lastName" => 'required',
                    'email' => 'required|email',
//                    'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
//                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
                   "uaeResidency" => 'required|in:true,false',
                //    "uaeIdNumber" => 'required',
               //     "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
                    // 'refereeGames' => 'required',
                    'password' => ['required', 'confirmed', 'max:20', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
            case 'Club':
                $validationArray = [
                    "Name" => "required",
                    "firstName" => "required",
                    "lastName" => 'required',
                    'email' => 'required|email',
//                    'userName' => 'required',
                    "phone" => 'required|numeric',
                    'account-type' => 'required|in:Player,Coach,Manager,referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    'licenceEndDate' => 'required|date',
                    'StartDate' => 'required|date',
                    'EndDate' => 'required|date',
                    'isEventCreator' => 'required',
                    // 'ClubTypeId' => 'required',
                    'princedomId' => 'sometimes|nullable',
                    'passportNumber' => 'required',
//                    "website" => 'required',
                    "address" => 'sometimes|nullable',
                    "fax" => 'sometimes|nullable',
                    'password' => ['required', 'confirmed', 'max:20', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
            case 'Academy':
            case 'Sport-Company':
                $validationArray = [
                    "Name" => "required",
                    "firstName" => "required",
                    "lastName" => 'required',
                    'isEventCreator' => 'required',
                    'email' => 'required|email',
//                    'userName' => 'required',
                    "phone" => 'required|numeric',
                    'account-type' => 'required|in:Player,Coach,Manager,referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    'licenceEndDate' => 'required|date',
                    'StartDate' => 'required|date',
                    'EndDate' => 'required|date',
                    'princedomId' => 'sometimes|nullable',
                    'passportNumber' => 'required',
//                    "website" => 'required',
//                    "womenJuniorMembers" => 'required',
//                    "menJuniorMembers" => 'required',
//                    "menMembers" => 'required',
//                    "womenMembers" => 'required',
//                    "trainersMembers" => 'required',
//                    "administratorMembers" => 'required',
                    "address" => 'sometimes|nullable',
                    "fax" => 'sometimes|nullable',
                    'password' => ['required', 'confirmed', 'max:20', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
        }
        return $validationArray;
    }

    private function generateRequestFollowerData($dataIn)
    {
        $data = [
            'name' => $dataIn['name'],
            'client' => [
                'type' => $dataIn['account-type'],
                'name' => $dataIn['name'],
                'email' => $dataIn['email'],
                'userName' => null,
                'password' => $dataIn["password"],
                'confirmPassword' => $dataIn["password_confirmation"]
            ],
            'email' => $dataIn['email'],
        ];
        return $data;
    }

    private function generateRequestData($dataIn)
    {
        $data = [
            'name' => $dataIn['firstName'] . ' ' . $dataIn['lastName'],
            'client' => [
                'type' => isset($dataIn['account-type']) ? $dataIn['account-type'] : null,
                'name' => $dataIn['firstName'] . ' ' . $dataIn['lastName'],
                'email' => isset($dataIn['email']) ? $dataIn['email'] : null,
                "state"=> "",
               // "requestDeleted"=> true,
                'userName' => null,
                "isEventCreator" => false,
                'password' => $dataIn["password"],
                'confirmPassword' => $dataIn["password_confirmation"]
            ],
            'personInfo' => [
                'image' => [],
                'birthDate' => isset($dataIn['BirthDate']) ? $dataIn['BirthDate'] : null,
                'gender' => isset($dataIn['gender']) ? $dataIn['gender'] : null,
               'socialStatus' => isset($dataIn['socialStatus']) ? $dataIn['socialStatus'] : null,
               'uaeResidency' => $dataIn['uaeResidency'] == 'false' ? false : true,
              //  'uaeIdNumber' => $dataIn['uaeIdNumber'],
               // 'uaeIdEndDate' => $dataIn['uaeIdEndDate'],
                'email' => isset($dataIn['email']) ? $dataIn['email'] : null,
                'phone' => isset($dataIn['phone']) ? $dataIn['phone'] : null,
                'educationLevelId' => isset($dataIn['educationLevelId']) ? $dataIn['educationLevelId'] : null,
                'passport' => [
                    'number' => isset($dataIn['passportNumber']) ? $dataIn['passportNumber'] : null
                ],
                'NationalityId' => isset($dataIn['NationalityId']) ? $dataIn['NationalityId'] : null,
                'princedomId' => $dataIn['uaeResidency'] == 'true' ? $dataIn['princedomId'] : null,
                'facebook' => isset($dataIn['facebook']) ? $dataIn['facebook'] : null,
                'twitter' => isset($dataIn['twitter']) ? $dataIn['twitter'] : null,
                'instagram' => isset($dataIn['instagram']) ? $dataIn['instagram'] : null,
                'youTube' => isset($dataIn['youtube']) ? $dataIn['youtube'] : null,
                'discord' => isset($dataIn['discord']) ? $dataIn['discord'] : null,
                'tikTok' => isset($dataIn['tikTok']) ? $dataIn['tikTok'] : null,
                'twitch' => isset($dataIn['twitch']) ? $dataIn['twitch'] : null,
            ]
        ];
        switch ($dataIn['account-type']) {
            case 'Player':
                if (isset($dataIn['playerPlatforms'])) {
                $playerPlatforms = [];
                    foreach ($dataIn['playerPlatforms'] as $platform) {
                        $platformExplode = explode('|', $platform);
                        $platform = [
                            'platformId' => $platformExplode[0],
                            'platformName' => $platformExplode[1],
                        ];
                        array_push($playerPlatforms, $platform);
                    }
                    $data['playerPlatforms'] = $playerPlatforms;
                }
                if (isset($dataIn['playerGames'])) {
                    $playerGames = [];
                    foreach ($dataIn['playerGames'] as $game) {
                        $gameExplode = explode('|', $game);
                        $game = [
                            'gameId' => $gameExplode[0],
                            'gameName' => $gameExplode[1],
                        ];
                        array_push($playerGames, $game);
                    }
                    $data['playerGames'] = $playerGames;
                }

                break;
            case 'Coach':
                if (isset($dataIn['coachGames'])) {
                    $coachGames = [];
                    foreach ($dataIn['coachGames'] as $game) {
                        $gameExplode = explode('|', $game);
                        $game = [
                            'gameId' => $gameExplode[0],
                            'gameName' => $gameExplode[1],
                        ];
                        array_push($coachGames, $game);
                    }
                    $data['coachGames'] = $coachGames;
                }
                break;
            case 'Referee':
                if (isset($dataIn['refereeGames'])) {
                    $refereeGames = [];
                    foreach ($dataIn['refereeGames'] as $game) {
                        $refereeExplode = explode('|', $game);
                        $game = [
                            'gameId' => $refereeExplode[0],
                            'gameName' => $refereeExplode[1],
                        ];
                        array_push($refereeGames, $game);
                    }
                    $data['refereeGames'] = $refereeGames;
                }
                break;
        /*     case 'Manager':
                if (isset($dataIn['managerGames'])) {
                    $managerGames = [];
                    foreach ($dataIn['managerGames'] as $game) {
                        $gameExplode = explode('|', $game);
                        $game = [
                            'gameId' => $gameExplode[0],
                            'gameName' => $gameExplode[1],
                        ];
                        array_push($managerGames, $game);
                    }
                    $data['managerGames'] = $managerGames;
                }
                break; */
                case 'Manager':
                if (isset($dataIn['managerGames'])) {
                    $managerGames = [];
                    foreach ($dataIn['managerGames'] as $game) {
                        $gameExplode = explode('|', $game);
                        $game = [
                            'gameId' => $gameExplode[0],
                            'gameName' => $gameExplode[1],
                        ];
                        array_push($managerGames, $game);
                    }
                    $data['managerGames'] = $managerGames;
                }
                break;
        }

        return $data;
    }
    private function generateClubRequestData($dataIn)
    {
        $data = [
            'client' => [
                'name' => $dataIn['firstName'] . ' ' . $dataIn['lastName'],
                'type' => $dataIn['account-type'],
                'email' => isset($dataIn['email']) ? $dataIn['email'] : null,
                "isEventCreator" => isset($dataIn["isEventCreator"]) ? $dataIn["isEventCreator"] : null,
                'userName' => null,
                'password' => $dataIn["password"],
                'confirmPassword' => $dataIn["password_confirmation"]
            ],
            'orgnizationInfo' => [
                'email' => isset($dataIn['email']) ? $dataIn['email'] : null,
                'phone' => isset($dataIn['phone']) ? $dataIn['phone'] : null,
                'website' => isset($dataIn['website']) ? $dataIn['website'] : null,
                'fax' => isset($dataIn['fax']) ? $dataIn['fax'] : null,
                'address' => isset($dataIn['address']) ? $dataIn['address'] : null,
                'owner' => [
                    'name' => $dataIn['firstName'] . ' ' . $dataIn['lastName'],
                    'passport' => [
                        'number' => isset($dataIn['passportNumber']) ? $dataIn['passportNumber'] : null,
                        'StartDate' => isset($dataIn['StartDate']) ? $dataIn['StartDate'] : null,
                        'EndDate' => isset($dataIn['EndDate']) ? $dataIn['EndDate'] : null,
                        'image' => []
                    ],
                ],
                'licenceEndDate' => isset($dataIn['licenceEndDate']) ? $dataIn['licenceEndDate'] : null,
                'licenceImage' => [],
                'princedomId' => isset($dataIn['princedomId']) ? $dataIn['princedomId'] : null,
                'facebook' => isset($dataIn['facebook']) ? $dataIn['facebook'] : null,
                'twitter' => isset($dataIn['twitter']) ? $dataIn['twitter'] : null,
                'instagram' => isset($dataIn['instagram']) ? $dataIn['instagram'] : null,
                'youTube' => isset($dataIn['youtube']) ? $dataIn['youtube'] : null,
                'discord' => isset($dataIn['discord']) ? $dataIn['discord'] : null,
                'tikTok' => isset($dataIn['tikTok']) ? $dataIn['tikTok'] : null,
                'twitch' => isset($dataIn['twitch']) ? $dataIn['twitch'] : null,
            ],
            'Name' => isset($dataIn['Name']) ? $dataIn['Name'] : null,
        ];
        //  switch ($dataIn['account-type']) {
        //      case 'Club':
        //         $data['ClubTypeId'] = $dataIn['ClubTypeId'];
        //         break;
        //  }
        return $data;
    }

    private function uploadFiles($request, $type)
    {
        if ($request->hasFile($type)) {
            $uploadFile = $request->file($type);
            $imgBase64String = base64_encode(file_get_contents($request->file($type)));
            $fileSize = $uploadFile->getSize();
            $fileNameWithExt = $uploadFile->getClientOriginalName();                    // ex : (example.png)
            $filenameWithOutEXt = pathinfo($fileNameWithExt, PATHINFO_FILENAME);  // ex : (example)
            $fileExtension = $uploadFile->getClientOriginalExtension();                 // ex : (png)
            $mimeType = $uploadFile->getClientMimeType();                               // ex : (image/jpeg)
            $imgFile = [];
            $imgFile['data'] = $imgBase64String;
            $imgFile['fileType'] = $mimeType;
            $imgFile['size'] = $fileSize;
            $imgFile['name'] = $fileNameWithExt;
            $file['image'] = $imgFile;
            return $imgFile;
        }
    }

    public function account($symbol, $slug='', $id=0, $id1=0)
    {
        $user = session()->has('loggedUser') ? session('loggedUser') : '';
    //    dd($user, empty($user) || is_null($user));
        if (empty($user) || is_null($user)) {
            if (session()->has('loggedUser')) session()->forget('loggedUser');
            if (session()->has('token')) session()->forget('token');
            if (session()->has('loggedUser')) session()->forget('loggedUser');
            if (session()->has('cart')) session()->forget('cart');
            return redirect(url(App::getLocale() . '/login'));
        }
        $token = session('token');
// dd($token);
        $pageInfo['title'] = trans('auth.my-account');
        $promoted = false;
        //dd($user);
        $userId = session()->has('loggedUser') ? session('loggedUser') : '';
        // dd($userId);
        $userId = $userId['id'];
        switch ($user['client']['type']) {
            case 'WebSite-Follower':
                $articles = ApiService::GetDataByEndPoint(EndPoints::GetClientArticlesApi,$token);
                // Check if the user still activated from dashboard or not
                if (isset($articles['hasErrors']) && $articles['hasErrors'] && isset($articles['validationErrors'][0]['field']) && $articles['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($articles['validationErrors'][0]['errors'][0]);
                }
                $articles = $articles['result'];
                return view('auth.account.follower.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted','articles'));
                break;
            case 'Player' :
                $endPoints = [
                    EndPoints::GetClientJoinRequestApi,
                    EndPoints::GetPlayerTeamDetailsApi,
                    EndPoints::GetClientArticlesApi,
                    EndPoints::GetClientCertificateRequestsApi,
                    EndPoints::GetPlayerInfoApi
                ];
                $responses = ApiService::GetDataByMultiEndPoint($endPoints, $token);
                // Check if the user still activated from dashboard or not
                if (isset($responses[0]['hasErrors']) && $responses[0]['hasErrors'] && isset($responses[0]['validationErrors'][0]['field']) && $responses[0]['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($responses[0]['validationErrors'][0]['errors'][0]);
                }
                $ClientEventsRequests = $responses[0]['result'];
                $clientTeamRequests = !$responses[1]['hasErrors'] ? $responses[1]['result'] : [];
                $articles = $responses[2]['result'];
                $certificateRequests = $responses[3]['result'];
                $user = $responses[4]['result'];
                // $response = ApiService::GetDataByEndPoint(EndPoints::PlayersApi . '/' . $userId , session('mainToken'));
                return view('auth.account.player.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted', 'ClientEventsRequests','clientTeamRequests','certificateRequests','articles'));
                break;
            case 'Commentator' :
                $endPoints = [
                    EndPoints::GetClientArticlesApi,
                    EndPoints::GetCommentatorsInfoApi
                ];
                $responses = ApiService::GetDataByMultiEndPoint($endPoints, $token);
                // Check if the user still activated from dashboard or not
                if (isset($responses[0]['hasErrors']) && $responses[0]['hasErrors'] && isset($responses[0]['validationErrors'][0]['field']) && $responses[0]['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($responses[0]['validationErrors'][0]['errors'][0]);
                }
//                $articles = ApiService::GetDataByEndPoint(EndPoints::GetClientArticlesApi,$token);
                $articles = $responses[0]['result'];
//                $user = ApiService::GetDataByEndPoint(EndPoints::GetCommentatorsInfoApi,$token);
                $user = $responses[1]['result'];
                return view('auth.account.Commentator.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted','articles'));
                break;
            case 'Content-Creator' :
                $endPoints = [
                    EndPoints::GetClientArticlesApi,
                    EndPoints::GetContentCreatorsInfoApi
                ];
                $responses = ApiService::GetDataByMultiEndPoint($endPoints, $token);
                // Check if the user still activated from dashboard or not
                if (isset($responses[0]['hasErrors']) && $responses[0]['hasErrors'] && isset($responses[0]['validationErrors'][0]['field']) && $responses[0]['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($responses[0]['validationErrors'][0]['errors'][0]);
                }
                $articles = $responses[0]['result'];
                $user = $responses[1]['result'];
                return view('auth.account.Content-Creator.account', compact('pageInfo','articles','slug', 'user', 'id', 'id1','promoted'));
                break;
            case 'Coach':
                $endPoints = [
                    EndPoints::GetClientCertificateRequestsApi,
                    EndPoints::GetClientArticlesApi,
                    EndPoints::GetCoachInfoApi
                ];
                $responses = ApiService::GetDataByMultiEndPoint($endPoints, $token);
                // Check if the user still activated from dashboard or not
                if (isset($responses[0]['hasErrors']) && $responses[0]['hasErrors'] && isset($responses[0]['validationErrors'][0]['field']) && $responses[0]['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($responses[0]['validationErrors'][0]['errors'][0]);
                }
                $certificateRequests = $responses[0]['result'];
                $articles = $responses[1]['result'];
                $user = $responses[2]['result'];

                $responsesTwo = ApiService::GetDataByMultiEndPoint([EndPoints::GetALCertificateRequestsApi, EndPoints::CoachsApi . '/' . $userId], session('mainToken'));
                $aLLCertificateRequests = $responsesTwo[0];
//                $aLLCertificateRequests = ApiService::GetDataByEndPoint(EndPoints::GetALCertificateRequestsApi, session('mainToken'));
//                $response = ApiService::GetDataByEndPoint(EndPoints::CoachsApi . '/' . $userId , session('mainToken'));
                $response = $responsesTwo[1]['result'];
//                $players = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayersApi, $token);
//                $user = ApiService::GetDataByEndPoint(EndPoints::GetCoachInfoApi,$token);
              // dd($certificateRequests);
                return view('auth.account.Coach.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted','aLLCertificateRequests','response','certificateRequests','articles'));
                break;
            case 'Manager' :
                $aLLCertificateRequests = ApiService::GetDataByEndPoint(EndPoints::GetALCertificateRequestsApi, session('mainToken'));
                $response = ApiService::GetDataByEndPoint(EndPoints::GetManagersDetailsApi . '/' . $userId , session('mainToken'));
                // $response = $response['result'];
                $articles = ApiService::GetDataByEndPoint(EndPoints::GetClientArticlesApi,$token);
                // Check if the user still activated from dashboard or not
                if (isset($articles['hasErrors']) && $articles['hasErrors'] && isset($articles['validationErrors'][0]['field']) && $articles['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($articles['validationErrors'][0]['errors'][0]);
                }
                $articles = $articles['result'];
                $players = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayersApi, $token);
                $user = ApiService::GetDataByEndPoint(EndPoints::GetManagersInfoApi,$token);
                $user = $user['result'];
                // dd($user);
                return view('auth.account.Manager.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted','aLLCertificateRequests','response','articles'));
                break;
            case 'Referee':
                $response = ApiService::GetDataByEndPoint(EndPoints::RefereesApi . '/' . $userId , session('mainToken'));
                $response = $response['result'];
                $articles = ApiService::GetDataByEndPoint(EndPoints::GetClientArticlesApi,$token);
                // Check if the user still activated from dashboard or not
                if (isset($articles['hasErrors']) && $articles['hasErrors'] && isset($articles['validationErrors'][0]['field']) && $articles['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($articles['validationErrors'][0]['errors'][0]);
                }
                $articles = $articles['result'];
                $certificateRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientCertificateRequestsApi, $token);
                $certificateRequests = $certificateRequests['result'];
                $aLLCertificateRequests = ApiService::GetDataByEndPoint(EndPoints::GetALCertificateRequestsApi, session('mainToken'));
                $user = ApiService::GetDataByEndPoint(EndPoints::GetRefereesInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.judgment.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted','aLLCertificateRequests','certificateRequests','articles','response'));
                break;
            case 'Club':
                $responsesMainToken = ApiService::GetDataByMultiEndPoint([EndPoints::PlatformIndexGetApi, EndPoints::GamesIndexGetApi, EndPoints::EventClassificationsApi, EndPoints::GetOrganizationRequestLevelsApi, EndPoints::GetOrganizationRequestTypesApi], session('mainToken'));
                $platforms = $responsesMainToken[0];
                $games = $responsesMainToken[1];
                $EventClassifications = $responsesMainToken[2];
                $organizationRequestLevels = $responsesMainToken[3];
                $organizationRequestTypes = $responsesMainToken[4];
//                $platforms = ApiService::GetDataByEndPoint(EndPoints::PlatformIndexGetApi, session('mainToken'));
//                $games = ApiService::GetDataByEndPoint(EndPoints::GamesIndexGetApi, session('mainToken'));
//                $EventClassifications = ApiService::GetDataByEndPoint(EndPoints::EventClassificationsApi, session('mainToken'));
//                $organizationRequestLevels = ApiService::GetDataByEndPoint(EndPoints::GetOrganizationRequestLevelsApi, session('mainToken'));
//                $organizationRequestTypes = ApiService::GetDataByEndPoint(EndPoints::GetOrganizationRequestTypesApi, session('mainToken'));
                $endpoints = [
                    EndPoints::PlatformIndexGetApi,
                    EndPoints::GetClientPlayerRequestsApi,
                    EndPoints::GetClientCoachesApi,
                    EndPoints::GetClientCoachRequestsApi,
                    EndPoints::GetClientManagersApi,
                    EndPoints::GetClientManagersRequestsApi,
                    EndPoints::GetClientRequestsApi
                ];
                $responsesUserToken = ApiService::GetDataByMultiEndPoint($endpoints, $token);
//                dd($responsesUserToken);
                 // Check if the user still activated from dashboard or not
                 if (isset($responsesUserToken[0]['hasErrors']) && $responsesUserToken[0]['hasErrors'] && isset($responsesUserToken[0]['validationErrors'][0]['field']) && $responsesUserToken[0]['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($responsesUserToken[0]['validationErrors'][0]['errors'][0]);
                }
                $players = $responsesUserToken[0];
                $playerClub = $responsesUserToken[1];
                $coaches = $responsesUserToken[2];
                $coachesClub = $responsesUserToken[3];
                $managers = $responsesUserToken[4];
                $managersClub = $responsesUserToken[5];
                $noProblemRequests = $responsesUserToken[6];
//                $players = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayersApi, $token);
         //      dd($playerClub);
//                $playerClub = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayerRequestsApi, $token);
//                 dd($playerClub);
//                $coaches = ApiService::GetDataByEndPoint(EndPoints::GetClientCoachesApi, $token);
//                $coachesClub = ApiService::GetDataByEndPoint(EndPoints::GetClientCoachRequestsApi, $token);
                // dd($coachesClub);
//                $managers = ApiService::GetDataByEndPoint(EndPoints::GetClientManagersApi, $token);
//                $managersClub = ApiService::GetDataByEndPoint(EndPoints::GetClientManagersRequestsApi, $token);
//                $noProblemRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientRequestsApi, $token);
                $teams = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamsApi, $token);
                $teams = !is_null($teams) ? $teams['result'] : [];
                $organizationRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientOrgnizingRequestsApi, $token);
                $organizationRequests = $organizationRequests['result'];
                $ClientEventsRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientJoinRequestApi, $token);
                $ClientEventsRequests = $ClientEventsRequests['result'];
                $user = ApiService::GetDataByEndPoint(EndPoints::GetClubsInfoApi,$token);
                $user = $user['result'];
       //  dd($ClientEventsRequests);
                return view('auth.account.Clubs.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted', 'teams','playerClub','players','coaches','managers','noProblemRequests', 'platforms', 'games','organizationRequestLevels','organizationRequestTypes','organizationRequests','ClientEventsRequests','EventClassifications','coachesClub','managersClub'));
                break;
            case 'Academy':

                $EventClassifications = ApiService::GetDataByEndPoint(EndPoints::EventClassificationsApi, session('mainToken'));
                $organizationRequestLevels = ApiService::GetDataByEndPoint(EndPoints::GetOrganizationRequestLevelsApi, session('mainToken'));
                $organizationRequestTypes = ApiService::GetDataByEndPoint(EndPoints::GetOrganizationRequestTypesApi, session('mainToken'));
                $organizationRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientOrgnizingRequestsApi, $token);
                // Check if the user still activated from dashboard or not
                if (isset($organizationRequests['validationErrors'][0]['field']) && $organizationRequests['validationErrors'][0]['field'] == 'User') {
                    return self::accountNotActive($organizationRequests['validationErrors'][0]['errors'][0]);
                }
                $noProblemRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientRequestsApi, $token);
                $organizationRequests = $organizationRequests['result'];
                $ClientEventsRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientJoinRequestApi, $token);
                $ClientEventsRequests = $ClientEventsRequests['result'];
                $teams = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamsApi, $token);
                $teams = !is_null($teams) ? $teams['result'] : [];
//                dd($teams);
                $platforms = ApiService::GetDataByEndPoint(EndPoints::PlatformIndexGetApi, session('mainToken'));
                $games = ApiService::GetDataByEndPoint(EndPoints::GamesIndexGetApi, session('mainToken'));
                $players = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayersApi, $token);
                $playerClub = ApiService::GetDataByEndPoint(EndPoints::GetClientPlayerRequestsApi, $token);
                $coaches = ApiService::GetDataByEndPoint(EndPoints::GetClientCoachesApi, $token);
                $managers = ApiService::GetDataByEndPoint(EndPoints::GetClientManagersApi, $token);
                $coachesClub = ApiService::GetDataByEndPoint(EndPoints::GetClientCoachRequestsApi, $token);
                $managersClub = ApiService::GetDataByEndPoint(EndPoints::GetClientManagersRequestsApi, $token);
                $user = ApiService::GetDataByEndPoint(EndPoints::GetAcademiesInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.Academy.account', compact('pageInfo','slug', 'user', 'id', 'id1','EventClassifications','ClientEventsRequests','promoted','platforms', 'games','playerClub','noProblemRequests','organizationRequestLevels','organizationRequestTypes','organizationRequests','players','coaches','managers','coachesClub','managersClub', 'teams'));
                break;
            case 'Sport-Company':
                $EventClassifications = ApiService::GetDataByEndPoint(EndPoints::EventClassificationsApi, session('mainToken'));
                $organizationRequestLevels = ApiService::GetDataByEndPoint(EndPoints::GetOrganizationRequestLevelsApi, session('mainToken'));
                $organizationRequestTypes = ApiService::GetDataByEndPoint(EndPoints::GetOrganizationRequestTypesApi, session('mainToken'));
                $organizationRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientOrgnizingRequestsApi, $token);
                // Check if the user still activated from dashboard or not
                if (isset($organizationRequests['validationErrors'][0]['field']) && $organizationRequests['validationErrors'][0]['field'] == 'User') {
                    return self::accountNotActive($organizationRequests['validationErrors'][0]['errors'][0]);
                }
                $noProblemRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientRequestsApi, $token);
                $organizationRequests = $organizationRequests['result'];
                $ClientEventsRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientEventsApi, $token);
                $ClientEventsRequests = $ClientEventsRequests['result'];
                $user = ApiService::GetDataByEndPoint(EndPoints::GetSportCompaniesInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.sports-services.account', compact('pageInfo','slug', 'user', 'id','noProblemRequests','EventClassifications','organizationRequests','ClientEventsRequests', 'id1','promoted','organizationRequestLevels','organizationRequestTypes'));
                break;
            default:
                $aLLCertificateRequests = ApiService::GetDataByEndPoint(EndPoints::GetALCertificateRequestsApi, session('mainToken'));
                $organizationRequestLevels = ApiService::GetDataByEndPoint(EndPoints::GetOrganizationRequestLevelsApi, session('mainToken'));
                $organizationRequestTypes = ApiService::GetDataByEndPoint(EndPoints::GetOrganizationRequestTypesApi, session('mainToken'));
                $organizationRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientOrganizationRequestsApi, $token);
                // Check if the user still activated from dashboard or not
                if (isset($organizationRequests['validationErrors'][0]['field']) && $organizationRequests['validationErrors'][0]['field'] == 'User') {
                    return self::accountNotActive($organizationRequests['validationErrors'][0]['errors'][0]);
                }
                $noProblemRequests = ApiService::GetDataByEndPoint(EndPoints::GetClientRequestsApi, $token);
                $organizationRequests = $organizationRequests['result'];
                $clientTeamRequests = PlayersService::getSpecialResponse(EndPoints::GetClientTeamRequestsApi, $token);
                $clientTeamRequests = is_null($clientTeamRequests) ? [] : $clientTeamRequests;
                return view('auth.account.account.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted','aLLCertificateRequests','noProblemRequests','organizationRequestLevels','organizationRequestTypes','organizationRequests','clientTeamRequests'));
                break;
        }
    }

    private function login($dataIn)
    {
        $data = [
            'userType' => $dataIn['account-type'],
            'email' => $dataIn['email'],
            'password' => $dataIn['password']
        ];
        return $this->memberLogin($data);
    }

    private function memberLogin($dataIn)
    {
        try {
            $data = $this->generateArray($dataIn);
            $response = ApiService::PostDataByEndPoint(EndPoints::loginApi, $data);
            // Get Responses
            if ((isset($response['errors']) && !empty($response['errors'])) || !isset($response['token'])) {
                if (isset($response['errors'][0])) {
                    return $this->invalidResponse($response['errors'][0]);
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
        } catch(\Exception $e) {
//            dd($e->getMessage());
            return back()->with('error', trans('auth.invalid-data'));
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
                $arrayResponse = ApiService::GetDataByEndPoint(EndPoints::GetFollowerInfoApi, $token);
                if (is_null($arrayResponse)) {
                    if (session()->has('token')) {
                        session()->forget('token');
                    }
                    return back()->with('error', trans('all.server-error-msg'));
                }
                if (!$arrayResponse['hasErrors']) {
                    session()->put('memberSuccessRegister', trans('auth.success-follower-register'));
                    session()->put('loggedUser', $arrayResponse['result']);
                    return redirect(RouteServiceProvider::HOME);
                }
                return $this->invalidResponse($arrayResponse['validationErrors'][0]['errors'][0]);
            } catch(\Exception $e) {
                return $this->invalidResponse();
            }
        }
    }

    private function invalidResponse($message = null)
    {
        if (session()->has('token')) {
            session()->forget('token');
        }
        return back()->with('error', (is_null($message) ? trans('auth.invalid-data') : trans('validation-messages.' . $message)));
    }

    private function accountNotActive($message) {
        if (session()->has('loggedUser')) session()->forget('loggedUser');
        if (session()->has('token')) session()->forget('token');
        if (session()->has('loggedUser')) session()->forget('loggedUser');
        if (session()->has('cart')) session()->forget('cart');
        return redirect(App::getLocale() . '/login')->with('error', $message);
    }


}
