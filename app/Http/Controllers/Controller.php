<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;



    public function respSuccess($data = null) {
		return response()->json(array(
            "message" => "",
            "data" => $data,
            "_token" => Auth::user()->createToken('1Frame')->accessToken
        ), 200);
	}

    public function respError($subject, $message) {
		return response()->json(array(
            "message" => $message,
            'errors' => [
                $subject => [
                    $message
                ]
            ]
        ), 422);
	}





	public function readURL($url, $header) {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        // $fp = fopen(dirname(__FILE__).'/errorlog_'.date("Y-m-d H:i:s").'.txt', 'w');
        // $fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
        // curl_setopt($curlHandle, CURLOPT_STDERR, $fp);
        // curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curlHandle);
        curl_close($curlHandle);
        // fclose($fp);
        return $response;
    }

    public function postURL($url, $header, $PostData) {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $PostData);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        // curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        // $fp = fopen(dirname(__FILE__).'/errorlog_'.date("Y-m-d H:i:s").'.txt', 'w');
        // $fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
        // curl_setopt($curlHandle, CURLOPT_STDERR, $fp);
        // curl_setopt($curlHandle, CURLOPT_VERBOSE, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curlHandle);
        curl_close($curlHandle);
        // fclose($fp);
        return $response;
    }
}
