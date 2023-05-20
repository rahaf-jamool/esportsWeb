<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class TranslationService extends Facade
{
    protected static function getFacadeAccessor() { return 'TranslationService'; }
}