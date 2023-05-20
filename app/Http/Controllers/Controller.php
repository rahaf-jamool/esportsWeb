<?php

namespace App\Http\Controllers;

use App\Facades\LanguageService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;

class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (session('success')) {
                Alert::success(session('success'));
            }
            if (session('error')) {
                Alert::error(session('error'));
            }
            return $next($request);
        });
    }
}
