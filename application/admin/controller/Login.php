<?php
namespace app\admin\controller;
use think\Controller;

use app\admin\model\RoleModel;
use app\admin\model\UserModel;

/*登录*/
class Login extends Controller{
    
    //登录页面
    public function index(){
        return $this->fetch('/login'); 
    }
    
    //登录操作
    public function doLogin(){
        //1、接收参数
        $username = input("param.username");
        $password = input("param.password");
        
        //2、初步验证参数格式，没有问题，返回 true，否则返回提示语
        $result = $this->validate(array('username'=>$username,'password'=>$password), 'AdminValidate');
        if($result!==true){  //数据是为空的
            return json(['code'=>-1,'msg'=>$result,'data'=>'']);
        }
        
        //3、管理员是否存在
        $hasUser=db("user")->where("username",$username)->find();
        if(empty($hasUser)){   //为空不存在
            return json(['code'=>-3,'msg'=>'用户不存在','data'=>'']);
        }

        //4、密码是否正确
        if(md5($password) != $hasUser['password']){  //密码错误
            return json(['code'=>-4,'msg'=>'密码错误','data'=>'']);
        }
        
        //5、账号是否被禁用了
        if(1 != $hasUser['status']){  //1是可用，其他的都是禁用
            return json(['code'=>-5,'msg'=>'此管理员已被禁用','data'=>'']); 
        }
        
        //判断是否已经离职
        if(1 != $hasUser['is_leave']){  //1是在职，其他的都是禁用
            return json(['code'=>-6,'msg'=>'此管理员已离职','data'=>'']);
        }
        
        //6、获取该管理员的角色信息
        $RoleModel = new RoleModel();
        $info=$RoleModel->getRoleInfo($hasUser['typeid']);
        
        session('username', $username);
        session('id', $hasUser['id']);
        session('real_name', $hasUser['real_name']);
        session('role', $info['rolename']);  //角色名
        session('rule', $info['rule']);  //角色节点
        session('action', $info['action']);  //角色权限
        session('login_time',date('Y-m-d',time()));    //登录时间  年月日
        
        //7、更新管理员状态
        $param = [
            'loginnum' => $hasUser['loginnum'] + 1,
            'last_login_ip' => request()->ip(),
            'last_login_time' => time()
        ];
        
        db('user')->where('id', $hasUser['id'])->update($param);
        
        return json(['code' => 1, 'data' => url('index/index'), 'msg' => '登录成功']);
        
    }
    
    //退出登录
    public function loginOut(){
        session('username', null);
        session('real_name',null);
        session('id', null);
        session('role', null);  //角色名
        session('rule', null);  //角色节点
        session('action', null);  //角色权限
        session('login_time', null);  //本次的登录时间  年月日
        
        $this->redirect(url('index'));
        
    }
    
    /**
     * 修改密码
     * @author hugo
     * @time 2019-11-10
     */
    public function updatepassword(){
        
        if(request()->isAjax()){
            $loginModel = new UserModel();
            
            $userId = session('id');
            $param = input('post.');
            $param = parseParams($param['data']);
            
            //校验旧密码是否正确
            $resSelect = $loginModel->checkOldPass($userId,$param);

            if( $resSelect > 0 ){
                $resUpdate = $loginModel->updatepass($userId,$param);
            }else{
                return json(['code' => 2, 'data' => url('/admin/login/updatepassword'), 'msg' => '旧密码错误']);
            }
            
            if( $resUpdate > 0 ){
                return json(['code' => 1, 'data' => url('/admin/login/index'), 'msg' => '修改密码成功,请重新登录']);
            }else{
                return json(['code' => 2, 'data' => url('/admin/login/updatepassword'), 'msg' => '修改密码失败']);
            }
            
            
        }
        $this->assign('username',session('username'));

        return $this->fetch();
        
    }

}