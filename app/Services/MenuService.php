<?php

namespace App\Services;

use App\Models\Menu;

class MenuService extends BaseService {
    private $model;
    private $attributes = [
        'Id',
        'Name',
        'DataAccessKey',
        'Type',
        'Order',
        'Category',
        'ParentMenuId',
        'URL',
        'IsActive',
        'IsDeleted',
        'CreatedBy',
        'CreatedAt',
        'LastModifiedBy',
        'LastModefiedAt'
    ];

    function __construct() {
        $this->model = new Menu();
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

    function paginate($criteria = [], $number, $relation = null)
    {
        return $this->basePaginate($criteria, $this->model, $this->attributes, $number, $relation);
    }

}
