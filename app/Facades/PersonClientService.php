<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class PersonClientService extends Facade
{
    protected static function getFacadeAccessor() { return 'PersonClientService'; }
}