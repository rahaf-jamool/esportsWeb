<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class UnitService extends Facade
{
    protected static function getFacadeAccessor() { return 'UnitService'; }
}