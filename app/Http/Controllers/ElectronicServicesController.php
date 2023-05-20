<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Facades\ClubsService;
use App\Facades\CountriesService;
use App\Facades\NationalityService;
use App\Facades\PlatformService;
use Illuminate\Http\Request;
use App\Helpers\General\EndPoints;
use App\Services\ApiService;
use App\Services\OnlineService;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;
use Image;
class ElectronicServicesController extends Controller
{
    public function getIndividually(){
        $pageInfo['title'] = trans('site.individually');
        return view('electronicServices.individually.individually',compact('pageInfo'));
    }

    public function getIndividuallydetails($local, $slug ){
        $pageInfo['title'] = trans('site.home');
        switch($slug) {
            case('electronic-player'):
                return view('electronicServices.individually.player.view',compact('pageInfo'));
                break;
            case('electronic-coach'):
                return view('electronicServices.individually.coach.view',compact('pageInfo'));
                break;
            case('electronic-judgment'):
                return view('electronicServices.individually.judgment.view',compact('pageInfo'));
                break;
            default:
                return view('electronicServices.individually.individually',compact('pageInfo'));
            }
    }

    public function getInstitutions(){
        $pageInfo['title'] = trans('site.institutions');
        return view('electronicServices.institutions.institutions',compact('pageInfo'));
    }

    public function getInstitutionsdetails( $local, $slug ){

        $pageInfo['title'] = trans('site.home');
        switch($slug) {
            case('electronicclubs'):
                return view('electronicServices.institutions.electronic-club.view',compact('pageInfo'));
                break;
            case('privateacademies'):
                return view('electronicServices.institutions.private-academy.view',compact('pageInfo'));
                break;
            case('sportsservicescompanies'):
                return view('electronicServices.institutions.sports-services-companies.view',compact('pageInfo'));
                break;
            case('sportsteams'):
                return view('electronicServices.institutions.sports-teams.view',compact('pageInfo'));
                break;
            default:
                return view('electronicServices.institutions.institutions',compact('pageInfo'));
            }
    }

    public function getRequestsAndPermission() {
        $pageInfo['title'] = trans('site.home');
        return view('electronicServices.requestsAndPermission',compact('pageInfo'));
    }

    public function registerFollower() {
        $responses = ApiService::GetDataByMultiEndPoint([EndPoints::EducationLevelsGetAllApi, EndPoints::PlatformIndexGetApi, EndPoints::GamesIndexGetApi, EndPoints::NationalitiesGetAllApi, EndPoints::PrincedomsGetAllApi], session('mainToken'));
        $princedoms = $responses[4];

        return view('registarion.follower-registarion', compact('princedoms'));
    }

    public function registerPlayer() {
        $responses = ApiService::GetDataByMultiEndPoint([
            EndPoints::EducationLevelsGetAllApi,
            EndPoints::PlatformIndexGetApi,
            EndPoints::GamesIndexGetApi,
            EndPoints::NationalitiesGetAllApi,
            EndPoints::PrincedomsGetAllApi], session('mainToken'));
        $educationLevel = $responses[0];
        $platforms = $responses[1];
        $games = $responses[2];
        $nationalities = $responses[3];
        $princedoms = $responses[4];
        return view('registarion.player-registarion', compact('games', 'princedoms','platforms', 'nationalities', 'educationLevel'));
    }

    public function registerContentWriter() {
        $responses = ApiService::GetDataByMultiEndPoint([EndPoints::EducationLevelsGetAllApi, EndPoints::PlatformIndexGetApi, EndPoints::GamesIndexGetApi, EndPoints::NationalitiesGetAllApi, EndPoints::PrincedomsGetAllApi], session('mainToken'));
        $educationLevel = $responses[0];
        $platforms = $responses[1];
        $games = $responses[2];
        $nationalities = $responses[3];
        $princedoms = $responses[4];

        return view('registarion.content-writer-regitarion', compact('games', 'platforms', 'nationalities', 'educationLevel','princedoms'));
    }

    public function registerCommentator() {
        $responses = ApiService::GetDataByMultiEndPoint([EndPoints::EducationLevelsGetAllApi, EndPoints::NationalitiesGetAllApi, EndPoints::PrincedomsGetAllApi], session('mainToken'));
        $educationLevel = $responses[0];
        $nationalities = $responses[1];
        $princedoms = $responses[2];
        return view('registarion.commentator-registeration', compact('nationalities', 'educationLevel','princedoms'));
    }

