<?php


namespace Atonal_OAuth;


use Atonal_Auth\AlgorithmV1;
use Atonal_Public\Method;

class AtonalAuth
{
    // 设置Api 接口的地址信息
    protected $ApiAddress = "https://oauth.atonal.cn/";

    // 指定使用的签名算法的标准
    protected $AlgorithmVersion = "V1";

    public function __construct($AppId,$AppSerect)
    {
        $this->AppId = $AppId;
        $this->AppSerect = $AppSerect;
    }


    // 请求执行指定的Api
    public function AtonalRequest($Api,$Param){

        // 自动加载 API通讯协议 暂未支持
        //$Algorithm = eval("return new Algorithm".$this->AlgorithmVersion."()");

        $Algorithm = new AlgorithmV1($this->AppId,$this->AppSerect); $Method =new Method();
        $Response = $Algorithm->RequestApi($this->ApiAddress.$Api,$Param);
        if($Method->IS_JSON($Response)) return json_decode($Response,true);
        else   return $Response;
    }

}