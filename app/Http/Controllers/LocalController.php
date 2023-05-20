<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LocalController extends Controller
{

    public function setLocal($lang){
        if(in_array($lang , ['ar', 'en'])) {
            $cookie = Cookie::forever('locale', $lang);
            return redirect()->back()->withCookie($cookie);
        }else{
            abort(404);
        }
    }

}