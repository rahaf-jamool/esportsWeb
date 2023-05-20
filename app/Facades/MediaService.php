<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class MediaService extends Facade
{
    protected static function getFacadeAccessor() { return 'mediaservice'; }
}