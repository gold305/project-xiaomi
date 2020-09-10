<?php 
    namespace app\admin\controller;

    use think\Controller;
    use app\admin\model\UserleModel;
    
    class Userle extends Controller
    {
        //查询用户信息
        /*
         *  作者：李昊枕
         *  审：李昊枕
         *  时间：2020-09-08
         */
        public function index(){
            if(request()->isAjax()){
                $user = input('post.user');
                $pageNumber = empty(input('post.page')) ? 1 : input('post.page');        //当前第几页
                $top = input('post.top');                                                //上一页
                $bottom = input('post.bottom');                                          //下一页
                
                if(!empty($top)){
                    $pageNu = $pageNumber - $top;
                }else{
                    $pageNu = $pageNumber + $bottom;
                }
               
                //判断是否接收到值，没有值返回空数组
                if(!empty($user)){
                    $sent = new UserleModel();
                    
                    $pageSize = 10;
                    $fe = ($pageNu - 1) * $pageSize;
                    $limit = "$fe , $pageSize";
                    
                    $where = [
                        'username' => ["like","%$user%"]
                    ];
                    
                    $sel = $sent->showfan($where,$limit);

                    $sels = $sent->countfan($where);
                    
                    $count = count($sels);
                    $yei = ceil($count / $pageSize);
                 
                    
                    return Json(['code' => 1 , 'data' => $sel , 'datas' => $yei , 'msg' => $pageNu ]);
                }else{
                    return Json(['code' => -1 , 'data' => [] ]);
                }
            }
            return $this->fetch('user/index');
        }
        
        //查询用户信息跳转用户详情与编辑
        public function xiangqing(){
            return $this->fetch('user/xiangqing');
        }
    }