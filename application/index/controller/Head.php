<?php
namespace app\index\controller;

use think\Controller;
use think\Session;
use app\index\controller\Base;

class Head extends Base
{
    //
    public function xianbin()
    {
        $phone = Session::get('phone');
        
        $operate = [
            "$phone" => url('index/deng'),
            "个人中心" => url('index/deng'),
            "退出登录" => url('index/logout')
        ];
        
        $yi=userdetails($operate,$phone);
        
        $wei=weilog();
        
        if(empty($phone)){
            $this->assign('yilog',$wei);
        }else{
            $this->assign('yilog',$yi);
        }
    }
    
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
    
    //小米手机页面
    public function liebiao()
    {
        $this->xianbin();
        return $this->fetch('index/liebiao');
    }
    
    //详情页面
    public function xiangqing()
    {
        $this->xianbin();
        return $this->fetch('index/xiangqing');
    }
    
    //个人中心页面
    public function selfInfo()
    {
        $this->xianbin();
        return $this->fetch('index/self_info');
    }
    
    //订单页面
    public function order()
    {
        $this->xianbin();
        return $this->fetch('index/dingdanzhongxin');
    }
    
    //购物车页面
    public function shopping()
    {
        $this->xianbins();
        return $this->fetch('index/gouwuche');
    }
}
