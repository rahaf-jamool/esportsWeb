<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class CountriesService extends Facade
{
    protected static function getFacadeAccessor() { return 'CountriesService'; }
}