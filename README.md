# atonacloud_sdk_php
无调网络通用SDK 

 零、 序
    
    Version 1.0.beta  
    Data:2020年7月27日  
    Author:sudem.sang@atonal.cn



 一、环境需求

    1.PHP >=7.0  
    2.PHP 需要安装CURL 拓展并支持使用 HTTPS 协议
    3.PHP 需要允许 eval 函数（暂定）
 
 
 二、安装
 
    强烈建议使用 composer 进行安装  
    composer require atonalcloud/sdk_php
    
 三、支持的API 应用列表
 
    1.融合登录 Atonal_OAuth https://oauth.atonal.cn
    
 四、使用示例
    
    <?php
        require "vendor/autoload.php";
        use atonalcloud\Atonal_OAuth\App;
    
        $App = new App($ApiId,$ApiSerect);
        $AppList = $App->->ListApp();
        
        print_r($AppList);
    ?>
    
 五、更多功能努力开发中，敬请期待！