<?php
namespace app\admin\model;

use think\Model;

/*登录后台的所有管理员，财务，员工 用户表*/
class UserModel extends Model{
    protected $table = 'brary_user';
    
    /**
     * 根据搜索条件获取用户列表信息
     * @param $where
     * @param $offset
     * @param $limit
     */
    public function getUsersByWhere($where, $offset, $limit){
        return $this->field('admin_user.*,rolename')
        ->join('admin_role', 'admin_user.typeid = admin_role.id','left')
        ->where($where)->limit($offset, $limit)->order('id desc')->select();
    }
    
    
    /**
     * 根据搜索条件获取所有的用户数量
     * @param $where
     */
    public function getAllUsers($where){
        return $this->where($where)->count();
    }
    
    
    /**
     * 插入管理员信息
     * @param $param
     */
    public function insertUser($param){
        try{
            //插入之前先验证管理员是否已经存在
            $hasUser = $this->where('username',$param['username'])->count();
            if($hasUser<1){
                $result =  $this->insert($param);
            }else{
                return ['code' => -3, 'data' => '', 'msg' => '管理员已存在'];
            }
            
            if(false === $result){
                // 验证失败 输出错误信息
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                
                return ['code' => 1, 'data' => '', 'msg' => '添加用户成功'];
            }
        }catch( PDOException $e){
            
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    
    
    
    /**
     * 删除管理员
     * @param $id
     */
    public function delUser($id){
        try{
            
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除用户成功'];
            
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    
    
    /**
     * 根据管理员id获取角色信息
     * @param $id
     */
    public function getOneUser($id){
        return $this->where('id', $id)->find();
    }
    
    
    /**
     * 获取所有用户
     */
    public function getAllUser(){
        return $this->select();
    }
    
    
    /**
     * 编辑管理员信息
     * @param $param
     */
    public function editUser($param){
        try{
            $result =  $this->save($param, ['id' => $param['id']]);
            if(false === $result){
                // 验证失败 输出错误信息
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                
                return ['code' => 1, 'data' => '', 'msg' => '编辑用户成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
        
    }
    
    /**
     * 校验旧密码
     * @author hugo
     * @time 2019-11-11
     */
    public function checkOldPass($userId,$data){
        $where = [
            'id' => ['eq',$userId],
            'password' => ['eq',md5($data['userpassword'])]
        ];
        
        $res = $this->where($where)->find();
        
        $ressult = is_null($res) ? 0 : 1;
        return $ressult;
    }
    
    /**
     * 修改用户密码
     * @author hugo
     * @time 2019-11-11
     */
    public function updatepass($userId,$data){
        $where = [
            'id' => ['eq',$userId]
        ];
        $update = [
            'password' => md5($data['newpassword'])
        ];
        
        return $this->where($where)->update($update);
    }
    
    
    
    
    
    
    
    
    
    
}