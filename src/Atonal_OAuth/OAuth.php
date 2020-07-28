<?php


namespace Atonal_OAuth;


class OAuth extends AtonalAuth
{


    public function AppLogin($OAuthId,$OAuthApp,$OAuthSafe="",$OAuthSafe_Reffer="",$OAuthSafe_Ip="",$OAuthSafe_Ua="",$OAuthCallBack="",$OAuthClientParam="",$OAuthServerParam=""){
        if(!is_string($OAuthClientParam)) return "ERROR:OAuthClientParam Must A String!";
        if(!is_string($OAuthServerParam)) return "ERROR:OAuthServerParam Must A String!";
        $Param = array(
            "OAuthId" => $OAuthId,
            "OAuthApp" => $OAuthApp,
            "OAuthSafe" => $OAuthSafe,
            "Safe_Reffer" =>$OAuthSafe_Reffer,
            "Safe_Ip" => $OAuthSafe_Ip,
            "Safe_Ua" => $OAuthSafe_Ua,
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