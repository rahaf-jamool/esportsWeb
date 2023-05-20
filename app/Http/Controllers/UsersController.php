<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Facades\CustomerOrderService;
use App\Helpers\General\CollectionHelper;
use App\Helpers\General\EndPoints;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{


    public function __construct()
    {

        $this->middleware(function ($request, $next) {
            return $next($request);
        });
    }

    public function profile()
    {
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        $pageInfo['title'] = trans('user.my-profile');
        $pageInfo['keywords'] = trans('site.home-keywords');
        $pageInfo['description'] = trans('site.description');
        $user = session('loggedUser');
        $customerOrder = CustomerOrderService::getList(session('token'), 10);
        return view('user.profile', compact('pageInfo', 'user', 'customerOrder'));
    }

    public function edit_profile()
    {
        if (!session()->has('loggedUser')):
            return redirect(url(App::getLocale() . '/'));
        endif;
        $pageInfo['title'] = trans('user.edit-profile');
        $pageInfo['keywords'] = trans('site.home-keywords');
        $pageInfo['description'] = trans('site.description');
        $user = session('loggedUser');
        return view('user.edit-profile', compact('pageInfo', 'user'));
    }

    public function save_profile(Request $request)
    {
        dd($request->all());
        $dataIn = $request->all();
        // {
        //     "id": "string",
        //     "userName": "string",
        //     "email": "string",
        //     "phone": "string",
        //     "managerId": "string",
        //     "password": "string",
        //     "confirmPassword": "string",
        //     "confirmedAccount": true,
        //     "dataAccessKey": "string",
        //     "roles": [
        //       {
        //         "id": "string",
        //         "name": "string",
        //         "claims": [
        //           {
        //             "value": "string",
        //             "type": "string",
        //             "name": "string"
        //           }
        //         ]
        //       }
        //     ],
        //     "claims": [
        //       {
        //         "subject": {
        //           "actor": {
        //             "label": "string"
        //           },
        //           "label": "string"
        //         }
        //       }
        //     ]
        //   }
        $data = [
            'id'        => $dataIn['user_id'],
            'userName'  => $dataIn['userName'],
            'email'     => $dataIn['email'],
            'phone'     => $dataIn['phone'],
            'image_url' => $dataIn['image_url']
        ];

        $response = ApiService::PutDataByEndPoint(EndPoints::editUserInfoApi, $data, session('token'));
        dd($response);
    }

    public function upload(Request $request)
    {
        if ($request->ajax()) {

            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:png,jpg,jpeg,gif'
             ], [
                 'file.mimes' => trans('user.allow-file-type-msg')
             ]);
            // Validate message if error
            if ($validator->fails()) {
               return response()->json(['error' => $validator->errors()->first('file')], Response::HTTP_NOT_ACCEPTABLE);
            }

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileSize = $file->getSize();
                // Get File Name With Extension ex : (example.png)
	            $fileNameWithExt = $file->getClientOriginalName();
	            // Get file Name Without Extension ex : (example)
	            $filenameWithOutEXt = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
	            // Get File Extension ex : (png)
	            $fileExtension = $file->getClientOriginalExtension();

                $data['userId'] = $request->userId;
                $data['imgFile'] = [
                    'data' => $request->imgBase64String,
                    "fileType" => "image/png",
                    "size" => $fileSize,
                    "name" => $filenameWithOutEXt
                ];
                $response = ApiService::PostDataByEndPoint(EndPoints::uploadProfilePicApi, $data, session('token'));
                if (!$response['hasErrors']) {
                    return response()->json([
                        'success' => trans('user.upload-success-msg'),
                        'url' => $response['result']
                    ], Response::HTTP_OK);
                }
            }


        }
    }

}
