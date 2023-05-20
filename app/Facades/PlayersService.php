<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class PlayersService extends Facade
{
    protected static function getFacadeAccessor() { return 'PlayersService'; }
}
