<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;


class BaseService {

    function __construct() {}

    protected function getBaseApiResponse($endpoint, $token, $id = null)
    {
        try {
            if (!is_null($token)) {
                if (is_null($id)) {
                    return ApiService::GetDataByEndPoint($endpoint, $token);
                }
                return ApiService::GetDataByEndPoint($endpoint . $id, $token);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function getBaseSpecialApiResponse($endpoint, $token)
    {
        try {
            if (!is_null($token)) {
                return ApiService::GetDataByEndPoint($endpoint , $token);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