    public function registerCoach() {
        $responses = ApiService::GetDataByMultiEndPoint([EndPoints::EducationLevelsGetAllApi, EndPoints::GamesIndexGetApi, EndPoints::NationalitiesGetAllApi, EndPoints::PrincedomsGetAllApi], session('mainToken'));
        $educationLevel = $responses[0];
        $games = $responses[1];
        $nationalities = $responses[2];
        $princedoms = $responses[3];

        return view('registarion.coach-registarion', compact('nationalities', 'games', 'educationLevel','princedoms'));
    }

    public function registerJudgment(){
        $responses = ApiService::GetDataByMultiEndPoint([EndPoints::EducationLevelsGetAllApi, EndPoints::GamesIndexGetApi, EndPoints::NationalitiesGetAllApi], session('mainToken'));
        $educationLevel = $responses[0];
        $games = $responses[1];
        $nationalities = $responses[2];
        return view('registarion.judgment-registarion', compact('nationalities', 'games', 'educationLevel'));
    }

    public function registerClub(){
        $princedoms = ClubsService::getApiResponse(EndPoints::PrincedomsGetAllApi);
        return view('registarion.electronic-club-registarion', compact('princedoms'));
    }

    public function registerAcademy() {
        $princedoms = ApiService::GetDataByEndPoint(EndPoints::PrincedomsGetAllApi, session('mainToken'));
        return view('registarion.private-academy-registarion', compact( 'princedoms'));
    }

    public function registerSportServicesCompany()
    {
        $princedoms = ApiService::GetDataByEndPoint(EndPoints::PrincedomsGetAllApi, session('mainToken'));
        return view('registarion.sports-services-companies-registarion', compact('princedoms'));
    }

    public function getElectronicOrders($local, $slug )
    {
        $pageInfo['title'] = trans('site.home');
        switch($slug) {
            case('certificate-enrollment'):
                return view('electronicServices.Orders.certificate-enrollment',compact('pageInfo'));
                break;
            case('experience-certificate'):
                return view('electronicServices.Orders.experience-certificate',compact('pageInfo'));
                break;
            case('joining-certificate'):
                return view('electronicServices.Orders.joining-certificate',compact('pageInfo'));
                break;
            case('no-objection-letter'):
                return view('electronicServices.Orders.No-objection-letter',compact('pageInfo'));
                break;
            case('organization-request'):
                return view('electronicServices.Orders.organization-request',compact('pageInfo'));
                break;
        }
    }

    public function sendNoProblemRequest(Request $request)
    {
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $data = $request->all();
                $data['ClientId']= $user['clientId'];
                $data['requestDate']= Carbon::now()->toDateTimeString();

               $response = ApiService::PostDataByEndPoint(EndPoints::SendNoProblemRequestApi, $data, $token);


              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }

    public function sendCertificateRequest(Request $request)
    {
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $data = $request->all();

                $data['ClientId']= $user['clientId'];
                $data['requestDate']= Carbon::now()->toDateTimeString();
                $response = ApiService::PostDataByEndPoint(EndPoints::SendCertificateRequestApi, $data, $token );

                return response()->json(['success' => $response], Response::HTTP_OK);

             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }

