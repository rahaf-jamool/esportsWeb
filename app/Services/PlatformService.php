<?php

namespace App\Services;


use App\Helpers\General\EndPoints;


class PlatformService extends BaseService
{
    private $token;
    function __construct()
    {
        $this->token = session()->has('mainToken') ? session('mainToken') : null;
    }

    function getApiResponse($endpoint)
    {
        return $this->getBaseApiResponse($endpoint, $this->token);
    }

    function getOne($id)
    {
        try {
            if (!is_null($this->token)) {
                $pageResponse = ApiService::GetDataByEndPoint(EndPoints::GetPagesApi . '/' . $id, $this->token);
                if (!$pageResponse['hasErrors']) {
                    return $pageResponse['result'];
                }
                return $pageResponse;
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
