<?php 
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\DashboardModel;

class Index extends Base{

    /**
     * 后台默认首页
     * @return mixed
     */
    
    /*显示导航和左侧菜单栏*/
    public function index(){
        return $this->fetch('./index');
    }

    /*在导航和左侧菜单栏中  显示内容页*/
    public function indexPage(){
        return $this->fetch('./index/index');
    }

}
