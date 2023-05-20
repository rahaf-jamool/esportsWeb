<?php

namespace App\Http\Controllers;

use App\Facades\AcademiesService;
use App\Facades\ClubsService;
use App\Facades\CountriesService;
use App\Facades\NationalityService;
use App\Facades\PlatformService;
use App\Services\ApiService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Facades\UserService;
use App\Helpers\General\EndPoints;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\RenewRequest;
use App\Models\ApiUser;
use App\Models\Renew;
use App\Services\RenewService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\General\File;
use Illuminate\Validation\Rules\Password;
use App\Models\Complaint;
use App\Providers\RouteServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;
// use Alert;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     */
    private $member;
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            // $this->member = Auth::user()->Member;
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @param $category_slug
     * @param int $page
     * @return \Illuminate\Http\Response
     */
    public function index(Request $requset, $lang)
    {

        $pageInfo['title'] =  (App::getLocale() == 'ar' )?$this->member->Title:$this->member->TitleE;
        $pageInfo['keywords'] = trans('site.home-keywords');
        $pageInfo['description'] = trans('site.description');
        $member = $this->member;

        return view('profile.view', compact('pageInfo', 'member'));
    }

    public function confirm(Request $requset, $lang)
    {

        $pageInfo['keywords'] = trans('site.home-keywords');
        $pageInfo['description'] = trans('site.description');
        $member = $this->member;
        if($lang == 'ar') {
            $pageInfo['title'] = $this->member->Title;
        }else{
            $pageInfo['title'] = $this->member->TitleE;
        }
        return view('profile.confirm', compact('pageInfo', 'member' ));
    }

    private function accountNotActive($message) {
        session()->forget('token');
        session()->forget('loggedUser');
        return redirect(App::getLocale() . '/login')->with('error', $message);
    }

    public function storageImageFromUrl() {
        $url = request()->url;
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        $isStored = Storage::put('SD08/' .$name, $contents);
        if ($isStored) {
//            $url = explode('\\', request()->url);
//            $url = array_reverse($url)[0];  // get image name with extension
//            $ext = array_reverse(explode('.', $url))[0];    // get image extension
//            $url = rename($url,'membership-user-photo.' . $ext);
            $url = Storage::url('SD08/'.$name);
            $storage = "/storage/";
            $urlWithoutStorage = ltrim(str_replace('\\', '/', $url), $storage);
            return response()->json(['error' => false, 'result' => $urlWithoutStorage, 'full_url' => asset($urlWithoutStorage)], 200);
        } else {
            return response()->json(['error' => true, 'result' => '', 'message' => 'Error, Stored The Image'], 500);
        }
    }

    public function deleteStorageImageFromUrl() {
        $url = request()->url;
        Storage::delete($url);      // Delete Image
        Storage::deleteDirectory('SD08/StaticFiles');   // Delete folder
        return response()->json(['error' => false, 'result' => 'Folder Deleted Successfully'], 200);
    }

    public function change_password($locale)
    {
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        $pageInfo['title'] = trans('all.change-password');
        $pageInfo['keywords'] = trans('all.home-keywords');
        $pageInfo['description'] = trans('site.description');
        $user = session('loggedUser');
        return view('user.change-password', compact('pageInfo', 'user'));
    }

    public function store_password(Request $request)
    {
        $dataIn = $request->all();
            $validator = Validator::make($dataIn, [
                'oldPassword' => 'required|min:6|max:16',
                'newPassword' => 'required|min:6|max:16',
            ], [
                'newPassword.max' => trans('auth.max-password'),
                'newPassword.min' => trans('auth.min-password'),
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator->errors());
            }
            $user = [];
            $user['oldPassword'] = $dataIn['oldPassword'];
            $user['newPassword'] = $dataIn['newPassword'];

            // dd($user);
             try {
                switch ($dataIn['account-type']) {
                    case 'WebSite-Follower':
                        $endpoint = EndPoints::ChangeFollowerPassword;
                        break;
                    case 'Player':
                        $endpoint = EndPoints::ChangePlayerPassword;
                        break;
                    case 'Coach':
                        $endpoint = EndPoints::ChangeCoachPassword;
                        break;
                    case 'Manager':
                        $endpoint = EndPoints::ChangeManagerPassword;
                        break;
                    case 'Referee':
                        $endpoint = EndPoints::ChangeRefereesPassword;
                        break;
                    case 'Club':
                        $endpoint = EndPoints::ChangeClubPassword;
                        break;
                    case 'Commentator':
                        $endpoint = EndPoints::ChangeCommentatorsPassword;
                        break;
                    case 'Content-Creator':
                        $endpoint = EndPoints::ChangeContentCreatorsPassword;
                        break;
                    case 'Academy':
                        $endpoint = EndPoints::ChangeAcademiesPassword;
                        break;
                    case 'Sport-Company':
                        $endpoint = EndPoints::ChangeSportCompaniesPassword;
                        break;
                }
                $response = ApiService::PostDataByEndPoint($endpoint, $user, session('token'));
            // dd($response);
            } catch (\Exception $e) {
                // return  $e->getMessage();
                return back()->with('error', trans('auth.invalid-data'));

            }
            // dd($response);
            if (isset($response['hasErrors']) && !$response['hasErrors']) {
                // if (session()->has('loggedUser')) {
                //     session()->forget('loggedUser');
                //     session()->put('loggedUser', $response['result']);
                // }
                session()->put('memberSuccessRegister', trans('auth.password_successfully'));
                return redirect(url(App::getLocale() . '/myaccount'));
            } else {
                return back()->with('error', trans('auth.invalid-data'));
            }
    }

    public function edit_profile($slug='',$id)
    {
        $token = session('token');

        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        $pageInfo['title'] = trans('auth.edit-profile');
        $pageInfo['keywords'] = trans('all.home-keywords');
        $pageInfo['description'] = trans('site.description');
//        $clubTypes = ClubsService::getApiResponse(EndPoints::GetClubTypesApi);

        // academy
        $countries = CountriesService::getApiResponse(EndPoints::CountriesIndexGetApi);
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);

        // Referee
        $platforms = PlatformService::getApiResponse(EndPoints::PlatformIndexGetApi);

        // coach
        $educationLevel = ApiService::GetDataByEndPoint(EndPoints::GetEducationLevelsIndexApi, session('mainToken'));
        $games = PlatformService::getApiResponse(EndPoints::GamesIndexGetApi);
        $nationalities = NationalityService::getApiResponse(EndPoints::NationalitiesIndexGetApi);
