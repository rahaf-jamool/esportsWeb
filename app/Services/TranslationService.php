<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Translation;
use Illuminate\Support\Facades\Storage;


class TranslationService extends BaseService {
    private $model;
    private $attributes = [
        'Id',
        'Content',
        'LanguageId',
        'ReferenceName',
        'ReferenceField',
        'ReferenceId',
        'Content',
        'IsDeleted',
        'DataAccessKey',
        'CreatedBy',
        'CreatedAt',
        'LastModifiedBy',
        'LastModefiedAt'
    ];

    function __construct() {
        $this->model = new Translation();
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
