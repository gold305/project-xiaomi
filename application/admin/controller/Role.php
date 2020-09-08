<?php 
    namespace app\admin\controller;

    use think\Controller;
    
    class Role extends Controller
    {
        public function index(){
            return $this->fetch('role/index');
        }
    }