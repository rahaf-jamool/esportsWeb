<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class PlatformService extends Facade
{
    protected static function getFacadeAccessor() { return 'PlatformService'; }
}
