<?php
    namespace app\index\controller;
    
    use think\Controller;
    use think\Session;
    use app\index\model\Dengmodel;
    use app\index\model\Notemodel;
    
    class Index extends Controller
    {
        
        public function text()
        {
            return $this->fetch('index/text');
        }
        
        //默认进入页面
        /*
         *  作者：欧阳磊
         *  审：李昊枕
         *  时间：2020-09-07
         */
        public function index()
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
           
            return $this->fetch('index/index');
        }
        
        //登录操作
        /*
         *  作者：陈欢
         *  审：李昊枕
         *  时间：2020-09-01
         */
        public function deng()
        {
            if (request()->isAjax()){
                $vicode = input('ajcode');  //验证码
                
    			if(!captcha_check($vicode) ){
    			    return Json(['code' => -3 , 'data' => '验证码错误']);   //验证码错误
    			}else{
    			    $naDuser = input('ajname');  //账号
    			    $naDpass = input('ajpass');  //密码
    			    
    			    $where = [
    			        'username' => $naDuser
    			    ];
    			    
    			    $whereht = [
    			        'username' => trim($naDuser),
    			        'password' => trim(md5($naDpass.config('salt')))
    			    ];
    			    
    			    
    			    $sent= new Dengmodel();
    			    $res = $sent->mylogin($where);		//判断用户名是否存在
    			    $res2 = $sent->mylogin($whereht);	//判断用户名或密码是否正确
    			    
    			    if(empty($res)){
    			        return Json(['code' => -1 , 'data' => '用户名不存在']);                  //用户名不存在
    			    }else if(empty($res2)){
    			        return Json(['code' => -2 , 'data' => '用户名或密码不正确，请重新输入']);    //用户名或密码不正确，请重新输入
    			    }else{
    			        session('phone',$naDuser);      //写入seesion
    			        return Json(['code' => 1 , 'data' => '登录成功！']);   //登录成功！
    			    }
    			}
            }
            return $this->fetch('login/login');
        }
        
        //注册操作
        /*
         *  作者：张佳鹏
         *  审：李昊枕
         *  时间：2020-09-03
         */
        public function note()
        {
            if( request()->isAjax() ){
                $naDuser = input('naDuser');
                $naDpass = input('naDpass');
                $naDphone = input('naDtel');
                $vicode = input('vicode');
                
                $redis = new \Redis();
                $redis->connect('127.0.0.1','6379');
                $redis->auth('520111');                 //连接密码
                $redis->select(5);                      //选择redis数据库
                
                $tel = $redis->get($naDphone);          //通过手机号获取验证码
              
                if( $vicode != $tel){
                    return Json(['code' => -3 , 'data' => '验证码错误']);
                }
                
                $register = new Notemodel();
                
                //判断用户名是否存在的
                $where = [
                    'username' => $naDuser
                ];
                //注册成功需要插入用户表中的参数
                $charu = [
                    'id' => '',
                    'username' => $naDuser,
                    'password' => trim(md5($naDpass.config('salt'))),
                    'phone' => $naDphone,
                    'date' => date("Y-m-d h:i:s"),
                    'state' => '1'
                ];
           
                $res = $register->is_zai($where);
                
                
                if( $res ){
                    return Json(['code' => -1 , 'data' => '该账号已经被注册，请重新注册']);
                }else{
                    $reg = $register->addDenglu($charu);
                    if(!empty($reg)){
                        return Json(['code' => 1 , 'data' => '注册成功']);
                    }else{
                        return Json(['code' => -2 , 'data' => '注册失败']);
                    }
                }
                
            }
            return $this->fetch('note/register');
        }
        
        
        /*
         *  作者：李昊枕
         *  审：李昊枕
         *  时间：2020-09-10
         */
        
        //获取验证码还有多少重发
        public function vicodeResend()
        {
            if(request()->isAjax()){
                $naDtel = input('post.naDtel');
                
                $redis = new \Redis();
                $redis->connect('127.0.0.1','6379');
                $redis->auth('520111');                 //连接密码
                $redis->select(5);                      //选择redis数据库
                
                $tel = $redis->get($naDtel);            //通过手机号获取验证码
                $countDown = $tel . 'lumme';            //获取存【验证码倒计时】的变量名
                $results = $redis->get($countDown);
                
                if($results == 'cz'){
                    $miao = $redis->TTl($countDown);
                    return Json(['code' => 3 , 'msg' => $miao , 'data' => $naDtel]);
                    
                }else{
                    return Json(['code' => -2 , 'msg' => '验证码不存在']); 
                }
            }
        }
        
        
        //获取验证码操作
        public function vecode()
        {
            if(request()->isAjax()){
                $naDyzm = input('post.naDyzm');
                $naDtel = input('post.naDtel');
                
                if($naDyzm == '8dTe'){
                    $randomNumber = str_pad(mt_rand(10, 999999), 6, "0", STR_PAD_BOTH);

                    if(!empty($randomNumber)){
                        $redis = new \Redis();
                        $redis->connect('127.0.0.1','6379');
                        $redis->auth('520111');                 //连接密码
                        $redis->select(5);                      //选择redis数据库
                        
                        $countDown = $randomNumber . 'lumme';  
                        
                        $redis->set($naDtel,$randomNumber);
                        $redis->EXPIRE($naDtel,300);
                        
                        $redis->set($countDown,'cz');
                        $coutxn = $redis->EXPIRE($countDown,60);          //验证码发送成功，多少秒后重发
                        
                        $an = sendTemplateSMS($naDtel,array($randomNumber,5),1);
                        if($an == '2003T'){
                            return Json(['code' => 1 , 'msg' => $coutxn]);
                        }else{
                            return Json(['code' => -3 , 'msg' => 'result error!']);
                        }
                       
                    }else{
                        return Json(['code' => -1 , 'msg' => 'unable to parse error!']);
                    }
                } 
            }
        }
        
        
        //退出登录
        /*
         *  作者：欧阳磊
         *  审：李昊枕
         *  时间：2020-09-04
         */
        public function logout(){
            Session::delete('phone');
            $this->redirect(url('index/index'));
        }
    }
