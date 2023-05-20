<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class LanguageService extends Facade
{
    protected static function getFacadeAccessor() { return 'languageservice'; }
}