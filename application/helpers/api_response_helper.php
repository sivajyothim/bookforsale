<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function httpResponse($data,$status="200",$errorCode=null)
{
    $statusMessage=statusMessage($status);
    $errorMessage=errorMessage($errorCode);
    if($statusMessage==FALSE)
        httpResponse($data,500,901);
    if($errorCode!=null && $errorMessage==FALSE){
        httpResponse($data,$status,900);
    }
	header("HTTP/1.1 ".$status." ".statusMessage($status));
	header("Content-Type:application/json; charset=utf-8");
	if(empty($data))
        {
            if($errorCode!=null)
               exit(json_encode(array("code"=>$errorCode,"message"=>$errorMessage),true));
            exit();
        }
		
	else if(is_array($data))
                    if($errorCode!=null)
                        exit(json_encode(array("code"=>$errorCode,"message"=>$errorMessage,"errors"=>$data),true));
                    else 
                        exit(json_encode($data,true));
             else httpResponse(array(),500,600);	
}

function statusMessage($status)
{
	$responseCode = array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported');
	if(array_key_exists($status,$responseCode))
        return $responseCode[$status];
        else return FALSE;
}

function errorMessage($errorCode)
{
	$errorMessage = array(
            "100" => "Invalid Request Data",
            "101" => "Request Data Not Found",
            "102" => "Content-Type allowed JSON only",
            "103" => "Content-Type Header Missing",
            "104" => "Charset Not Accepted",
            "105" => "Authorization Header Missing",
            "106" => "Invalid Authorization Header",
            "107" => "Invalid Refresh Token",
            "108" => "Could not generate access token",
            "109" => "Could not generate refresh token",
            "200" => "Invalid Form Data",
            "201" => "Record Exists",
            "202" => "No record found",
            "203" => "Form Data Missing",
            "300" => "Invalid Authentication Code",
            "301" => "Invalid Access Token",
            "302" => "Invalid Refresh Token",
            "303" => "Access Token Revoked",
            "304" => "Refresh Token Revoked",
            "305" => "Authentication Code expired",
            "306" => "Access Token Expired",
            "307" => "Refresh Token Expired",
            "308" => "Authorization Header Missing",
            "309" => "Invalid user credintals",
            "310" => "Account Suspended",
            "311" => "Access denied to the requested Resource",
            "312" => "Undefined Scope in token",
            "500" => "Database Error",
            "501" => "Method inputs invalid",
            "600" => "Response input is not a array",
            "900" => "Undefined Error",
            "901" => "Unrecognized HTML Status",
            "902" => "Payment Success",
            "903" => "Payment Failed"
        );
        if(array_key_exists($errorCode,$errorMessage))
        return $errorMessage[$errorCode];
        else return FALSE;
}


function staffAuthToken($data)
{
    $userToken='';
    $userToken = (isset($data['Authorization']))?$data['Authorization']:'';
    return $userToken;
}