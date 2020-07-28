<?php


namespace Atonal_Public;


class Request
{
    // CURL 请求的超时时间设置
    protected $timeout = 5;

    // 默认请求使用的 UA
    protected $ua = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Safari/537.36";

    protected $error = "";
    protected $errno = "";

    public function __construct($timeout=false,$ua=false)
    {
        if($ua)       $this->ua = $ua;
        if($timeout)  $this->timeout = $timeout;
    }

    public function CURL_RES_ERROR(){

    }

    public function CURL_GET($url,$time=false,$ua=false ){
        if($time=false) $time = $this->timeout;
        if($ua=false) $ua = $this->ua;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_USERAGENT, $ua);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , $time);
        curl_setopt($curl, CURLOPT_TIMEOUT, $time);
        $data = curl_exec($curl);
        if($data=="") {
            $this->error = curl_error($curl);
            $this->errno = curl_errno($curl);
            return "ERROR CODE:".$this->errno."\nERROR MSG:".$this->error;
        }
        curl_close($curl);
        return $data;
    }

    public function CURL_POST($url,$post,$time=false,$ua = false,$isjson=false){
        if($time=false) $time = $this->timeout;
        if($ua=false) $ua = $this->ua;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        if($isjson){
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8', 'Content-Length:' .strlen($post)));
        }


        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT , $time);
        curl_setopt($curl, CURLOPT_TIMEOUT, $time);

        $data = curl_exec($curl);
        if($data=="") {
            $this->error = curl_error($curl);
            $this->errno = curl_errno($curl);
            return "ERROR CODE:".$this->errno."\nERROR MSG:".$this->error;
        }
        curl_close($curl);
        return $data;

    }


}