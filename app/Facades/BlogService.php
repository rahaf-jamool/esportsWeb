<?php

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class BlogService extends Facade
{
    protected static function getFacadeAccessor() { return 'BlogService'; }
}
