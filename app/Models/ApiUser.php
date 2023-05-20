<?php

namespace App\Models;

class ApiUser {
    
    public $id;
    public $userName;
    public $name;
    public $image;
    public $email;
    public $phone;
    public $mobile;
    public $officePhone;
    public $fax;
    public $address;
    public $state;
    public $countryId;
    public $webSite;
    public $managerId;
    public $password;
    public $passwordConfirm;
    public $isCompany;
    public $permissions;
    public $confirmedAccount;
    public $roles = [];
    public $claims;

    public function __construct() {}
}