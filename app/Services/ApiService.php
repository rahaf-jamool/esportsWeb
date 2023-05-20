<?php
/**
 * Created by PhpStorm.
 * User: amro
 * Date: 12/3/16
 * Time: 12:03 PM
 */

namespace App\Services;

use App\Models\Block;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;


/**
 * Class BlockService
 * @package App\Services
 */
class ApiService
{
    function __construct() {}

    public static function getHttpHeaders($token)
    {
        if(!empty($token)) {
            $headers = [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ];
        }
        else {
            $headers = ['Content-Type' => 'application/json', 'Accept' => 'application/json'];
        }
        return $headers;
    }

    public static function GetDataByEndPoint($url, $token = null, $body = null)
    {
        // dd($body);
        $headers = self::getHttpHeaders($token);
        // dd($headers);
        if (!is_null($body)) {
            $res = Http::withHeaders($headers)->withBody(json_encode($body), 'application/json')->get($url);
        } else {
            $res = Http::withHeaders($headers)->get($url);
        }
        $response = json_decode((string) $res->getBody(), true);
        return $response;
    }

    public static function PostDataByEndPoint($url, $body = [], $token = null)
    {
        $headers = self::getHttpHeaders($token);
        $res = Http::withHeaders($headers)->post($url, $body);
        $response = json_decode((string) $res->getBody(), true);
        return $response;
    }

    public static function PutDataByEndPoint($url, $body = [], $token = null)
    {
        $headers = self::getHttpHeaders($token);
        $res = Http::withHeaders($headers)->put($url, $body);
        $response = json_decode((string) $res->getBody(), true);
        return $response;
    }

    public static function PatchDataByEndPoint($url, $body = [], $token = null)
    {
        $headers = self::getHttpHeaders($token);
        $res = Http::withHeaders($headers)->patch($url, $body);
        $response = json_decode((string) $res->getBody(), true);
        return $response;
    }

    public static function deleteDataByEndPoint($url, $token){
        $headers = self::getHttpHeaders($token);
        $res = Http::withHeaders($headers)->delete($url);
        $response = json_decode((string) $res->getBody(), true);
        return $response;
    }

    public static function GetDataByMultiEndPoint($urls = [], $token = null)
    {
        $headers = self::getHttpHeaders($token);
        $groupOfResponse = [];
        $responses = Http::pool(function (Pool $pool) use ($urls, $headers) {
            $https = [];
            foreach($urls as $url) {
                $https[] = $pool->withHeaders($headers)->get($url);
            }
            return $https;
        });
        foreach($responses as $response) {
            $responseItem = json_decode((string) $response->getBody(), true);
            $groupOfResponse[] = $responseItem;
        }
        return count($urls) == 1 ? json_decode((string) $responses[0]->getBody(), true) : $groupOfResponse;
    }

}
