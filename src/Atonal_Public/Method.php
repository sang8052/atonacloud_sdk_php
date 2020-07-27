<?php


namespace Atonal_Public;



class Method
{


    public function GetIp(){
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
            $ip = getenv('REMOTE_ADDR');
        } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
        return $res;
    }

    public function GetIpLocal($ip=false)
    {
        if($ip=false)  $ip = $this->GetIp();
        $Request = new Request();
        $res =  $Request->CURL_GET("https://v2.api.iw3c.top/?api=ip&ip=".$ip);
        if(!$this->IS_JSON($res)) return $res;
        $data = json_decode($res,true)['data'];
        if ($data['Hlocal']!=""){$iplocal=$data["Hlocal"]." ".$data['isp'];}
        else $iplocal=$data["local"]." ".$data["isp"];
        return $iplocal;
    }

    public function GetServerIp(){
        $Request = new Request();
        $RES=$Request->CURL_GET("https://ip.iw3c.top");
        return trim($RES);
    }

    public function IS_JSON($data)
    {
        $data = json_decode($data, true);
        if (($data && is_object($data)) || (is_array($data) && !empty($data))) {
            return true;
        }
        return false;
    }

    public function RandStr($len){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $max = strlen($strPol)-1;

        for($i=0;$i<$len;$i++)
        {
            $str.=$strPol[rand(0,$max)];
        }
        return $str;
    }

    public function RandAppStr($len=8,$num=4)
    {
        $str = "";
        for($i=0;$i<$num-1;$i++){
            $str = $str .$this->RandStr($len)."-";
        }
        $str = $str .$this->RandStr($len);
        return $str;
    }
}