     public function sendOrganizationRequest(OrganizationRequest $request)
    {
        $token = session()->has('token') ? session('token') : null;
        if ($request->ajax() && !is_null($token)) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();

                if(isset($data['question1'])){
                    $questions = $data['question1'];
                    $answers = $data['answer1'];
                    $enquestions = $data['enquestion1'];
                    $enanswers = $data['enanswer1'];
                    $eventFAQs = [];
                    foreach ($questions as $key_question => $question) {
                        foreach ($answers as $key_answer => $answer) {
                            foreach ($enquestions as $key_enquestion => $enquestion) {
                                foreach ($enanswers as $key_enanswer => $enanswer) {
                                    if($key_question == $key_answer  && $key_answer == $key_enanswer  && $key_enquestion == $key_enanswer){
                                        $eventFAQ = [
                                            'question' => $question,
                                            'enAnswer' => $enanswer,
                                            'enQuestion' => $enquestion,
                                            'answer' => $answer,
                                        ];

                                        array_push($eventFAQs, $eventFAQ);
                                        //dd($key_question);
                                    }
                                }
                            }
                        }
                        $data['eventFAQs'] = $eventFAQs;
                    }
                } else {
                    $data['eventFAQs'] = [];
                }


                /////////////////////////



                //////////////////////////////////
                if(isset($data['category1'])){
                    $categories = $data['category1'];
                    $feeValues = $data['feeValue1'];
                    $encategories = $data['encategory1'];
                    $enfeeValues = $data['enfeeValue1'];
                    $eventFees = [];
                    foreach ($categories as $key_category => $category) {
                        foreach ($feeValues as $key_feeValue => $feeValue) {
                            foreach ($encategories as $key_encategory => $encategory) {
                                foreach ($enfeeValues as $key_enfeeValue => $enfeeValue) {
                                    if($key_category == $key_feeValue && $key_feeValue == $key_encategory && $key_encategory == $key_enfeeValue){
                                        $eventFee = [
                                            'category' => $category,
                                            'feeValue' => $feeValue,
                                            'enCategory' => $encategory,
                                            'enFeeValue' => $enfeeValue,
                                        ];

                                        array_push($eventFees, $eventFee);
                                        //dd($key_category);
                                    }
                                }
                            }
                        }
                        $data['eventFees'] = $eventFees;
                    }
                } else {
                    $data['eventFees'] = [];
                }

        //   dd($data);

            //    $data['eventFAQs'] = json_decode($data['eventFAQs'], true);
              //  $data['eventFees'] = json_decode($data['eventFees'], true);

                $data['clientId']= $user['clientId'];
                $data['requestDate']= Carbon::now()->toDateTimeString();
                $mainImage = $this->uploadFiles($request, 'mainImage');
                $files = $this->uploadFiles($request, 'attachments');
                $data['mainImage'] = $mainImage;
                $data['attachments'] = $files;
       // dd($data);
                //var_dump($data);
                $response = ApiService::PostDataByEndPoint(EndPoints::EventOrganizingRequestApi, $data, $token);
            //dd($response);

                return response()->json(['success' =>    $response], Response::HTTP_OK);

             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        return 'Server Error, Method Not Allowed';
    }