//        dd($educationLevel);


       $user = session()->has('loggedUser') ? session('loggedUser') : '';
        // $user = ApiService::GetDataByEndPoint(EndPoints::GetCoachInfoApi,$token);
        // $user = $user['result'];
      // dd($user);
        switch ($user['client']['type']) {
            case 'Player':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetPlayerInfoApi, $token);
                // Check if the user still activated from dashboard or not
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.player.edit-client-profile', compact('pageInfo','user','platforms','games','nationalities', 'educationLevel'));
                break;
            case 'Manager' :
                $user = ApiService::GetDataByEndPoint(EndPoints::GetManagersInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.Manager.edit-client-profile', compact('pageInfo','user','nationalities', 'games', 'educationLevel'));
                break;
            case 'Coach':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetCoachInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.Coach.edit-client-profile', compact('pageInfo','user','nationalities', 'games', 'educationLevel'));
                break;
            case 'Referee':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetRefereesInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.judgment.edit-client-profile', compact('pageInfo','user','games', 'platforms', 'nationalities'));
                break;
            case 'Commentator':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetCommentatorsInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.Commentator.edit-client-profile', compact('pageInfo','user','nationalities'));
                break;
            case 'Content-Creator':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetContentCreatorsInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.Content-Creator.edit-client-profile', compact('pageInfo','user','nationalities'));
                break;
            case 'Club':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetClubsInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.Clubs.edit-client-profile', compact('pageInfo','user', 'princedoms'));
                break;
            case 'Academy':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetAcademiesInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.Academy.edit-client-profile', compact('pageInfo','user','countries','princedoms'));
                break;
            case 'Sport-Company':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetSportCompaniesInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.sports-services.edit-client-profile', compact('pageInfo','user','princedoms'));
                break;
            case 'WebSite-Follower':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetFollowerInfoApi,$token);
                if ($user['hasErrors'] && isset($user['validationErrors'][0]['field']) && $user['validationErrors'][0]['field'] == 'User') {
                    return $this->accountNotActive($user['validationErrors'][0]['errors'][0]);
                }
                $user = $user['result'];
                return view('auth.account.follower.edit-client-profile', compact('pageInfo','user'));
                break;
        }
    }

    public function save_profile(Request $request)
    {
        $dataIn = $request->all();
        //        dd($dataIn);
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
            // dd($user['personInfo']['passport']['imagePath']);
        switch ($dataIn['account-type']) {
            case 'WebSite-Follower':
                $data = $this->generateRequestFollowerData($dataIn);
                break;
            case 'Player':
            case 'Referee':
            case 'Coach':
            case 'Manager':
            case 'Commentator':
            case 'Content-Creator':
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
            case 'Club':
            case 'Academy':
            case 'Sport-Company':
                $data = $this->generateClubRequestData($dataIn);
                $image = $this->uploadFiles($request, 'file');
                $clubLicenceImage = $this->uploadFiles($request, 'licenceImage');
                $clubPassportImage = $this->uploadFiles($request, 'passport-file');
                if(!is_null($image)){
                    $data['orgnizationInfo']['image'] = $image;
                }
                if (!is_null($clubPassportImage)) {
                    $data['orgnizationInfo']['owner']['passport']['image'] = $clubPassportImage;
                }
                if (!is_null($clubLicenceImage)) {
                    $data['orgnizationInfo']['licenceImage'] = $clubLicenceImage;
                }
                break;
        }
        // dd($data);
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
        //    dd($response);
        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->with('error', trans('auth.invalid-data'));

        }
        //   dd($response);
        if (isset($response['hasErrors']) && !$response['hasErrors']) {
            if (session()->has('loggedUser')) {
                session()->forget('loggedUser');
                session()->put('loggedUser', $response['result']);
            }
            session()->put('memberSuccessRegister', trans('auth.account-successfully-modified'));
            return redirect(url(App::getLocale() . '/myaccount'));
        } else {
            return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
//            return back()->with('error', trans('auth.invalid-data'));
        }
    }
    public function edit_Player_ByClient_profile($slug='',$id)
    {
        $token = session('token');

        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        $pageInfo['title'] = trans('auth.edit-profile');
        $pageInfo['keywords'] = trans('all.home-keywords');
        $pageInfo['description'] = trans('site.description');
        $clubTypes = ClubsService::getApiResponse(EndPoints::GetClubTypesApi);
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);

        // academy
        $countries = CountriesService::getApiResponse(EndPoints::CountriesIndexGetApi);
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);

        // Referee
        $platforms = PlatformService::getApiResponse(EndPoints::PlatformIndexGetApi);
        $games = PlatformService::getApiResponse(EndPoints::GamesIndexGetApi);
        $nationalities = NationalityService::getApiResponse(EndPoints::NationalitiesIndexGetApi);

        // coach
        $educationLevel = ApiService::GetDataByEndPoint(EndPoints::GetEducationLevelsIndexApi, session('mainToken'));
        $games = PlatformService::getApiResponse(EndPoints::GamesIndexGetApi);
        $nationalities = NationalityService::getApiResponse(EndPoints::NationalitiesIndexGetApi);

        // Sport-Company
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsIndexGetApi);

       $user = session()->has('loggedUser') ? session('loggedUser') : '';
        // $user = ApiService::GetDataByEndPoint(EndPoints::GetCoachInfoApi,$token);
        // $user = $user['result'];
      // dd($user);
        switch ($user['client']['type']) {
            case 'Player':
                $responses = ApiService::GetDataByMultiEndPoint([EndPoints::EducationLevelsGetAllApi, EndPoints::PlatformIndexGetApi, EndPoints::GamesIndexGetApi, EndPoints::NationalitiesGetAllApi], session('mainToken'));
                $educationLevel = $responses[0];
                $platforms = $responses[1];
                $games = $responses[2];
                $nationalities = $responses[3];
                $user = ApiService::GetDataByEndPoint(EndPoints::GetPlayerInfoApi, $token);
                $user = $user['result'];
                return view('auth.account.player.edit-client-profile', compact('pageInfo', 'educationLevel', 'user','platforms','games','nationalities'));
                break;
            case 'Manager' :
                $user = ApiService::GetDataByEndPoint(EndPoints::GetManagersInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.Manager.edit-client-profile', compact('pageInfo','user','nationalities', 'games', 'educationLevel'));
                break;
            case 'Coach':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetCoachInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.Coach.edit-client-profile', compact('pageInfo','user','nationalities', 'games', 'educationLevel'));
                break;
            case 'Referee':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetRefereesInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.judgment.edit-client-profile', compact('pageInfo','user','games', 'platforms', 'nationalities'));
                break;
            case 'Commentator':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetCommentatorsInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.Commentator.edit-client-profile', compact('pageInfo','user','nationalities'));
                break;
            case 'Content-Creator':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetContentCreatorsInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.Content-Creator.edit-client-profile', compact('pageInfo','user','nationalities'));
                break;
            case 'Club':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetClubsInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.Clubs.edit-client-profile', compact('pageInfo','user','clubTypes','princedoms'));
                break;
            case 'Academy':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetAcademiesInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.Academy.edit-client-profile', compact('pageInfo','user','countries','princedoms'));
                break;
            case 'Sport-Company':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetSportCompaniesInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.sports-services.edit-client-profile', compact('pageInfo','user','princedoms'));
                break;
            case 'WebSite-Follower':
                $user = ApiService::GetDataByEndPoint(EndPoints::GetFollowerInfoApi,$token);
                $user = $user['result'];
                return view('auth.account.follower.edit-client-profile', compact('pageInfo','user'));
                break;
        }
    }

    public function save_Player_ByClient_profile(Request $request)
    {
        $dataIn = $request->all();
        //        dd($dataIn);
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
            // dd($user['personInfo']['passport']['imagePath']);
        switch ($dataIn['account-type']) {
            case 'WebSite-Follower':
                $data = $this->generateRequestFollowerData($dataIn);
                break;
            case 'Player':
            case 'Referee':
            case 'Coach':
            case 'Manager':
            case 'Commentator':
            case 'Content-Creator':
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
            case 'Club':
            case 'Academy':
            case 'Sport-Company':
                $data = $this->generateClubRequestData($dataIn);
                $image = $this->uploadFiles($request, 'file');
                $clubLicenceImage = $this->uploadFiles($request, 'licenceImage');
                $clubPassportImage = $this->uploadFiles($request, 'passport-file');
                if(!is_null($image)){
                    $data['orgnizationInfo']['image'] = $image;
                }
                if (!is_null($clubPassportImage)) {
                    $data['orgnizationInfo']['owner']['passport']['image'] = $clubPassportImage;
                }
                if (!is_null($clubLicenceImage)) {
                    $data['orgnizationInfo']['licenceImage'] = $clubLicenceImage;
                }
                break;
        }
        // dd($data);
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
        //    dd($response);
        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->with('error', trans('auth.invalid-data'));

        }
        //   dd($response);
        if (isset($response['hasErrors']) && !$response['hasErrors']) {
            if (session()->has('loggedUser')) {
                session()->forget('loggedUser');
                session()->put('loggedUser', $response['result']);
            }
            session()->put('memberSuccessRegister', trans('auth.account-successfully-modified'));
            return redirect(url(App::getLocale() . '/myaccount'));
        } else {
            return back()->with('error', trans('auth.invalid-data'));
        }
    }

    private function generateRequestFollowerData($dataIn)
    {
        $userId = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $userId['id'];
        // $userName = explode('@', $dataIn['userName'])[0];
        // $userName = str_replace('#', '', $userName);
        // $userName = str_replace('.', '', $userName);
        // $userName = str_replace('-', '', $userName);
        // $userName = str_replace('_', '', $userName);
        $data = [
            "id" => $userId,
            'name' => $dataIn['name'],
            "clientId" => $dataIn['clientId'],
            'client' => [
                "id" => $dataIn['clientId'],
                'type' => $dataIn['account-type'],
                'name' => $dataIn['name'],
                // "state": "Accepted",
                // "requestDeleted": false,
                // "userId": "string",
                'email' => $dataIn['email'],
                // 'userName' => $userName,
                // 'password' => $dataIn["password"],
                // 'confirmPassword' => $dataIn["password_confirmation"]
            ],
            'email' => $dataIn['email'],
        ];
        return $data;
    }

    private function generateRequestData($dataIn)
    {
        $userId = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $userId['id'];
        $data = [
            'id' => $userId,
            'name' => $dataIn['name'],
            'clientId' => $dataIn['clientId'],
            'client' => [
                'id' => $dataIn['clientId'],
                'type' => isset($dataIn['account-type']) ? $dataIn['account-type'] : null,
                'name' => $dataIn['name'],
                'email' => isset($dataIn['email']) ? $dataIn['email'] : null,
                // 'userName' => $userName,
                // 'password' => $dataIn["password"],
                // 'confirmPassword' => $dataIn["password_confirmation"]
            ],
            'personInfoId' => $dataIn['personInfoId'],
            'personInfo' => [
                'id' => $dataIn['personInfoId'],
                'birthDate' => isset($dataIn['BirthDate']) ? $dataIn['BirthDate'] : null,
                'gender' => isset($dataIn['gender']) ? $dataIn['gender'] : null,
                'socialStatus' => isset($dataIn['socialStatus']) ? $dataIn['socialStatus'] : null,
                'uaeResidency' => $dataIn['uaeResidency'] == 'false' ? false : true,
                // 'uaeIdNumber' => $dataIn['uaeIdNumber'],
                // 'uaeIdEndDate' => $dataIn['uaeIdEndDate'],
                // 'membershipNumber' => '234243',
                // 'membershipEndDate' => '2022-10-08T00:00:00',
                // 'educationLevelName' => null,
                'educationLevelId' => $dataIn['educationLevelId'],
                'email' => $dataIn['email'],
                'phone' => $dataIn['phone'],
                'address' => null,
                // 'idCardNumber' => 1234568988,
                // 'nationalityId' => $dataIn['NationalityId'],
                'nationalityId' => isset($dataIn['NationalityId']) ? $dataIn['NationalityId'] : null,
                'nationalityName' => 'KSA',
                'passportId' => $dataIn['passportId'],
//                'EducationLevelId' => $dataIn['EducationLevelId'],
                'passport' => [
                    'id' => $dataIn['passportId'],
                    'number' => $dataIn['passportNumber'],
                    'countryId' => 1,
                    'countryName' => '',
                    'startDate' => $dataIn['StartDate'],
                    'endDate' => $dataIn['EndDate']
                ],
                'princedomId' => $dataIn['uaeResidency'] == 'true' ? $dataIn['princedomId'] : null,
                'princedomName' => 'دبي',
                'facebook' => isset($dataIn['facebook']) ? $dataIn['facebook'] : null,
                'twitter' => isset($dataIn['twitter']) ? $dataIn['twitter'] : null,
                'instagram' => isset($dataIn['instagram']) ? $dataIn['instagram'] : null,
                'youTube' => isset($dataIn['youtube']) ? $dataIn['youtube'] : null,
                'discord' => isset($dataIn['discord']) ? $dataIn['discord'] : null,
                'tikTok' => isset($dataIn['tikTok']) ? $dataIn['tikTok'] : null,
                'twitch' => isset($dataIn['twitch']) ? $dataIn['twitch'] : null,
            ],
            'clubId' => $dataIn['clubId'],
            'clubName' => '',
            'academyId' => $dataIn['academyId'],
            'academyName' => '',
            'careerStartDate' => '2022-10-07T00:00:00',
            // 'nationalTeamId' => null,
        ];
        switch ($dataIn['account-type']) {
            case 'Player':
                if (isset($dataIn['playerPlatforms'])) {
                    $playerPlatforms = [];
                    foreach ($dataIn['playerPlatforms'] as $platform) {
                        $platformExplode = explode('|', $platform);
                        $platform = [
                            'playerId' => $userId,
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
                            'playerId' => $userId,
                            'playerName' => $dataIn['name'],
                            'gameId' => $gameExplode[0],
                            'gameName' => $gameExplode[1],
                            'team' => false
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
                            'coachId' => $userId,
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
                            'managerId' => $userId,
                            'gameId' => $gameExplode[0],
                            'gameName' => $gameExplode[1],
                        ];
                        array_push($managerGames, $game);
                    }
                    $data['managerGames'] = $managerGames;
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
        }
        return $data;
    }
    private function generateClubRequestData($dataIn)
    {
        $userId = session()->has('loggedUser') ? session('loggedUser') : '';
        $userId = $userId['id'];
        // $userName = explode('@', $dataIn['userName'])[0];
        // $userName = str_replace('#', '', $userName);
        // $userName = str_replace('.', '', $userName);
        // $userName = str_replace('-', '', $userName);
        // $userName = str_replace('_', '', $userName);
        $data = [
            'id' => $userId,
            'name' => $dataIn['name'],
            'clientId' => $dataIn['clientId'],
            'client' => [
                'id' => $dataIn['clientId'],
                'name' => $dataIn['name'],
                'type' => $dataIn['account-type'],
                'email' => $dataIn['email'],
                // 'userName' => $userName,
                // 'password' => $dataIn["password"],
                // 'confirmPassword' => $dataIn["password_confirmation"]
            ],
            'orgnizationInfoId' => $dataIn['orgnizationInfoId'],
            'orgnizationInfo' => [
                'id' => $dataIn['orgnizationInfoId'],
                'email' => $dataIn['email'],
                'phone' => $dataIn['phone'],
                'website' => $dataIn['website'],
                'fax' => $dataIn['fax'],
                'address' => $dataIn['address'],
                'ownerId' => $dataIn['ownerId'],
                'owner' => [
                    'id' => $dataIn['ownerId'],
                    'name' => $dataIn['OName'],
                    ////'passportId' => $dataIn['passportId'],
                    'passport' => [
                        ////'id' => $dataIn['passportId'],
                        'number' => $dataIn['passportNumber'],
                        'StartDate' => $dataIn['StartDate'],
                        'EndDate' => $dataIn['EndDate'],
                        // 'image' => []
                    ],
                ],
                'licenceEndDate' => $dataIn['licenceEndDate'],
                'licenceNumber' => null,
                'licenceIssuar' => null,
                'licencePrincedomName' => null,
                // 'licenceImage' => [],
                'princedomId' => $dataIn['princedomId'],
                'facebook' => $dataIn['facebook'],
                'twitter' => $dataIn['twitter'],
                'instagram' => $dataIn['instagram'],
                'youtube' => $dataIn['youtube'],
                'discord' => $dataIn['discord'],
                'tikTok' => $dataIn['tikTok'],
                'twitch' => $dataIn['twitch'],
            ],

        ];
        // switch ($dataIn['account-type']) {
        //     case 'Club':
        //         $data['ClubTypeId'] = $dataIn['ClubTypeId'];
        //         break;
        // }
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

    public function createUserClass($data)
    {

        $user = new ApiUser();
        $user->id           = $data["id"];
        $user->image        = $data['image'];
        // $user->userName     = $data["userName"];
        $user->name         = $data["name"];
        $user->email        = $data["email"];
        $user->phone        = $data["phone"];
        $user->mobile       = $data["mobile"];
        if(session('loggedUser')->isCompany) {
            $user->officePhone = !is_null($data['officePhone']) ? $data['officePhone'] : '';
            $user->fax = !is_null($data['fax']) ? $data['fax'] : '';
            $user->address = !is_null($data['address']) ? $data['address'] : '';
            $user->state = !is_null($data['state']) ? $data['state'] : '';
            $user->isCompany = session('loggedUser')->isCompany;
        }
        return $user;
    }

    private function validationArray($type)
    {
        switch ($type) {
            case 'WebSite-Follower':
                $validationArray = [
                    "name" => "required",
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    // 'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    // 'password_confirmation' => 'required'
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
                    // "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
//                    "EducationLevelId" => 'required',
//                    "uaeResidency" => 'required|in:0,1',
                    // "uaeIdNumber" => 'required',
                    // "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
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
            case 'Commentator':
            case 'Content-Creator':
                $validationArray = [
                    "name" => "required",
                    // "lastName" => 'required',
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
                    // "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
//                    "EducationLevelId" => 'required',
//                    "uaeResidency" => 'required|in:0,1',
                    // "uaeIdNumber" => 'required',
                    // "uaeIdEndDate" => 'required|date',
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
                    // "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
//                    "uaeResidency" => 'required|in:0,1',
                    // "uaeIdNumber" => 'required',
                    // "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
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
                    // "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
//                    "uaeResidency" => 'required|in:0,1',
                    // "uaeIdNumber" => 'required',
                    // "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
                    // 'managerGames' => 'required',
                    // 'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    // 'password_confirmation' => 'required'
                ];
                break;
            case 'Referee':
                $validationArray = [
                    "name" => "required",
                    // "lastName" => 'required',
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    "phone" => 'required|numeric',
                    "gender" => 'required|in:M,F',
                    // "socialStatus" => 'required|in:Married,Single',
                    "BirthDate" => 'required|date',
//                    "uaeResidency" => 'required|in:0,1',
                    // "uaeIdNumber" => 'required',
                    // "uaeIdEndDate" => 'required|date',
                    "NationalityId" => 'required',
                    "passportNumber" => 'required',
                    'refereeGames' => 'required',
                    // 'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    // 'password_confirmation' => 'required'
                ];
                break;
            case 'Club':
                $validationArray = [
                    "name" => "required",
                    'email' => 'required|email',
                    "phone" => 'required|numeric',
                     'account-type' => 'required|in:Player,Coach,Manager,referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    'licenceEndDate' => 'required|date',
                    'StartDate' => 'required|date',
                    'EndDate' => 'required|date',
                    // 'ClubTypeId' => 'required',
                    // 'princedomId' => 'required',
                    'passportNumber' => 'required',
//                    "website" => 'required',
                    "address" => 'sometimes|nullable',
                    "fax" => 'sometimes|nullable',
                    // 'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    // 'password_confirmation' => 'required'
                ];
                break;
            case 'Academy':
            case 'Sport-Company':
                $validationArray = [
                    "OName" => "required",
                    "name" => "required",
                    'email' => 'required|email',
                    // 'userName' => 'required',
                    "phone" => 'required|numeric',
                    'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
                    'licenceEndDate' => 'required|date',
                    'StartDate' => 'required|date',
                    'EndDate' => 'required|date',
                    // 'princedomId' => 'required',
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
                    // 'password' => ['required', 'confirmed', 'max:16', Password::min(6)],
                    // 'password_confirmation' => 'required'
                ];
                break;
        }
        return $validationArray;
    }

    public function upload(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:png,jpg,jpeg,gif'
             ], [
                 'file.mimes' => trans('individually.allow-file-type-msg')
             ]);
            // Validate message if error
            if ($validator->fails()) {
               return response()->json(['error' => $validator->errors()->first('file')], Response::HTTP_NOT_ACCEPTABLE);
            }

            if ($request->hasFile('file')) {
                $uploadFile = $request->file('file');

                $fileSize = $uploadFile->getSize();
	            $fileNameWithExt = $uploadFile->getClientOriginalName();                    // ex : (example.png)
	            $filenameWithOutEXt = pathinfo($fileNameWithExt, PATHINFO_FILENAME);  // ex : (example)
	            $fileExtension = $uploadFile->getClientOriginalExtension();                 // ex : (png)
                $mimeType = $uploadFile->getClientMimeType();                               // ex : (image/jpeg)

//	            $imgFile = new \stdClass();
	            $imgFile = [];
                $imgFile['data'] = $request->imgBase64String;
//                $imgFile->fileType = "image/" . $fileExtension;
                $imgFile['fileType'] = $mimeType;
                $imgFile['size'] = $fileSize;
                $imgFile['name'] = $fileNameWithExt;

//                $file = new File();
                $file = [];
//                $file->userId = $request->userId;
//                $file['userId'] = $request->userId;
//                $file->imgFile = $imgFile;
                $file['image'] = $imgFile;

                try {
                    $response = ApiService::PostDataByEndPoint(EndPoints::uploadProfilePicApi, $file, session('mainToken'));
                } catch(\Exception $e) {
                    dd($e->getMessage());
                }
                if (!$response['hasErrors']) {
                    if (!session()->has('profileImageUrl')) {
                        session()->put('profileImageUrl', $response['result']);
                    } else {
                        session()->forget('profileImageUrl');
                        session()->put('profileImageUrl', $response['result']);
                    }
                    return response()->json([
                        'success' => trans('auth.upload-success-msg'),
                        'url' => $response['result']
                    ], Response::HTTP_OK);
                } else {
                    return response()->json(['error' => trans('product.server-error-msg')], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
        }
    }

    public function getClubPlayerDetailsAjax(Request $request)
    {
        if ($request->ajax()) {
            $response = ApiService::GetDataByEndPoint(EndPoints::PlayersApi . '/' . $request->id , session('mainToken'));
            $clientEventResponse = ApiService::GetDataByEndPoint(EndPoints::GetClientEventsApi, session('token'));
            $player = $response['result'];
            $events = $clientEventResponse['result'];
        //    dd($player);
            if (count($player) > 0) {
                $html = view('auth.account.Clubs.ajax_player_details', compact('player', 'events'))->render();
//                return response()->json(['data' => json_encode($html, JSON_INVALID_UTF8_IGNORE)]);
                return response()->json(['data' => $html]);
            }
        }
        return 'Server Error, Method Not Allowed';
    }

    public function getClubPlayerEventsDetailsAjax(Request $request)
    {
        if ($request->ajax()) {
            $response = ApiService::GetDataByEndPoint(EndPoints::GetEventsApi . '/' . $request->id, session('mainToken'));
            $event = $response['result'];
//            dd($event);
            if (!is_null($event)) {
                $html = view('auth.account.Clubs.ajax_event_details', compact('event'))->render();
                return response()->json(['data' => $html]);
            }
        }
        return 'Server Error, Method Not Allowed';
    }

    public function getClubCoachDetailsAjax(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'Coach') {
                $response = ApiService::GetDataByEndPoint(EndPoints::GetCoachDetailsApi . $request->id , session('mainToken'));
            } else {
                $response = ApiService::GetDataByEndPoint(EndPoints::GetManagersDetailsApi . $request->id , session('mainToken'));
            }
//            dd($response);
            $data = $response['result'];
        //    dd($data);
            if (count($data) > 0) {
                if ($request->type == 'Coach') {
                    $html = view('auth.account.Clubs.ajax_coach_details', compact('data'))->render();
                } else {
                    $html = view('auth.account.Clubs.ajax_manager_details', compact('data'))->render();
                }
                return response()->json(['data' => $html]);
            }
        }
        return 'Server Error, Method Not Allowed';
    }


    public function getPlayerTeamDetailsAjax(Request $request)
    {
        if ($request->ajax()) {
            $response = ApiService::GetDataByEndPoint(EndPoints::GetTeamsApi . '/' . $request->id , session('mainToken'));
//            $response = ApiService::GetDataByEndPoint(EndPoints::GetPlayerTeamDetailsApi , session('token'));
//            dd($response['result']);
            $team = $response['result'];
            if (count($team) > 0) {
                $html = view('auth.account.player.ajax_team_details', compact('team'))->render();
                return response()->json(['data' => $html]);
            }
        }
        return 'Server Error, Method Not Allowed';
    }

    public function playerTeamRequestAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $player = ($request->type == 'AddNew') ? $this->getPlayerInformation($request->playerId) : null;
                $data = $this->generateTeamRequestData($request->all(), $user, $player);
                $response = ApiService::PostDataByEndPoint(EndPoints::PostTeamRequestsApi, $data, session('token'));
//                if (isset($response['hasErrors']) && $response['hasErrors']) {
//                    return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
//                }
                switch ($data['type']) {
                    case 'Add' :
                        $successMessage = trans('all.success-add-player-to-team');
                        $errorMessage = trans('all.server-error-msg');
                        break;
                    case 'AddNew' :
                    case 'Join' :
                        $successMessage = trans('all.player-send-invitation');
                        $errorMessage = trans('all.server-error-msg');
                        break;
                    case 'Remove' :
                        $successMessage = trans('all.player-remove-player-request');
                        $errorMessage = trans('all.server-error-msg');
                        break;
                    case 'Leave':
                        $successMessage = trans('all.player-leave-request-team');
                        $errorMessage = trans('all.player-leave-pending-request');
                        break;
                    case 'Create':
                    default:
                        if ($user['client']['type'] == 'Club') {
                            $errorMessage = trans('all.club-create-pending-request');
                        } else {
                            $errorMessage = trans('all.player-create-pending-request');
                        }
                        $successMessage = trans('site.success-team-create-request');
                        break;
                }
                if (isset($response['hasErrors']) && !$response['hasErrors']) {
                    return response()->json([
                        'error' => false,
                        'result' => $successMessage,
                        'data' => $response['result']
                    ], Response::HTTP_OK);
                }
                if (isset($response['hasErrors']) && $response['hasErrors']) {
                    if (isset($response['validationErrors'][0])) {
                        return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
                    } else {
                        return response()->json([
                            'error' => true,
                            'result' => $errorMessage
                        ]);
                    }
                }
                return $this->serverErrorResponse();
            } catch (\Exception $e) {
                return $this->serverErrorResponse();
            }
        }
        return 'Server Error, Method Not Allowed, Must Be Through Ajax';
    }


    private function generateTeamRequestData($dataIn, $user, $player = null)
    {
        switch ($dataIn['type']) {
            case 'Join':
                $data = [
                    "id" => 0,
                    "type" => "Join",
                    "teamId" => $dataIn['teamId'],
                    "playerId" => $dataIn['playerId'],
                ];
                break;
            case 'AddNew':
                $data = [
                    "type" => "AddNew",
                    "teamId" => isset($dataIn['teamId']) ? $dataIn['teamId'] : (session()->has('teamId') ? session('teamId') : ''),
                    "player" => $player
                ];
                break;
            case 'Add':
                $data = [
                    "id" => 0,
                    "type" => "Add",
                    "teamId" => isset($dataIn['teamId']) ? $dataIn['teamId'] : (session()->has('teamId') ? session('teamId') : ''),
                    "playerId" => $dataIn['playerId']
                ];
//                if ($user['client']['type'] == 'Club') {
//                    unset($data['isTeamHead']);
//                }
                break;
            case 'leave':
                $data = ["type" => "Leave"];
                break;
            case 'remove':
                $data = [
                    "type" => "Remove",
                    "teamId" => $dataIn['teamId'],
                    "playerId" => $dataIn['playerId']
                ];
                break;
            case 'create':
            default:
                $data = [
                    "type" => "Create",
                    "playerName" => $user['name'],
                    "team" => [
                        "name" => $dataIn['name'],
                        "logoImage" => [
                            'data' => $dataIn['file-imgBase64String'],
                            'fileType' => $dataIn['file-type'],
                            'size' => $dataIn['file-size'],
                            'name' => $dataIn['file-name'],
                        ]
                    ]
                ];
                if ($user['client']['type'] == 'Club') {
                    unset($data['playerName']);
//                    $data['team']['clubId'] = $user['id'];
                }
        }
        return $data;
    }

    private function getPlayerInformation($playerId)
    {
        try {
            $response = ApiService::GetDataByEndPoint(EndPoints::GetAnyPlayerInfoApi . $playerId, session('mainToken'));
            if (isset($response['hasErrors']) && !$response['hasErrors']) {
                return $response['result'];
            }
            return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
        } catch(\Exception $e) {
            return $this->serverErrorResponse();
        }
    }

    public function getPlayerRequestsAjax(Request $request)
    {
        if ($request->ajax()) {
            $response = ApiService::GetDataByEndPoint(EndPoints::GetClientTeamRequestsApi, session('token'));
            $requests = $response['result'];
            if (count($requests) > 0) {
                $html = view('auth.account.player.ajax_player_requests', compact('requests'))->render();
                return response()->json(['error' => false, 'data' => $html]);
            } else {
                return response()->json(['error' => true, 'data' => '', 'result' => trans('site.player_requests_empty')]);
            }
        }
        return 'Server Error, Method Not Allowed';
    }

    public function getPlayerInvitationsAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $response = ApiService::GetDataByEndPoint(EndPoints::GetPlayerInvitationsApi , session('token'));
                if (!is_null($response) && isset($response['hasErrors']) && !$response['hasErrors']) {
                    $invitations = $response['result'];
                    if (count($invitations) > 0) {
                        $clientTeamRequests = ApiService::GetDataByEndPoint(EndPoints::GetPlayerTeamDetailsApi , session('token'));
//                    $isJoinedTeam = $clientTeamRequests['result'] != null || count($clientTeamRequests['result']) > 0;
                        $isJoinedTeam = $clientTeamRequests['result'] != null;
                        $html = view('auth.account.player.ajax_player_invitations', compact('invitations', 'isJoinedTeam'))->render();
                        return response()->json(['error' => false, 'data' => $html]);
                    } else {
                        return response()->json(['error' => true, 'data' => '', 'result' => trans('site.player_invitations_empty')]);
                    }
                } else {
                    return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
                }
            } catch(\Exception $e) {
                return $this->serverErrorResponse();
            }

        }
        return 'Server Error, Method Not Allowed';
    }

    public function playerAcceptInvitationAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = [
                  'id' => $request->id,
                  'state' => 'Accepted'
                ];
                $response = ApiService::PostDataByEndPoint(EndPoints::PlayerAcceptInvitationApi . $request->id , $data, session('token'));
                if (!is_null($response)) {
                    $invitations = $response['result'];
                    if (count($invitations) > 0) {
                        return response()->json(['error' => false, 'result' => trans('all.accept-invitation-message')]);
                    } else {
                        return $this->serverErrorResponse();
                    }
                } else {
                    return $this->serverErrorResponse();
                }
            } catch(\Exception $e) {
                return $this->serverErrorResponse();
            }

        }
        return 'Server Error, Method Not Allowed';
    }

    public function searchAcceptedPlayerAjax(Request $request)
    {
        if ($request->ajax()) {
            $queryParams = 'name=' . $request->name . '&email=' . $request->email . '&cardid=' . $request->cardid;
            $response = ApiService::GetDataByEndPoint(EndPoints::SearchForPlayerApi . $queryParams, session('token'));
//            dd($response);
            if (!$response['hasErrors']) {
                $players = $response['result'];
                if (count($players) > 0) {
                    $html = view('auth.account.player.ajax_search_player_result', compact('players'))->render();
                    return response()->json(['error' => false, 'data' => $html]);
                } else {
                    return response()->json(['error' => true, 'data' => trans('site.search_player_empty')]);
                }
            }
            return $this->serverErrorResponse();
        }
        return 'Server Error, Method Not Allowed';
    }

    public function renderPlayerFormAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $responses = ApiService::GetDataByMultiEndPoint([EndPoints::EducationLevelsGetAllApi, EndPoints::PlatformIndexGetApi, EndPoints::GamesIndexGetApi, EndPoints::NationalitiesGetAllApi], session('mainToken'));
                $educationLevel = $responses[0];
                $platforms = $responses[1];
                $games = $responses[2];
                $nationalities = $responses[3];
                $clientTeamRequests = ApiService::GetDataByEndPoint(EndPoints::GetPlayerTeamDetailsApi , session('token'));
                $teamId = !is_null($clientTeamRequests) ? $clientTeamRequests['result']['id'] : (session()->has('teamId') ? session('teamId') : '');
                $html = view('auth.account.player.player-registarion-form', compact('games', 'platforms', 'nationalities', 'educationLevel', 'teamId'))->render();
                return response()->json(['error' => false, 'data' => $html]);
            } catch(\Exception $e) {
//                return response()->json(['error' => true, 'data' => $e->getMessage()]);
                return $this->serverErrorResponse();
            }
        }
        return 'Server Error, Method Not Allowed';
    }

    public function renderPlayerEditFormAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $teamDetails = ApiService::GetDataByEndPoint(EndPoints::GetPlayerTeamDetailsApi , session('token'));
                if (!is_null($teamDetails)) {
                    $teamDetails = $teamDetails['result'];
                    $html = view('auth.account.player.edit-team-details', compact('teamDetails'))->render();
                    return response()->json(['error' => false, 'data' => $html]);
                }
                return $this->serverErrorResponse();
            } catch(\Exception $e) {
                return $this->serverErrorResponse();
            }
        }
        return 'Server Error, Method Not Allowed';
    }

    public function updateTeamInfoAjax(Request $request)
    {
        if ($request->ajax()) {
            try {
                $dataIn = $request->all();
                $data['id'] = $dataIn['teamId'];
                $data['name'] = $dataIn['team-name'];
                $data['teamHeadId'] = $dataIn['teamHeadId'];
                if (isset($dataIn['clubId'])) {
                    $data['clubId'] = $dataIn['clubId'];
                }
                if (isset($dataIn['academyId'])) {
                    $data['academyId'] = $dataIn['academyId'];
                }
                if (isset($dataIn['file'])) {
                    $image = $this->uploadFiles($request, 'file');
                    $data['logoImage'] = $image;
                }

                $response = ApiService::PutDataByEndPoint(EndPoints::UpdateTeamsInfoApi, $data, session('token'));
                if (isset($response['hasErrors']) && !$response['hasErrors']) {
                    return response()->json(['error' => false, 'data' => $response['result'], 'result' => trans('site.successfully-update-team-info')]);
                }
                return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
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

    public function playerRegisterNewPlayerAjax(Request $request)
    {
        if ($request->ajax()) {
            $dataIn = $request->all();
            $validationArray = $this->playerValidationArray();
            $validator = Validator::make($dataIn, $validationArray, [
                "name.required" => trans('validation.required', ['field' => trans('individually.name')]),
                "Name.required" => trans('validation.required', ['field' => trans('institutions.clubName')]),
                // "ClubTypeId.required" => trans('validation.required', ['field' => trans('institutions.ClubType')]),
                "firstName.required" => trans('validation.required', ['field' => trans('institutions.firstName')]),
                "lastName.required" => trans('validation.required', ['field' => trans('institutions.lastName')]),
                "email.required" => trans('validation.required', ['field' => trans('auth.email')]),
                "account-type.required" => trans('validation.required', ['field' => trans('auth.account-type')]),
                "phone.required" => trans('validation.required', ['field' => trans('auth.phone')]),
                "gender.required" => trans('validation.required', ['field' => trans('auth.gender')]),
                "socialStatus.required" => trans('validation.required', ['field' => trans('auth.socialStatus')]),
                "licenceEndDate.required" => trans('validation.required', ['field' => trans('institutions.licensedate')]),
                "StartDate.required" => trans('validation.required', ['field' => trans('institutions.startPassportDate')]),
                "EndDate.required" => trans('validation.required', ['field' => trans('institutions.endPassportDate')]),
//                "education_degree.required" => trans('validation.required', ['field' => 'education_degree']),
                "BirthDate.required" => trans('validation.required', ['field' => trans('auth.birthDate')]),
    //            "uaeResidency.required" => trans('validation.required', ['field' => 'uaeResidency']),
                //"uaeIdNumber.required" => trans('validation.required', ['field' => trans('individually.emirates-number')]),
                //"uaeIdEndDate.required" => trans('validation.required', ['field' => trans('individually.emirates-expiry-date')]),
                "educationLevelId.required" => trans('validation.required', ['field' => trans('individually.educational-level')]),
                "NationalityId.required" => trans('validation.required', ['field' => trans('individually.nationality')]),
                "passportId.required" => trans('validation.required', ['field' => trans('individually.passport-number')]),
                "princedomId.required" => trans('validation.required', ['field' => trans('institutions.princedoms')]),
                // "playerPlatforms.required" => trans('validation.required', ['field' => trans('individually.platform')]),
                // "playerGames.required" => trans('validation.required', ['field' => trans('individually.game-platform')]),
                "coachGames.required" => trans('validation.required', ['field' => trans('individually.game-platform')]),
                "refereeGames.required" => trans('validation.required', ['field' => trans('individually.game-platform')]),
                "password.required" => trans('validation.required', ['field' => trans('auth.password')]),
                "password_confirmation.required" => trans('validation.required', ['field' => trans('auth.confirm-password')]),
                'password.max' => trans('auth.max-password'),
                'password.min' => trans('auth.min-password'),
                'password.confirmed' => trans('auth.confirmed-password-msg'),
                'account-type.in' => trans('auth.allow-account-type-msg'),
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
//                dd($errors);
                $txt = "";
                if ( ! empty( $errors ) ) {
                    foreach ($errors->all() as $message){
                        $txt .= '<div class="text-danger"><p class="mb-0">' . $message . '</p></div>';
                    }
                }
                return response()->json([
                    'error' => true,
                    'result' => $txt,
                ]);
            }
            try {
                $image = $this->uploadFiles($request, 'file');
                $passportImage = $this->uploadFiles($request, 'passport-file');
                $data = $this->playerRequestData($dataIn);
//                dd($data);
                $data['personInfo']['image'] = $image;
                $data['personInfo']['passport']['image'] = $passportImage;
//                dd($data);
                return $this->sendPlayerInvitations($dataIn['team-id'], $data);
//                $response = ApiService::PostDataByEndPoint(EndPoints::registerPlayersApi, $data);
//                if (isset($response['hasErrors']) && !$response['hasErrors']) {
                    // Send Player Invitation
//                } else {
//                    if (isset($response['validationErrors'][0]['field']) && $response['validationErrors'][0]['field'] == 'User') {
//                        return $this->invalidResponse(trans('auth.register-user-exists'));
//                    }
//                    if (isset($response['validationErrors'][0]['field']) && $response['validationErrors'][0]['field'] == 'Validation') {
//                        return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
//                    }
//                    return $this->invalidResponse();
//                    return $this->invalidResponse($response['validationErrors'][0]['errors'][0]);
//                }
//                return $this->serverErrorResponse();
            } catch (\Exception $e) {
                return $this->invalidResponse();
            }
        }
    }

    private function playerValidationArray()
    {
        return [
            "firstName" => "required",
            "lastName" => 'required',
            'email' => 'required|email',
            'account-type' => 'required|in:Player,Coach,Manager,Referee,Club,Academy,WebSite-Follower,Sport-Company,Commentator,Content-Creator',
            "phone" => 'required|numeric',
            "gender" => 'required|in:M,F',
            // "socialStatus" => 'required|in:Married,Single',
            "BirthDate" => 'required|date',
//            "educationLevelId" => 'required',
//            "uaeResidency" => 'required|in:0,1',
//            "uaeIdNumber" => 'required',
//            "uaeIdEndDate" => 'required|date',
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
            'password' => ['required', 'confirmed', 'max:26', Password::min(6)],
            'password_confirmation' => 'required'
        ];
    }

    private function playerRequestData($dataIn)
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
                'password' => isset($dataIn["password"]) ? $dataIn["password"] : null,
                'confirmPassword' => isset($dataIn["password_confirmation"]) ? $dataIn["password_confirmation"] : null
            ],
            'personInfo' => [
                'image' => [],
                'BirthDate' => isset($dataIn['BirthDate']) ? $dataIn['BirthDate'] : null,
                'gender' => isset($dataIn['gender']) ? $dataIn['gender'] : null,
                'uaeResidency' => $dataIn['uaeResidency'] == 'false' ? false : true,
                'socialStatus' => isset($dataIn['socialStatus']) ? $dataIn['socialStatus'] : null,
//                'uaeResidency' => $dataIn['uaeResidency'] == 1,
                //  'uaeIdNumber' => $dataIn['uaeIdNumber'],
                // 'uaeIdEndDate' => $dataIn['uaeIdEndDate'],
                'email' => isset($dataIn['email']) ? $dataIn['email'] : null,
                'phone' => isset($dataIn['phone']) ? $dataIn['phone'] : null,
                'educationLevelId' => isset($dataIn['educationLevelId']) ? $dataIn['educationLevelId'] : null,
                'passport' => [
                    'number' => isset($dataIn['passportNumber']) ? $dataIn['passportNumber'] : null
                ],
                'NationalityId' => isset($dataIn['NationalityId']) ? $dataIn['NationalityId'] : null,
                'facebook' => isset($dataIn['facebook']) ? $dataIn['facebook'] : null,
                'twitter' => isset($dataIn['twitter']) ? $dataIn['twitter'] : null,
                'instagram' => isset($dataIn['instagram']) ? $dataIn['instagram'] : null,
                'youTube' => isset($dataIn['youtube']) ? $dataIn['youtube'] : null,
                'discord' => isset($dataIn['discord']) ? $dataIn['discord'] : null,
                'tikTok' => isset($dataIn['tikTok']) ? $dataIn['tikTok'] : null,
                'twitch' => isset($dataIn['twitch']) ? $dataIn['twitch'] : null,
            ]
        ];
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
        return $data;
    }

    private function sendPlayerInvitations($teamId, $player)
    {
        $data = [
            "type" => "AddNew",
            "teamId" => $teamId,
            "player" => $player
        ];
        $response = ApiService::PostDataByEndPoint(EndPoints::PostTeamRequestsApi, $data, session('token'));
//        dd($response);
        if (isset($response['hasErrors']) && $response['hasErrors']) {
//            dd($response);
            if (isset($response['validationErrors'][0]['field']) && $response['validationErrors'][0]['field'] == 'Validation') {
                return response()->json([
                    'error' => true,
                    'result' => trans('auth.success-register-with-error-send-invitation') . ' ( ' . trans('validation-messages.',$response['validationErrors'][0]['errors'][0]) . ' ), ' . trans('auth.go-search-send-invitation')
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'result' => trans('auth.success-register-with-error-send-invitation') . ' ( ' . trans('all.server-error-msg') . ' ), ' . trans('auth.go-search-send-invitation')
                ]);
            }
        }
        return response()->json(['error' => false, 'result' => trans('auth.success-player-register-with-invitation')]);
    }
    // public function changePassword(Request $request, $locale)
    // {
    //     if ($request->ajax()) {
    //         try {
    //             return response()->json([
    //                 'error' => false,
    //                 'result' => [
    //                     'view' => view('user.change-password')->render(),
    //                 ],
    //             ]);

    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'error' => true,
    //                 'result' => $e->getMessage(),
    //             ]);
    //         }
    //     } else {
    //         abort(403, 'Unauthorized action');
    //     }
    // }

    // public function storePassword(PasswordRequest $request, $locale)
    // {
    //     if ($request->ajax()) {
    //         try {
    //             $dataIn = $request->all();
    //             if(Hash::check($dataIn['oldpassword'], $this->user->password))
    //             {
    //                 $user = UserService::getOne($this->user->id);
    //                 UserService::update( $dataIn , $user) ;

    //                 return response()->json([
    //                     'error' => false,
    //                     'result' => true,
    //                 ]);
    //             }else{
    //                 return response()->json([
    //                     'error' => true,
    //                     'result' => trans( 'all.password-wrong'),
    //                 ]);
    //             }

    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'error' => true,
    //                 'result' => $e->getMessage(),
    //             ]);
    //         }
    //     } else {
    //         abort(403, 'Unauthorized action');
    //     }
    // }

    public function requests(Request $request, $locale)
    {
        if ($request->ajax()) {
            try {
                return response()->json([
                    'error' => false,
                    'result' => [
                        'view' => view('profile.requests.requsets-managment')->render(),
                    ],
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'result' => $e->getMessage(),
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }
    public function shopping(Request $request, $locale)
    {
        if ($request->ajax()) {
            try {
                return response()->json([
                    'error' => false,
                    'result' => [
                        'view' => view('profile.requests.shoping-request')->render(),
                    ],
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'result' => $e->getMessage(),
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }
    public function informations(Request $request, $locale)
    {
        if ($request->ajax()) {
            try {
                return response()->json([
                    'error' => false,
                    'result' => [
                        'view' => view('profile.requests.personal-informations')->render(),
                    ],
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'result' => $e->getMessage(),
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }
    public function participations(Request $request, $locale)
    {
        if ($request->ajax()) {
            try {
                return response()->json([
                    'error' => false,
                    'result' => [
                        'view' => view('profile.requests.participations-requests')->render(),
                    ],
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'result' => $e->getMessage(),
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }
    public function activities(Request $request, $locale)
    {
        if ($request->ajax()) {
            try {
                return response()->json([
                    'error' => false,
                    'result' => [
                        'view' => view('profile.requests.activities-requests')->render(),
                    ],
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'result' => $e->getMessage(),
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }
    public function articles(Request $request, $locale)
    {
        if ($request->ajax()) {
            try {
                return response()->json([
                    'error' => false,
                    'result' => [
                        'view' => view('profile.requests.articles-requests')->render(),
                    ],
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'result' => $e->getMessage(),
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }
    public function membership(Request $request, $locale)
    {
        if ($request->ajax()) {
            try {
                return response()->json([
                    'error' => false,
                    'result' => [
                        'view' => view('profile.requests.membership')->render(),
                    ],
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'error' => true,
                    'result' => $e->getMessage(),
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }

    public function storeMembership(RenewRequest $request, $locale)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $data['request_date'] = Carbon::now();
            $data['status'] = 0;
            $data['user_id'] = $this->user->id;
            $data['member_id'] = $this->member->ID;
            $renew_request = new Renew();
            $result = RenewService::create($data, $renew_request);
            if ($result) {
                return response()->json([
                    'errors' => 0,
                    'results' => $result,
                ]);
            } else {
                return response()->json([
                    'errors' => 1,
                    'results' => $result,
                ]);
            }
        } else {
            abort(403, 'Unauthorized action');
        }
    }

    public function submitComplaint(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
//            $complaint = new Complaint();
            $complaint = [];
            $complaint['type'] = $data['type'];
            $complaint['subject'] = $data['subject'];
            $complaint['content'] = $data['content'];
            try {
                $response = ApiService::PostDataByEndPoint(EndPoints::clientComplaintsApi, $complaint, session('token'));
            } catch(\Exception $e) {
                return $e->getMessage();
            }
            if (!$response['hasErrors']) {
                $htmlResponse = '<div class="mb-2"><a href="javascript:void(0)" class="complaint-details"
							   data-id="' . $response['result']['id'] . '" data-url="'.url(App::getLocale() . '/complaint/' . $response['result']['id']).'"
							   data-toggle="modal" data-target="#complaintDetailsModal"><div class="comment_body px-3">
                                    <h5 class="mb-0 d-inline-block">' . $response['result']['subject'] . '</h5><span class="text-secondary ' . (App::getLocale() == 'ar' ? 'pull-left' : 'pull-right') . '">
                                    <i class="fa fa-calendar fa-fw"></i> '.
                    Carbon::parse($response['result']['date'])->format('Y-m-d') .'</span></div></a></div>';
                return response()->json([
                    'success' => trans('auth.complaint-success-msg'),
                    'data' => json_encode($htmlResponse, JSON_INVALID_UTF8_IGNORE),
                ], Response::HTTP_OK);
            } else {
                return response()->json(['error' => trans('product.server-error-msg')], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function complaint_details(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            try {
                $response = ApiService::GetDataByEndPoint(EndPoints::clientComplaintsApi . '/' . $data['id'], session('token'));
            } catch(\Exception $e) {
                return $e->getMessage();
            }
            if (!$response['hasErrors']) {
                $textRight = App::getLocale() == 'ar' ? 'text-right' : 'text-left';
                $title = $response['result']['subject'];
                $htmlResponse = '<div><div class="comment_body px-3 bg-white" style="border-radius: 5px">
							    <p class="mb-0 py-2">' . $response['result']['content'] . '</p></div>
                                <div class="comment_toolbar mt-1">
                                    <p class="text-secondary '.$textRight.'"><i class="fa fa-calendar fa-fw"></i>'.
                    Carbon::parse($response['result']['date'])->format('Y-m-d') .'</p></div>';
                if (count($response['result']['complaintReplies']) > 0):
                    foreach($response['result']['complaintReplies'] as $reply):
                        $htmlResponse .= '<div class="col-10 col-sm-11 comment-reply ' . (App::getLocale() == 'ar' ? 'mr-auto' : 'ml-auto') . ' px-0">
                            <div class="comment_body bg-white p-2">
                                <div class="comment_toolbar">
                                    <p class="'.$textRight.' mb-0" style="color: #6c757d82">
                                        <i class="fa fa-reply fa-fw" aria-hidden="true"></i>'.
                            trans('auth.management-reply').'</p></div>
                                    <p class="mb-0">'.$reply['content'].'</p></div>
                                    <div class="comment_toolbar mt-1">
                                        <p class="text-secondary '.$textRight.'">
                                            <i class="fa fa-calendar fa-fw"></i> '.Carbon::parse($reply['date'])->format('Y-m-d').'</p>
                                    </div>
                                </div>';
                    endforeach;
                endif;
                $htmlResponse .= '</div>';
                return response()->json([
                    'title' => $title,
                    'data' => json_encode($htmlResponse, JSON_INVALID_UTF8_IGNORE),
                ], Response::HTTP_OK);
            } else {
                return response()->json(['error' => trans('product.server-error-msg')], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function order_details(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $status = $data['status'] ? 'completed' : 'pending';
            try {
                $orderEndPoint = EndPoints::getGroupOrdersApi . $data['id'];
//                    $orders = ApiService::GetDataByEndPoint($orderEndPoint, session('token'));

                $orders = ApiService::GetDataByEndPoint($orderEndPoint, session('token'));
                $comments = ApiService::GetDataByEndPoint(EndPoints::getOrderGroupCommentsApi . $data['id'], session('token'));
//                dd($status, $orders, $clientOrder, $comments);
            } catch(\Exception $e) {
                dd($e->getMessage());
            }
            if ($orders || $comments) {
//                dd($orders);
                $view = view('user.orders-ajax-details', compact('orders', 'comments', 'status'))->render();
                return response()->json([
                    'view' => $view,
                ], Response::HTTP_OK);
            } else {
                return response()->json(['error' => trans('product.server-error-msg')], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }



}
