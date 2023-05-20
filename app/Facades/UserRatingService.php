<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class UserRatingService extends Facade
{
    protected static function getFacadeAccessor() { return 'userratingservice'; }
}