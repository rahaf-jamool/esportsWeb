<?php

namespace App\Services;

use App\Models\Currency;
use Illuminate\Support\Facades\Storage;


class CurrenciesService extends BaseService {
    private $model;
    private $attributes = [
        'Id',
        'Name',
        'DataAccessKey',
        'IsDeleted',
        'Symbol',
        'CountryId',
        'USDollarRatio',
        'CreatedBy',
        'CreatedAt',
        'LastModifiedBy',
        'LastModefiedAt'
    ];

    function __construct() {
        $this->model = new Currency();
    }

    function getList($criteria = []) {
        return $this->getBaseList($criteria, $this->model, $this->attributes);
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
}
