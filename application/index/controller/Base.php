<?php
    namespace app\index\controller;

    use think\Controller;
    use think\Session;
    

    class Base extends Controller{
        public function _initialize()
        {
        // 1、判断是否登录了
            if (session::get('phone') == null) {
                $this->redirect(url('index/deng'));
            }
        }
    }