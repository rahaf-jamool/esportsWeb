<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class RegistrationService extends Facade
{
    protected static function getFacadeAccessor() { return 'registrationservice'; }
}