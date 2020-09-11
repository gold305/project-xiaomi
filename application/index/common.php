<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//登录，登出页面
function userdetails($operate = [],$ter){
    $option = <<<EOT
    
            <ul class="anty">
                <li>|</li>
                <li class='ana' ><a href="">消息通知</a></li>
                <li>|</li>
                <li class='bnb' ><a href="/index/head/order" >我的订单</a></li>
           </ul>
            <div class="dropdown">
			  <a class="dropbtn">$ter</a>
			  <div class="dropdown-content">
			    <a href="/index/head/selfInfo">个人中心</a>
			    <a href="#">评价晒单</a>
			    <a href="#">我的喜欢</a>
			    <a href="/index/index/logout">退出登录</a>
			  </div>
			</div>
EOT;
    
    return $option;
}

function userdeta($operate = [],$ter){
    $option = <<<EOT
    
            <ul class="antys">
                <li>|</li>
                <li class='bnb' ><a href="/index/head/order" >我的订单</a></li>
           </ul>
            <div class="dropdowns">
			  <a class="dropbtns">$ter</a>
			  <div class="dropdown-contents">
			    <a href="/index/head/selfInfo">个人中心</a>
			    <a href="#">评价晒单</a>
			    <a href="#">我的喜欢</a>
			    <a href="/index/index/logout">退出登录</a>
			  </div>
			</div>
EOT;
    
    return $option;
}

function weilog(){
    
    $option = <<<EOT
        <ul>
        <li><a href="/index/index/deng" >登录</a></li>
        <li>|</li>
        <li><a href="/index/index/note" >注册</a></li>
        <li>|</li>
        <li><a href="">消息通知</a></li>
        </ul>
EOT;
    
    return $option;
}

include_once("../application/extra/CCP/SDK/CCPRestSDK.php");

/**
 * 发送模板短信
 * @param to 手机号码集合,用英文逗号分开
 * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
 * @param $tempId 模板Id
 */
function sendTemplateSMS($to,$datas,$tempId)
{
    //主帐号
    $accountSid= '8a216da8746c6ee4017471d256550288';
    
    //主帐号Token
    $accountToken= '6ef975b9a84e4fd1ad04667b73c297a4';
    
    //应用Id
    $appId='8a216da8746c6ee4017471d25740028f';
    
    //请求地址，格式如下，不需要写https://
    $serverIP='app.cloopen.com';
    
    //请求端口
    $serverPort='8883';
    
    //REST版本号
    $softVersion='2013-12-26';
    
    // 初始化REST SDK
    //global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
    $rest = new REST($serverIP,$serverPort,$softVersion);
    $rest->setAccount($accountSid,$accountToken);
    $rest->setAppId($appId);
    
    // 发送模板短信
    //echo "Sending TemplateSMS to $to <br/>";
    $result = $rest->sendTemplateSMS($to,$datas,$tempId);
    if($result == NULL ) {
        //echo "result error!";
    }
    if($result->statusCode!=0) {
        //echo "error code :" . $result->statusCode . "<br>";
        //echo "error msg :" . $result->statusMsg . "<br>";
        //TODO 添加错误处理逻辑
    }else{
        //echo "Sendind TemplateSMS success!<br/>";
        // 获取返回信息
        //$smsmessage = $result->TemplateSMS;
        //echo "dateCreated:".$smsmessage->dateCreated."<br/>";
        //echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
        return '2003T';
        //TODO 添加成功处理逻辑
    }
    
}