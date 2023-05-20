<?php
/**
 * Created by PhpStorm.
 * User: amro
 * Date: 12/3/16
 * Time: 12:03 PM
 */
namespace App\Services;

use App\Models\PersonClient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 * @package App\Services
 */
class PersonClientService extends BaseService {
    private $model;
    private $attributes = [
        'Id',
        'Name',
        'DataAccessKey',
        'State',
        'Phone',
        'Fax',
        'Email',
        'Address',
        'OfficePhone',
        'WebSite',
        'CountryId',
        'LegalForm',
        'ActivityType',
        'Accepted', 
        'UserId',
        'ResponsiblePersonMobile',
        'ResponsiblePersonName',
        'LicenseNumber',
        'LicenseIssuarDate',
        'LicenseEndDate',
        'CreatedBy',
        'CreatedAt',
        'LastModifiedBy',
        'LastModefiedAt'
    ];


    function __construct() {
        $this->model = new PersonClient();
    }

    function getList($criteria = []) {
        return $this->getBaseList($criteria, $this->model, $this->attributes);
    }

    function create($dataIn = [], User &$User)
    {
        if(array_key_exists('id_photo' , $dataIn))
        {
            $imageName = "user-".rand(0 , 1000000). '.' .
                $dataIn['id_photo']->getClientOriginalExtension();

            $dataIn['id_photo']->move(public_path() . '/SD08/msf/', $imageName);

            $dataIn['id_photo'] = $imageName;
        }

        if(array_key_exists('bank_statement' , $dataIn))
        {
            $imageName = "user-".rand(0 , 1000000). '.' .
                $dataIn['bank_statement']->getClientOriginalExtension();

            $dataIn['bank_statement']->move(public_path() . '/SD08/msf/', $imageName);

            $dataIn['bank_statement'] = $imageName;
        }

        if(array_key_exists('salary_letter' , $dataIn))
        {
            $imageName = "user-".rand(0 , 1000000). '.' .
                $dataIn['salary_letter']->getClientOriginalExtension();

            $dataIn['salary_letter']->move(public_path() . '/SD08/msf/', $imageName);

            $dataIn['salary_letter'] = $imageName;
        }
        $dataIn['welcome'] = 'new';
        $dataIn['type'] = 6;
        $this->mapDataModel($dataIn, $User);

        $User->save();
    }

    function getOne($id) {
        return $this->getBaseOne($this->model, $id);
    }

    function update($dataIn = []) {
        $this->baseUpdate($dataIn, $this->model, $this->attributes);
    }

    function delete($id) {
        $this->baseDelete($id);
    }
}
