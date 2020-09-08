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
    
    $res=<<<EOT
    <ul>
    <li><a href="/index/index/deng" >登录</a></li>
    <li>|</li>
    <li><a href="/index/index/note" >注册</a></li>
    <li>|</li>
    <li><a href="">消息通知</a></li>
    </ul>
EOT;
    
    return $res;
    
}