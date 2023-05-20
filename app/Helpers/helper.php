<?php

use App\Services\ApiService;
use App\Helpers\General\EndPoints;
use Illuminate\Support\Facades\Session;

/**
 * Created by PhpStorm.
 * User: amro
 * Date: 12/21/16
 * Time: 11:38 AM
 */



function make_slug($string = null, $separator = "-") {
    if (is_null($string)) {
        return "";
    }

    // Remove spaces from the beginning and from the end of the string
    $string = trim($string);

    // Lower case everything
    // using mb_strtolower() function is important for non-Latin UTF-8 string | more info: http://goo.gl/QL2tzK
    $string = mb_strtolower($string, "UTF-8");;

    // Make alphanumeric (removes all other characters)
    // this makes the string safe especially when used as a part of a URL
    // this keeps latin characters and arabic charactrs as well
    $string = preg_replace("/[^a-z0-9-ءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]_\s/u", "", $string);

    // Remove multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);

    // Convert whitespaces and underscore to the given separator
    $string = preg_replace("/[\s_]/", $separator, $string);

    $string = str_replace("/", $separator, $string);

    return $string;
}

if (! function_exists('words')) {
    /**
     * Limit the number of words in a string.
     *
     * @param  string  $value
     * @param  int     $words
     * @param  string  $end
     * @return string
     */
    function words($value, $words = 100, $end = '...')
    {
        return \Illuminate\Support\Str::words(strip_tags($value), $words, $end);
    }
}


if (! function_exists('getTranslate') ) {
    function getTranslate($object, $parameter) {
        if (!is_null($object)) {
            return App::getLocale() == 'en' ? $object['en' . ucfirst($parameter)] : $object[$parameter];
        }
    }
}

if (!function_exists('sessionTimeOut')) {
    function sessionTimeOut() {
        if (Session::has('last_activity') && ( (time() - Session::get('last_activity')) > 28800 )) {
            Session::flush();
        }
        if (!Session::has('last_activity')) {
            Session::put('last_activity', time());
        }
    }
}

// Get Company Token
function getCompanyToken()
{
    try {
        $esportsFederationUsername = 'Admin@app.com';
        $esportsFederationPassword = 'Admin@123';
        $esportsFederationEmail = 'Admin@app.com';
        $data = [
            'Email' => $esportsFederationEmail,
            'userName' => $esportsFederationUsername,
            'password' => $esportsFederationPassword
        ];
        $response = ApiService::PostDataByEndPoint(EndPoints::loginApi, $data);
        // Check if there is an error
        if (isset($response[0]['errors']) && !empty($response[0]['errors'])) {
            return back()->with('error', trans('auth.invalid-data'));
        }
        $token = $response['token'];
        if (empty($token)) {
            abort(500, 'Server Error');
        }
        if (session()->has('mainToken')) {
            session()->forget('mainToken');
            session()->put('mainToken', $token);
        } else {
            session()->put('mainToken', $token);
        }

    } catch (\Exception $e) {
        return $e->getMessage();
    }
}

