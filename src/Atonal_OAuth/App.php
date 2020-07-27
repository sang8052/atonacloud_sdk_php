<?php


namespace Atonal_OAuth;


// 控制用户账户目录下的 进行OAuth 的应用
class App extends AtonalAuth
{


    // 添加一个 用于融合登录的应用
    public function AddApp($AppName,$AppAuthor,$AppIcon,$AppDes,$AppCallBack){

        $Param =array(
            "AppName"   =>   $AppName,
            "AppAuthor" =>   $AppAuthor,
            "AppIcon"   =>   $AppIcon,
            "AppDes"    =>   $AppDes,
            "AppCallBack" => $AppCallBack
        );

        return $this->AtonalRequest("App/AddNewOAuthApp");
    }

    // 删除一个用于融合登录的应用
    public function DeleteApp($OAuthId){
        $Param = array(
            "OAuthId" => $OAuthId
        );
        return $this->AtonalRequest("App/DeleteOAuthApp",$Param);
    }

    // 列出用户目录下的所有App
    public function ListApp()
    {
        $Param = array();
        return $this->AtonalRequest("App/GetOAuthAppList",$Param);
    }

    // 更新指定的用户目录下的App的配置信息
    // 注意如果不需要更新某个参数 请不要传入数据 或把参数置为false
    public function UpdateApp($OAuthId,$AppName=false,$AppAuthor=false,$AppIcon=false,$AppDes=false,$AppCallBack=false,$AppStatus=false){
        $Param = array(
            "OAuthId" => $OAuthId
        );
        if($AppName)     $Param["AppName"] = $AppName;
        if($AppAuthor)   $Param["AppAuthor"] = $AppAuthor;
        if($AppIcon)     $Param["AppIcon"] = $AppIcon;
        if($AppDes)      $Param["AppDes"] = $AppDes;
        if($AppCallBack) $Param["AppCallBack"] = $AppCallBack;
        if($AppStatus)   $Param["AppStatus"] = $AppStatus;


        return $this->AtonalRequest("App/UpdateOAuthApp",$Param);
    }


}