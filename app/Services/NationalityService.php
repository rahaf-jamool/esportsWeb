<?php

namespace App\Services;

use App\Models\Nationality;

class NationalityService extends BaseService {

    private $token;
    function __construct()
    {
        $this->token = session()->has('mainToken') ? session('mainToken') : null;
    }

    function getApiResponse($endpoint)
    {
        return $this->getBaseApiResponse($endpoint, $this->token);
    }

    function getOne($id) {
        return $this->getBaseOne($this->model, $id);
    }

    function create($dataIn = []) {
        $this->baseCreate($dataIn, $this->model, $this->attributes);
    }

    function update($dataIn = []) {
        $this->baseUpdate($dataIn, $this->model, $this->attributes);
    }

    function delete($id) {
        $this->baseDelete($id);
    }

    function paginate($criteria = [], $number, $relation = null)
    {
        return $this->basePaginate($criteria, $this->model, $this->attributes, $number, $relation);
    }

}
