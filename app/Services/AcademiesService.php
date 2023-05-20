<?php

namespace App\Services;

use App\Helpers\General\EndPoints;

class AcademiesService extends BaseService {
    private $token;
    function __construct()
    {
        $this->token = session()->has('mainToken') ? session('mainToken') : null;
    }

    function getList()
    {
        try {
            if (!is_null($this->token)) {
                return ApiService::GetDataByEndPoint(EndPoints::GetAcademiesApi,  $this->token);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function getOne($id)
    {
        try {
            if (!is_null($this->token)) {
                return ApiService::GetDataByEndPoint(EndPoints::GetAcademiesApi . '/' . $id , $this->token);
                // if (!$pageResponse['hasErrors']) {
                //     return $pageResponse['result'];
                // }
                // return $pageResponse;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function delete($id)
    {
        $res = $this->getOne($id);
        $res->delete();
    }

}