    private function uploadFiles($request, $type)
    {
        if ($request->hasFile($type)) {
            $uploadFile = $request->file($type);
            if (is_array($uploadFile)) {
                foreach($uploadFile as $upload) {
                    $imgBase64String = base64_encode(file_get_contents($upload));
                    $fileSize = $upload->getSize();
                    $fileNameWithExt = $upload->getClientOriginalName();                    // ex : (example.png)
                    $filenameWithOutEXt = pathinfo($fileNameWithExt, PATHINFO_FILENAME);  // ex : (example)
                    $fileExtension = $upload->getClientOriginalExtension();                 // ex : (png)
                    $mimeType = $upload->getClientMimeType();                               // ex : (image/jpeg)
                    $imgFile = [];
                    $imgFile['data'] = $imgBase64String;
                    $imgFile['fileType'] = $mimeType;
                    $imgFile['size'] = $fileSize;
                    $imgFile['name'] = $fileNameWithExt;
                    $file['entityName'] = 'Articles';
                    $file['name'] = $fileNameWithExt;
                    $file['type'] = $mimeType;
                    $file['size'] = $fileSize;
                    $file['isImage'] = explode('/', $mimeType)[0] == 'image' ? true : false;
                    $file['fileData'] = $imgFile;
                    $files[] = $file;
                }
                return $files;
            } else {
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

    public function showNoProblemRequest($local,  $id)
    {
            $token = session('token');

            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }


                $response = ApiService::GetDataByEndPoint(EndPoints::GetClientRequestApi . '/' . $id, $token);
                $response = $response['result'];
            //    dd($response);
              return response()->json(['success' =>   $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }

    }
    public function showCertificateRequest($local,  $id)
    {
        $token = session('token');

            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }


                $response = ApiService::GetDataByEndPoint(EndPoints::GetClientCertificateRequestApi . '/' . $id, $token);
                $response = $response['result'];
            //    dd($response);
              return response()->json(['success' =>   $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }

    }
    public function showOrganizationRequest($local,  $id)
    {
        $token = session('token');
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }


                $response = ApiService::GetDataByEndPoint(EndPoints::GetClientOrgnizingRequestApi . '/' . $id, $token);
                $response = $response['result'];
              // dd($response);
              return response()->json(['success' =>   $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }

    }


    public function deleteNoProblemRequest(Request $request)
    {
       // dd( $request);
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();
           // dd( $data['id']);
            $id =  $data['id'];
               $response = ApiService::PostDataByEndPoint(EndPoints::DeleteClientRequestApi. '?id=' . $id, $data,  $token);
            //   dd( $response);

              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }
    public function deleteCertificateRequest(Request $request)
    {
       // dd( $request);
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();
               // dd( $data);
                $id =  $data['id'];
               //$response = ApiService::deleteDataByEndPoint(EndPoints::CertificateRequestsApi. '/' . $id, session('mainToken'));
               $response = ApiService::PostDataByEndPoint(EndPoints::DeleteCertificateRequestApi. '?id=' . $id, $data, $token);

              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }
    public function deleteOrganizationRequest(Request $request)
    {
       // dd( $request);
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();
           // dd( $data['id']);
            $id =  $data['id'];
               //$response = ApiService::deleteDataByEndPoint(EndPoints::GetEventsApi. '/' . $id, session('mainToken'));
               $response = ApiService::PutDataByEndPoint(EndPoints::DeleteOrganizingRequestApi. '/' . $id, $data, $token );

            //   dd( $response);

              return response()->json(['success' =>    $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }


    public function editCertificateRequest(Request $request)
    {
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $data = $request->all();

                $data['ClientId']= $user['clientId'];
                $data['requestDate']= Carbon::now()->toDateTimeString();

                $response = ApiService::PutDataByEndPoint(EndPoints::UpdateCertificateRequestApi, $data, $token );
                return response()->json(['success' =>    $response], Response::HTTP_OK);

             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }


    public function sendEditOrganizationRequest(Request $request)
    {
      //  dd($request);
        $token = session()->has('token') ? session('token') : null;
        if ($request->ajax() && !is_null($token)) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();
               //dd($data);
                /////////////////////////
                $questions = $data['question1'];
                $answers = $data['answer1'];
                $enquestions = $data['enquestion1'];
                $enanswers = $data['enanswer1'];
                $ids = $data['id1'];

                $eventFAQs = [];
                foreach ($questions as $key_question => $question) {
                    foreach ($answers as $key_answer => $answer) {
                        foreach ($enquestions as $key_enquestion => $enquestion) {
                            foreach ($enanswers as $key_enanswer => $enanswer) {

                                        if($key_question == $key_answer  && $key_answer == $key_enanswer  && $key_enquestion == $key_enanswer){
                                            $eventFAQ = [
                                                'eventId' =>$data['id'],
                                                'question' => $question,
                                                'enQuestion' => $enquestion,
                                                'answer' => $answer,
                                                'enAnswer' => $enanswer,
                                            ];

                                            array_push($eventFAQs, $eventFAQ);
                                            //dd($key_question);
                                        }
                            }
                        }
                    }
                    $data['eventFAQs'] = $eventFAQs;
                }
               // dd( $data);
                //////////////////////////////////
                $categories = $data['category1'];
                $feeValues = $data['feeValue1'];
                $encategories = $data['encategory1'];
                $enfeeValues = $data['enfeeValue1'];
               // dd( $categories);
                $eventFees = [];
                foreach ($categories as $key_category => $category) {
                    foreach ($feeValues as $key_feeValue => $feeValue) {
                        foreach ($encategories as $key_encategory => $encategory) {
                            foreach ($enfeeValues as $key_enfeeValue => $enfeeValue) {
                                if($key_category == $key_feeValue && $key_feeValue == $key_encategory && $key_encategory == $key_enfeeValue){
                                    $eventFee = [
                                        'eventId' =>$data['id'],
                                        'category' => $category,
                                        'feeValue' => $feeValue,
                                        'enCategory' => $encategory,
                                        'enFeeValue' => $enfeeValue,
                                    ];

                                    array_push($eventFees, $eventFee);
                                    //dd($key_category);
                                }
                            }
                        }
                    }
                    $data['eventFees'] = $eventFees;
                }


        // dd( $data['eventFees'] );

            //    $data['eventFAQs'] = json_decode($data['eventFAQs'], true);
              //  $data['eventFees'] = json_decode($data['eventFees'], true);
          // dd($data['mainImage']);
                $data['requestedClientId']= $user['clientId'];
                $data['requestedClient']['id']= $user['clientId'];

                $data['requestDate']= Carbon::now()->toDateTimeString();
               // $mainImage = $this->uploadFiles($request, 'mainImage');
               // $files = $this->uploadFiles($request, 'attachments');
             //   $data['mainImage'] = $mainImage;
               // $data['attachments'] = $files;

                if (!$data['mainImage'] == 'null') {
                    $mainImage = $this->uploadFiles($request, 'mainImage');
                    $data['mainImage'] = $mainImage;
                }
               if (!$data['attachments'] == 'undefined') {
                    $files = $this->uploadFiles($request, 'attachments');
                    $data['attachments'] = $files;
                } else {
                    $data['attachments'] = [];
                }
     //dd($data);
                //var_dump($data);
                $response = ApiService::PutDataByEndPoint(EndPoints::UpdateOrganizingRequestApi, $data, $token);
           //dd($response);

                return response()->json(['success' =>    $response], Response::HTTP_OK);

             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        return 'Server Error, Method Not Allowed';
    }


    public function downloadCertification($local, $id)
    {
            $token = session('token');

            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $response = ApiService::GetDataByEndPoint(EndPoints::GetClientCertificateRequestApi . '/' . $id, $token);
                $response = $response['result'];
                //  dd($user);
                $clientType = trans("site." . $user['client']['type']);
                return view('auth.account.certifications.certification',compact('response', 'user','clientType'));
              //  return view('auth.account.follower.account', compact('pageInfo','slug', 'user', 'id', 'id1','promoted','articles'));


              //return response()->json(['success' =>   $response], Response::HTTP_OK);
             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }

    }



//cancel
    public function editorganizationRequest(Request $request)
    {
        $token = session()->has('token') ? session('token') : null;
        if ($request->ajax() && !is_null($token)) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $data = $request->all();
                /////////////////////////
                $questions = $data['question1'];
                $answers = $data['answer1'];
                $eventFAQs = [];
                foreach ($questions as $key_question => $question) {
                    foreach ($answers as $key_answer => $answer) {
                        if($key_question == $key_answer){
                            $eventFAQ = [
                                'question' => $question,
                                'answer' => $answer,
                            ];

                            array_push($eventFAQs, $eventFAQ);
                            //dd($key_question);
                        }
                    }
                    $data['eventFAQs'] = $eventFAQs;
                }
                //////////////////////////////////
                $categories = $data['category1'];
                $feeValues = $data['feeValue1'];
                $eventFees = [];
                foreach ($categories as $key_category => $category) {
                    foreach ($feeValues as $key_feeValue => $feeValue) {
                        if($key_category == $key_feeValue){
                            $eventFee = [
                                'category' => $category,
                                'feeValue' => $feeValue,
                            ];

                            array_push($eventFees, $eventFee);
                            //dd($key_category);
                        }
                    }
                    $data['eventFees'] = $eventFees;
                }

                //   dd($data);

                //    $data['eventFAQs'] = json_decode($data['eventFAQs'], true);
                //  $data['eventFees'] = json_decode($data['eventFees'], true);

                $data['clientId']= $user['clientId'];
                $data['requestDate']= Carbon::now()->toDateTimeString();
                $mainImage = $this->uploadFiles($request, 'mainImage');
                $files = $this->uploadFiles($request, 'attachments');
                $data['mainImage'] = $mainImage;
                $data['attachments'] = $files;
            // dd($data);
                //var_dump($data);
                $response = ApiService::PostDataByEndPoint(EndPoints::EventOrganizingRequestEditApi, $data, $token);
            //dd($response);

                return response()->json(['success' =>    $response], Response::HTTP_OK);

             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        return 'Server Error, Method Not Allowed';
    }
    public function editNoProblemRequest(Request $request)
    {
        $token = session('token');
        if ($request->ajax()) {
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $data = $request->all();

                $data['ClientId']= $user['clientId'];

              //  $data['client']['state']= 'DeletedByClient';
                $data['requestDate']= Carbon::now()->toDateTimeString();
              //  dd( $data );
                $response = ApiService::PutDataByEndPoint(EndPoints::UpdateNoProblemRequestApi, $data, $token );
                return response()->json(['success' =>    $response], Response::HTTP_OK);

             //   return response()->json(['success' => 'ok'], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }

    public function addPlatform(Request $request,$locale,$name){
        if ($request->ajax()) {
            try {
                $data = $request->all();
                $data['name'] = $name;
               $response = ApiService::PostDataByEndPoint(EndPoints::PlatformApi, $data,  session('mainToken'));
              return response()->json(['success' =>    $response], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }

    public function addGames(Request $request,$locale,$name){
        if ($request->ajax()) {
            try {
                $data = $request->all();
                $data['name'] = $name;
               $response = ApiService::PostDataByEndPoint(EndPoints::GamesApi, $data,  session('mainToken'));
              return response()->json(['success' =>    $response], Response::HTTP_OK);
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
        }
        abort('404');
    }



    public function downloadMembershipcertificate($local)
    {
        $token = session()->has('token') ? session('token') : null;

            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $clientType =  $user['client']['type'];
               // dd( $clientType);
                if(!empty($token))
                {
                    switch ($clientType) {
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
                    $user = ApiService::GetDataByEndPoint($endPoint, session('token'));

                }

                // dd( $user);
                $user = $user['result'];
                return view('auth.account.certifications.Membershipcertificate',compact( 'user','clientType'));
               // dd($clientType);
               /* if(is_null($user['joinDate'])){ */
                    // return response()->json(['success' =>   $user], Response::HTTP_OK);
             /*    }   else{
                return view('auth.account.certifications.Membershipcertificate',compact( 'user','clientType'));
               } */
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
    }

    public function openMembershipcertificate($local)
    {
        $token = session()->has('token') ? session('token') : null;

            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $clientType =  $user['client']['type'];
               // dd( $clientType);
                if(!empty($token))
                {
                    switch ($clientType) {
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
                    $user = ApiService::GetDataByEndPoint($endPoint, session('token'));
                    $user = $user['result'];

                }
                  //  dd(  $user );
            $clientType = trans("site." . $user['client']['type']);
        //    dd($user);
            return view('auth.account.certifications.Membershipcertificate',compact( 'user','clientType'));

            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
    }



    public function downloadNoProblemCertificate($local,$id)
    {
            $token = session('token');
            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }

                $clientType =  $user['client']['type'];
               // dd( $clientType);
                if(!empty($token))
                {
                    switch ($clientType) {
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
                    $user = ApiService::GetDataByEndPoint($endPoint, session('token'));
                    $user = $user['result'];

                }

                $response = ApiService::GetDataByEndPoint(EndPoints::GetClientRequestApi . '/' . $id, $token);
                $response = $response['result'];
                //  dd($user);
                $clientType = trans("site." . $user['client']['type']);
               // dd($clientType);
                return view('auth.account.certifications.noProblemCertification',compact( 'user','clientType','response'));
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
    }


    public function membershipCardPrinting($local)
    {
        $token = session()->has('token') ? session('token') : null;

            try {
                $user = !is_null(session('loggedUser')) ? session('loggedUser') : null;
                if (is_null($user)) {
                    return response()->json(['error' => trans('auth.not-authorize-user')], Response::HTTP_UNAUTHORIZED);
                }
                $clientType =  $user['client']['type'];
               // dd( $clientType);
                if(!empty($token))
                {
                    switch ($clientType) {
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
                    $user = ApiService::GetDataByEndPoint($endPoint, session('token'));

                }

                // dd( $user);
                $user = $user['result'];
                return view('auth.account.certifications.card',compact( 'user','clientType'));
               // dd($clientType);
               /* if(is_null($user['joinDate'])){ */
                    // return response()->json(['success' =>   $user], Response::HTTP_OK);
             /*    }   else{
                return view('auth.account.certifications.Membershipcertificate',compact( 'user','clientType'));
               } */
            } catch (\Exception $e) {
                return response()->json(['error' => trans('all.server-error-msg')], Response::HTTP_BAD_REQUEST);
            }
    }

}
