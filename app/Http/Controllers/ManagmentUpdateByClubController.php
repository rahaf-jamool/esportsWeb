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

class ManagmentUpdateByClubController extends Controller
{
    public function getFormEditPlayerClub($locale,$id)
    {
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        if (session()->has('memberSuccessRegister')):
            session()->forget('memberSuccessRegister');
        endif;

        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $user['id'];

        $response = ApiService::GetDataByEndPoint(EndPoints::GetAnyPlayerInfoApi . $id, session('mainToken'));
        $response = $response['result'];
        // dd($response);
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
        // dd($id);
        return view('auth.account.Clubs.form_managment.form_edit_player_managment',compact('pageInfo','user','userId','educationLevel','platforms','games','nationalities','clubs','academies','princedoms','response'));
    }

    public function getFormEditCoachClub($locale,$id)
    {
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        if (session()->has('memberSuccessRegister')):
            session()->forget('memberSuccessRegister');
        endif;

        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $user['id'];

        $response = ApiService::GetDataByEndPoint(EndPoints::GetCoachDetailsApi . $id, session('mainToken'));
        $response = $response['result'];
        // dd($response);
        $pageInfo['title'] = trans('auth.edit-profile');
        $pageInfo['keywords'] = trans('all.home-keywords');
        $pageInfo['description'] = trans('site.description');

        $educationLevel = ApiService::GetDataByEndPoint(EndPoints::GetEducationLevelsIndexApi, session('mainToken'));
        $games = PlatformService::getApiResponse(EndPoints::GamesIndexGetApi);
        $nationalities = NationalityService::getApiResponse(EndPoints::NationalitiesIndexGetApi);
        $clubs = ClubsService::getApiResponse(EndPoints::GetClubsApi);
        $academies = AcademiesService::getList();
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);
        // dd($id);
        return view('auth.account.Clubs.form_managment.form_edit_coach_managment',compact('pageInfo','user','userId','educationLevel','games','nationalities','clubs','academies','princedoms','response'));
    }

    public function getFormEditManagerClub($locale,$id)
    {
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        if (session()->has('memberSuccessRegister')):
            session()->forget('memberSuccessRegister');
        endif;

        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $user['id'];

        $response = ApiService::GetDataByEndPoint(EndPoints::GetManagersDetailsApi . $id, session('mainToken'));
        $response = $response['result'];
        // dd($response);
        $pageInfo['title'] = trans('auth.edit-profile');
        $pageInfo['keywords'] = trans('all.home-keywords');
        $pageInfo['description'] = trans('site.description');

        $educationLevel = ApiService::GetDataByEndPoint(EndPoints::GetEducationLevelsIndexApi, session('mainToken'));
        $games = PlatformService::getApiResponse(EndPoints::GamesIndexGetApi);
        $nationalities = NationalityService::getApiResponse(EndPoints::NationalitiesIndexGetApi);
        $clubs = ClubsService::getApiResponse(EndPoints::GetClubsApi);
        $academies = AcademiesService::getList();
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);
        // dd($id);
        return view('auth.account.Clubs.form_managment.form_edit_manager_managment',compact('pageInfo','user','userId','educationLevel','games','nationalities','clubs','academies','princedoms','response'));
    }

    public function saveUpdateMangment(Request $request)
    {
        $dataIn = $request->all();
          //   dd($dataIn);
        if (!session()->has('loggedUser')) {
            return redirect(url(App::getLocale() . '/login'));
        }
        $user = session('loggedUser');
        $userId = $user['id'];
        $validationArray = $this->validationArray($dataIn['account-type']);
        $validator = Validator::make($dataIn, $validationArray, [
            "name.required" => trans('validation.required', ['field' => trans('individually.name')]),
            "Name.required" => trans('validation.required', ['field' => trans('institutions.clubName')]),
            // "ClubTypeId.required" => trans('validation.required', ['field' => trans('institutions.ClubType')]),
            "email.required" => trans('validation.required', ['field' => trans('auth.email')]),
            // "userName.required" => trans('validation.required', ['field' => trans('auth.username')]),
            "account-type.required" => trans('validation.required', ['field' => trans('auth.account-type')]),
            "phone.required" => trans('validation.required', ['field' => trans('auth.phone')]),
            "gender.required" => trans('validation.required', ['field' => trans('auth.gender')]),
            "socialStatus.required" => trans('validation.required', ['field' => trans('auth.socialStatus')]),
            "licenceEndDate.required" => trans('validation.required', ['field' => trans('institutions.licensedate')]),
            "StartDate.required" => trans('validation.required', ['field' => trans('institutions.startPassportDate')]),
            "EndDate.required" => trans('validation.required', ['field' => trans('institutions.endPassportDate')]),
            // "uaeIdNumber.required" => trans('validation.required', ['field' => trans('individually.emirates-number')]),
            // "uaeIdEndDate.required" => trans('validation.required', ['field' => trans('individually.emirates-expiry-date')]),
            // "EducationLevelId.required" => trans('validation.required', ['field' => trans('individually.educational-level')]),
            "NationalityId.required" => trans('validation.required', ['field' => trans('individually.nationality')]),
            "passportNumber.required" => trans('validation.required', ['field' => trans('individually.passport-number')]),
            "princedomId.required" => trans('validation.required', ['field' => trans('institutions.princedoms')]),
            // "playerPlatforms.required" => trans('validation.required', ['field' => trans('individually.platform')]),
            // "playerGames.required" => trans('validation.required', ['field' => trans('individually.game-platform')]),
            // "coachGames.required" => trans('validation.required', ['field' => trans('individually.game-platform')]),
            // "refereeGames.required" => trans('validation.required', ['field' => trans('individually.game-platform')]),
            'account-type.in' => trans('auth.allow-account-type-msg'),
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
       // dd($dataIn);
            // dd($user['personInfo']['passport']['imagePath']);
        switch ($dataIn['account-type']) {
            case 'Player':
            case 'Coach':
            case 'Manager':
                $image = $this->uploadFiles($request, 'file');
                $passportImage = $this->uploadFiles($request, 'passport-file');
                $data = $this->generateRequestData($dataIn);
                
                if (!is_null($image)) {
                    $data['personInfo']['image'] = $image;
                }
                if (!is_null($passportImage)) {
                    $data['personInfo']['passport']['image'] = $passportImage;
                }
                break;
        }
     //dd($data);
        try {
            switch ($dataIn['account-type']) {
                case 'WebSite-Follower':
                    $endpoint = EndPoints::WebSiteFollowersUpdateInfoApi;
                    break;
                case 'Player':
                    $endpoint = EndPoints::PlayersUpdateInfoApi;
                    break;
                case 'Coach':
                    $endpoint = EndPoints::CoachesUpdateInfoApi;
                    break;
                case 'Manager':
                    $endpoint = EndPoints::ManagersUpdateInfoApi;
                    break;
                case 'Referee':
                    $endpoint = EndPoints::RefereesUpdateInfoApi;
                    break;
                case 'Club':
                    $endpoint = EndPoints::ClubsUpdateInfoApi;
                    break;
                case 'Academy':
                    $endpoint = EndPoints::AcademiesUpdateInfoApi;
                    break;
                case 'Commentator':
                    $endpoint = EndPoints::CommentatorsUpdateInfoApi;
                    break;
                case 'Content-Creator':
                    $endpoint = EndPoints::ContentCreatorsUpdateInfoApi;
                    break;
                case 'Sport-Company':
                    $endpoint = EndPoints::SportCompaniesUpdateInfoApi;
                    break;
            }
            $response = ApiService::PutDataByEndPoint($endpoint, $data, session('token'));
            //dd($response);
        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->with('error', trans('auth.invalid-data'));

        }
        // dd($response);
        if (isset($response['hasErrors']) && !$response['hasErrors']) {
           /*  if (session()->has('loggedUser')) {
                session()->forget('loggedUser');
                session()->put('loggedUser', $response['result']);
            } */
            session()->put('memberSuccessRegister', trans('auth.account-successfully-modified'));
            return redirect(url(App::getLocale() . '/myaccount'));
        } else {
            return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
//            return back()->with('error', trans('auth.invalid-data'));
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
                    "name" => "required",
                    // "lastName" => 'required',
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
                //                    "EducationLevelId" => 'required',
                //                    "uaeResidency" => 'required|in:0,1',
                    // "uaeIdNumber" => 'required',
                    // "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required|numeric',
                    "twitter" => 'sometimes|nullable',
                    "instagram" => 'sometimes|nullable',
                    "facebook" => 'sometimes|nullable',
                    "youtube" => 'sometimes|nullable',
                    "discord" => 'sometimes|nullable',
                    "tikTok" => 'sometimes|nullable',
                    "twitch" => 'sometimes|nullable',
                    'playerPlatforms' => 'required',
                    'playerGames' => 'required',
                    // 'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    // 'password_confirmation' => 'required'
                ];
                break;
            case 'Coach':
                $validationArray = [
                    "name" => "required",
                    // "lastName" => 'required',
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
                //                    "uaeResidency" => 'required|in:0,1',
                    // "uaeIdNumber" => 'required',
                    // "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required|numeric',
                    'coachGames' => 'required',
                    // 'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    // 'password_confirmation' => 'required'
                ];
                break;
            case 'Manager':
                $validationArray = [
                    "name" => "required",
                    // "lastName" => 'required',
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
                    "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
            //                    "uaeResidency" => 'required|in:0,1',
                    // "uaeIdNumber" => 'required',
                    // "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required|numeric',
                    // 'managerGames' => 'required',
                    // 'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    // 'password_confirmation' => 'required'
                ];
                break;
        }
        return $validationArray;
    }
    private function generateRequestData($dataIn)
    {
        $user = session()->has('loggedUser') ? session('loggedUser') : '';
        $accountType = $user['client']['type'];
       // dd($accountType);
        // $userName = explode('@', $dataIn['userName'])[0];
        // $userName = str_replace('#', '', $userName);
        // $userName = str_replace('.', '', $userName);
        // $userName = str_replace('-', '', $userName);
        // $userName = str_replace('_', '', $userName);
        switch ($accountType) {
                case 'Club':
                     $data = [
                        'id' => $dataIn['responseId'],
                        'name' => $dataIn['name'],
                        'clientId' => $dataIn['clientId'],
                        'client' => [
                            'id' => $dataIn['clientId'],
                            'type' => $dataIn['account-type'],
                            'name' => $dataIn['name'],
                            'email' => $dataIn['email'],
                            'state' => $dataIn['state'],
                            // 'userName' => $userName,
                            // 'password' => $dataIn["password"],
                            // 'confirmPassword' => $dataIn["password_confirmation"]
                        ],
                        'personInfoId' => $dataIn['personInfoId'],
                        'personInfo' => [
                            'id' => $dataIn['personInfoId'],
                            // 'image' => [],
                            'birthDate' => $dataIn['BirthDate'],
                            'gender' => $dataIn['gender'],
                            'socialStatus' => $dataIn['socialStatus'],
                            'email' => $dataIn['email'],
                            'phone' => $dataIn['phone'],
                            // 'educationLevelId' => $dataIn['educationLevelId'],
                            'passportId' => $dataIn['passportId'],
                            'passport' => [
                                'id' => $dataIn['passportId'],
                                'number' => $dataIn['passportNumber'],
                                'countryId' => 1,
                                'countryName' => '',
                                'startDate' => $dataIn['StartDate'],
                                'endDate' => $dataIn['EndDate']
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
                 //   dd($data);
                break;
                case 'Academy':
                    $data = [
                        'id' => $dataIn['responseId'],
                        'name' => $dataIn['name'],
                        'clientId' => $dataIn['clientId'],
                        'client' => [
                            'id' => $dataIn['clientId'],
                            'type' => $dataIn['account-type'],
                            'name' => $dataIn['name'],
                            'email' => $dataIn['email'],
                            // 'userName' => $userName,
                            // 'password' => $dataIn["password"],
                            // 'confirmPassword' => $dataIn["password_confirmation"]
                        ],
                        'personInfoId' => $dataIn['personInfoId'],
                        'personInfo' => [
                            'id' => $dataIn['personInfoId'],
                            // 'image' => [],
                            'birthDate' => $dataIn['BirthDate'],
                            'gender' => $dataIn['gender'],
                            'socialStatus' => $dataIn['socialStatus'],
                            'email' => $dataIn['email'],
                            'phone' => $dataIn['phone'],
                            // 'educationLevelId' => $dataIn['educationLevelId'],
                            'passport' => [
                                'id' => $dataIn['passportId'],
                                'number' => $dataIn['passportNumber'],
                                'countryId' => 1,
                                'countryName' => '',
                                'startDate' => $dataIn['StartDate'],
                                'endDate' => $dataIn['EndDate']
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
                            'playerId' => $dataIn['responseId'],
                            'playerName' => $dataIn['name'],
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
                            'playerId' => $dataIn['responseId'],
                            'playerName' => $dataIn['name'],
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
                            'coachId' => $dataIn['responseId'],
                            'gameId' => $gameExplode[0],
                            'gameName' => $gameExplode[1],
                        ];
                        array_push($coachGames, $game);
                    }
                    $data['coachGames'] = $coachGames;
                }
                break;
            case 'Manager':
                if (isset($dataIn['managerGames'])) {
                    $managerGames = [];
                    foreach ($dataIn['managerGames'] as $game) {
                        $gameExplode = explode('|', $game);
                        $game = [
                            'managerId' => $dataIn['responseId'],
                            'gameId' => $gameExplode[0],
                            'gameName' => $gameExplode[1],
                        ];
                        array_push($managerGames, $game);
                    }
                    $data['managerGames'] = $managerGames;
                }
                break;

        }
       // dd($data);
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

    public function deletePlayerRequest(Request $request)
    {
       // dd( $request->id); 
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all(); 
           // dd( $user);
            switch ($user['client']['type']) {
                case 'Club':
                    $endpoint = EndPoints::ClubDeletePlayerApi;
                    break;
                case 'Academy':
                    $endpoint = EndPoints::AcademyDeletePlayerApi;
                    break;
                default :
                    $endpoint = EndPoints::ClubDeletePlayerApi;
            }

            $id =  $data['id']; 
               $response = ApiService::PostDataByEndPoint($endpoint. '/' . $id, $data,  $token);
            //   dd( $response);

              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }

    public function deleteCoachRequest(Request $request)
    {
    //    dd( $request);
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();
        //    dd( $data['id']);
        switch ($user['client']['type']) {
            case 'Club':
                $endpoint = EndPoints::ClubDeleteCoachApi;
                break;
            case 'Academy':
                $endpoint = EndPoints::AcademyDeleteCoachApi;
                break;
            default :
                $endpoint = EndPoints::ClubDeleteCoachApi;
        }
            $id =  $data['id'];
               $response = ApiService::PostDataByEndPoint($endpoint. '/' . $id, $data,  $token);
            //   dd( $response);

              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }

    public function deleteManagerRequest(Request $request)
    {
    //    dd( $request);
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();
        //    dd( $data['id']);
            switch ($user['client']['type']) {
                case 'Club':
                    $endpoint = EndPoints::ClubDeleteManagerApi;
                    break;
                case 'Academy':
                    $endpoint = EndPoints::AcademyDeleteManagerApi;
                    break;
                default :
                    $endpoint = EndPoints::ClubDeleteManagerApi;
            }
                $id =  $data['id'];
                   $response = ApiService::PostDataByEndPoint($endpoint. '/' . $id, $data,  $token);
            //   dd( $response);

              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }
}
