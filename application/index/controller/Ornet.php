<?php
namespace app\index\controller;

use think\Controller;
use think\Session;

class Ornet extends Controller
{
    public function xianbins()
    {
        $phone = Session::get('phone');
        
        $operate = [
            "$phone" => url('index/deng'),
            "个人中心" => url('index/deng'),
            "退出登录" => url('index/logout')
        ];
        
        $yi=userdeta($operate,$phone);
        
        $wei=weilog();
        
        if(empty($phone)){
            $this->assign('yilog',$wei);
        }else{
            $this->assign('yilog',$yi);
        }
    }
    
    //确认付款订单页面
    public function sureorder()
    {
        $this->xianbins();
        return $this->fetch('order/sureorder');
    }
    
   
}
