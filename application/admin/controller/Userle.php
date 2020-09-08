<?php 
    namespace app\admin\controller;

    use think\Controller;
    use app\admin\model\UserleModel;
    
    class Userle extends Controller
    {
        //查询用户信息
        public function index($lik = false){
            
            $sent = new UserleModel();
            $where = [
                'username' => ["like","%$lik%"]
            ];
            
            $sel = $sent->showfan($where);
            
//             $this->saveAll('zhi',$sel);
            $this->assign('zhi',$sel);
            
            return $this->fetch('user/index');
        }
        
        public function text(){
            if(request()->isAjax()){
                $user = input('post.user');
                
                
                $this->index($user);
            }
        }
    }