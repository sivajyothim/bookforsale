<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function processRequest($scope,$dataRequired=FALSE,$id=0,$hierarchy=0){
    $headers=getallheaders();
   //print_r($headers);
  if($_SERVER['REQUEST_METHOD']=='POST'||$_SERVER['REQUEST_METHOD']=='PUT')
    if(array_key_exists("Content-Type",$headers)){
        if($headers['Content-Type']!="application/json")
            httpResponse(array(),400,102);
    } else httpResponse(array(),400,103);
    
    if($id!=0 || $hierarchy!=0){
      
        if(array_key_exists("Authorization",$headers))
        { 
            if(preg_match("/^Bearer \S+$/",$headers['Authorization']))
            {
                $token =preg_replace("/^Bearer /","",$headers['Authorization']);
                $CI=get_instance();
                $CI->load->model("auth_model");
                $token=$CI->auth_model->decodeToken($token);
               // print_r($token);
                if(!preg_match("/".$scope."_ALL/",$token['scope']))
                    if(preg_match("/".$scope."_CHILDREN/",$token['scope']))
                    {
                        $hierarchyArray=explode("|",$token['hierarchy']); 
						if(!in_array($hierarchy,$hierarchyArray))
							httpResponse(array(),401,311);
                    }
                    else if(preg_match("/".$scope."_SELF/",$token['scope']))
                    {
                       if($id!=$token['id'])
                           httpResponse(array(),401,311);
                    }
                    else httpResponse(array(),401,312);
            } else httpResponse(array(),400,106);
        } else httpResponse(array(),400,105);  
    }
    
    if($dataRequired==TRUE)
    {
        $data=json_decode(file_get_contents("php://input"),true);
        if(!empty($data)){
            return $data;
        } else httpResponse(array(),400,203);
    }
    return array();
}

