<?php

namespace App\Services;

use App\Models\Unit;
use Illuminate\Support\Facades\Storage;


class UnitService {


    function __construct() {}

    protected function resolveCriteria($data = [])
    {
        $query = Unit::Query();
        
        if (array_key_exists('columns', $data)) {
            $query = $query->select($data['columns']);
        }else{
            $query = $query->select("*");
        }
        if (array_key_exists('Id', $data)) {
            $query = $query->where('Id', $data['Id']);
        }
        if (array_key_exists('Name', $data)) {
            $query = $query->where('Name', $data['Name']);
        }
        if (array_key_exists('DataAccessKey', $data)) {
            $query = $query->where('DataAccessKey', $data['DataAccessKey']);
        }
        if (array_key_exists('BaseUnitId', $data)) {
            $query = $query->where('BaseUnitId', $data['BaseUnitId']);
        }
        if (array_key_exists('BaseUnitRatio', $data)) {
            $query = $query->where('BaseUnitRatio', $data['BaseUnitRatio']);
        }
        if (array_key_exists('IsDeleted', $data)) {
            $query = $query->where('IsDeleted', $data['IsDeleted']);
        }
        if (array_key_exists('orderBy', $data)) {
            $query = $query->orderBy($data['orderBy'], 'ASC');
        } else {
            $query = $query->orderBy('id' , 'ASC');
        }

        if (array_key_exists('limit', $data) && array_key_exists('offset', $data)) {
            $query = $query->take($data['limit']);
            $query = $query->skip($data['offset']);
        }

        return $query;
    }

    function getOne($id) {
        $res = Unit::findOrFail($id);
        return $res;
    }

    /**
     * @param $criteria
     */
    function getList($criteria = []){
        $res = $this->resolveCriteria($criteria)->get();
        return $res;
    }

    function create( $dataIn = [], Unit &$photo){
        $this->mapDataModel($dataIn , $photo);
        $photo->save();
    }

    function update($dataIn = [] , Unit &$photo ){
        $this->mapDataModel($dataIn , $photo);
        $photo->save();
    }

    function delete($id){
        $res = $this->getOne($id);
        $res->delete();
    }

    public function mapDataModel($data, Unit &$model)
    {
        $attribute = [
			'Id',
            'Name',
            'DataAccessKey',
            'Description',
            'IsDeleted',
            'BaseUnitId',
            'BaseUnitRatio',
            'CreatedBy',
            'CreatedAt',
            'LastModifiedBy',
            'LastModefiedAt'
        ];
        foreach ($attribute as $val) {
            if (array_key_exists($val, $data)) {
                $model->$val = $data[$val];
            }
        }
    }
}
