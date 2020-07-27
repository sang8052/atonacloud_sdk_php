<?php


namespace Atonal_OAuth;


class Log extends AtonalAuth
{


    public function GetLog($OAuthId,$Page="",$Nums=""){
        $Param = array(
            "OAuthId" => $OAuthId,
            "Page" => $Page,
            "Nums" => $Nums
        );
        return $this->AtonalRequest("Log/",$Param);
    }
}