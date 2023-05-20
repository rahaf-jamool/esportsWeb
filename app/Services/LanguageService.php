<?php

namespace App\Services;

use App\Models\Language;
use App\Models\Product;
use App\Models\Translation;
use Illuminate\Support\Facades\Storage;


class LanguageService extends BaseService {
    private $model;
    private $attributes = [
			'Id',
            'Name',
            'Slug',
            'DataAccessKey',
            'IsDeleted',
            'IsPrimary',
            'IsActive',
            'CreatedBy',
            'CreatedAt',
            'LastModifiedBy',
            'LastModefiedAt'
        ];

    function __construct() {
        $this->model = new Language();
    }

    function getList($criteria = []) {
        return $this->getBaseList($criteria, $this->model, $this->attributes);
    }

    function create($dataIn = []) {
        $this->baseCreate($dataIn, $this->model, $this->attributes);
    }

    function update($dataIn = []) {
        $this->baseUpdate($dataIn, $this->model, $this->attributes);
    }

}
