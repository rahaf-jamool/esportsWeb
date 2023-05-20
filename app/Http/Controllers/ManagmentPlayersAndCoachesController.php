<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\ClubsService;
use App\Facades\PlayersService;
use App\Facades\UserService;
use App\Mail\RegisterNotification;
use App\Facades\CountriesService;
use App\Facades\NationalityService;
use App\Facades\PlatformService;
use App\Services\ApiService;
use App\Http\Controllers\Controller;
use App\Models\ApiUser;
use App\Helpers\General\EndPoints;
use App\Models\LoggedUser;
use App\Facades\AcademiesService;
use App\Models\RegisterUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class ManagmentPlayersAndCoachesController extends Controller
{

    public function getFormPlayerClub($locale){
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        if (session()->has('memberSuccessRegister')):
            session()->forget('memberSuccessRegister');
        endif;

        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $user['id'];

        $pageInfo['title'] = trans('auth.edit-profile');
        $pageInfo['keywords'] = trans('all.home-keywords');
        $pageInfo['description'] = trans('site.description');

        $educationLevel = ApiService::GetDataByEndPoint(EndPoints::GetEducationLevelsIndexApi, session('mainToken'));
        $platforms = PlatformService::getApiResponse(EndPoints::PlatformIndexGetApi);
        $games = PlatformService::getApiResponse(EndPoints::GamesIndexGetApi);
        $nationalities = NationalityService::getApiResponse(EndPoints::NationalitiesIndexGetApi);
        $clubs = ClubsService::getApiResponse(EndPoints::GetClubsApi);
        $academies = AcademiesService::getList();
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);

        return view('auth.account.Clubs.form_managment.form_player_managment',compact('pageInfo','user','userId','educationLevel','platforms','games','nationalities','clubs','academies','princedoms'));
    }

    public function getFormCoachClub($locale){
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        if (session()->has('memberSuccessRegister')):
            session()->forget('memberSuccessRegister');
        endif;
        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $user['id'];

        $pageInfo['title'] = trans('auth.edit-profile');
        $pageInfo['keywords'] = trans('all.home-keywords');
        $pageInfo['description'] = trans('site.description');

        $educationLevel = ApiService::GetDataByEndPoint(EndPoints::GetEducationLevelsIndexApi, session('mainToken'));
        $games = PlatformService::getApiResponse(EndPoints::GamesIndexGetApi);
        $nationalities = NationalityService::getApiResponse(EndPoints::NationalitiesIndexGetApi);
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);

        return view('auth.account.Clubs.form_managment.form_coach_managment',compact('pageInfo','princedoms','user','userId','educationLevel','games','nationalities'));
    }

    public function getFormManagerClub(){
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;

        if (session()->has('memberSuccessRegister')):
            session()->forget('memberSuccessRegister');
        endif;
        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $user['id'];

        $pageInfo['title'] = trans('auth.edit-profile');
        $pageInfo['keywords'] = trans('all.home-keywords');
        $pageInfo['description'] = trans('site.description');

        $educationLevel = ApiService::GetDataByEndPoint(EndPoints::GetEducationLevelsIndexApi, session('mainToken'));
        $nationalities = NationalityService::getApiResponse(EndPoints::NationalitiesIndexGetApi);
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);

        return view('auth.account.Clubs.form_managment.form_manager_managment',compact('pageInfo','princedoms','user','userId','educationLevel','nationalities'));
    }

     public function registerMangment(Request $request)
    {
        $dataIn = $request->all();
        $validationArray = $this->validationArray($dataIn['account-type']);
        $validator = Validator::make($dataIn, $validationArray, [
            "name.required" => trans('validation.required', ['field' => trans('individually.name')]),
            "Name.required" => trans('validation.required', ['field' => trans('institutions.clubName')]),
            "ClubTypeId.required" => trans('validation.required', ['field' => trans('institutions.ClubType')]),
            "firstName.required" => trans('validation.required', ['field' => trans('institutions.firstName')]),
            "lastName.required" => trans('validation.required', ['field' => trans('institutions.lastName')]),
            "email.required" => trans('validation.required', ['field' => trans('auth.email')]),
          //  "userName.required" => trans('validation.required', ['field' => trans('auth.username')]),
            "account-type.required" => trans('validation.required', ['field' => trans('auth.account-type')]),
            "phone.required" => trans('validation.required', ['field' => trans('auth.phone')]),
            "gender.required" => trans('validation.required', ['field' => trans('auth.gender')]),
            "socialStatus.required" => trans('validation.required', ['field' => trans('auth.socialStatus')]),
            "licenceEndDate.required" => trans('validation.required', ['field' => trans('institutions.licensedate')]),
            "StartDate.required" => trans('validation.required', ['field' => trans('institutions.startPassportDate')]),
            "EndDate.required" => trans('validation.required', ['field' => trans('institutions.endPassportDate')]),
            "BirthDate.required" => trans('validation.required', ['field' => trans('auth.birthDate')]),
            "educationLevelId.required" => trans('validation.required', ['field' => trans('individually.educational-level')]),
            "NationalityId.required" => trans('validation.required', ['field' => trans('individually.nationality')]),
            "passportNumber.required" => trans('validation.required', ['field' => trans('individually.passport-number')]),
            "princedomId.required" => trans('validation.required', ['field' => trans('institutions.princedoms')]),
            // "coachGames.required" => trans('validation.required', ['field' => trans('individually.game-platform')]),
            // "refereeGames.required" => trans('validation.required', ['field' => trans('individually.game-platform')]),
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
            case 'Player':
            case 'Coach':
            case 'Manager':
                $image = $this->uploadFiles($request, 'file');
                $passportImage = $this->uploadFiles($request, 'passport-file');
                $data = $this->generateRequestData($dataIn);
                $data['personInfo']['image'] = $image;
                $data['personInfo']['passport']['image'] = $passportImage;
                break;
        }
      //dd($data);
        try {
            switch ($dataIn['account-type']) {
                case 'WebSite-Follower':
                    $endpoint = EndPoints::registerFollowerApi;
                    break;
                case 'Player':
                    $endpoint = EndPoints::registerPlayersApi;
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
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', trans('auth.invalid-data'));
        }
    //  dd($response);
        if (isset($response['hasErrors']) && !$response['hasErrors']) {
            session()->put('memberSuccessRegister', trans('auth.success-member-register'));
            return redirect(url(App::getLocale() . '/myaccount'));
        } else {
            if (isset($response['validationErrors'][0]['field']) && $response['validationErrors'][0]['field'] == 'User') {
                return back()->with('error', trans('auth.register-user-exists'));
            }
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
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company',
                ];
                break;
            case 'Player':
                $validationArray = [
                    "firstName" => "required",
                    "lastName" => 'required',
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
                    "twitter" => 'sometimes|nullable',
                    "instagram" => 'sometimes|nullable',
                    "facebook" => 'sometimes|nullable',
                    "youtube" => 'sometimes|nullable',
                    "discord" => 'sometimes|nullable',
                    "tikTok" => 'sometimes|nullable',
                    "twitch" => 'sometimes|nullable',
                    'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
            case 'Coach':
                $validationArray = [
                    "firstName" => "required",
                    "lastName" => 'required',
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
                    'coachGames' => 'required',
                    'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
            case 'Manager':
                $validationArray = [
                    "firstName" => "required",
                    "lastName" => 'required',
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
                    'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    'password_confirmation' => 'required'
                ];
                break;
        }
        return $validationArray;
    }
    private function generateRequestData($dataIn)
    {
        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $accountType = $user['client']['type'];
        // $userName = explode('@', $dataIn['userName'])[0];
        // $userName = str_replace('#', '', $userName);
        // $userName = str_replace('.', '', $userName);
        // $userName = str_replace('-', '', $userName);
        // $userName = str_replace('_', '', $userName);
        switch ($accountType) {
                case 'Club':
                     $data = [
                        'name' => $dataIn['firstName'] . ' ' . $dataIn['lastName'],
                        'client' => [
                            'type' => $dataIn['account-type'],
                            'name' => $dataIn['firstName'] . ' ' . $dataIn['lastName'],
                            'email' => $dataIn['email'],
                            // 'userName' => $userName,
                            'password' => $dataIn["password"],
                            'confirmPassword' => $dataIn["password_confirmation"]
                        ],
                        'personInfo' => [
                            'image' => [],
                            'BirthDate' => $dataIn['BirthDate'],
                            'gender' => $dataIn['gender'],
                            'socialStatus' => $dataIn['socialStatus'],
                            'email' => $dataIn['email'],
                            'phone' => $dataIn['phone'],
                            'educationLevelId' => $dataIn['educationLevelId'],
                            'passport' => [
                                'number' => $dataIn['passportNumber'],
                            ],
                            'NationalityId' => $dataIn['NationalityId'],
                            'princedomId' => $dataIn['princedomId'],
                            'facebook' => $dataIn['facebook'],
                            'twitter' => $dataIn['twitter'],
                            'instagram' => $dataIn['instagram'],
                            'youTube' => $dataIn['youtube'],
                            'discord' => $dataIn['discord'],
                            'tikTok' => $dataIn['tikTok'],
                            'twitch' => $dataIn['twitch'],
                        ],
                        'clubId' => $dataIn['clubId'],
                        'clubName' => $dataIn['clubName'],
                    ];
                break;
                case 'Academy':
                    $data = [
                        'name' => $dataIn['firstName'] . ' ' . $dataIn['lastName'],
                        'client' => [
                            'type' => $dataIn['account-type'],
                            'name' => $dataIn['firstName'] . ' ' . $dataIn['lastName'],
                            'email' => $dataIn['email'],
                            // 'userName' => $userName,
                            'password' => $dataIn["password"],
                            'confirmPassword' => $dataIn["password_confirmation"]
                        ],
                        'personInfo' => [
                            'image' => [],
                            'BirthDate' => $dataIn['BirthDate'],
                            'gender' => $dataIn['gender'],
                            'socialStatus' => $dataIn['socialStatus'],
                            'email' => $dataIn['email'],
                            'phone' => $dataIn['phone'],
                            'educationLevelId' => $dataIn['educationLevelId'],
                            'passport' => [
                                'number' => $dataIn['passportNumber']
                            ],
                            'NationalityId' => $dataIn['NationalityId'],
                            'princedomId' => $dataIn['princedomId'],
                            'facebook' => $dataIn['facebook'],
                            'twitter' => $dataIn['twitter'],
                            'instagram' => $dataIn['instagram'],
                            'youTube' => $dataIn['youtube'],
                            'discord' => $dataIn['discord'],
                            'tikTok' => $dataIn['tikTok'],
                            'twitch' => $dataIn['twitch'],
                        ],
                        'academyId' => $dataIn['academyId'],
                        'academyName' => $dataIn['academyName'],
                    ];
                break;
            }
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
            case 'Manager':
            break;

        }
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
}
