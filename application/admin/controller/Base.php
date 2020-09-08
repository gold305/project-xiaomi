<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\NodeModel;

/* 基础类文件 */
class Base extends Controller
{

    public function _initialize()
    {
        // 1、判断是否登录了
        if (session('username') == null) {
            $this->redirect(url('login/index'));
        }
        
        //检测登录是过期  一天保质期
        $now = date('Y-m-d',time());
        if($now!=session('login_time')){   //已过期
            $this->redirect(url('login/index'));
        }
        
        // 2、检测权限
        $control = lcfirst(request()->controller());
        $action = lcfirst(request()->action());
        // 跳过登录系列的检测以及主页权限
        if (! in_array($control, [
            'login',
            'index'
        ])) {
            
            if (! in_array($control . '/' . $action, session('action'))) {
                $this->error('没有权限');
            }
        }
        
        // 3、获取权限菜单
        $node = new NodeModel();
        
        $this->assign([
            'username' => session('username'),
            'menu' => $node->getMenu(session('rule')),
            'rolename' => session('role')
        ]);
    }

}

