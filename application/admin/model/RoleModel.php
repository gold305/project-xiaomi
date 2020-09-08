<?php
namespace app\admin\model;
use think\Model;

/*角色表*/
class RoleModel extends Model{
    protected  $table = 'brary_role';
    
    /**
     * 获取角色信息(多表查询，做权限树)
     * @param $id
     */
    public function getRoleInfo($id){
        
        $info = db('role')->where('id', $id)->find();
        if("#" == $info['rule']){
            $where = '1=1';
        }else{
            $where = 'id in('.$info['rule'].')';
        }
        $res = db('node')->field('control_name,action_name')->where($where)->select();
        $arr=array();
        foreach($res as $key=>$vo){
                $arr[] = $vo['control_name'] . '/' . $vo['action_name'];
        }
        
        $info['action']=$arr;
        return $info;
    }
    
    
    /**
     * 根据搜索条件获取角色列表信息
     * @param $where.
     * @param $offset
     * @param $limit
     */
    public function getRoleByWhere($where, $offset, $limit){
        
        return $this->where($where)->limit($offset, $limit)->order('id desc')->select();
    }
    
    
    /**
     * 根据搜索条件获取所有的角色数量
     * @param $where
     */
    public function getAllRole($where){
        return $this->where($where)->count();
    }
    
    
    /**
     * 插入角色信息
     * @param $param
     */
    public function insertRole($param){
        try{
            //先验证此角色是否已经存在
            $hasRole = $this->where('rolename',$param['rolename'])->count();
            if($hasRole<1){
                $result =  $this->save($param);
            }else{
                return ['code' => -3, 'data' => '', 'msg' => '角色已存在'];
            }
           
            if(false === $result){
                // 验证失败 输出错误信息
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                
                return ['code' => 1, 'data' => '', 'msg' => '添加角色成功'];
            }
        }catch( PDOException $e){
            
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    
    
    /**
     * 删除角色
     * @param $id
     */
    public function delRole($id){
        try{
            
            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除角色成功'];
            
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    
    
    /**
     * 编辑角色信息
     * @param $param
     */
    public function editRole($param){
        try{
            $result =  $this->validate('RoleValidate')->save($param, ['id' => $param['id']]);
            
            if(false === $result){
                // 验证失败 输出错误信息
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑角色成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    
    /**
     * 根据角色id获取角色信息
     * @param $id
     */
    public function getOneRole($id){
        return $this->where('id', $id)->find();
    }
    
    
    /**********权限分配***********/
    
    /**
     * 获取角色的权限节点
     */
    public function getRuleById($id){
        $res = $this->field('rule')->where('id', $id)->find();
        
        return $res['rule'];
    }
    
    
    /**
     * 分配权限
     * @param $param
     */
    public function editAccess($param){
        try{
            $this->save($param, ['id' => $param['id']]);
            return ['code' => 1, 'data' => '', 'msg' => '分配权限成功'];
            
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
    

    /**
     * 获取所有的角色信息
     */
    public function getRole($where=""){
        return $this->where($where)->select();
    }
    
    
    
}