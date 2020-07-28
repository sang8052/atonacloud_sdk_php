<?php


namespace Atonal_OAuth;


class OAuth extends AtonalAuth
{


    public function AppLogin($OAuthId,$OAuthApp,$OAuthSafe="",$OAuthSafeParam=array(),$OAuthCallBack="",$OAuthClientParam="",$OAuthServerParam=""){
        if(!is_string($OAuthClientParam)) return "ERROR:OAuthClientParam Must A String!";
        if(!is_string($OAuthServerParam)) return "ERROR:OAuthServerParam Must A String!";
        $Param = array(
            "OAuthId" => $OAuthId,
            "OAuthApp" => $OAuthApp,
            "OAuthSafe" => $OAuthSafe,
            "Safe_Reffer" => $OAuthSafeParam["Reffer"],
            "Safe_Ip" => $OAuthSafeParam["Ip"],
            "Safe_Ua" => $OAuthSafeParam["Ua"],
            "OAuthCallBack" => $OAuthCallBack,
            "OAuthClientParam" => $OAuthClientParam,
            "OAuthServerParam" => $OAuthServerParam
        );
        return $this->AtonalRequest("Login/",$Param);
    }

    public function AppResponse($Access_Token){
        $Param = array(
            "Access_Token" => $Access_Token,
        );
        return $this->AtonalRequest("Response/",$Param);
    }
}