<?php
namespace app\admin\model;
use think\Model;

//菜单节点
class NodeModel extends Model{
     protected $table = "brary_node";
    
    //获取菜单
    public function getmenu($nodestr=""){
        if($nodestr=="#"){  //是超级管理员
            $where="is_menu=2";
            
        }else{
            //普通管理员,财务，员工
            $where="is_menu=2 and id in (".$nodestr.")";
        }
        
        $menu=db("node")->where($where)->select();
        
        //菜单整理（父菜单和子菜单要有层级关系）
        $parent=array();   //父节点
        $child=array();   //子节点
        
        //把父菜单和子菜单分别存到两个数组里面了
        foreach($menu as $key=>$value){
            if($value['parentid']==0){   //父亲
                $value['href']='#';
                $parent[]=$value;
            }else{
                //孩子
                $value['href']=url($value['control_name'].'/'.$value['action_name']);
                $child[]=$value;
                
            }
        }
        
        
        //把子菜单放到父亲菜单下面的child元素下面去
        foreach($parent as $key=>$value){
            foreach($child as $k=>$v){
                if($value['id']==$v['parentid']){
                    //是父子关系
                    $parent[$key]['child'][]=$v;
                    
                }
                
            }
            
        }
        return $parent;  
    }
    
    
    /********  权限分配  ******/
    
    /**
     * 获取节点数据
     */
    public function getNodeInfo($id){
        
        $result = $this->field('id,nodename,parentid')->select();
        $str = "";
        
        
        $RoleModel = new RoleModel();
        $rule = $RoleModel->getRuleById($id);
        
        
        if(!empty($rule)){
            $rule = explode(',', $rule);
        }
        foreach($result as $key=>$vo){
            $str .= '{ "id": "' . $vo['id'] . '", "pId":"' . $vo['parentid'] . '", "name":"' . $vo['nodename'].'"';
            
            if(!empty($rule) && in_array($vo['id'], $rule)){
                $str .= ' ,"checked":1';
            }
            
            $str .= '},';
            
        }
        
        return "[" . substr($str, 0, -1) . "]";
    }
    
    
    
    
    
    
    
    
}
