<?php


namespace Atonal_Auth;


use Atonal_Public\Method;
use Atonal_Public\Request;

class AlgorithmV1
{
    protected $AppId;
    protected $AppSerect;
    protected $ServerIp ;
    protected $AppRandStr ;

    protected $CacheTime = 7200;
    protected $CacheFile = __DIR__ ."\..\..\Atonal\ServerIp.Cache";

    public function __construct($AppId,$Appserect)
    {
        $this->AppId = $AppId;
        $this->AppSerect = $Appserect;
        $this->ServerIp = $this->CacheServerIp();
        // 创建缓存文件的文件夹
        if(!file_exists(__DIR__ ."\..\..\Atonal")) mkdir(__DIR__ ."\..\..\Atonal");
    }

    public function CacheServerIp(){
        if(file_exists(""))
        {
            $Cache = json_decode(file_get_contents($this->CacheFile),true);
            if($Cache["EXPIRE"]<time()) $Cache = $this->GetServerIp();
        }
        else $Cache = $this->GetServerIp();
        return $Cache["IP"];
    }

    public function GetServerIp(){
        $Method = new Method();
        $Cache["IP"] = $Method->GetServerIp();
        $Cache["EXPIRTE"] = time() + $this->CacheTime;
        file_put_contents($this->CacheFile,json_encode($Cache));
        return $Cache;
    }

    public function RequestApi($Api,$Param){
        $Request = new Request();
        if(!$Param) $Param = Array();
        $Param = $this->SignAppToken($Param);
        $Response = $Request->CURL_POST($Api,$Param);
        return $Response;
    }

    public function SignAppToken($Param){
        $Method = new Method();
        $this->AppRandStr = $Method->RandAppStr();


        // 请求头部
        $Param["AppId"] = $this->AppId;
        $Param["AppRandStr"] = $this->AppRandStr;
        // 历史遗留问题 此参数作废 非必传
        $Param["AppSignTime"] = time();

        // 数据包体
        $Param = $Param;

        //效验签名
        $Param["AppToken"] = $this->HashAppToken($Param);

        return $Param;
    }


    public function HashAppToken($Param){
        unset($Param["AppRandStr"]);

        ksort($Param);

        $STR_MD5 = $this->AppSerect.$this->AppRandStr;
        $STR_SHA256 = http_build_query($Param);

        $KEY_MD5  = base64_encode($this->ServerIp);
        $KEY_SHA256 = hash_hmac("md5",$STR_MD5,$KEY_MD5);

        $AppToken = hash_hmac("sha256",$STR_SHA256,$KEY_SHA256);
        return $AppToken;
    }
}