<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class CurrenciesService extends Facade
{
    protected static function getFacadeAccessor() { return 'CurrenciesService'; }
}